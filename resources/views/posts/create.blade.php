@extends('layouts.app')
@section('content')
    <h1>Criar Posts</h1>
    <!-- abrir formulario action= controller e metodo e com method= POST         enctype pq tem um ficheiro -->
    {!! Form::open(['action' => 'PostsController@store' , 'method' => 'POST','enctype'=>'multipart/form-data']) !!} 
        
        <div class="form-group">
             <!-- label é para invisuais  label( for= , Título: -->
            {{Form::label('title', 'Título:')}} 
            <!-- quando o label>for = text/input>name  vai dar um !!id!!-->
            <!-- input( name , value , [outros atributos] -->
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Escreve titulo' ] )}} 
        </div>
        <div class="form-group">
            <!-- label é para invisuais  label( for= , Título: -->
            <!-- quando o label>for = text/input>name  vai dar um !!id!!-->
            <!-- input( name , value , [outros atributos] -->
            {{Form::label('body', 'Body:')}} 
            {{Form::textarea('body', '', ['id'=> 'article-ckeditor','class' => 'form-control', 'placeholder' => 'Escreve o body' ] )}} 
        </div>

        <div class="form-gourp"> <!-- campo para uma imagem -->
            {{Form::file('cover_image')}}
        </div>

        {{Form::submit('Guardar!', ['class'=>'btn btn-primary'])}}   
    {!! Form::close() !!}
@endsection