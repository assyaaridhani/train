<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public static function valid() {

    return array(

      'content' => 'required'

    );

  }

  public function article() {

    return $this->belongsTo('App\Article', 'article_id');

  }
}
