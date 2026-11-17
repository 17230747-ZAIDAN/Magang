<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::latest();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('category', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $news = $query->paginate(10)->withQueryString();
        $categories = ['Umum', 'Legislasi', 'Pengawasan', 'Anggaran', 'Kegiatan Dewan', 'Fraksi'];

        return view('v_admin.berita.index', compact('news', 'categories'));
    }

    public function create()
    {
        $categories = ['Umum', 'Legislasi', 'Pengawasan', 'Anggaran', 'Kegiatan Dewan', 'Fraksi'];
        return view('v_admin.berita.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'author' => 'nullable|string|max:100',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_featured' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . Str::slug(Str::limit($request->title, 20)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/news'), $fileName);
            $imagePath = 'uploads/news/' . $fileName;
        }

        News::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']) . '-' . Str::random(5),
            'category' => $validated['category'],
            'author' => $validated['author'] ?? auth()->user()->name,
            'excerpt' => $validated['excerpt'] ?? Str::limit(strip_tags($validated['content']), 150),
            'content' => $validated['content'],
            'image' => $imagePath,
            'is_featured' => $request->has('is_featured'),
            'published_at' => $validated['published_at'] ?? now(),
        ]);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(News $berita)
    {
        $categories = ['Umum', 'Legislasi', 'Pengawasan', 'Anggaran', 'Kegiatan Dewan', 'Fraksi'];
        return view('v_admin.berita.edit', compact('berita', 'categories'));
    }

    public function update(Request $request, News $berita)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'author' => 'nullable|string|max:100',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_featured' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);

        $imagePath = $berita->image;
        if ($request->hasFile('image')) {
            // Delete old file if exists
            if ($berita->image && File::exists(public_path($berita->image))) {
                File::delete(public_path($berita->image));
            }

            $file = $request->file('image');
            $fileName = time() . '_' . Str::slug(Str::limit($request->title, 20)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/news'), $fileName);
            $imagePath = 'uploads/news/' . $fileName;
        }

        $berita->update([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'author' => $validated['author'] ?? $berita->author,
            'excerpt' => $validated['excerpt'] ?? Str::limit(strip_tags($validated['content']), 150),
            'content' => $validated['content'],
            'image' => $imagePath,
            'is_featured' => $request->has('is_featured'),
            'published_at' => $validated['published_at'] ?? $berita->published_at,
        ]);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(News $berita)
    {
        if ($berita->image && File::exists(public_path($berita->image))) {
            File::delete(public_path($berita->image));
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }
}
