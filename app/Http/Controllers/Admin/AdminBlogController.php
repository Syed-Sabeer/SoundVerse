<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminBlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return view('admin.crud.blogs.index', compact('blogs'));
    }

    public function add()
    {
        return view('admin.crud.blogs.add');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'tags' => 'nullable|string|max:255',
                'category' => 'nullable|string|max:255',
                'min_read' => 'nullable|string|max:255',
                'visibility' => 'nullable|integer',
            ]);

            $validatedData = $request->only(['title', 'content', 'tags', 'min_read', 'visibility', 'category']);

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('uploads', $imageName, 'public');
                $validatedData['image'] = $imagePath;
            }

            Log::info('Validated Blog data:', $validatedData);

            $blog = Blog::create([
                'title' => $validatedData['title'],
                'content' => $validatedData['content'],
                'image' => $validatedData['image'] ?? null,
                'tags' => $validatedData['tags'] ?? null,
                'category' => $validatedData['category'] ?? null,
                'min_read' => $validatedData['min_read'] ?? null,
                'visibility' => $validatedData['visibility'] ?? 1,
            ]);

            Log::info('Blog created successfully:', ['id' => $blog->id]);

            return redirect()->route('admin.blog.index')->with('success', 'Blog added successfully.');
        } catch (\Exception $e) {
            Log::error('Error while creating blog:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.crud.blogs.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'tags' => 'nullable|string|max:255',
                'category' => 'nullable|string|max:255',
                'min_read' => 'nullable|string|max:255',
                'visibility' => 'nullable|integer',
            ]);

            $blog = Blog::findOrFail($id);
            $updateData = [
                'title' => $request->title,
                'content' => $request->content,
                'tags' => $request->tags,
                'category' => $request->category,
                'min_read' => $request->min_read,
                'visibility' => $request->visibility ?? 1,
            ];

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($blog->image && Storage::disk('public')->exists($blog->image)) {
                    Storage::disk('public')->delete($blog->image);
                }

                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('uploads', $imageName, 'public');
                $updateData['image'] = $imagePath;
            }

            $blog->update($updateData);

            return redirect()->route('admin.blog.index')->with('success', 'Blog updated successfully.');
        } catch (\Exception $e) {
            Log::error('Blog update error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $blog = Blog::findOrFail($id);

            // Delete image if exists
            if ($blog->image && Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }

            $blog->delete();
            return redirect()->route('admin.blog.index')->with('success', 'Blog deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Blog delete error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors('Could not delete blog.');
        }
    }

    public function toggleVisibility(Request $request, $id)
    {
        try {
            $blog = Blog::findOrFail($id);
            // Toggle the visibility: if it's 1, make it 0; if it's 0, make it 1
            $blog->visibility = $blog->visibility ? 0 : 1;
            $blog->save();
            
            return redirect()->route('admin.blog.index')->with('success', 'Blog visibility updated successfully.');
        } catch (\Exception $e) {
            Log::error('Blog visibility toggle error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors('Could not update blog visibility.');
        }
    }
}
