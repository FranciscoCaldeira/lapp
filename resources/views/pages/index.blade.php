@extends('layouts.app')  <!--vai extender o que o ficheiro layout.app tem -->

@section('content') <!-- no yield do app-->
    <div class="jumbotron text-center">
        <h1>index app</h1>
    <p>
        {{$title}} <!-- vem do metodo compact -->
    </p>
        {{-- <a class="btn btn-primary" href="/login" role="button">Login</a>
        <a class="btn btn-success" href="/register" role="button">Register</a>     --}}
    </div>
@endsection


