<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'picture',
        'category_id',
        'user_id',
        'published',
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}