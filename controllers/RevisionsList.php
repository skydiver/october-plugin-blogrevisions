<?php

    namespace Martin\BlogRevisions\Controllers;

    use BackendMenu;
    use Backend\Classes\Controller;

    class RevisionsList extends Controller {

        public $implement = [
            'Backend.Behaviors.FormController',
            'Backend.Behaviors.ListController',
            'Backend.Behaviors.RelationController'
        ];

        public $formConfig = 'config_form.yaml';
        public $listConfig = 'config_list.yaml';

        public $relationConfig = 'config_relation.yaml';

        public $requiredPermissions = ['martin.blogrevisions.access_revisions'];

        public function __construct() {
            parent::__construct();
            BackendMenu::setContext('RainLab.Blog', 'blog', 'revisions');
        }

        public function listExtendQuery($query) {
            $query->with('post')->groupBy('post_id');
        }

    }

?>