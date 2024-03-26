<?php

namespace App\Services;

use App\Filters\V1\CommentsFilter;
use App\Http\Requests\V1\Comment\GetCommentRequest;
use App\Http\Resources\V1\CommentResource;
use App\Models\Comment;

class CommentService
{
  public function find_all(GetCommentRequest $request)
  {
    $filter = new CommentsFilter();
    $filter_items = $filter->transform($request);

    $comments = Comment::where($filter_items);

    $include_user = $request->query('include_user');
    $include_task = $request->query('include_task');

    if ($include_user) {
      $comments = $comments->with('user');
    }

    if ($include_task) {
      $comments = $comments->with('task');
    }

    return CommentResource::collection($comments->paginate()->appends($request->query()));
  }
}
