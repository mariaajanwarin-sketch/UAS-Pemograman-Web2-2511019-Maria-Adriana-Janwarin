<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Recipe extends Model
{
    protected $fillable = [
        'category_id', 'judul', 'slug', 'deskripsi',
        'bahan', 'langkah', 'waktu_masak', 'gambar',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /** 20 => "20 menit", 180 => "3 jam", 90 => "1 jam 30 menit" */
    public function getWaktuFormatAttribute(): string
    {
        $m = (int) $this->waktu_masak;
        if ($m <= 0) return '-';
        if ($m < 60) return "$m menit";
        $jam = intdiv($m, 60);
        $sisa = $m % 60;
        return $sisa ? "$jam jam $sisa menit" : "$jam jam";
    }

    /**
     * URL cover resep:
     * 1) foto yang diunggah lewat admin, atau
     * 2) file apa pun di public/foto-resep dengan nama {slug}.(jpg|jpeg|jfif|png|webp|gif|avif)
     * File kosong (0 byte) diabaikan.
     */
    public function getGambarUrlAttribute(): ?string
    {
        if ($this->gambar) {
            return asset('storage/'.$this->gambar);
        }

        foreach (glob(public_path('foto-resep/'.$this->slug.'.*')) ?: [] as $file) {
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'jfif', 'png', 'webp', 'gif', 'avif']) && filesize($file) > 0) {
                return asset('foto-resep/'.basename($file)).'?v='.filemtime($file);
            }
        }

        return null;
    }

    /** Emoji cover bila resep belum punya foto. */
    public function getEmojiAttribute(): string
    {
        $judul = strtolower($this->judul);
        $kategori = strtolower($this->category->nama ?? '');

        return match (true) {
            str_contains($judul, 'rendang') => '🍖',
            str_contains($judul, 'sate') => '🍢',
            str_contains($judul, 'lemon') => '🍋',
            str_contains($judul, 'cendol') => '🍧',
            str_contains($judul, 'pisang') => '🍌',
            str_contains($judul, 'gado') => '🥗',
            str_contains($judul, 'bakwan') => '🥬',
            str_contains($judul, 'bubur') => '🥣',
            str_contains($judul, 'soto') => '🍲',
            str_contains($judul, 'nasi') => '🍛',
            str_contains($kategori, 'sup') => '🍲',
            str_contains($kategori, 'minum') => '🥤',
            str_contains($kategori, 'camil') => '🍢',
            str_contains($kategori, 'salad') => '🥗',
            str_contains($kategori, 'sarap') => '🥣',
            str_contains($kategori, 'utama') => '🍛',
            default => '🍽️',
        };
    }

    public function getDaftarBahanAttribute(): array
    {
        return array_values(array_filter(array_map('trim', preg_split('/\R/', $this->bahan))));
    }

    public function getDaftarLangkahAttribute(): array
    {
        return array_values(array_filter(array_map('trim', preg_split('/\R/', $this->langkah))));
    }

    public static function slugUnik(string $judul, ?int $abaikanId = null): string
    {
        $dasar = Str::slug($judul);
        $slug = $dasar;
        $i = 2;
        while (static::where('slug', $slug)->when($abaikanId, fn ($q) => $q->where('id', '!=', $abaikanId))->exists()) {
            $slug = $dasar.'-'.$i++;
        }
        return $slug;
    }
}
