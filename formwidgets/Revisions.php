<?php

    namespace Martin\BlogRevisions\FormWidgets;

    use Config;
    use Backend\Classes\FormWidgetBase;
    use Martin\BlogRevisions\Controllers\Revisions as ControllerRevisions;

    class Revisions extends FormWidgetBase {

        public function widgetDetails() {
            return [
                'name'        => 'Tag Box Field',
                'description' => 'Tagbox using AJAX'
            ];
        }




        public function onShow() {
            $pepe = new ControllerRevisions;
            return $pepe->view(post('revision_id'));
        }





        public function render() {
            $this->prepareVars();
            return $this->makePartial('widgets');
        }

        public function prepareVars() {
            $this->vars['id']        = $this->model->id;
            $this->vars['revisions'] = $this->model->revisions;
        }

        // public function loadAssets() {
        //     $this->addCss('css/jquery.taghandler.css');
        //     $this->addCss('css/jquery-ui-1.8.2.custom.css');
        //     $this->addJs('js/jquery-ui-11.min.js');
        //     $this->addJs('js/jquery.taghandler.min.js');
        // }




    }

?>