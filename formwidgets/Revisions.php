<?php

    namespace Martin\BlogRevisions\FormWidgets;

    use Config;
    use Backend\Classes\FormWidgetBase;
    use Martin\BlogRevisions\Controllers\Revisions as ControllerRevisions;

    class Revisions extends FormWidgetBase {

        public function widgetDetails() {
            return [
                'name'        => 'Blog Revisions',
                'description' => 'Widget to display blog revisions'
            ];
        }

        public function onShow() {
            $pepe = new ControllerRevisions;
            return $pepe->view(post('revision_item_id'));
        }

        public function render() {
            $this->prepareVars();
            return $this->makePartial('widgets');
        }

        public function prepareVars() {
            $this->vars['id']        = $this->model->id;
            $this->vars['revisions'] = ($this->model->revision->revisionitems) ? $this->model->revision->revisionitems : null;
        }

    }

?>