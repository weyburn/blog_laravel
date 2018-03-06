<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;

/**
 * Class FrontendController
 * @package App\Http\Controllers
 */
class FrontendController extends Controller
{

    public function __construct()
    {
        $isDist = config('app.env') === 'production';
        $prefix = $isDist ? '' : '____';

        if (file_exists(public_path("statics/{$prefix}views/frontend.php"))) {
            $_gStaticFiles = require_once public_path("statics/{$prefix}views/frontend.php");
            view()->share('_gStaticFiles', $_gStaticFiles);
        }

        $postCount = count(Post::where('status',1)->get());
        $tagCount = count(Tag::all());
        $categoryCount = count(Category::all());
        view()->share('count', ['postCount' => $postCount, 'categoryCount' => $categoryCount, 'tagCount' => $tagCount]);
    }
}
