<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 分类表模型
 * Class Category
 * @package App
 */
class Category extends Model
{
    use SoftDeletes;

    protected $table = 'categories';

    protected $fillable = ['name'];

    public function posts()
    {
        return $this->hasMany('App\Post', 'category_id')->orderBy('published_at', 'desc');
    }

    public function publishedPosts()
    {
        return $this->hasMany('App\Post', 'category_id')->where('status', 1)->orderBy('published_at', 'desc');
    }
}
