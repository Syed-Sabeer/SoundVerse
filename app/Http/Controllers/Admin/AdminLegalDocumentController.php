<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LegalDocument;
use App\Models\DocumentVersion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminLegalDocumentController extends Controller
{
    public function index()
    {
        $documents = LegalDocument::latest('effective_date')->paginate(20);
        return view('admin.legal-documents.index', compact('documents'));
    }

    public function create()
    {
        return view('admin.legal-documents.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'document_type' => 'required|in:privacy_policy,terms_of_service,user_agreement,artist_agreement,copyright_policy,data_usage_policy,refund_policy,community_guidelines',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'version' => 'required|string|max:50',
            'is_active' => 'boolean',
            'is_required' => 'boolean',
            'effective_date' => 'required|date',
            'expiry_date' => 'nullable|date|after:effective_date',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['created_by'] = auth()->id();
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        $validated['is_required'] = $request->has('is_required') ? 1 : 0;

        $document = LegalDocument::create($validated);

        // Create version history
        DocumentVersion::create([
            'document_id' => $document->id,
            'version' => $validated['version'],
            'content' => $validated['content'],
            'changes_summary' => $request->changes_summary,
            'effective_date' => $validated['effective_date'],
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('admin.legal-documents.index')
            ->with('success', 'Legal document created successfully.');
    }

    public function edit($id)
    {
        $document = LegalDocument::findOrFail($id);
        return view('admin.legal-documents.edit', compact('document'));
    }

    public function update($id, Request $request)
    {
        $document = LegalDocument::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'version' => 'required|string|max:50',
            'is_active' => 'boolean',
            'is_required' => 'boolean',
            'effective_date' => 'required|date',
            'expiry_date' => 'nullable|date|after:effective_date',
            'changes_summary' => 'nullable|string',
        ]);

        $oldVersion = $document->version;
        $validated['updated_by'] = auth()->id();
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        $validated['is_required'] = $request->has('is_required') ? 1 : 0;

        // If version changed, create new version history
        if ($validated['version'] !== $oldVersion || $document->content !== $validated['content']) {
            DocumentVersion::create([
                'document_id' => $document->id,
                'version' => $validated['version'],
                'content' => $validated['content'],
                'changes_summary' => $request->changes_summary,
                'effective_date' => $validated['effective_date'],
                'created_by' => auth()->id(),
            ]);

            // Reset user/artist agreements if required
            if ($document->is_required) {
                // This would trigger notifications to users/artists to accept new version
            }
        }

        $document->update($validated);

        return redirect()->route('admin.legal-documents.index')
            ->with('success', 'Legal document updated successfully.');
    }

    public function versions($id)
    {
        $document = LegalDocument::findOrFail($id);
        $versions = DocumentVersion::where('document_id', $id)
            ->latest('effective_date')
            ->get();

        return view('admin.legal-documents.versions', compact('document', 'versions'));
    }

    public function delete($id)
    {
        $document = LegalDocument::findOrFail($id);
        $document->delete();

        return back()->with('success', 'Legal document deleted successfully.');
    }
}
