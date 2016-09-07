<?php

    namespace Martin\BlogRevisions\Models;

    use Model;

    class RevisionItem extends Model {

        public $table = 'rainlab_blog_revisions_items';

        protected $casts = [
            'model' => 'array',
        ];

        public $belongsTo = [
            'user' => 'Backend\Models\User'
        ];

        public function beforeCreate() {
            $rev  = self::select('revision')->where('revision_id', $this->model['id'])->orderBy('revision', 'desc')->first();
            $next = ($rev) ? $rev->revision + 1 : 1;
            $this->revision = $next;
        }

        public function afterFetch() {

            $this->view_title   = $this->model['title'];
            $this->view_content = $this->model['content'];

            if($this->user) {
                $this->view_user = $this->user->login;
                $this->view_name = $this->user->first_name . ' ' . $this->user->last_name;
            }

        }

    }

?>