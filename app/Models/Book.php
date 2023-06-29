<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * @package  App\Models
 * @property   int $id
 * @property   string $name
 * @property   string $isbn
 * @property   string $summary
 * @property   string $author
 * @property   Carbon $created_at
 * @property   Carbon $deleted_at
 * @property   Collection $user
 * @method   filter(array $filters)
 */


class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["name", "isbn", "author", "summary"];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    protected static function boot(){
        parent::boot();
        self::creating(function ($model) {
            if(!app()->runningInConsole()) {
                $model->user_id = auth()->id();
            }
        });
    }

    public function scopeFilter(Builder $query, array $filters){
        session()->put("search", $filters['search'] ?? null);
        session()->put("status", $filters['status'] ?? null);

        $query->when(session("search"), default: function ($query, $search){
            $query->where('name', 'LIKE', '%'.$search.'%');
        })->when(session("status"), function ($query, $status){
            if($status === 'with'){
                $query->withTrashed();
            }elseif ($status === 'only'){
                $query->onlyTrashed();
            }
        });
    }
}
