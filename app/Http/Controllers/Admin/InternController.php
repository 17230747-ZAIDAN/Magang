<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class InternController extends Controller
{
    /**
     * Display a listing of intern accounts
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'magang')->latest();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('institution', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('status')) {
            $isActive = $request->status === 'active';
            $query->where('is_active', $isActive);
        }

        $interns = $query->paginate(10)->withQueryString();

        return view('v_admin.magang.index', compact('interns'));
    }

    /**
     * Show the form for creating a new intern account
     */
    public function create()
    {
        return view('v_admin.magang.create');
    }

    /**
     * Store a newly created intern account
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'institution' => 'required|string|max:255',
            'internship_period' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:25',
        ], [
            'name.required' => 'Nama peserta magang wajib diisi.',
            'email.required' => 'Email login wajib diisi.',
            'email.unique' => 'Email ini sudah terdaftar di sistem.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'institution.required' => 'Asal kampus/instansi magang wajib diisi.',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'magang', // Dikunci khusus untuk akun magang
            'institution' => $validated['institution'],
            'internship_period' => $validated['internship_period'],
            'phone' => $validated['phone'],
            'is_active' => true,
        ]);

        return redirect()->route('admin.magang.index')
            ->with('success', 'Akun magang untuk "' . $validated['name'] . '" berhasil dibuat.');
    }

    /**
     * Show the form for editing an intern account
     */
    public function edit(User $magang)
    {
        if ($magang->role !== 'magang') {
            return redirect()->route('admin.magang.index')
                ->with('error', 'Hanya akun magang yang dapat dikelola di modul ini.');
        }

        return view('v_admin.magang.edit', compact('magang'));
    }

    /**
     * Update the specified intern account
     */
    public function update(Request $request, User $magang)
    {
        if ($magang->role !== 'magang') {
            return redirect()->route('admin.magang.index')
                ->with('error', 'Hanya akun magang yang dapat dikelola di modul ini.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($magang->id)],
            'password' => 'nullable|string|min:6',
            'institution' => 'required|string|max:255',
            'internship_period' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:25',
            'is_active' => 'nullable|boolean',
        ]);

        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'institution' => $validated['institution'],
            'internship_period' => $validated['internship_period'],
            'phone' => $validated['phone'],
            'is_active' => $request->has('is_active'),
        ];

        // Jika password diisi, update password
        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $magang->update($updateData);

        return redirect()->route('admin.magang.index')
            ->with('success', 'Data akun magang berhasil diperbarui.');
    }

    /**
     * Toggle active/inactive status
     */
    public function toggleStatus(User $magang)
    {
        if ($magang->role !== 'magang') {
            return redirect()->route('admin.magang.index');
        }

        $magang->update([
            'is_active' => !$magang->is_active,
        ]);

        $statusMsg = $magang->is_active ? 'diaktifkan kembali' : 'dinonaktifkan';
        return redirect()->route('admin.magang.index')
            ->with('success', 'Akun magang ' . $magang->name . ' berhasil ' . $statusMsg . '.');
    }

    /**
     * Remove the specified intern account
     */
    public function destroy(User $magang)
    {
        if ($magang->role !== 'magang') {
            return redirect()->route('admin.magang.index')
                ->with('error', 'Akun administrator tidak dapat dihapus di sini.');
        }

        $name = $magang->name;
        $magang->delete();

        return redirect()->route('admin.magang.index')
            ->with('success', 'Akun magang "' . $name . '" berhasil dihapus.');
    }
}
