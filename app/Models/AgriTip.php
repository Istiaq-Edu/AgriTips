<?php

namespace App\Models;

use App\TipCategory;
use Illuminate\Database\Eloquent\Model;

class AgriTip extends Model
{

    protected $fillable = [
        'title',
        'description',
        'category',
    ];


    protected $casts = [
        'category' => TipCategory::class,
    ];


    public function scopeByCategory($query, $category)
    {
        if ($category) {
            return $query->where('category', $category);
        }
        return $query;
    }


    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }


    public function getCategoryLabelAttribute(): string
    {
        return $this->category->labelBangla();
    }
}
