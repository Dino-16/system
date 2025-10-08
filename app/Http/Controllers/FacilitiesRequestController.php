<?php

namespace App\Http\Controllers;

use App\Models\FacilitiesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FacilitiesRequestController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required','string','max:255'],
            'file' => ['nullable','file','max:10240'], // 10MB
            'category_id' => ['nullable','string','max:255'],
            'new_category' => ['nullable','string','max:255'],
            'description' => ['nullable','string'],
        ]);

        $category = $validated['new_category'] ?? $validated['category_id'] ?? null;

        $path = null;
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('facilities_requests', 'public');
        }

        FacilitiesRequest::create([
            'title' => $validated['title'],
            'file_path' => $path,
            'category' => $category,
            'description' => $validated['description'] ?? null,
            'requested_by' => Auth::id(),
            'status' => 'Pending',
        ]);

        return back()->with('success', 'Request submitted successfully.');
    }
}
