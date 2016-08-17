<?php

    namespace Martin\BlogRevisions;

    use System\Classes\PluginBase;
    use RainLab\Blog\Controllers\Posts as PostsController;
    use RainLab\Blog\Models\Post as PostModel;
    use Martin\BlogRevisions\Models\Revision;

    class Plugin extends PluginBase {

        public $require = ['RainLab.Blog'];

        public function pluginDetails() {
            return [
                'name'        => 'martin.blogrevisions::lang.plugin.name',
                'description' => 'martin.blogrevisions::lang.plugin.description',
                'author'      => 'Martin M.',
                'icon'        => 'icon-history'
            ];
        }

        public function boot() {

            PostModel::extend(function ($model) {

                $model->hasMany['revisions'] = ['Martin\BlogRevisions\Models\Revision'];

                $model->bindEvent('model.beforeUpdate', function() use ($model) {
                    $revision = new Revision;
                    $revision->post_id = $model->id;
                    $revision->model   = $model['original'];
                    $revision->save();
                });

            });

            PostsController::extendFormFields(function ($form, $model) {
                if (!$model instanceof PostModel) return;
                $form->addSecondaryTabFields([
                    'blogrevisions' => [
                        'tab'         => 'revisions',
                        'type'        => 'Martin\BlogRevisions\FormWidgets\Revisions',
                    ]
                ]);
            });

        }

        public function registerFormWidgets() {
            return [
                'Martin\BlogRevisions\FormWidgets\Revisions' => [
                    'label' => 'Tag box field',
                    'code'  => 'tagbox'
                ]
            ];
        }

    }

?>