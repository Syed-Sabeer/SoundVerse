<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminNewsletterSubmissionController extends Controller
{
    public function index()
    {
        $newsletters = \App\Models\NewNewsletter::all();

        return view('admin.submissions.newsletters.index', compact('newsletters'));
    }
public function destroy($id)
{
    $newsletter = \App\Models\NewNewsletter::findOrFail($id);
    $newsletter->delete();

    return redirect()->back()->with('success', 'Newsletter deleted successfully.');
}


}
