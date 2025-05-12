<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
    ];


    /**
     * @param Builder $query
     * @param array $filters
     * @return Builder
     */
    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query
            ->when($filters['date_column'] ?? null, function (Builder $query) use ($filters) {
                if (!empty($filters['date_from']) && !empty($filters['date_to'])) {
                    return $query->whereBetween($filters['date_column'], [$filters['date_from'], $filters['date_to']]);
                }
                return $query;
            })
            ->when($filters['order_column'] ?? null, function (Builder $query) use ($filters) {
                return $query->orderBy(
                    $filters['order_column'],
                    $filters['order_type'] ?? 'asc'
                );
            })
            ->when($filters['search'] ?? null, function (Builder $query) use ($filters) {
                return $query->where(function ($query) use ($filters) {
                    $searchTerm = '%' . $filters['search'] . '%';
                    $query->where('title', 'like', $searchTerm)
                        ->orWhere('description', 'like', $searchTerm);
                });
            });
    }
}
