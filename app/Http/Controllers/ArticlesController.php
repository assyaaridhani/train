<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Article;
use Validator, Session, File, Image, Input;
use Intervention\Image\ImageManager;
use App\Repositories\ImageRepository;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
    {

    if($request->ajax()) {

      if($request->keywords && empty($request->direction)){
        $articles = Article::where('title','like','%'.$request->keywords.'%')
            ->orWhere('content','like','%'.$request->keywords.'%')
            ->paginate(4);
      }else if($request->direction){
         $articles = Article::where('title','like','%'.$request->keywords.'%')
            ->orWhere('content','like','%'.$request->keywords.'%')
            ->orderBy('id', $request->direction)
            ->paginate(4);
         $request->direction == 'asc' ? $direction = 'desc' : $direction = 'asc';    
      }else{
         $articles = Article::paginate(4);
      }


      $view = (String)view('articles._list')

        ->with('articles', $articles)

        ->render();
      if (empty($direction)) {
        $direction = 'empty';
      }
     // $direction=isset($direction)?$direction:'desc'; 
      return response()->json(['view' => $view, 'direction'=>$direction]);

    } else {

      $articles = Article::orderBy('created_at', 'desc')->paginate(4);

        return view('articles.index')

      ->with('articles', $articles);

    }

  }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), Article::valid());
        if($validate->fails()) {
         return back()
            ->withErrors($validate)
            ->withInput();
          } else {
            $add = new Article();
            $add -> title = $request['title'];
            $add -> content = $request['content'];
            $add -> author = $request['author'];
            $photo = $request-> file('picture');
            $image_location = public_path().'/updload/image/';
            $name = $photo->getClientOriginalName();
            $request->file('picture')->move($image_location, $name);

            $add->picture=$name;
            $add->save();

            if(!File::exists($image_location)){
                File::makeDirectory($image_location, $mode=0777, true, true);
            }
            Session::flash('notice', 'Success add article');
            return redirect('articles');
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        $comments = Article::find($id)->comments->sortBy('Comment.created_at');
            return view('articles.show')
                ->with('article', $article)
                ->with('comments', $comments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        return view('articles.edit')
        ->with('article', $article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), Article::valid($id));
        if($validate->fails()) {
         return back()
         ->withErrors($validate)
         ->withInput();
        } else {
          $update = Article::where('id',$id) -> first();
          $update->title = $request['title'];
          $update->content = $request['content'];
          $update->author = $request['author'];
          if($request->file('picture')){
            $update->picture= $update->picture;
          }else{
            $photo = $request->file('picture');
            $image_location = public_path().'/updload/image/';
            $name = $photo->getClientOriginalName();
            $request->file('picture')->move($image_location, $name);
            $update->photo = $name;
          }

          $update->update();
          Session::Flash('notice', 'success update articles');
          return redirect('articles');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        if ($article->delete()) {
          Session::flash('notice', 'Article success delete');
          return redirect('articles');
        } else {
          Session::flash('error', 'Article fails delete');
          return redirect('articles');
        }
    }
}
