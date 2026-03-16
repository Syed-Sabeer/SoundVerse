<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use App\Models\Comment;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
public function index(Request $request)
{
    $query = Blog::query();


    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where('title', 'like', "%{$search}%")
            //   ->orWhere('description', 'like', "%{$search}%")
              ;
    }
$latestBlogs = \App\Models\Blog::withCount('comments')
    ->latest()
    ->take(5)
    ->get();

    $blogs = $query->latest()->paginate(6)->withQueryString();

    return view("frontend.blog", compact('blogs','latestBlogs'));
}


    public function detail($slug){
        $blog = Blog::with('comments')->where('slug',$slug)->first();
        if (!$blog) {
            Log::error("Blog not found for slug: $slug");
            abort(404, 'Blog not found');
        }

        // Debug logging
        Log::info("Blog detail loaded", [
            'blog_id' => $blog->id,
            'blog_title' => $blog->title,
            'comments_count' => $blog->comments->count()
        ]);

        return view("frontend.blogdetail", compact('blog'));
    }

    public function commentStore(Request $request){
        Log::info('Comment submission attempt', $request->all());

        $data = request()->validate([
            'blog_id' => 'required|exists:blogs,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'comment' => 'required|string|max:1000',
        ]);

        try {
            $comment = Comment::create($data);
            Log::info('Comment created successfully', ['comment_id' => $comment->id]);
            return redirect()->back()->with('success', 'Comment added successfully.');
        } catch (\Exception $e) {
            Log::error('Error storing comment: '.$e->getMessage(), [
                'data' => $data,
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Failed to add comment. Please try again.')->withInput();
        }
    }

}
