<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of news
     */
    public function index(Request $request)
    {
        $query = News::published()->latest('published_at');

        // Filter by category if provided
        if ($request->has('category') && $request->category != '') {
            $query->byCategory($request->category);
        }

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        $news = $query->paginate(12);

        // Get available categories for filter
        $categories = News::published()
            ->distinct()
            ->pluck('category')
            ->sort();

        return view('v_berita.index', compact('news', 'categories'));
    }

    /**
     * Display the specified news
     */
    public function show($slug)
    {
        $news = News::published()
            ->where('slug', $slug)
            ->firstOrFail();

        // Increment views
        $news->incrementViews();

        // Related news (same category, exclude current)
        $relatedNews = News::published()
            ->byCategory($news->category)
            ->where('id', '!=', $news->id)
            ->latest('published_at')
            ->take(4)
            ->get();

        // Latest news for sidebar
        $latestNews = News::published()
            ->where('id', '!=', $news->id)
            ->latest('published_at')
            ->take(5)
            ->get();

        return view('v_berita.show', compact('news', 'relatedNews', 'latestNews'));
    }

    /**
     * Display news by category
     */
    public function category($category)
    {
        $news = News::published()
            ->byCategory($category)
            ->latest('published_at')
            ->paginate(12);

        // Get available categories for filter
        $categories = News::published()
            ->distinct()
            ->pluck('category')
            ->sort();

        return view('v_berita.index', compact('news', 'categories', 'category'));
    }
}
