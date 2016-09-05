<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
      'title', 'content', 'author', 'picuture'
    ];

    public static function valid($id='') {
      return array(
        'title' => 'required|min:10|unique:articles,title'.($id ? ",$id" : ''),
        'content' => 'required|min:100|unique:articles,content'.($id ? ",$id" : ''),
        'author' => 'required',
        'picture' => 'required'
      );
    }

    public function comments() {
     return $this->hasMany('App\Comment', 'article_id');
  }

  public function export(){
    Excel::create('Filename', function($excel) {

  })->export('xls');
  
  }
  
}
