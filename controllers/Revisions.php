<?php

    namespace Martin\BlogRevisions\Controllers;

    use Backend, BackendMenu, Flash, Lang;
    use Backend\Classes\Controller;
    use System\Classes\SettingsManager;
    use Martin\BlogRevisions\Models\Revision;

    class Revisions extends Controller {

        public $implement = [
            'Backend.Behaviors.FormController',
        ];

        public $formConfig = 'config_form.yaml';

        public function view($id) {
            $this->vars['revision'] = Revision::find($id);
            $this->asExtension('FormController')->update($id);
            return $this->makePartial('view');
        }

    }

?>