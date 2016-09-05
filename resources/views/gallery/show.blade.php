@extends("layouts.application")
  @section("content")
  <div>
    <img src="{{ asset('updload/image/'.$article->picture) }}" width="750">
  </div>
  
  @stop