<?php

    namespace Martin\BlogGallery\Updates;

    use Schema;
    use October\Rain\Database\Updates\Migration;

    class CreateBlogGalleryField extends Migration {

        public function up() {

            Schema::create('rainlab_blog_revisions', function($table) {
                $table->increments('id')->unsigned();
                $table->integer('post_id' )->unsigned()->nullable();
                $table->foreign('post_id' )->references('id')->on('rainlab_blog_posts')->onDelete('CASCADE');
                $table->timestamps();
                $table->unique(['post_id']);
            });

            Schema::create('rainlab_blog_revisions_items', function($table) {
                $table->increments('id')->unsigned();
                $table->integer('revision')->unsigned();
                $table->integer('revision_id')->unsigned()->nullable();
                $table->foreign('revision_id')->references('id')->on('rainlab_blog_revisions');
                $table->integer('user_id'    )->unsigned()->nullable();
                $table->foreign('user_id'    )->references('id')->on('backend_users');
                $table->json   ('model'      );
                $table->timestamps();
                $table->unique(['revision', 'revision_id']);
            });

        }

        public function down() {
            Schema::drop('rainlab_blog_revisions_items');
            Schema::drop('rainlab_blog_revisions');
        }

    }

?>