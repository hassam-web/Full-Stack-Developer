<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Validator;
class UserController extends Controller
{

    /**
     *
     * @OA\GET(
     *      path="/api/users",
     *      operationId="getUserList",
     *      tags={"User"},
     *      security={
     *       {"passport": {}},
     *      },
     *      summary="listing of all users",
     *      description="Returns list of users",
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
        $users = UserResource::collection(User::get());
        return $this->sendSuccessResponse($users,"Users get successfully!");
    }

    /**
     *
     * @OA\POST(
     *      path="/api/users",
     *      operationId="StoreUser",
     *      tags={"User"},
     *      security={
     *       {"passport": {}},
     *      },
     *      summary="store user",
     *      description="Returns stored user.",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *   @OA\Parameter(
     *      name="username",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *
     *    @OA\Parameter(
     *      name="user_firstname",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *    @OA\Parameter(
     *      name="user_lastname",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *
     *  @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="password",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *    @OA\Parameter(
     *      name="user_role",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
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
            'username' => 'required',
            'password' => 'required',
            'user_firstname' => 'required',
            'user_lastname' => 'required',
            'email' => 'required|email',
            'user_role' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendErrorResponse($validator->errors(),"something went wrong!");  
        }

        $imageName = null;

        if ($request->user_image) {
            $imageName = "user_images/" .time().'.'.$request->user_image->extension();  
            $request->user_image->move(public_path('user_images'), $imageName);
        }


        $user = User::create([
          "username" => $request->username,
          "user_firstname" => $request->user_firstname,
          "user_lastname" => $request->user_lastname,
          "email" => $request->email,
          "password" => Hash::make($request->password),
          "user_role" => $request->user_role,
          "user_image" => $imageName
        ]);

        $token =  $user->createToken('MyApp')->accessToken;


        $responseData = [
            'token' => $token,
            'data' => new UserResource($user)
        ];


        return $this->sendSuccessResponse($responseData,"User added successfully!");
    }

    /**
     *
     * @OA\GET(
     *      path="/api/users/{id}",
     *      operationId="showUserById",
     *      tags={"User"},
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
     *      summary="show user by id",
     *      description="show user by id",
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
        $user = new UserResource(User::findOrFail($id));
        return $this->sendSuccessResponse($user,"User get successfully!");
    }

    /**
     *
     * @OA\PUT(
     *      path="/api/users/{id}",
     *      operationId="UpdateUser",
     *      tags={"User"},
     *      security={
     *       {"passport": {}},
     *      },
     *      summary="update user",
     *      description="Returns updated user.",
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
     *      name="username",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *
     *    @OA\Parameter(
     *      name="user_firstname",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *    @OA\Parameter(
     *      name="user_lastname",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *
     *  @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="password",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *    @OA\Parameter(
     *      name="user_role",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
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
            'username' => 'required',
            'password' => 'required',
            'user_firstname' => 'required',
            'user_lastname' => 'required',
            'email' => 'required|email',
            'user_role' => 'required',
        ]);

        if($validator->fails()){
             return $this->sendErrorResponse($validator->errors(),"something went wrong!");   
        }

        $user = User::findOrFail($id);

        $user_image_var = null;

        if ($request->user_image) {
            //old image delete
            if ($user->user_image) {
                unlink($user->user_image);
            }
            //then new image upload
            $imageName = time() . '.' . $request->user_image->extension();
            $request->user_image->move(public_path('user_images'), $imageName);
            $user_image_var = 'user_images/' . $imageName;
        } else {
            $user_image_var = $user->user_image;
        }


        $user->update([
            "username" => $request->username,
            "user_firstname" => $request->user_firstname,
            "user_lastname" => $request->user_lastname,
            "email" => $request->user_email,
            "user_role" => $request->user_role,
            "user_image" => $user_image_var,
            "password" => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        $token =  $user->createToken('MyApp')->accessToken;

        $data = [
            'token' => $token,
            'data' => new UserResource($user)
        ];

        return $this->sendSuccessResponse($data,"User updated successfully!");
    }

    /**
     * @OA\Delete(
     ** path="/api/users/{id}",
     *   tags={"User"},
     *   summary="delete user",
     *   operationId="UserDelete",
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
        $user = User::findOrFail($id);
        $user->delete();

        return $this->sendSuccessResponse(new UserResource($user),"this user $user->username deleted successfully!");
    }
    /**
     * @OA\Post(
     ** path="/api/login",
     *   tags={"User"},
     *   summary="user login",
     *   operationId="UserLogin",
     *
     *  @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *
     *    @OA\Parameter(
     *      name="password",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
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
    public function login(Request $request)
    {
        $validator =Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            // return response()->json($validator->errors());
            return $this->sendErrorResponse($validator->errors(),"something went wrong!");       
        }

        $credentials = $request->only('email', 'password');


        $login = Auth::attempt($credentials);

        if ($login) {
            $user = Auth::user();
            $token = $user->createToken('MyApp')->accessToken;
            $data = [
                'token' => $token,
                'user' => new UserResource($user),
            ];

            return $this->sendSuccessResponse($data,"users is logged in successfully!");
        }else{
            return $this->sendErrorResponse("UnAuthorize","something went wrong!");   
        }
    }
}