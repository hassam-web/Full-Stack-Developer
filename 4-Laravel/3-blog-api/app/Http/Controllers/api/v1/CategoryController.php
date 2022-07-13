<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Validator;

class CategoryController extends Controller
{
    /**
     *
     * @OA\GET(
     *      path="/api/categories",
     *      operationId="getCategoryList",
     *      tags={"Category"},
     *      security={
     *       {"passport": {}},
     *      },
     *      summary="listing of all categories",
     *      description="Returns list of categories",
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
        $categories = CategoryResource::collection(Category::get());
        return $this->sendSuccessResponse($categories,"Categories get successfully!");
    }

     /**
     *
     * @OA\POST(
     *      path="/api/categories",
     *      operationId="StoreCategories",
     *      tags={"Category"},
     *      security={
     *       {"passport": {}},
     *      },
     *      summary="store categories",
     *      description="Returns stored categories.",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *   @OA\Parameter(
     *      name="cat_title",
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
            'cat_title' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendErrorResponse($validator->errors(),"something went wrong!");  
        }

        $user = Category::create([
          "cat_title" => $request->cat_title
        ]);


        $responseData = [
            'data' => new CategoryResource($user)
        ];


        return $this->sendSuccessResponse($responseData,"Category added successfully!");
    }


    /**
     *
     * @OA\PUT(
     *      path="/api/categories/{id}",
     *      operationId="UpdateCategory",
     *      tags={"Category"},
     *      security={
     *       {"passport": {}},
     *      },
     *      summary="update category",
     *      description="Returns updated category.",
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
     *   @OA\Parameter(
     *      name="cat_title",
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
    public function update(Request $request, $id)
    {
        $validator =Validator::make($request->all(),[
            'cat_title' => 'required'
        ]);

        if($validator->fails()){
             return $this->sendErrorResponse($validator->errors(),"something went wrong!");   
        }

        $category = Category::findOrFail($id);
        $category->update([
            'cat_title' => $request->cat_title
        ]);
        
        $data = [
            'data' => new CategoryResource($category)
        ];

        return $this->sendSuccessResponse($data,"Category updated successfully!");
    }

    /**
     * @OA\GET(
     ** path="/api/categories/{id}",
     *   tags={"Category"},
     *   summary="show category",
     *   operationId="CategoryShow",
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
    public function show($id)
    {
        $category = Category::findOrFail($id);

        return $this->sendSuccessResponse(new CategoryResource($category),"category get successfully!");
    }

    /**
     * @OA\Delete(
     ** path="/api/categories/{id}",
     *   tags={"Category"},
     *   summary="delete category",
     *   operationId="CategoryDelete",
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
        $category = Category::findOrFail($id);
        $category->delete();

        return $this->sendSuccessResponse(new CategoryResource($category),"this category ($category->cat_title) deleted successfully!");
    }
}