<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Comment\DeleteCommentRequest;
use App\Http\Requests\V1\Comment\GetCommentRequest;
use App\Http\Requests\V1\Comment\StoreCommentRequest;
use App\Http\Requests\V1\Comment\UpdateCommentRequest;
use App\Http\Resources\V1\CommentResource;
use App\Models\Comment;
use App\Services\CommentService;

class CommentController extends Controller
{
    public function __construct(protected CommentService $comment_service)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(GetCommentRequest $request)
    {
        try {
            return $this->comment_service->find_all($request);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        try {
            return new CommentResource(Comment::create($request->all()));
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        try {
            return new CommentResource($comment);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        try {
            return $comment->update($request->all());
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteCommentRequest $request)
    {
        try {
            $comment = Comment::where(['id' => $request->id])->first();
            return $comment->delete();
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
