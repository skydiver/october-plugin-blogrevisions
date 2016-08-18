<?php

    return [

        'plugin' => [
            'name'        => 'Blog Revisions',
            'description' => 'Blog posts history revisions',
        ],

        'controller' => [
            'revisions' => [
                'title' => 'Revision'
            ]
        ],

        'fields' => [
            'revision' => [
                'view_user'    => 'Author',
                'created_at'   => 'Modified Date',
                'view_title'   => 'Title',
                'view_content' => 'Content',
            ]
        ],

        'widgets' => [
            'revisions' => [
                'button' => 'Revision #',
                'empty'  => 'There is no revision for this post'
            ]
        ],

        'misc' => [
            'tab_name' => 'Revisions'
        ]

    ];

?>