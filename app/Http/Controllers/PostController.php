<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Posts;

class PostController extends Controller
{
    //
    public function add()
  {
      return view('post.create');
  }

  // 以下を追記
  public function create(Request $request)
  {
      $this->validate($request, Posts::$rules);
      
      $posts = new Posts;
      $form = $request->all();

      // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
      if (isset($form['image'])) {
         $path = $request->file('image')->store('public/image');
         $posts->image_path = basename($path);
        
      } else {
        $posts->image_path = null;
      }
      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      // フォームから送信されてきたimageを削除する
      unset($form['image']);
      // データベースに保存する
      $posts->fill($form);
      $posts->save();
      
      return redirect('post/create');
      
  }
  
  public function index(Request $request)
  {
      $posts = Posts::all()->sortByDesc('updated_at');
      
      return view('post.index', ['posts' => $posts]);
  }
}
