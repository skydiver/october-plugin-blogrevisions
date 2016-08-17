<?php

    namespace Martin\BlogRevisions\Models;

    use Model;

    class Revision extends Model {

        public $table = 'rainlab_blog_revisions';

        protected $casts = [
            'model' => 'array',
        ];

    }

?>