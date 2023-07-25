<?php

return [
    'feeds' => [
        'news' => [
            /*
             * Here you can specify which class and method will return
             * the items that should appear in the feed. For example:
             * 'App\Model@getAllFeedItems'
             *
             * You can also pass an argument to that method:
             * ['App\Model@getAllFeedItems', 'argument']
             */
            'items' => 'App\Models\Post@getPostItem',

            /*
             * The feed will be available on this url.
             */
            'url' => '/feed',

            'title' => 'Portal Smart City Kota Palopo',
            'description' => 'Palopo Kota Kebersamaan  yang Kolaboratif, Edukatif, Berbudaya, Empati, Religius, Sehat, Aman, Maju, Akseleratif, Adaptifl, dan Nyaman',
            'language' => 'id',

            /*
             * The view that will render the feed.
             */
            // 'view' => 'feeds.news',

            /*
             * The type to be used in the <link> tag
             */
            'type' => 'application/atom+xml',
        ],
    ],
];
