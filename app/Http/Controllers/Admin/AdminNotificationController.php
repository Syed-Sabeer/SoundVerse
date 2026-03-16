<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NotificationTemplate;
use App\Models\NotificationLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminNotificationController extends Controller
{
    public function templates(Request $request)
    {
        $query = NotificationTemplate::query();

        if ($request->filled('event_type')) {
            $query->where('event_type', $request->event_type);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $templates = $query->latest()->paginate(20);

        return view('admin.notifications.templates', compact('templates'));
    }

    public function createTemplate()
    {
        return view('admin.notifications.create-template');
    }

    public function storeTemplate(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:email,push,sms,all',
            'event_type' => 'required|string|max:100',
            'subject' => 'nullable|string|max:255',
            'body' => 'required|string',
            'variables' => 'nullable|json',
            'is_active' => 'boolean',
        ]);

        $validated['created_by'] = auth()->id();
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        NotificationTemplate::create($validated);

        return redirect()->route('admin.notifications.templates')
            ->with('success', 'Notification template created successfully.');
    }

    public function editTemplate($id)
    {
        $template = NotificationTemplate::findOrFail($id);
        return view('admin.notifications.edit-template', compact('template'));
    }

    public function updateTemplate($id, Request $request)
    {
        $template = NotificationTemplate::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:email,push,sms,all',
            'event_type' => 'required|string|max:100',
            'subject' => 'nullable|string|max:255',
            'body' => 'required|string',
            'variables' => 'nullable|json',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        $template->update($validated);

        return redirect()->route('admin.notifications.templates')
            ->with('success', 'Notification template updated successfully.');
    }

    public function logs(Request $request)
    {
        $query = NotificationLog::with(['user', 'template']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('event_type')) {
            $query->where('event_type', $request->event_type);
        }

        if ($request->filled('notification_type')) {
            $query->where('notification_type', $request->notification_type);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        $logs = $query->latest()->paginate(50);

        // Statistics
        $totalSent = NotificationLog::where('status', 'sent')->count();
        $totalDelivered = NotificationLog::where('status', 'delivered')->count();
        $totalFailed = NotificationLog::where('status', 'failed')->count();

        return view('admin.notifications.logs', compact('logs', 'totalSent', 'totalDelivered', 'totalFailed'));
    }

    public function deleteTemplate($id)
    {
        $template = NotificationTemplate::findOrFail($id);
        $template->delete();

        return back()->with('success', 'Template deleted successfully.');
    }
}
