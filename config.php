<?php

use Illuminate\Support\Carbon;

return [
    'baseUrl' => env('APP_URL', 'https://miguelpiedrafita.com'),
    'production' => env('NODE_ENV', 'production') == 'production',
    'siteName' => 'Miguel Piedrafita',
    'cover' => 'https://i.imgur.com/74A2KrN.jpg',
    'siteDescription' => '16-year-old developer & maker',
    'siteAuthor' => 'Miguel Piedrafita',

    'navigation' => [
        ['title' => 'Support me', 'path' => 'patreon'],
    ],

    // collections
    'collections' => [
        'posts' => [
            'sort' => '-date',
            'path' => ['web' => '{slug}', 'amp' => '{slug}/amp'],
            'items'=> function () {
                $posts = json_decode(file_get_contents(env('GHOST_HOST').'/ghost/api/v0.1/posts/?limit=all&include=tags&client_id='.env('GHOST_ID').'&client_secret='.env('GHOST_SECRET').'&filter=page:false&absolute_urls=false'))->posts;

                return collect($posts)->map(function ($post) {
                    return [
                        'extends' => ['web' =>is_null($post->custom_template) || $post->custom_template == '' ? '_layouts.post' : str_replace('custom-', '_layouts.custom.', $post->custom_template), 'amp' => '_layouts.amp'],
                        'title' => $post->title,
                        'filename' => $post->slug,
                        'slug' => $post->slug,
                        'content' => $post->html,
                        'cover_image' => $post->feature_image,
                        'featured' => $post->featured,
                        'date'  => $post->published_at,
                        'excerpt' => htmlspecialchars($post->custom_excerpt, ENT_QUOTES),
                        'page' => $post->page,
                        'meta' => [
                            'title' => $post->meta_title,
                            'description' => $post->meta_description,
                        ],
                        'og' => [
                            'title' => $post->og_title,
                            'description' => $post->og_description,
                            'image' => $post->og_image,
                        ],
                        'twitter' => [
                            'title' => $post->twitter_title,
                            'description' => $post->twitter_description,
                            'image' => $post->twitter_image,
                        ],
                        'inject' => [
                            'head' => base64_encode($post->codeinjection_head),
                            'footer' => base64_encode($post->codeinjection_foot),
                        ],
                        'template' => $post->custom_template,
                        'tags' => collect($post->tags)->map(function ($tag) {
                            return [
                                'name' => $tag->name,
                                'slug' => $tag->slug,
                                'internal' => $tag->visibility != 'public',
                            ];
                        })->toArray(),
                        'amp_scripts' => get_amp_scripts($post->html),
                        'reading_time' => reading_time($post->html, isset($post->feature_image)),
                    ];
                });
            }
        ],
        'pages' => [
            'sort' => '-date',
            'path' => '{slug}',
            'items'=> function () {
                $posts = json_decode(file_get_contents(env('GHOST_HOST').'/ghost/api/v0.1/posts/?limit=all&include=tags&client_id='.env('GHOST_ID').'&client_secret='.env('GHOST_SECRET').'&filter=page:true&absolute_urls=false'))->posts;

                return collect($posts)->map(function ($post) {
                    return [
                        'extends' => is_null($post->custom_template) || $post->custom_template == '' ? '_layouts.post' : str_replace('custom-', '_layouts.custom.', $post->custom_template),
                        'title' => $post->title,
                        'filename' => $post->slug,
                        'slug' => $post->slug,
                        'content' => $post->html,
                        'cover_image' => $post->feature_image,
                        'featured' => $post->featured,
                        'date'  => $post->published_at,
                        'excerpt' => htmlspecialchars($post->custom_excerpt, ENT_QUOTES),
                        'page' => $post->page,
                        'meta' => [
                            'title' => $post->meta_title,
                            'description' => $post->meta_description,
                        ],
                        'og' => [
                            'title' => $post->og_title,
                            'description' => $post->og_description,
                            'image' => $post->og_image,
                        ],
                        'twitter' => [
                            'title' => $post->twitter_title,
                            'description' => $post->twitter_description,
                            'image' => $post->twitter_image,
                        ],
                        'inject' => [
                            'head' => base64_encode($post->codeinjection_head),
                            'footer' => base64_encode($post->codeinjection_foot),
                        ],
                        'template' => $post->custom_template,
                        'tags' => collect($post->tags)->map(function ($tag) {
                            return [
                                'name' => $tag->name,
                                'slug' => $tag->slug,
                                'internal' => $tag->visibility != 'public',
                            ];
                        })->toArray(),
                    ];
                });
            }
        ],
        'tags' => [
            'sort' => '-date',
            'path' => 'tag/{slug}',
            'extends' => '_layouts.tag',
            'items'=> function () {
                $posts = json_decode(file_get_contents(env('GHOST_HOST').'/ghost/api/v0.1/posts/?limit=all&include=tags&client_id='.env('GHOST_ID').'&client_secret='.env('GHOST_SECRET').'&absolute_urls=false'))->posts;

                return collect($posts)->map(function ($post) {
                    return collect($post->tags);
                })->reject(function ($tags) {
                    return $tags->isEmpty();
                })->flatten()->unique('slug')->reject(function ($tag) {
                    return $tag->visibility != 'public';
                })->map(function ($tag) use ($posts) {
                    return [
                        'name' => $tag->name,
                        'slug' => $tag->slug,
                        'filename' => $tag->slug,
                        'description' => $tag->description,
                        'cover_image' => $tag->feature_image,
                        'meta_title' => $tag->meta_title,
                        'meta_description' => $tag->meta_description,
                        'date' => $tag->created_at,
                        'posts' =>  collect($posts)->filter(function ($post) use ($tag) {
                            return collect($post->tags)->contains('slug', $tag->slug);
                        })->map(function ($post) {
                            return [
                                'tags' => collect($post->tags)->map(function ($tag) {
                                    return [
                                        'name' => $tag->name,
                                        'slug' => $tag->slug,
                                        'internal' => $tag->visibility != 'public',
                                    ];
                                })->toArray(),
                                'slug' => $post->slug,
                                'featured' => $post->featured,
                                'cover_image' => $post->feature_image,
                                'title' => $post->title,
                                'date' => $post->created_at,
                            ];
                        }),
                    ];
                });
            }
        ]
    ],

    // helpers
    'getDate' => function ($page, $collection = null) {
        return Carbon::parse($collection->date ?? $page->date);
    },
    'isActive' => function ($page, $path) {
        return ends_with(trimPath($page->getPath()), trimPath($path));
    },
];
