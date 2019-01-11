<?php

use M1guelpf\GhostAPI\Ghost;
use Illuminate\Support\Carbon;

$ghost = new Ghost(env('GHOST_HOST'), env('GHOST_KEY'));

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
            'items' => function () use ($ghost) {
                $posts = $ghost->getPosts('tags', null, null, 'all')['posts'];

                return collect($posts)->map(function ($post) {
                    return [
                        'extends' => ['web' => is_null($post['custom_template']) || $post['custom_template'] == '' ? '_layouts.post' : str_replace('custom-', '_layouts.custom.', $post['custom_template']), 'amp' => '_layouts.amp'],
                        'title' => $post['title'],
                        'filename' => $post['slug'],
                        'slug' => $post['slug'],
                        'content' => $post['html'],
                        'cover_image' => get_image_path($post['feature_image']),
                        'featured' => $post['featured'],
                        'date' => $post['published_at'],
                        'excerpt' => htmlspecialchars($post['excerpt'], ENT_QUOTES),
                        'meta' => [
                            'title' => $post['meta_title'],
                            'description' => $post['meta_description'],
                        ],
                        'og' => [
                            'title' => $post['og_title'],
                            'description' => $post['og_description'],
                            'image' => get_image_path($post['og_image']),
                        ],
                        'twitter' => [
                            'title' => $post['twitter_title'],
                            'description' => $post['twitter_description'],
                            'image' => get_image_path($post['twitter_image']),
                        ],
                        'inject' => [
                            'head' => base64_encode($post['codeinjection_head']),
                            'footer' => base64_encode($post['codeinjection_foot']),
                        ],
                        'template' => $post['custom_template'],
                        'tags' => collect($post['tags'])->map(function ($tag) {
                            return [
                                'name' => $tag['name'],
                                'slug' => $tag['slug'],
                                'internal' => $tag['visibility'] != 'public',
                            ];
                        })->toArray(),
                        'amp_scripts' => get_amp_scripts($post['html']),
                        'reading_time' => reading_time($post['html'], isset($post['feature_image'])),
                    ];
                });
            },
        ],
        'pages' => [
            'sort' => '-date',
            'path' => '{slug}',
            'items' => function () use ($ghost) {
                $pages = $ghost->getPages('tags', null, null, 'all')['pages'];

                return collect($pages)->map(function ($page) {
                    return [
                        'extends' => is_null($page['custom_template']) || $page['custom_template'] == '' ? '_layouts.post' : str_replace('custom-', '_layouts.custom.', $page['custom_template']),
                        'title' => $page['title'],
                        'filename' => $page['slug'],
                        'slug' => $page['slug'],
                        'content' => $page['html'],
                        'cover_image' => get_image_path($page['feature_image']),
                        'featured' => $page['featured'],
                        'date' => $page['published_at'],
                        'excerpt' => htmlspecialchars($page['excerpt'], ENT_QUOTES),
                        'meta' => [
                            'title' => $page['meta_title'],
                            'description' => $page['meta_description'],
                        ],
                        'og' => [
                            'title' => $page['og_title'],
                            'description' => $page['og_description'],
                            'image' => get_image_path($page['og_image']),
                        ],
                        'twitter' => [
                            'title' => $page['twitter_title'],
                            'description' => $page['twitter_description'],
                            'image' => get_image_path($page['twitter_image']),
                        ],
                        'inject' => [
                            'head' => base64_encode($page['codeinjection_head']),
                            'footer' => base64_encode($page['codeinjection_foot']),
                        ],
                        'template' => $page['custom_template'],
                    ];
                });
            },
        ],
        'tags' => [
            'sort' => '-date',
            'path' => 'tag/{slug}',
            'extends' => '_layouts.tag',
            'items' => function () use ($ghost) {
                $tags = $ghost->getTags(null, null, null, 'all')['tags'];
                $posts = $ghost->getPosts('tags', null, null, 'all')['posts'];

                return collect($tags)->reject(function ($tag) {
                    return $tag['visibility'] != 'public';
                })->map(function ($tag) use ($posts) {
                    return [
                        'name' => $tag['name'],
                        'slug' => $tag['slug'],
                        'filename' => $tag['slug'],
                        'description' => $tag['description'],
                        'cover_image' => get_image_path($tag['feature_image']),
                        'meta_title' => $tag['meta_title'],
                        'meta_description' => $tag['meta_description'],
                        'posts' => collect($posts)->filter(function ($post) use ($tag) {
                            return collect($post['tags'])->contains('slug', $tag['slug']);
                        })->map(function ($post) {
                            return [
                                'tags' => collect($post['tags'])->map(function ($tag) {
                                    return [
                                        'name' => $tag['name'],
                                        'slug' => $tag['slug'],
                                        'internal' => $tag['visibility'] != 'public',
                                    ];
                                })->toArray(),
                                'slug' => $post['slug'],
                                'featured' => $post['featured'],
                                'cover_image' => get_image_path($post['feature_image']),
                                'title' => $post['title'],
                                'date' => $post['created_at'],
                            ];
                        }),
                    ];
                });
            },
        ],
    ],

    // helpers
    'getDate' => function ($page, $collection = null) {
        return Carbon::parse($collection->date ?? $page->date);
    },
    'isActive' => function ($page, $path) {
        return ends_with(trimPath($page->getPath()), trimPath($path));
    },
];
