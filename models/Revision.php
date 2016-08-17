<?php

    namespace Martin\BlogRevisions\Models;

    use Model;

    class Revision extends Model {

        public $table = 'rainlab_blog_revisions';

        protected $casts = [
            'model' => 'array',
        ];

        public function beforeCreate() {
            $rev  = self::select('revision')->where('post_id', $this->model['id'])->orderBy('revision', 'desc')->first();
            $next = ($rev) ? $rev->revision + 1 : 1;
            $this->revision = $next;
        }

    }

?>