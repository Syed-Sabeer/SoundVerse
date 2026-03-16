<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
    public function index()
    {
        $contacts = \App\Models\ContactSubmission::all();

        return view('admin.submissions.contact.index', compact('contacts'));
    }
public function destroy($id)
{
    $contact = \App\Models\ContactSubmission::findOrFail($id);
    $contact->delete();

    return redirect()->back()->with('success', 'Contact deleted successfully.');
}


}
