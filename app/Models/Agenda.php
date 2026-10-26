<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'type',
        'location',
        'start_time',
        'end_time',
        'commission',
        'status',
        'note'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime'
    ];

    /**
     * Scope untuk agenda hari ini
     */
    public function scopeToday($query)
    {
        return $query->whereDate('start_time', today());
    }

    /**
     * Scope untuk agenda minggu ini
     */
    public function scopeThisWeek($query)
    {
        return $query->whereBetween('start_time', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ]);
    }

    /**
     * Scope untuk agenda bulan ini
     */
    public function scopeThisMonth($query)
    {
        return $query->whereMonth('start_time', now()->month)
                     ->whereYear('start_time', now()->year);
    }

    /**
     * Scope untuk agenda mendatang
     */
    public function scopeUpcoming($query)
    {
        return $query->where('start_time', '>=', now())
                     ->orderBy('start_time', 'asc');
    }

    /**
     * Scope untuk filter berdasarkan tipe
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk filter berdasarkan komisi
     */
    public function scopeByCommission($query, $commission)
    {
        return $query->where('commission', $commission);
    }

    /**
     * Check if agenda is ongoing
     */
    public function isOngoing()
    {
        $now = now();
        return $this->start_time <= $now && ($this->end_time === null || $this->end_time >= $now);
    }

    /**
     * Check if agenda is past
     */
    public function isPast()
    {
        return $this->end_time ? $this->end_time < now() : $this->start_time < now();
    }

    /**
     * Get formatted time range
     */
    public function getTimeRangeAttribute()
    {
        $start = $this->start_time->format('H:i');
        $end = $this->end_time ? $this->end_time->format('H:i') : 'selesai';
        return $start . ' - ' . $end . ' WIB';
    }

    /**
     * Get formatted date
     */
    public function getFormattedDateAttribute()
    {
        return $this->start_time->format('d M Y');
    }

    /**
     * Get status badge color
     */
    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'scheduled' => 'primary',
            'ongoing' => 'success',
            'completed' => 'secondary',
            'cancelled' => 'danger',
            default => 'secondary'
        };
    }

    /**
     * Get status label in Indonesian
     */
    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'scheduled' => 'Terjadwal',
            'ongoing' => 'Sedang Berlangsung',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
            default => 'Tidak Diketahui'
        };
    }
}
