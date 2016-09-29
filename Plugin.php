<?php

    namespace Martin\BlogRevisions;

    use BackendAuth;
    use System\Classes\PluginBase;
    use RainLab\Blog\Controllers\Posts as PostsController;
    use RainLab\Blog\Models\Post as PostModel;
    use Martin\BlogRevisions\Models\Revision;
    use Martin\BlogRevisions\Models\RevisionItem;

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

            \Event::listen('backend.menu.extendItems', function($manager) {
                $manager->addSideMenuItems('RainLab.Blog', 'blog', [
                    'revisions' => [
                        'label'       => 'martin.blogrevisions::lang.menuitem.revisions',
                        'icon'        => 'icon-history',
                        'order'       => 500,
                        'url'         => \Backend::url('martin/blogrevisions/revisionslist'),
                        'permissions' => ['rainlab.blog.access_posts'],
                    ]
                ]);
            });

            PostModel::extend(function ($model) {

                $model->hasOne = [
                    'revision' => ['Martin\BlogRevisions\Models\Revision']
                ];

                $model->bindEvent('model.beforeSave', function() use ($model) {
                    unset($model->blogrevisions);
                });

                $model->bindEvent('model.afterSave', function() use ($model) {
                    $revision = Revision::firstOrCreate(['post_id' => $model->id]);
                });

                $model->bindEvent('model.beforeDelete', function() use ($model) {
                    $revision = Revision::firstOrCreate(['post_id' => $model->id]);
                    $revision->deleted_model    = $model['original'];
                    $revision->deleted_by       = BackendAuth::getUser()['id'];
                    $revision->deleted_by_login = BackendAuth::getUser()['login'];
                    $revision->deleted_model_at = date('Y-m-d H:i:s');
                    $revision->save();
                });

                $model->bindEvent('model.beforeUpdate', function() use ($model) {
                    $revision = Revision::firstOrCreate(['post_id' => $model->id]);
                    $item = new RevisionItem;
                    $item->revision_id = $revision->id;
                    $item->user_id     = BackendAuth::getUser()['id'];
                    $item->model       = $model['original'];
                    $item->save();
                });

            });

            PostsController::extendFormFields(function ($form, $model) {

                if(!$model instanceof PostModel) { return; }

                if(!$model->id) { return; }

                $form->addSecondaryTabFields([
                    'blogrevisions' => [
                        'tab'  => 'martin.blogrevisions::lang.misc.tab_name',
                        'type' => 'Martin\BlogRevisions\FormWidgets\Revisions',
                    ]
                ]);

            });

        }

        public function registerFormWidgets() {
            return [
                'Martin\BlogRevisions\FormWidgets\Revisions' => [
                    'label' => 'Blog Revisions',
                    'code'  => 'Widget to display blog revisions'
                ]
            ];
        }

    }

?>