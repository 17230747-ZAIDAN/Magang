<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'type',
        'number',
        'year',
        'file_path',
        'file_url',
        'file_size',
        'downloads',
        'document_date',
        'published_at'
    ];

    protected $casts = [
        'year' => 'integer',
        'file_size' => 'integer',
        'downloads' => 'integer',
        'document_date' => 'date',
        'published_at' => 'datetime'
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($document) {
            if (empty($document->slug)) {
                $document->slug = Str::slug($document->title);
            }
        });
    }

    /**
     * Scope untuk dokumen yang sudah dipublish
     */
    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', now())
                     ->whereNotNull('published_at');
    }

    /**
     * Scope untuk filter berdasarkan tipe
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope untuk filter berdasarkan tahun
     */
    public function scopeByYear($query, $year)
    {
        return $query->where('year', $year);
    }

    /**
     * Increment downloads counter
     */
    public function incrementDownloads()
    {
        $this->increment('downloads');
    }

    /**
     * Get formatted file size
     */
    public function getFormattedFileSizeAttribute()
    {
        if (!$this->file_size) {
            return '-';
        }

        $units = ['B', 'KB', 'MB', 'GB'];
        $size = $this->file_size;
        $unit = 0;

        while ($size >= 1024 && $unit < count($units) - 1) {
            $size /= 1024;
            $unit++;
        }

        return round($size, 2) . ' ' . $units[$unit];
    }

    /**
     * Get full document number with year
     */
    public function getFullNumberAttribute()
    {
        if ($this->number && $this->year) {
            return $this->number . ' Tahun ' . $this->year;
        }
        return $this->number ?? '-';
    }

    /**
     * Get download URL
     */
    public function getDownloadUrlAttribute()
    {
        if ($this->file_url) {
            return $this->file_url;
        }
        if ($this->file_path && file_exists(public_path($this->file_path))) {
            return asset($this->file_path);
        }
        return null;
    }

    /**
     * Get formatted document date
     */
    public function getFormattedDocumentDateAttribute()
    {
        return $this->document_date ? $this->document_date->format('d M Y') : '-';
    }
}
