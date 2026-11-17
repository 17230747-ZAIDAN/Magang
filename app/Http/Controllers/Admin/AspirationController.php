<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspiration;
use Illuminate\Http\Request;

class AspirationController extends Controller
{
    public function index(Request $request)
    {
        $query = Aspiration::latest();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('subject', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $aspirations = $query->paginate(15)->withQueryString();
        return view('v_admin.aspirasi.index', compact('aspirations'));
    }

    public function show(Aspiration $aspirasi)
    {
        return view('v_admin.aspirasi.show', compact('aspirasi'));
    }

    public function update(Request $request, Aspiration $aspirasi)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,reviewed,responded',
            'response' => 'nullable|string',
        ]);

        $updateData = [
            'status' => $validated['status'],
            'response' => $validated['response'],
        ];

        if ($validated['status'] === 'responded' && empty($aspirasi->responded_at)) {
            $updateData['responded_at'] = now();
        }

        $aspirasi->update($updateData);

        return redirect()->route('admin.aspirasi.show', $aspirasi->id)
            ->with('success', 'Status aspirasi dan tanggapan berhasil disimpan.');
    }

    public function destroy(Aspiration $aspirasi)
    {
        $aspirasi->delete();
        return redirect()->route('admin.aspirasi.index')
            ->with('success', 'Data aspirasi berhasil dihapus.');
    }
}
