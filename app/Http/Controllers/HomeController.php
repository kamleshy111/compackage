<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function category($slug = ''): Response
    {
        return Inertia::render('Front/Category',[
            'cateroryId' => $slug,
         ]);
    }

    public function archive(): Response
    {
        return Inertia::render('Front/Archive');
    }

    public function blog($slug = ''): Response
    {
        return Inertia::render('Front/Post',[
           'slug' => $slug,
        ]);
    }
}
