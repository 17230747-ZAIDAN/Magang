<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Member;
use App\Models\Document;
use App\Models\Agenda;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    /**
     * Display the home page
     */
    public function index()
    {
        // Featured news (4 items)
        $featuredNews = News::published()
            ->featured()
            ->latest('published_at')
            ->take(4)
            ->get();

        // Latest news (6 items)
        $latestNews = News::published()
            ->latest('published_at')
            ->take(6)
            ->get();

        // Latest documents (5 items)
        $latestDocuments = Document::published()
            ->latest('published_at')
            ->take(5)
            ->get();

        // Today's agenda
        $todayAgendas = Agenda::today()
            ->byStatus('scheduled')
            ->orWhere(function($query) {
                $query->today()->byStatus('ongoing');
            })
            ->orderBy('start_time', 'asc')
            ->take(5)
            ->get();

        // Statistics for Tugas dan Fungsi section
        $statistics = [
            'legislasi' => [
                'ruu_selesai' => 6,
                'ruu_proses' => 12,
                'total_uu' => 450
            ],
            'anggaran' => [
                'apbn_tahun_ini' => '3.000 T',
                'realisasi' => '65%',
                'perubahan_apbn' => 3
            ],
            'pengawasan' => [
                'rapat_dengar' => 24,
                'laporan_pemerintah' => 18,
                'rekomendasi' => 45
            ],
            'diplomasi' => [
                'kunjungan_luar' => 8,
                'pertemuan_bilateral' => 15,
                'forum_internasional' => 6
            ]
        ];

        return view('v_beranda.index', compact(
            'featuredNews',
            'latestNews',
            'latestDocuments',
            'todayAgendas',
            'statistics'
        ));
    }
}
