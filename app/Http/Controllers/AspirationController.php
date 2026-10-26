<?php

namespace App\Http\Controllers;

use App\Models\Aspiration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AspirationController extends Controller
{
    /**
     * Display the aspiration form
     */
    public function create()
    {
        $categories = [
            'Legislasi',
            'Pengawasan',
            'Anggaran',
            'Diplomasi Parlemen',
            'Umum',
            'Lainnya'
        ];

        return view('v_aspirasi.create', compact('categories'));
    }

    /**
     * Store a new aspiration
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'province' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:20',
            'category' => 'required|string|max:100'
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'subject.required' => 'Subjek wajib diisi',
            'message.required' => 'Pesan aspirasi wajib diisi',
            'message.min' => 'Pesan aspirasi minimal 20 karakter',
            'category.required' => 'Kategori wajib dipilih'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            Aspiration::create($request->all());

            return redirect()
                ->route('aspirasi.success')
                ->with('success', 'Aspirasi Anda berhasil dikirim. Terima kasih atas partisipasi Anda.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat mengirim aspirasi. Silakan coba lagi.')
                ->withInput();
        }
    }

    /**
     * Display success page
     */
    public function success()
    {
        return view('v_aspirasi.success');
    }

    /**
     * Display aspiration tracking form
     */
    public function track()
    {
        return view('v_aspirasi.track');
    }

    /**
     * Check aspiration status
     */
    public function checkStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'subject' => 'required|string'
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'subject.required' => 'Subjek wajib diisi'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $aspirations = Aspiration::where('email', $request->email)
            ->where('subject', 'like', "%{$request->subject}%")
            ->latest()
            ->get();

        if ($aspirations->isEmpty()) {
            return redirect()
                ->back()
                ->with('error', 'Tidak ditemukan aspirasi dengan email dan subjek yang Anda masukkan.')
                ->withInput();
        }

        return view('v_aspirasi.status', compact('aspirations'));
    }
}
