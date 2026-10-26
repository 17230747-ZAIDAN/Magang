<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Display a listing of documents
     */
    public function index(Request $request)
    {
        $query = Document::published()->latest('published_at');

        // Filter by type
        if ($request->has('type') && $request->type != '') {
            $query->byType($request->type);
        }

        // Filter by year
        if ($request->has('year') && $request->year != '') {
            $query->byYear($request->year);
        }

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('number', 'like', "%{$search}%");
            });
        }

        $documents = $query->paginate(15);

        // Get available types for filter
        $types = Document::published()
            ->distinct()
            ->orderBy('type')
            ->pluck('type');

        // Get available years for filter
        $years = Document::published()
            ->distinct()
            ->whereNotNull('year')
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('v_dokumen.index', compact('documents', 'types', 'years'));
    }

    /**
     * Display the specified document
     */
    public function show($slug)
    {
        $document = Document::published()
            ->where('slug', $slug)
            ->firstOrFail();

        // Related documents (same type, exclude current)
        $relatedDocuments = Document::published()
            ->byType($document->type)
            ->where('id', '!=', $document->id)
            ->latest('published_at')
            ->take(5)
            ->get();

        // Latest documents for sidebar
        $latestDocuments = Document::published()
            ->where('id', '!=', $document->id)
            ->latest('published_at')
            ->take(5)
            ->get();

        return view('v_dokumen.show', compact('document', 'relatedDocuments', 'latestDocuments'));
    }

    /**
     * Download the specified document
     */
    public function download($slug)
    {
        $document = Document::published()
            ->where('slug', $slug)
            ->firstOrFail();

        // Increment downloads counter
        $document->incrementDownloads();

        // Check if file exists locally
        if ($document->file_path && file_exists(public_path($document->file_path))) {
            return response()->download(public_path($document->file_path));
        }

        // If external URL, redirect
        if ($document->file_url) {
            return redirect($document->file_url);
        }

        abort(404, 'File tidak ditemukan');
    }

    /**
     * Display documents by type
     */
    public function byType($type)
    {
        $documents = Document::published()
            ->byType($type)
            ->latest('published_at')
            ->paginate(15);

        // Get available types for filter
        $types = Document::published()
            ->distinct()
            ->orderBy('type')
            ->pluck('type');

        // Get available years for filter
        $years = Document::published()
            ->distinct()
            ->whereNotNull('year')
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('v_dokumen.index', compact('documents', 'types', 'years', 'type'));
    }

    /**
     * Display JDIH page (Jaringan Dokumentasi dan Informasi Hukum)
     */
    public function jdih(Request $request)
    {
        $legalTypes = ['UUD 1945', 'UU', 'PP', 'Perpres', 'Peraturan DPR', 'Peraturan Sekjen'];
        
        $query = Document::published()
            ->whereIn('type', $legalTypes)
            ->latest('published_at');

        // Filter by type
        if ($request->has('type') && $request->type != '') {
            $query->byType($request->type);
        }

        // Filter by year
        if ($request->has('year') && $request->year != '') {
            $query->byYear($request->year);
        }

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('number', 'like', "%{$search}%");
            });
        }

        $documents = $query->paginate(15);

        // Get available years for filter
        $years = Document::published()
            ->whereIn('type', $legalTypes)
            ->distinct()
            ->whereNotNull('year')
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('v_dokumen.jdih', compact('documents', 'legalTypes', 'years'));
    }
}
