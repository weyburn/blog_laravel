<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 标签表模型
 * Class Tag
 * @package App
 */
class Tag extends Model
{
    use SoftDeletes;

    protected $table = 'tags';

    protected $fillable = ['name'];

    public function posts()
    {
        return $this->belongsToMany('App\Post')->orderBy('published_at','desc');
    }

    public function publishedPosts()
    {
        return $this->belongsToMany('App\Post')->where('status',1)->orderBy('published_at','desc');
    }
}
