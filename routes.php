<?php

    use Martin\Revisions\Models\Revision;
    /**
     * get available tags and assigned tags by post id
     */
    Route::get('martin/blogrevisions/view/{revision_id}', ['as' => 'blog.revisions.view', function($revision_id) {
        // $availableTags = Tag::all()->lists('name');
        // $assignedTags  = Tag::whereHas('posts', function($q) use ($postId) {
        //     $q->where('id', $postId);
        // })->lists('name');
        // $response = [
        //     'assignedTags'  => $assignedTags,
        //     'availableTags' => $availableTags
        // ];
        return Response::json($revision_id);
    }]);

?>