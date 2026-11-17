<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = Gallery::latest();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('category', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $galleries = $query->paginate(12)->withQueryString();
        $categories = ['Kegiatan', 'Sidang Paripurna', 'Rapat Kerja', 'Kunjungan Kerja', 'Sosialisasi'];

        return view('v_admin.galeri.index', compact('galleries', 'categories'));
    }

    public function create()
    {
        $categories = ['Kegiatan', 'Sidang Paripurna', 'Rapat Kerja', 'Kunjungan Kerja', 'Sosialisasi'];
        return view('v_admin.galeri.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'nullable|string',
            'event_date' => 'nullable|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:3072',
        ], [
            'image.required' => 'Foto galeri wajib diunggah.'
        ]);

        $imagePath = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . Str::slug(Str::limit($request->title, 20)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/galleries'), $fileName);
            $imagePath = 'uploads/galleries/' . $fileName;
        }

        Gallery::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']) . '-' . Str::random(5),
            'category' => $validated['category'],
            'description' => $validated['description'],
            'event_date' => $validated['event_date'] ?? now(),
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Foto galeri berhasil ditambahkan.');
    }

    public function edit(Gallery $galeri)
    {
        $categories = ['Kegiatan', 'Sidang Paripurna', 'Rapat Kerja', 'Kunjungan Kerja', 'Sosialisasi'];
        return view('v_admin.galeri.edit', compact('galeri', 'categories'));
    }

    public function update(Request $request, Gallery $galeri)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'nullable|string',
            'event_date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $imagePath = $galeri->image;
        if ($request->hasFile('image')) {
            if ($galeri->image && File::exists(public_path($galeri->image))) {
                File::delete(public_path($galeri->image));
            }
            $file = $request->file('image');
            $fileName = time() . '_' . Str::slug(Str::limit($request->title, 20)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/galleries'), $fileName);
            $imagePath = 'uploads/galleries/' . $fileName;
        }

        $galeri->update([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'event_date' => $validated['event_date'] ?? $galeri->event_date,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Foto galeri berhasil diperbarui.');
    }

    public function destroy(Gallery $galeri)
    {
        if ($galeri->image && File::exists(public_path($galeri->image))) {
            File::delete(public_path($galeri->image));
        }

        $galeri->delete();

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Foto galeri berhasil dihapus.');
    }
}
