<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ["name", "isbn", "author", "summary"];


    protected static function boot(){
        parent::boot();
        self::creating(function ($model) {
            if(!app()->runningInConsole()) {
                $model->user_id = auth()->id();
            }
        });
    }

    public function scopeFilter(Builder $query, array $filter){
        
    }
}
