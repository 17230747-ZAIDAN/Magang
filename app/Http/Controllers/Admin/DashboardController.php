<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Member;
use App\Models\Document;
use App\Models\Gallery;
use App\Models\Aspiration;
use App\Models\Agenda;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_news' => News::count(),
            'total_members' => Member::count(),
            'total_documents' => Document::count(),
            'total_galleries' => Gallery::count(),
            'total_aspirations' => Aspiration::count(),
            'pending_aspirations' => Aspiration::where('status', 'pending')->count(),
            'total_agendas' => Agenda::count(),
            'total_interns' => User::where('role', 'magang')->count(),
        ];

        $recentNews = News::latest()->take(5)->get();
        $recentAspirations = Aspiration::latest()->take(5)->get();
        $upcomingAgendas = Agenda::where('start_time', '>=', now())
            ->orderBy('start_time', 'asc')
            ->take(5)
            ->get();

        return view('v_admin.dashboard', compact('stats', 'recentNews', 'recentAspirations', 'upcomingAgendas'));
    }
}
