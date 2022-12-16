<?php

namespace App\Http\Controllers;

use App\Models\Wordpress\WpPost;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function posts()
    {
        $posts = WpPost::where('post_status', 'publish')
            ->where('post_type', 'post')
            ->orderBy('post_date', 'desc')
            ->get();

        foreach ($posts as $post) {
            $post->created_at = strtotime($post->post_date);
        }

        return response()->view('sitemap.posts', [
            'posts' => $posts,
        ])->header('Content-Type', 'text/xml');
    }
}
