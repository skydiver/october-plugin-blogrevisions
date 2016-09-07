<?php

    namespace Martin\BlogRevisions\Controllers;

    use Backend;
    use Backend\Classes\Controller;
    use Martin\BlogRevisions\Models\RevisionItem;

    class Revisions extends Controller {

        public $implement = [
            'Backend.Behaviors.FormController',
        ];

        public $formConfig = 'config_form.yaml';

        public function view($id) {
            $this->vars['revision'] = RevisionItem::find($id);
            $this->asExtension('FormController')->update($id);
            return $this->makePartial('view');
        }

    }

?>