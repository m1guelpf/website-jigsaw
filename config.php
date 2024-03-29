<?php

use M1guelpf\GhostAPI\Ghost;
use Illuminate\Support\Carbon;

$colors = array_flip(['violet', 'green', 'red', 'orange', 'yellow', 'blue']);
$ghost = new Ghost(env('GHOST_HOST'), env('GHOST_KEY'));

return [
    'baseUrl' => env('APP_URL', 'https://miguelpiedrafita.com'),
    'production' => env('NODE_ENV', 'production') == 'production',
    'siteName' => 'Miguel Piedrafita',
    'cover' => 'https://i.imgur.com/74A2KrN.jpg',
    'siteDescription' => '17-year-old developer & maker',
    'siteAuthor' => 'Miguel Piedrafita',

    'navigation' => [
        ['title' => 'Support me', 'path' => 'patreon'],
        ['title' => 'Daily writing', 'path' => '200wad'],
        ['title' => 'Newsletter', 'path' => 'newsletter'],
    ],

    'written_days' => value(function () {
        $posts = collect(json_decode(file_get_contents('https://200wordsaday.com/api/texts?api_key='.env('WAD_KEY')), true));

        return Carbon::parse(Carbon::parse($posts->first()['published_datetime']['date']))->diffInDays(Carbon::parse($posts->last()['published_datetime']['date'])) + 1;
    }),

    // collections
    'collections' => [
        'daily' => [
            'sort' => '-date',
            'path' => ['web' => '200wad/{slug}', 'amp' => '200wad/{slug}/amp'],
            'items' => function () use ($colors) {
                $posts = json_decode(file_get_contents('https://200wordsaday.com/api/texts?api_key='.env('WAD_KEY')), true);

                $startDate = Carbon::parse(collect($posts)->last()['published_datetime']['date']);

                $lastColor;

                return collect($posts)->filter(function ($post) {
                    return $post['status'] == 'published' && $post['access_rights'] == 'public';
                })->map(function ($post) use ($colors, $startDate, &$lastColor) {
                    $color = array_rand($colors);

                    while ($color == $lastColor) {
                        $color = array_rand($colors);
                    }

                    $lastColor = $color;
                    
                    return [
                        'extends' => ['web' => '_layouts.200wad', 'amp' => '_layouts.200wad_amp'],
                        'accent' => $color,
                        'title' => $post['title'],
                        'filename' => $post['slug'],
                        'slug' => str_slug($post['title']),
                        'content' => $post['content'],
                        'date' => $post['published_datetime']['date'],
                        'count' => $post['word_count'],
                        'tags' => collect($post['categories'])->map(function ($tag) {
                            return $tag['name'];
                        })->toArray(),
                        'amp_scripts' => get_amp_scripts($post['content']),
                        'reading_time' => reading_time_200wad($post['word_count']),
                        'word_count' => $post['word_count'],
                        'day' => Carbon::parse($post['published_datetime']['date'])->diffInDays($startDate) + 1
                    ];
                });
            },
        ],
        'posts' => [
            'sort' => '-date',
            'path' => ['web' => '{slug}', 'amp' => '{slug}/amp'],
            'items' => function () use ($ghost) {
                $posts = $ghost->getPosts('tags', null, null, 'all')['posts'];
                return collect($posts)->reject(function ($post) {
                    return collect($post['tags'])->map(function ($tag) {
                        return $tag['name'];
                    })->contains('#philosophy');
                })->map(function ($post) {
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
