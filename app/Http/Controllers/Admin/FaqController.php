<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    // Public FAQ page
    public function publicIndex()
    {
        try {
            // Tampilkan hanya FAQ yang aktif (status = 1), urutkan terbaru
            $faqs = \App\Models\Faq::where('status', 1)
                ->orderBy('created_at', 'asc')
                ->select('id', 'question', 'answer', 'status', 'created_at')
                ->paginate(10);
            
            return view('faq.index', compact('faqs'));
        } catch (\Exception $e) {
            \Log::error('Error in FAQ publicIndex: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            return view('faq.index', ['faqs' => new \Illuminate\Support\Collection()]);
        }
    }

    public function index()
    {
        $faqs = Faq::paginate(10); // Pastikan pakai paginate
        return view('admin.faq.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faq.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'status' => 'boolean'
        ]);

        Faq::create($validated);
        return redirect()->route('admin.faq.index')->with('success', 'FAQ created successfully');
    }

    public function edit(Faq $faq)
    {
        return view('admin.faq.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faqs)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'status' => 'boolean'
        ]);

        $faqs->update($validated);
        return redirect()->route('admin.faq.index')->with('success', 'FAQ updated successfully');
    }

    public function destroy(Faq $faqs)
    {
        $faqs->delete();
        return redirect()->route('admin.faq.index')->with('success', 'FAQ deleted successfully');
    }
}