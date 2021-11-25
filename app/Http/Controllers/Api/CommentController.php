<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

/**
 * The controller to control all models relating to comments
 */
class CommentController extends Controller
{
    /**
     * List the comments ordered by ascending along with its child comments
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Comment::orderBy('created_at', 'desc')->get();

        /* TODO: Need to improvement */
        foreach($data as $item) {
            // A magic way to override the magic __get function for Laravel Model
            $item->children = array_merge($data->where('parent_id', $item->id)->all(), []);
        }
        $comments = $data->whereNull('parent_id');

        return $comments;
    }


    /**
     * Store a newly created comments in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'comment' => 'required'
        ], [
            'name.required' => 'Name is required',
            'comment.required' => 'Please write a comment'
        ]);

        $comment = Comment::create($request->all());

        // Set children to empty array to be used in front-end
        $comment->children = [];

        return response()->json([
            'message' => "New comment[ID: {$comment->id}] added",
            'data' => $comment
        ]);
    }
}
