<?php

    namespace Martin\BlogRevisions\Models;

    use Model;

    class RevisionItem extends Model {

        public $table = 'rainlab_blog_revisions_items';

        protected $casts = [
            'model' => 'array',
        ];

        public function beforeCreate() {
            $rev  = self::select('revision')->where('revision_id', $this->model['id'])->orderBy('revision', 'desc')->first();
            $next = ($rev) ? $rev->revision + 1 : 1;
            $this->revision = $next;
        }

    }

?>