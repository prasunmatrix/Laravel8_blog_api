<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use File;

use App\Models\Blog;

class BlogController extends Controller
{
  public function createBlogs(Request $request)
  {
    //echo "test";
    $blogs = new Blog;
    $blogs->title = $request->title;
    $blogs->description = $request->description;
    $blogs->save();

    return response()->json([
      "message" => "Blog record created"
    ], 201);
  }
  public function getAllBlogs()
  {
    //$blogs = Blog::get()->toJson(JSON_PRETTY_PRINT);
    //return response($blogs, 200);
    $blogs = Blog::get();
    return [
      "status" => 200,
      "data" => $blogs
    ]; 
  }
  public function getBlogs($id)
  {
    if (Blog::where('id', $id)->exists()) {
      $blog = Blog::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
      return response($blog, 200);
    } else {
      return response()->json([
        "message" => "Blog not found"
      ], 404);
    }
  }
  public function updateBlog(Request $request, $id)
  {
    if (Blog::where('id', $id)->exists()) {
      $blog = Blog::find($id);
      $blog->title = is_null($request->title) ? $blog->title : $request->title;
      $blog->description = is_null($request->description) ? $blog->description : $request->description;
      $blog->save();

      return response()->json([
        "message" => "records updated successfully"
      ], 200);
    } else {
      return response()->json([
        "message" => "Blog not found"
      ], 404);
    }
  }
  public function deleteBlogs($id)
  {
    if (Blog::where('id', $id)->exists()){
      $blog=Blog::find($id);
      $blog->delete();
      return response()->json([
        "message" =>"record deleted"
      ],200);
    } else {
      return response()->json([
        "message"=>"Blog not found"
      ],404);
    } 
  }
}
