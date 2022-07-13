<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use Auth;
use Illuminate\Http\Request;
use Validator;

class CommentController extends Controller
{
    /**
     * @OA\GET(
     ** path="/api/comments/{post_id}",
     *   tags={"Comment"},
     *   summary="get comments",
     *   operationId="GetComments",
     *      security={
     *       {"passport": {}},
     *      },
     *   @OA\Parameter(
     *      name="post_id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function index(Request $request,$post_id)
    {
        $post = Post::with('comments','comments.user','comments.post','comments.post.category')->findOrFail($post_id);
        $collectionComments = CommentResource::collection($post->comments);
        return $this->sendSuccessResponse($collectionComments,"Comments get successfully!");
    }

    /**
     *
     * @OA\POST(
     *      path="/api/comments",
     *      operationId="StoreComment",
     *      tags={"Comment"},
     *      security={
     *       {"passport": {}},
     *      },
     *      summary="store comment",
     *      description="Returns stored comment.",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *   @OA\Parameter(
     *      name="post_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="comment_content",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ), 
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     *
     */

    public function store(Request $request)
    {
        $validator =Validator::make($request->all(),[
            'comment_content' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendErrorResponse($validator->errors(),"something went wrong!");  
        }

        $user_id = Auth::id();
        $post_id = $request->post_id;

        $post_find = Post::findOrFail($post_id);

        $comment = Comment::create([
            'comment_user_id' => $user_id,
            'comment_post_id' => $post_id,
            'comment_content' => $request->comment_content,
            'comment_status' => 'unapproved'
        ]);

        return $this->sendSuccessResponse(new CommentResource($comment),"comment store successfully");
    }


    /**
     * @OA\GET(
     ** path="/api/comments/approve/{comment_id}",
     *   tags={"Comment"},
     *   summary="approve comment",
     *   operationId="approveComment",
     *      security={
     *       {"passport": {}},
     *      },
     *   @OA\Parameter(
     *      name="comment_id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function comment_approve(Request $request,$comment_id)
    {
        $comment = Comment::findOrFail($comment_id);   

        $comment->update(['comment_status' => 'approved' ]);

        return $this->sendSuccessResponse(new CommentResource($comment),"comment approved successfully");
    }
    /**
     * @OA\GET(
     ** path="/api/comments/unapprove/{comment_id}",
     *   tags={"Comment"},
     *   summary="unapprove comment",
     *   operationId="unapproveComment",
     *      security={
     *       {"passport": {}},
     *      },
     *   @OA\Parameter(
     *      name="comment_id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function comment_unapprove(Request $request,$comment_id)
    {
        $comment = Comment::findOrFail($comment_id);   

        $comment->update(['comment_status' => 'unapproved' ]);

        return $this->sendSuccessResponse(new CommentResource($comment),"comment unapproved successfully");
    }

}