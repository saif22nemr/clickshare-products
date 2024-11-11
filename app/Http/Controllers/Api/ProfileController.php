<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Resources\Post\PostResponse;
use App\Http\Resources\Post\PostsResponse;
use App\Http\Resources\ProfileResouce;
use App\Models\Post;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct(){
        $this->middleware('auth:sanctum');
    }
    public function profile(){

        $user = auth('sanctum')->user();
        return $this->successResponse(data:  new ProfileResouce($user));
    }

}
