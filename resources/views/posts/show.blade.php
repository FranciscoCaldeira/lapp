@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-2 col-sm-2">
            <a href="/posts" class="btn btn-default">Atrás</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4 col-sm-4">
        <img src="/storage/cover_images/{{$post->cover_image}}" alt="imagem" style="width:100%" >
        </div>
        <div class="col-md-8 col-sm-8">
            <h1>{{$post->title}}</h1><!-- vai buscar o title da bd , o $ vem do controller que foi dado à view para aceder-->
            <small>criado a {{$post->created_at}} por {{$post->user->name}}</small>
            <h6>{!!$post->body!!}</h6> <!-- permite q seja feito tags dentro -->
            
        </div>
    </div>
    
    <hr>
    @if (!Auth::guest()) <!-- !(guest)=logado -->
        @if (Auth::user()->id == $post->user_id) <!-- user-id == posts-user_id -->
            <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Editar</a>

            <!-- boão de apagar com formulario -->
        
            {!!Form::open(['action' => ['PostsController@destroy',$post->id], 'method'=>'POST', 'class'=>'pull-right'])!!}
                {{Form::hidden('_method','DELETE')}}
                {{Form::submit('Delete',['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
        @endif
    @endif

@endsection
