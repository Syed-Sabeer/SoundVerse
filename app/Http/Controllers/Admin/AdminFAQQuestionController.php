<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FAQQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminFAQQuestionController extends Controller
{
    /**
     * Display a listing of FAQ Questions
     */
    public function index()
    {
        $faqQuestions = FAQQuestion::orderBy('created_at', 'desc')->get();
        return view('admin.crud.faq-questions.index', compact('faqQuestions'));
    }

    /**
     * Show the form for creating a new FAQ Question
     */
    public function create()
    {
        return view('admin.crud.faq-questions.add');
    }

    /**
     * Store a newly created FAQ Question
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'question' => 'required|string',
                'answer' => 'required|string',
                'keywords' => 'required|string',
                'is_active' => 'nullable|boolean',
            ]);

            $faqQuestion = FAQQuestion::create([
                'question' => $request->question,
                'answer' => $request->answer,
                'keywords' => $request->keywords,
                'is_active' => $request->has('is_active') ? 1 : 0,
            ]);

            Log::info('FAQ Question created successfully:', ['id' => $faqQuestion->id]);

            return redirect()->route('admin.faq-question.index')->with('success', 'Chatbot QnA added successfully.');
        } catch (\Exception $e) {
            Log::error('Error while creating FAQ Question:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for editing the specified FAQ Question
     */
    public function edit($id)
    {
        $faqQuestion = FAQQuestion::findOrFail($id);
        return view('admin.crud.faq-questions.edit', compact('faqQuestion'));
    }

    /**
     * Update the specified FAQ Question
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'question' => 'required|string',
                'answer' => 'required|string',
                'keywords' => 'required|string',
                'is_active' => 'nullable|boolean',
            ]);

            $faqQuestion = FAQQuestion::findOrFail($id);
            $faqQuestion->update([
                'question' => $request->question,
                'answer' => $request->answer,
                'keywords' => $request->keywords,
                'is_active' => $request->has('is_active') ? 1 : 0,
            ]);

            Log::info('FAQ Question updated successfully:', ['id' => $faqQuestion->id]);

            return redirect()->route('admin.faq-question.index')->with('success', 'Chatbot QnA updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error while updating FAQ Question:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified FAQ Question
     */
    public function destroy($id)
    {
        try {
            $faqQuestion = FAQQuestion::findOrFail($id);
            $faqQuestion->delete();

            Log::info('FAQ Question deleted successfully:', ['id' => $id]);

            return redirect()->route('admin.faq-question.index')->with('success', 'Chatbot QnA deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error while deleting FAQ Question:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors('Could not delete Chatbot QnA.');
        }
    }

    /**
     * Toggle the active status of FAQ Question
     */
    public function toggleStatus(Request $request, $id)
    {
        try {
            $faqQuestion = FAQQuestion::findOrFail($id);
            $faqQuestion->is_active = $faqQuestion->is_active ? 0 : 1;
            $faqQuestion->save();

            Log::info('FAQ Question status toggled:', ['id' => $id, 'status' => $faqQuestion->is_active]);

            return redirect()->route('admin.faq-question.index')->with('success', 'Chatbot QnA status updated successfully.');
        } catch (\Exception $e) {
            Log::error('FAQ Question status toggle error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors('Could not update Chatbot QnA status.');
        }
    }
}
