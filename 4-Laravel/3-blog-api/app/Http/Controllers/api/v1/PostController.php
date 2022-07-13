<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Auth;
use Validator;

class PostController extends Controller
{
    /**
     *
     * @OA\GET(
     *      path="/api/posts",
     *      operationId="getPostList",
     *      tags={"Post"},
     *      security={
     *       {"passport": {}},
     *      },
     *      summary="listing of all posts",
     *      description="Returns list of posts",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
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
    public function index()
    {
        $posts = PostResource::collection(Post::get());
        return $this->sendSuccessResponse($posts,"Posts get successfully!");
    }

    /**
     *
     * @OA\POST(
     *      path="/api/posts",
     *      operationId="StorePost",
     *      tags={"Post"},
     *      security={
     *       {"passport": {}},
     *      },
     *      summary="store post",
     *      description="Returns stored post.",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *  @OA\Parameter(
     *      name="post_title",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="post_category_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="post_author",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="post_date",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="post_content",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="post_status",
     *      in="query",
     *      required=true,
     *      description="Publish Or Draft",
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
            "post_title" => "required",
            "post_category_id" => "required",
            "post_author" => "required",
            "post_date" => "required",
            "post_content" => "required",
            "post_status" => "required",
        ]);

        if($validator->fails()){
            return $this->sendErrorResponse($validator->errors(),"something went wrong!");  
        }

        $imageName = null;

        if ($request->post_image) {
            $imageName = time().'.'.$request->post_image->extension();  
            $request->post_image->move(public_path('post_images'), $imageName);
        }


        $post = Post::create([
            "post_title" => $request->post_title,
            "post_category_id" => $request->post_category_id,
            "post_author" => $request->post_author,
            "post_date" => $request->post_date,
            "post_image" => 'post_images/' .$imageName,
            "post_content" => $request->post_content,
            "post_tags" => $request->post_tags,
            "post_status" => $request->post_status,
        ]);


        return $this->sendSuccessResponse($post,"Post added successfully!");
    }

    /**
     *
     * @OA\GET(
     *      path="/api/posts/{id}",
     *      operationId="showPostById",
     *      tags={"Post"},
     *      security={
     *       {"passport": {}},
     *      },
     *      @OA\Parameter(
     *        name="id",
     *        in="path",
     *        required=true,
     *        @OA\Schema(
     *             type="integer"
     *        )
     *      ),
     *      summary="show post by id",
     *      description="show post by id",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
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
    public function show($id)
    {
        $post = new PostResource(Post::findOrFail($id));
        return $this->sendSuccessResponse($post,"Post get successfully!");
    }

    /**
     *
     * @OA\PUT(
     *      path="/api/posts/{id}",
     *      operationId="UpdatePost",
     *      tags={"Post"},
     *      security={
     *       {"passport": {}},
     *      },
     *      summary="update post",
     *      description="Returns updated post.",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Parameter(
     *        name="id",
     *        in="path",
     *        required=true,
     *        @OA\Schema(
     *             type="integer"
     *        )
     *      ),
     *  @OA\Parameter(
     *      name="post_title",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="post_category_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="post_author",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="post_date",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="post_content",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="post_status",
     *      in="query",
     *      required=true,
     *      description="Publish Or Draft",
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
    public function update(Request $request, $id)
    {
        $validator =Validator::make($request->all(),[
            "post_title" => "required",
            "post_category_id" => "required",
            "post_author" => "required",
            "post_date" => "required",
            "post_content" => "required",
            "post_status" => "required",
        ]);

        if($validator->fails()){
             return $this->sendErrorResponse($validator->errors(),"something went wrong!");   
        }

        $post = Post::findOrFail($id);

         $imageColumn = null;

        if ($request->post_image) {
            //old image delete
            unlink($post->post_image);
            //then new image upload
            $imageName = time().'.'.$request->post_image->extension();  
            $request->post_image->move(public_path('post_images'), $imageName);
            $imageColumn = 'post_images/' .$imageName;
        }else{
            $imageColumn = $post->post_image;
        }


        $post->update([
            "post_title" => $request->post_title,
            "post_category_id" => $request->post_category_id,
            "post_author" => $request->post_author,
            "post_date" => $request->post_date,
            "post_image" => $imageColumn,
            "post_content" => $request->post_content,
            "post_tags" => $request->post_tags,
            "post_status" => $request->post_status,
        ]);   

        return $this->sendSuccessResponse($post,"Post updated successfully!");
    }

    /**
     * @OA\Delete(
     ** path="/api/posts/{id}",
     *   tags={"Post"},
     *   summary="delete post",
     *   operationId="PostDelete",
     *      security={
     *       {"passport": {}},
     *      },
     *   @OA\Parameter(
     *      name="id",
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
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return $this->sendSuccessResponse(new PostResource($post),"this post $post->post_title deleted successfully!");
    }
}