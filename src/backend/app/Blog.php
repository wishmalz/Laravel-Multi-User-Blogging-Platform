<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'body'];
    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }
}
