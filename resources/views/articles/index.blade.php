@extends("layouts.application")
@section("content")
  <div class="col-md-6 pull-left off-canvas">{!! link_to('articles/create', 'Write Article', array('class' => 'btn btn-success')) !!}</div>
   <div id=”articles-list”>
    <div class="row">
      <div class="col-md-6 search pull-right off-canvas"> 
        <div class="col-md-10">
          <div class="input-group input-group-sm">
            <input type="text" class="form-control" id="keywords" placeholder="Keywords">
             <span class="input-group-btn">
             <button id="search" class="btn btn-info btn-flat" type="button">
               Search
             </button>
             </span>
          </div>
        </div>
      </div>
    </div>
   
  <div id="articles-list">
  @include('articles._list')
  </div>
  </div>
  {{ link_to('export', 'Export to Excel file', array('class' => 'btn btn-warning')) }}
  <form action="postImport" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="file" name="articles">
    <input type="submit" value="import"></input>
  </form>
  <script src="/assets/custom/js/list.js"></script>
  <script src="/assets/custom/js/sorting.js"></script>
   <script src="/assets/custom/js/search.js"></script>
  
  @stop