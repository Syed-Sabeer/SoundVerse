<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminContactPageController extends Controller
{
    public function index()
    {
        $contact = \App\Models\Contact::first();

        return view('admin.cms.contact.index', compact('contact'));
    }

    /**
     * Update contact section.
     */
    public function updateContact(\Illuminate\Http\Request $request)
    {
        \Log::info('updateContact called', ['request' => $request->except(['contact_image'])]);
        try {
            // Contact Section
            $contact = \App\Models\Contact::firstOrCreate([], []);
            $contact->update([
                'contact_heading' => $request->input('contact_heading'),
                'contact_subheading' => $request->input('contact_subheading'),
                'contact_email' => $request->input('contact_email'),
                'contact_call' => $request->input('contact_call'),
                'contact_visit' => $request->input('contact_visit'),
                'contact_map_heading' => $request->input('contact_map_heading'),
                'contact_map_link' => $request->input('contact_map_link'),
            ]);
            \Log::info('Contact section updated', ['contact' => $request->only(['contact_heading', 'contact_subheading', 'contact_email', 'contact_call', 'contact_visit', 'contact_map_heading', 'contact_map_link'])]);

            \Log::info('Contact section updated successfully');
            return redirect()->route('admin.contact.index')->with('success', 'Contact section updated successfully.');
        } catch (\Throwable $e) {
            \Log::error('Error updating contact section', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return back()->with('error', 'Failed to update contact section.');
        }
    }
}
