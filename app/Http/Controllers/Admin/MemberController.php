<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $query = Member::orderBy('name', 'asc');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('party', 'like', '%' . $request->search . '%')
                  ->orWhere('commission', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('party')) {
            $query->where('party', $request->party);
        }

        $members = $query->paginate(12)->withQueryString();
        $parties = Member::distinct()->whereNotNull('party')->pluck('party');

        return view('v_admin.anggota.index', compact('members', 'parties'));
    }

    public function create()
    {
        return view('v_admin.anggota.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'party' => 'required|string|max:100',
            'electoral_district' => 'required|string|max:255',
            'position' => 'nullable|string|max:100',
            'commission' => 'nullable|string|max:100',
            'faction' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'education' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:150',
            'phone' => 'nullable|string|max:30',
            'biography' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'nullable|boolean',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = time() . '_' . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/members'), $fileName);
            $photoPath = 'uploads/members/' . $fileName;
        }

        Member::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']) . '-' . Str::random(5),
            'party' => $validated['party'],
            'electoral_district' => $validated['electoral_district'],
            'position' => $validated['position'],
            'commission' => $validated['commission'],
            'faction' => $validated['faction'],
            'province' => $validated['province'] ?? 'Banten',
            'education' => $validated['education'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'biography' => $validated['biography'],
            'photo' => $photoPath,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.anggota.index')
            ->with('success', 'Data anggota dewan berhasil ditambahkan.');
    }

    public function edit(Member $anggota)
    {
        $member = $anggota;
        return view('v_admin.anggota.edit', compact('member'));
    }

    public function update(Request $request, Member $anggota)
    {
        $member = $anggota;
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'party' => 'required|string|max:100',
            'electoral_district' => 'required|string|max:255',
            'position' => 'nullable|string|max:100',
            'commission' => 'nullable|string|max:100',
            'faction' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'education' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:150',
            'phone' => 'nullable|string|max:30',
            'biography' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'nullable|boolean',
        ]);

        $photoPath = $member->photo;
        if ($request->hasFile('photo')) {
            if ($member->photo && File::exists(public_path($member->photo))) {
                File::delete(public_path($member->photo));
            }
            $file = $request->file('photo');
            $fileName = time() . '_' . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/members'), $fileName);
            $photoPath = 'uploads/members/' . $fileName;
        }

        $member->update([
            'name' => $validated['name'],
            'party' => $validated['party'],
            'electoral_district' => $validated['electoral_district'],
            'position' => $validated['position'],
            'commission' => $validated['commission'],
            'faction' => $validated['faction'],
            'province' => $validated['province'] ?? $member->province,
            'education' => $validated['education'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'biography' => $validated['biography'],
            'photo' => $photoPath,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.anggota.index')
            ->with('success', 'Data anggota dewan berhasil diperbarui.');
    }

    public function destroy(Member $anggota)
    {
        if ($anggota->photo && File::exists(public_path($anggota->photo))) {
            File::delete(public_path($anggota->photo));
        }

        $anggota->delete();

        return redirect()->route('admin.anggota.index')
            ->with('success', 'Data anggota dewan berhasil dihapus.');
    }
}
