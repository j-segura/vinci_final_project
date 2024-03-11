<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\CommentRequest;
use App\Models\Comment;
use App\Models\Project;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function store(CommentRequest $request, Project $project)
    {
        try {

            $data = $request->validated();

            $comment = new Comment();

            $comment->content = $data['comment'];
            $comment->author_id = auth()->user()->id;
            $comment->project_id = $project->id;

            $comment->save();

            return redirect()->route('pro.index')->with('success', 'Comment created successfully.');

        } catch (\Exception $ex) {

            $message = 'Error en el método' . __METHOD__ . ' / ' . $ex;
            Log::error($message);
            return false;

        }

    }
}
