<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["name", "isbn", "author", "summary"];


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
