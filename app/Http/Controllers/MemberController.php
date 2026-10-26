<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of members
     */
    public function index(Request $request)
    {
        $query = Member::active()->orderBy('name', 'asc');

        // Filter by party
        if ($request->has('party') && $request->party != '') {
            $query->byParty($request->party);
        }

        // Filter by province
        if ($request->has('province') && $request->province != '') {
            $query->byProvince($request->province);
        }

        // Filter by commission
        if ($request->has('commission') && $request->commission != '') {
            $query->byCommission($request->commission);
        }

        // Filter by faction
        if ($request->has('faction') && $request->faction != '') {
            $query->byFaction($request->faction);
        }

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('electoral_district', 'like', "%{$search}%")
                  ->orWhere('province', 'like', "%{$search}%");
            });
        }

        $members = $query->paginate(24);

        // Get filter options
        $parties = Member::active()
            ->distinct()
            ->orderBy('party')
            ->pluck('party');

        $provinces = Member::active()
            ->distinct()
            ->whereNotNull('province')
            ->orderBy('province')
            ->pluck('province');

        $commissions = Member::active()
            ->distinct()
            ->whereNotNull('commission')
            ->orderBy('commission')
            ->pluck('commission');

        $factions = Member::active()
            ->distinct()
            ->whereNotNull('faction')
            ->orderBy('faction')
            ->pluck('faction');

        return view('v_anggota.index', compact(
            'members',
            'parties',
            'provinces',
            'commissions',
            'factions'
        ));
    }

    /**
     * Display the specified member
     */
    public function show($slug)
    {
        $member = Member::active()
            ->where('slug', $slug)
            ->firstOrFail();

        // Other members from same party
        $samePartyMembers = Member::active()
            ->byParty($member->party)
            ->where('id', '!=', $member->id)
            ->inRandomOrder()
            ->take(4)
            ->get();

        // Other members from same commission
        $sameCommissionMembers = [];
        if ($member->commission) {
            $sameCommissionMembers = Member::active()
                ->byCommission($member->commission)
                ->where('id', '!=', $member->id)
                ->inRandomOrder()
                ->take(4)
                ->get();
        }

        return view('v_anggota.show', compact(
            'member',
            'samePartyMembers',
            'sameCommissionMembers'
        ));
    }

    /**
     * Display members by party
     */
    public function byParty($party)
    {
        $members = Member::active()
            ->byParty($party)
            ->orderBy('name', 'asc')
            ->paginate(24);

        // Get filter options
        $parties = Member::active()
            ->distinct()
            ->orderBy('party')
            ->pluck('party');

        $provinces = Member::active()
            ->distinct()
            ->whereNotNull('province')
            ->orderBy('province')
            ->pluck('province');

        $commissions = Member::active()
            ->distinct()
            ->whereNotNull('commission')
            ->orderBy('commission')
            ->pluck('commission');

        $factions = Member::active()
            ->distinct()
            ->whereNotNull('faction')
            ->orderBy('faction')
            ->pluck('faction');

        return view('v_anggota.index', compact(
            'members',
            'parties',
            'provinces',
            'commissions',
            'factions',
            'party'
        ));
    }

    /**
     * Display members by commission
     */
    public function byCommission($commission)
    {
        $members = Member::active()
            ->byCommission($commission)
            ->orderBy('name', 'asc')
            ->paginate(24);

        // Get filter options
        $parties = Member::active()
            ->distinct()
            ->orderBy('party')
            ->pluck('party');

        $provinces = Member::active()
            ->distinct()
            ->whereNotNull('province')
            ->orderBy('province')
            ->pluck('province');

        $commissions = Member::active()
            ->distinct()
            ->whereNotNull('commission')
            ->orderBy('commission')
            ->pluck('commission');

        $factions = Member::active()
            ->distinct()
            ->whereNotNull('faction')
            ->orderBy('faction')
            ->pluck('faction');

        return view('v_anggota.index', compact(
            'members',
            'parties',
            'provinces',
            'commissions',
            'factions',
            'commission'
        ));
    }
}
