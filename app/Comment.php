<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 评论表模型
 * Class Post
 * @package App
 */
class Comment extends Model
{
    use SoftDeletes;

    protected $table = 'comments';

    protected $fillable = [
        'name',
        'email',
        'website',
        'ip',
        'content',
        'status',
        'post_id',
        'reply_id',
        'reply_name'
    ];

    public function post()
    {
        return $this->belongsTo('App\Post', 'post_id');
    }
}
