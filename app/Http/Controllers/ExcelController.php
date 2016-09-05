<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Article;
use App\Comment;
use Validator, Session, Input, File, Image, Storage;
use App\Http\Controllers\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function export() {
      //dd($articles = Article::get()->toArray(););
      try {
          Excel::create('Article', function ($excel) {
            $excel->sheet('Articles', function ($sheet) {
              // first row styling and writing content
              $sheet->setWidth('A', 5);
              // getting data to display - in my case only one record
              $articles = Article::get()->toArray();
              // setting column names for data - you can of course set it manually
              $sheet->appendRow(array_keys($articles[0])); // column names
              // getting last row number (the one we already filled and setting it to bold
              $sheet->row($sheet->getHighestRow(), function ($row) {
                  $row->setFontWeight('bold');
              });
              // putting users data as next rows
              foreach ($articles as $article) {
                  $sheet->appendRow($article);
              }
            });
          })->export('xls');
       } catch (\Exception $e) {
          dd($e);
       }
    }

    public function import() {
        Excel::load(Input::file('article'), function($reader){

            foreach ($reader->toArray() as $sheet) {
                Article::firstOrCreate($sheet);
            };
        });
        dd(Input::file('article'));
            return redirect ('articles');
    }


   public function getImport(){
      return view('excel.importBook');
   }

   public function postImport(){
      Excel::load(Input::file('articles'), function($reader){
        $reader->each(function($sheet){
          Article::firstOrCreate($sheet->toArray());
      });
   });
    return redirect('articles');
  }
}