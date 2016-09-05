@extends("layouts.application")
@section("content")
  <h1>article page</h1>
  <div>{!! link_to('articles/create', 'Write Article', array('class' => 'btn btn-success')) !!}</div>
  <div id="list-article">
    @include('articles.list')
  </div>
@stop


  function get_page(page) {

  $.ajax({

    url : '/articles?page=' + page,

    type : ‘GET’,

    dataType : 'json',

    success : function(data) {

      $('#articles-list').html(data['view']);

    },

    error : function(xhr, status, error) {

      console.log(xhr.error + "\n ERROR STATUS : " + status + "\n" + error);

    },

    complete : function() {

      alreadyloading = false;

    }

  });

}


  </script>
@stop