<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th class="text-center"><a id="id">ID<i id="ic-direction"></i></a></th>
      <th class="text-center">Title</th>
      <th class="text-center">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($articles as $article)
   <tr>
    <td>{!! $article->id!!}</td>
    <td class="text-center">{{$article->title}}</td>
    <!-- <td> 
      <div> 
        <div class="row col-md-6" id="content">
            <div class="col-md-10">
              <div id="mycarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="item active">
                    <img src="{{ asset('updload/image/'.$article->picture) }}" alt="" class="img-responsive" width="300">
                       <div class="carousel-caption">
                       <h3>{{$article->title}}</h3>
                       </div>
                    </div>
                </div>
              </div>
            </div>
     </td> -->
  
            <!-- <h1>{{$article->title}}</h1>
            <p>{{$article->content}}</p>
           <i>By {{$article->author}}</i> -->
    
        <td> 
          <div>
            <a href="{{url('/articles/' .$article->id)}}" class="btn btn-success btn-sm" title="View Post"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
            <a href="{{url('/articles/' .$article->id. '/edit')}}" class="btn btn-warning btn-sm" title="Edit Post"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
            <a href="{{url('/articles/' .$article->id. '/destroy')}}" class="btn btn-danger btn-sm" title="Delete Post"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
            {!! Form::open(array('route' => array('articles.destroy', $article->id), 'method' => 'delete')) !!}
            {!! Form::submit('Delete', array('class' => 'btn btn-danger', "onclick" => "return confirm('are you sure?')")) !!}
            {!! Form::close() !!}
          </div>
          </td>
    </tr>
    <!--     </div>
      </div> -->
      
  @endforeach
  </tbody>
  </table>
  <div class="row col-md-8">
  {!! $articles->render() !!}
  </div>
  <input id="direction" type="hidden" value="asc" />

  