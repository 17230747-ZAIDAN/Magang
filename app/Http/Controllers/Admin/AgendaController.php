<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index(Request $request)
    {
        $query = Agenda::latest('start_time');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $agendas = $query->paginate(10)->withQueryString();
        return view('v_admin.agenda.index', compact('agendas'));
    }

    public function create()
    {
        $types = ['Sidang Paripurna', 'Rapat Komisi', 'Rapat Dengar Pendapat', 'Kunjungan Kerja', 'Sosialisasi'];
        return view('v_admin.agenda.create', compact('types'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'location' => 'nullable|string|max:255',
            'commission' => 'nullable|string|max:100',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
            'status' => 'required|in:scheduled,ongoing,completed,cancelled',
            'description' => 'nullable|string',
            'note' => 'nullable|string',
        ]);

        Agenda::create($validated);

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda berhasil ditambahkan.');
    }

    public function edit(Agenda $agenda)
    {
        $types = ['Sidang Paripurna', 'Rapat Komisi', 'Rapat Dengar Pendapat', 'Kunjungan Kerja', 'Sosialisasi'];
        return view('v_admin.agenda.edit', compact('agenda', 'types'));
    }

    public function update(Request $request, Agenda $agenda)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'location' => 'nullable|string|max:255',
            'commission' => 'nullable|string|max:100',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
            'status' => 'required|in:scheduled,ongoing,completed,cancelled',
            'description' => 'nullable|string',
            'note' => 'nullable|string',
        ]);

        $agenda->update($validated);

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda berhasil diperbarui.');
    }

    public function destroy(Agenda $agenda)
    {
        $agenda->delete();
        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda berhasil dihapus.');
    }
}
