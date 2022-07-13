<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     *
     * @OA\GET(
     *      path="/api/count",
     *      operationId="getCount",
     *      tags={"Dashboard"},
     *      security={
     *       {"passport": {}},
     *      },
     *      summary="counts of all tables",
     *      description="Returns list of counts",
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
     *      @OA\Response(
     *       response=400,
     *       description="Bad Request"
     *      ),
     *      @OA\Response(
     *        response=404,
     *        description="not found"
     *      )
     *  )
     *
     */
    public function index()
    {
       $posts_count = Post::get()->count();
       $comments_count = Comment::get()->count();
       $users_count = User::get()->count();
       $categories_count = Category::get()->count();

        return $this->sendSuccessResponse([
            'posts_count' => $posts_count,
            'comments_count' => $comments_count,
            'users_count' => $users_count,
            'categories_count' => $categories_count
        ],'all counts get successfully!');
    }
}