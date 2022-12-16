<?php

namespace App\Http\Controllers;

use App\Models\MiteDrive\Files;
use App\Models\Wordpress\WpPost;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ViewController extends Controller
{
    public function home()
    {
        $posts = WpPost::where('post_type', 'post')
            ->where('post_status', 'publish')
            ->orderBy('post_date', 'desc')
            ->paginate(4);

        foreach ($posts as $post) {
            $thumbnail = DB::select('SELECT * FROM wp_postmeta WHERE post_id = ? AND meta_key = ?', [$post->ID, '_thumbnail_id']);

            if ($thumbnail) {
                $thumbnail = DB::select('SELECT * FROM wp_postmeta WHERE post_id = ? AND meta_key = ?', [$thumbnail[0]->meta_value, '_wp_attached_file']);
                $post->thumbnail = $thumbnail[0]->meta_value;
            }

            $categories = DB::select('SELECT * FROM wp_term_relationships WHERE object_id = ?', [$post->ID]);

            $cate = [];

            foreach ($categories as $category) {
                $category = DB::select('SELECT * FROM wp_terms WHERE term_id = ?', [$category->term_taxonomy_id]);
                array_push($cate, $category[0]);
            }

            $post->categories = $cate;
        }

        // return response()->json($posts);
        return view('welcome', [
            'posts' => $posts,
        ]);
    }

    public function post($slug)
    {
        $files = Files::where('short_url', $slug)->first();
        if (!$files) {
            $post = WpPost::where('post_name', urlencode($slug))
                ->first();
    
            if (!$post) {
                abort(404);
            }
    
            $post->created_at = strtotime($post->post_date);
            $post->seo_description = substr(strip_tags($post->post_content), 0, 200);
    
            $thumbnail = DB::select('SELECT * FROM wp_postmeta WHERE post_id = ? AND meta_key = ?', [$post->ID, '_thumbnail_id']);
    
            if ($thumbnail) {
                $thumbnail = DB::select('SELECT * FROM wp_postmeta WHERE post_id = ? AND meta_key = ?', [$thumbnail[0]->meta_value, '_wp_attached_file']);
                $post->thumbnail = $thumbnail[0]->meta_value;
            }
    
            $categories = DB::select('SELECT * FROM wp_term_relationships WHERE object_id = ?', [$post->ID]);
    
            $cate = [];
    
            foreach ($categories as $category) {
                $category = DB::select('SELECT * FROM wp_terms WHERE term_id = ?', [$category->term_taxonomy_id]);
                array_push($cate, $category[0]);
            }
    
            $post->categories = $cate;
            $after_paragraph = '</p>';
            $paragraphs = explode($after_paragraph, $post->post_content);
            foreach ($paragraphs as $index => $paragraph) {
                if (trim($paragraph)) {
                    $paragraphs[$index] .= $after_paragraph . '<br/>';
                }
    
                // if (($index + 1) % 3 == 0) {
                //     $paragraphs[$index] .= '<div id="advertiser" class="w-full bg-gray-200 rounded-xl mt-4 mb-4" style="height: 200px;">
    
                //     </div>';
                // }
            }
    
            $post->post_content = implode('', $paragraphs);

            if (Session::has('files')) {
                $files = Session::get('files');
                $files->created_at_format = Date::parse($files->created_at)->format('d/m/Y');
                
                return view('mitedrive.view', [
                    'post' => $post,
                    'files' => $files,
                ]);
            }
    
    
            // return response()->json($post);
            return view('post', [
                'post' => $post,
            ]);
        }

        $post = WpPost::where('post_type', 'post')
        ->where('post_status', 'publish')
        ->inRandomOrder()
        ->first();

        return redirect()->route('post', $post->post_name)->with('files', $files);
    }

    public function categories($slug)
    {
        $category = DB::select('SELECT * FROM wp_terms WHERE slug = ?', [$slug]);

        if (!$category) {
            abort(404);
        }

        $category = $category[0];

        $posts = DB::select('SELECT * FROM wp_term_relationships WHERE term_taxonomy_id = ?', [$category->term_id]);

        $post_ids = [];

        foreach ($posts as $post) {
            array_push($post_ids, $post->object_id);
        }

        $posts = WpPost::whereIn('ID', $post_ids)
            ->where('post_type', 'post')
            ->where('post_status', 'publish')
            ->orderBy('post_date', 'desc')
            ->paginate(12);

        foreach ($posts as $post) {
            $thumbnail = DB::select('SELECT * FROM wp_postmeta WHERE post_id = ? AND meta_key = ?', [$post->ID, '_thumbnail_id']);

            if ($thumbnail) {
                $thumbnail = DB::select('SELECT * FROM wp_postmeta WHERE post_id = ? AND meta_key = ?', [$thumbnail[0]->meta_value, '_wp_attached_file']);
                $post->thumbnail = $thumbnail[0]->meta_value;
            }

            $categories = DB::select('SELECT * FROM wp_term_relationships WHERE object_id = ?', [$post->ID]);

            $cate = [];

            foreach ($categories as $category) {
                $category = DB::select('SELECT * FROM wp_terms WHERE term_id = ?', [$category->term_taxonomy_id]);
                array_push($cate, $category[0]);
            }

            $post->categories = $cate;
        }

        // return response()->json($category);
        return view('category', [
            'posts' => $posts,
            'category' => $category,
            'slug' => $slug,
        ]);
    }

    public function search(Request $request)
    {
        if (isset($request->title)) {
            $title = $request->title;
        } else {
            abort(404);
        }

        $posts = WpPost::where('post_type', 'post')
            ->where('post_status', 'publish')
            ->where('post_title', 'like', '%' . $title . '%')
            ->orderBy('post_date', 'desc')
            ->paginate(12);

        foreach ($posts as $post) {
            $thumbnail = DB::select('SELECT * FROM wp_postmeta WHERE post_id = ? AND meta_key = ?', [$post->ID, '_thumbnail_id']);

            if ($thumbnail) {
                $thumbnail = DB::select('SELECT * FROM wp_postmeta WHERE post_id = ? AND meta_key = ?', [$thumbnail[0]->meta_value, '_wp_attached_file']);
                $post->thumbnail = $thumbnail[0]->meta_value;
            }

            $categories = DB::select('SELECT * FROM wp_term_relationships WHERE object_id = ?', [$post->ID]);

            $cate = [];

            foreach ($categories as $category) {
                $category = DB::select('SELECT * FROM wp_terms WHERE term_id = ?', [$category->term_taxonomy_id]);
                array_push($cate, $category[0]);
            }

            $post->categories = $cate;
        }

        // return response()->json($posts);
        return view('search', [
            'posts' => $posts,
            'title' => $title,
        ]);
    }

    /* 
    * API
    */

    public function recommendation()
    {
        $cache = Cache::get('recommendation');
        if ($cache) {
            return response()->json($cache);
        }
        $posts = WpPost::where('post_type', 'post')
            ->where('post_status', 'publish')
            ->inRandomOrder()
            ->limit(3)
            ->get();

        foreach ($posts as $post) {
            $thumbnail = DB::select('SELECT * FROM wp_postmeta WHERE post_id = ? AND meta_key = ?', [$post->ID, '_thumbnail_id']);

            if ($thumbnail) {
                $thumbnail = DB::select('SELECT * FROM wp_postmeta WHERE post_id = ? AND meta_key = ?', [$thumbnail[0]->meta_value, '_wp_attached_file']);
                $post->thumbnail = $thumbnail[0]->meta_value;
            }

            $categories = DB::select('SELECT * FROM wp_term_relationships WHERE object_id = ?', [$post->ID]);

            $cate = [];

            foreach ($categories as $category) {
                $category = DB::select('SELECT * FROM wp_terms WHERE term_id = ?', [$category->term_taxonomy_id]);
                array_push($cate, $category[0]);
            }

            $post->categories = $cate;
        }

        Cache::put('recommendation', $posts, 60);

        return response()->json($posts);
    }

    public function category()
    {
        $cache = Cache::get('category');
        if ($cache) {
            return response()->json($cache);
        }
        $categories = DB::select('SELECT * FROM wp_terms');

        foreach ($categories as $category) {
            $category->count = DB::select('SELECT COUNT(*) as count FROM wp_term_relationships WHERE term_taxonomy_id = ?', [$category->term_id])[0]->count;
        }

        Cache::put('category', $categories, 60);

        return response()->json($categories);
    }

    public function trending()
    {
        $cache = Cache::get('trending');
        if ($cache) {
            return response()->json($cache);
        }

        $posts = WpPost::where('post_type', 'post')
            ->where('post_status', 'publish')
            ->orderBy('post_date', 'desc')
            ->first();

        $posts->created_at = strtotime($posts->post_date);

        $thumbnail = DB::select('SELECT * FROM wp_postmeta WHERE post_id = ? AND meta_key = ?', [$posts->ID, '_thumbnail_id']);

        if ($thumbnail) {
            $thumbnail = DB::select('SELECT * FROM wp_postmeta WHERE post_id = ? AND meta_key = ?', [$thumbnail[0]->meta_value, '_wp_attached_file']);
            $posts->thumbnail = $thumbnail[0]->meta_value;
        }

        $categories = DB::select('SELECT * FROM wp_term_relationships WHERE object_id = ?', [$posts->ID]);

        $cate = [];

        foreach ($categories as $category) {
            $category = DB::select('SELECT * FROM wp_terms WHERE term_id = ?', [$category->term_taxonomy_id]);
            array_push($cate, $category[0]);
        }

        $posts->categories = $cate;

        Cache::put('trending', $posts, 60);

        return response()->json($posts);
    }
}
