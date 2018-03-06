<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 文章表模型
 * Class Post
 * @package App
 */
class Post extends Model
{
    use SoftDeletes;

    protected $table = 'posts';

    protected $fillable = [
        'title',
        'content',
        'status',
        'category_id',
        'published_at'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag')->orderBy('name','asc');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment', 'post_id')->orderBy('created_at','desc');
    }
}
