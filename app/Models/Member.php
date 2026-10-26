<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'photo',
        'party',
        'electoral_district',
        'province',
        'position',
        'commission',
        'faction',
        'biography',
        'education',
        'email',
        'phone',
        'social_media',
        'start_period',
        'end_period',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'start_period' => 'date',
        'end_period' => 'date',
        'social_media' => 'array'
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($member) {
            if (empty($member->slug)) {
                $member->slug = Str::slug($member->name);
            }
        });
    }

    /**
     * Scope untuk anggota aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk filter berdasarkan partai
     */
    public function scopeByParty($query, $party)
    {
        return $query->where('party', $party);
    }

    /**
     * Scope untuk filter berdasarkan provinsi
     */
    public function scopeByProvince($query, $province)
    {
        return $query->where('province', $province);
    }

    /**
     * Scope untuk filter berdasarkan komisi
     */
    public function scopeByCommission($query, $commission)
    {
        return $query->where('commission', $commission);
    }

    /**
     * Scope untuk filter berdasarkan fraksi
     */
    public function scopeByFaction($query, $faction)
    {
        return $query->where('faction', $faction);
    }

    /**
     * Get full position title
     */
    public function getFullPositionAttribute()
    {
        $parts = array_filter([$this->position, $this->commission]);
        return implode(' - ', $parts);
    }

    /**
     * Get photo URL or default avatar
     */
    public function getPhotoUrlAttribute()
    {
        if ($this->photo && file_exists(public_path($this->photo))) {
            return asset($this->photo);
        }
        return asset('images/default-avatar.png');
    }
}
