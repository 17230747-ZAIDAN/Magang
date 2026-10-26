<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Member;
use App\Models\Document;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display search results
     */
    public function index(Request $request)
    {
        $query = $request->input('q', '');
        
        if (empty($query)) {
            return redirect()->route('beranda');
        }

        // Search in news
        $news = News::published()
            ->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('content', 'like', "%{$query}%")
                  ->orWhere('excerpt', 'like', "%{$query}%");
            })
            ->latest('published_at')
            ->take(10)
            ->get();

        // Search in members
        $members = Member::active()
            ->where(function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('party', 'like', "%{$query}%")
                  ->orWhere('electoral_district', 'like', "%{$query}%")
                  ->orWhere('province', 'like', "%{$query}%")
                  ->orWhere('commission', 'like', "%{$query}%");
            })
            ->take(10)
            ->get();

        // Search in documents
        $documents = Document::published()
            ->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%")
                  ->orWhere('number', 'like', "%{$query}%");
            })
            ->latest('published_at')
            ->take(10)
            ->get();

        $totalResults = $news->count() + $members->count() + $documents->count();

        return view('v_search.index', compact('query', 'news', 'members', 'documents', 'totalResults'));
    }
}
