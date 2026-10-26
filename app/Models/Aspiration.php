<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspiration extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'province',
        'city',
        'subject',
        'message',
        'category',
        'status',
        'response',
        'responded_at'
    ];

    protected $casts = [
        'responded_at' => 'datetime'
    ];

    /**
     * Scope untuk aspirasi dengan status tertentu
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk aspirasi pending
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope untuk aspirasi yang sudah direview
     */
    public function scopeReviewed($query)
    {
        return $query->where('status', 'reviewed');
    }

    /**
     * Scope untuk aspirasi yang sudah direspon
     */
    public function scopeResponded($query)
    {
        return $query->where('status', 'responded');
    }

    /**
     * Scope untuk filter berdasarkan kategori
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope untuk filter berdasarkan provinsi
     */
    public function scopeByProvince($query, $province)
    {
        return $query->where('province', $province);
    }

    /**
     * Mark as reviewed
     */
    public function markAsReviewed()
    {
        $this->update(['status' => 'reviewed']);
    }

    /**
     * Mark as responded
     */
    public function markAsResponded($response)
    {
        $this->update([
            'status' => 'responded',
            'response' => $response,
            'responded_at' => now()
        ]);
    }

    /**
     * Get status badge color
     */
    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'pending' => 'warning',
            'reviewed' => 'info',
            'responded' => 'success',
            default => 'secondary'
        };
    }

    /**
     * Get status label in Indonesian
     */
    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'pending' => 'Menunggu',
            'reviewed' => 'Sedang Ditinjau',
            'responded' => 'Telah Ditanggapi',
            default => 'Tidak Diketahui'
        };
    }
}
