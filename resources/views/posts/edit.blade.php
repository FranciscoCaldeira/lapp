@extends('layouts.app')
@section('content')
    <h1>Criar Posts</h1>
    <!-- abrir formulario action= [controller e metodo |variavel vinda do controller que vai armazenar o id ]| com method= POST | enctype por causa de ter files-->
    {!! Form::open(['action' => ['PostsController@update',$post->id ], 'method' => 'POST' ,'enctype'=>'multipart/form-data']) !!} 
        
        <div class="form-group">
             <!-- label é para invisuais  label( for= , Título: -->
            {{Form::label('title', 'Título:')}} 
            <!-- quando o label>for = text/input>name  vai dar um !!id!!-->
            <!-- input( name , value , [outros atributos] -->
            {{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Escreve titulo' ] )}} 
        </div>
        <div class="form-group">
            <!-- label é para invisuais  label( for= , Título: -->
            <!-- quando o label>for = text/input>name  vai dar um !!id!!-->
            <!-- input( name , value , [outros atributos] -->
            {{Form::label('body', 'Body:')}} 
            {{Form::textarea('body', $post->body, ['id'=> 'article-ckeditor','class' => 'form-control', 'placeholder' => 'Escreve o body' ] )}} 
        </div>
        <!-- checar as rotas e fazer pq é um update PUT|PATCH -->
        {{Form::hidden('_method','PUT')}}

        <div class="form-gourp"> <!-- campo para uma imagem -->
            {{Form::file('cover_image')}}
        </div>

        {{Form::submit('Guardar!', ['class'=>'btn btn-primary'])}}   
    {!! Form::close() !!}
@endsection