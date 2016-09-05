<?php
  namespace App\Http\Controllers;
  use Illuminate\Http\Request;
  use App\Http\Requests;
  use App\Http\Controllers\Controller;
  use App\Comment, App\Article;
  use Validator, Session;

  class CommentsController extends Controller {
    public function store(Request $request)
    {
      $validate = Validator::make($request->all(), Comment::valid());
      if($validate->fails()) {
        return redirect('articles/'. $request->article_id)
          ->withErrors($validate)
          ->withInput();
      } else {
        Comment::create($request->all());
        Session::flash('notice', 'Success add comment');
        return redirect('articles/'. $request->article_id);
      }
    }
  }