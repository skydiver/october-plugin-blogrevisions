<?php

    return [

        'plugin' => [
            'name'        => 'Blog Revisions',
            'description' => 'Blog posts history revisions',
        ],

        'menuitem' => [
            'revisions' => 'Revisions',
        ],

        'controller' => [
            'revisions' => [
                'title' => 'Revision'
            ]
        ],

        'lists' => [
            'revisionslist' => [
                'page_title'          => 'Blog Posts Revisions',
                '_post__id'           => 'Post ID',
                '_post__title'        => 'Post Title',
                '_post__published_at' => 'Published Date'
            ],
            'revisionslist_items' => [
                'bc_main_title' => 'Blog Post',
                'bc_sec_title'  => 'Revisons List',
                'post_title'    => 'Post Title',
                'revision'      => 'Revision #',
                'view_title'    => 'Revision Title',
                'user_id'       => 'User',
                'updated_at'    => 'Updated',
            ]
        ],

        'fields' => [
            'revision' => [
                'title'        => 'Title',
                'content'      => 'Content',
                'view_user'    => 'Author',
                'created_at'   => 'Modified Date',
                'view_title'   => 'Title',
                'view_content' => 'Content',
            ],
            'revisionslist_items' => [
                'modal_title' => 'Revision'
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