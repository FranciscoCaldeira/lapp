@extends('layouts.app')  <!--vai extender o que o ficheiro layout.app tem -->

@section('content') <!-- no yield do app-->
    <h1>about app</h1>
    <p>
        {{$title}}
    </p>
    @if (count($content)>0)    <!-- dentro da $data(no PageController) 'content'=> -->
        <ul class="list-group">
            @foreach ($content as $item)
                <li class="list-group-item">{{$item}}</li>
            @endforeach
        </ul> 
    @endif
@endsection

