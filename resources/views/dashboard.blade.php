@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/posts/create" class="btn btn-success">Criar</a>
                        
                    @if (count($posts)>0)
                        <table class="table table-striped">
                            <tr>
                                <th>Titulo</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{$post->title}}</td>
                                    <td> <a href="/posts/{{$post->id}}/edit" class="btn btn-primary"> Editar</a></td>
                                    <td><!-- boão de apagar com formulario -->

                                        {!!Form::open(['action' => ['PostsController@destroy',$post->id], 'method'=>'POST', 'class'=>'pull-right'])!!}
                                            {{Form::hidden('_method','DELETE')}}
                                            {{Form::submit('Delete',['class' => 'btn btn-danger'])}}
                                        {!!Form::close()!!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>     
                    @else
                            <p>Náo tens posts</p>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>

@endsection
