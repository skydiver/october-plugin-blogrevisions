<?php

    namespace Martin\BlogRevisions\Models;

    use Model;

    class Revision extends Model {

        public $table = 'rainlab_blog_revisions';

        protected $fillable = ['post_id'];

        protected $casts = [
            'deleted_model' => 'array'
        ];

        public $hasMany = [
            'revisionitems' => 'Martin\BlogRevisions\Models\RevisionItem'
        ];

        public $belongsTo = [
            'post' => 'RainLab\Blog\Models\Post'
        ];

    }

?>