@extends('layouts.app')
@section('content')
    <h1>Posts</h1>
    <a href="posts/create" > Criar post</a>
    @if (count($posts)>0)
        @foreach ($posts as $item)
            <div class="well">
                
                <h3><a href="/posts/{{$item->id}}">{{$item->title}}</a></h3> <!-- vai buscar o title/id da bd -->
                <small>Criado em {{$item->created_at}} por {{$item->user->name}} </small> <!--  do $ item -> vai ao userModel buscar os campos dele -->
                
                <a href="/posts/{{$item->id}}/edit" class="btn btn-default ">Editar</a>
                
            </div>
        @endforeach
        {{$posts->links()}}
    @else
        <p>False- sem posts </p>
    @endif
@endsection