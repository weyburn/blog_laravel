<?php

namespace App\Http\Controllers;

class BackendController extends Controller
{
    public function __construct()
    {
        $isDist = config('app.env') === 'production';
        $prefix = $isDist ? '' : '____';

        if (file_exists(public_path("statics/{$prefix}views/backend.php"))) {
            $_gStaticFiles = require_once public_path("statics/{$prefix}views/backend.php");
            view()->share('_gStaticFiles', $_gStaticFiles);
        }
    }
}
