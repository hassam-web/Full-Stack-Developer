<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Auth;
class CommentController extends Controller
{
    public function store_comment(Request $request,$post_id)
    {
        $request->validate([
            'comment_content' => 'required'
        ]);

        $user_id = Auth::id();


        Comment::create([
            'comment_user_id' => $user_id,
            'comment_post_id' => $post_id,
            'comment_content' => $request->comment_content,
            'comment_status' => 'unapproved'
        ]);

        return back()->with(['success' => 'your comment added successfully please wait for approve your comment!']);
    }
    public function index()
    {
        $comments = Comment::get();
        return view('admin.comments.index',compact('comments'));
    }
    public function destroy(Request $request,Comment $comment)
    {
        $comment->delete();
        return back()->with(['success' => 'comment deleted successfully!']);
    }
    public function comment_status(Request $request,Comment $comment)
    {
        $request->validate(['status' => 'required']);

        if ($request->status == 'unapproved') {
            $comment->update(['comment_status' => 'unapproved']);
        } else if($request->status == 'approved'){
            $comment->update(['comment_status' => 'approved']);
        }else{
            return back();
        }

        return back()->with(["success" => "now comment status is {$request->status}"]);

    }

    public function api_update_status(Request $request)
    {
        $request->validate([
            'bulk_option' => 'required',
            'comment_ids' => 'required|array',
        ]);

        $comment_ids = $request->comment_ids;
        $bulk_option = $request->bulk_option;

        $responseMessage = '';

        if (count($comment_ids) > 0) {
            foreach ($comment_ids as $key => $single_comment_id) {
                $comment_find = Comment::find($single_comment_id);

                $status = '';

                switch ($bulk_option) {
                    case 'approved':
                        $status = 'approved';
                        break;
                    case 'unapproved':
                        $status = 'unapproved';
                        break;
                    case 'delete':
                        $status = 'delete';
                        break;
                }

                if ($status == 'delete') {
                    $comment_find->delete();
                    $responseMessage = 'Comment deleted successfully!';
                }else{
                    $comment_find->update(['comment_status' => $status]);
                    $capitalStatus = ucfirst($status);
                    $responseMessage = "All comment status changed to $capitalStatus";
                }

            }
        }

        return response()->json([
            'data' => $comment_ids,
            'message' => $responseMessage,
        ]);
    }
}