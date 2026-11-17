<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $query = Document::latest('published_at');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('number', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $documents = $query->paginate(10)->withQueryString();
        $types = ['Peraturan Daerah', 'Keputusan DPRD', 'Risalah Sidang', 'Laporan Kinerja', 'Naskah Akademik', 'Lainnya'];

        return view('v_admin.dokumen.index', compact('documents', 'types'));
    }

    public function create()
    {
        $types = ['Peraturan Daerah', 'Keputusan DPRD', 'Risalah Sidang', 'Laporan Kinerja', 'Naskah Akademik', 'Lainnya'];
        return view('v_admin.dokumen.create', compact('types'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'number' => 'nullable|string|max:100',
            'year' => 'nullable|integer',
            'document_date' => 'nullable|date',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
            'file_url' => 'nullable|url|max:255',
        ]);

        $filePath = null;
        $fileSize = null;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . Str::slug(Str::limit($request->title, 20)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/documents'), $fileName);
            $filePath = 'uploads/documents/' . $fileName;
            $fileSize = $file->getSize();
        }

        Document::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']) . '-' . Str::random(5),
            'type' => $validated['type'],
            'number' => $validated['number'],
            'year' => $validated['year'] ?? date('Y'),
            'document_date' => $validated['document_date'] ?? now(),
            'description' => $validated['description'],
            'file_path' => $filePath,
            'file_url' => $validated['file_url'],
            'file_size' => $fileSize,
            'published_at' => now(),
        ]);

        return redirect()->route('admin.dokumen.index')
            ->with('success', 'Dokumen berhasil ditambahkan.');
    }

    public function edit(Document $dokumen)
    {
        $types = ['Peraturan Daerah', 'Keputusan DPRD', 'Risalah Sidang', 'Laporan Kinerja', 'Naskah Akademik', 'Lainnya'];
        return view('v_admin.dokumen.edit', compact('dokumen', 'types'));
    }

    public function update(Request $request, Document $dokumen)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'number' => 'nullable|string|max:100',
            'year' => 'nullable|integer',
            'document_date' => 'nullable|date',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
            'file_url' => 'nullable|url|max:255',
        ]);

        $filePath = $dokumen->file_path;
        $fileSize = $dokumen->file_size;

        if ($request->hasFile('file')) {
            if ($dokumen->file_path && File::exists(public_path($dokumen->file_path))) {
                File::delete(public_path($dokumen->file_path));
            }
            $file = $request->file('file');
            $fileName = time() . '_' . Str::slug(Str::limit($request->title, 20)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/documents'), $fileName);
            $filePath = 'uploads/documents/' . $fileName;
            $fileSize = $file->getSize();
        }

        $dokumen->update([
            'title' => $validated['title'],
            'type' => $validated['type'],
            'number' => $validated['number'],
            'year' => $validated['year'] ?? $dokumen->year,
            'document_date' => $validated['document_date'] ?? $dokumen->document_date,
            'description' => $validated['description'],
            'file_path' => $filePath,
            'file_url' => $validated['file_url'],
            'file_size' => $fileSize,
        ]);

        return redirect()->route('admin.dokumen.index')
            ->with('success', 'Dokumen berhasil diperbarui.');
    }

    public function destroy(Document $dokumen)
    {
        if ($dokumen->file_path && File::exists(public_path($dokumen->file_path))) {
            File::delete(public_path($dokumen->file_path));
        }

        $dokumen->delete();

        return redirect()->route('admin.dokumen.index')
            ->with('success', 'Dokumen berhasil dihapus.');
    }
}
