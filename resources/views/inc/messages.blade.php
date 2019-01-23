@if (count($errors)>0) <!-- se tiver erros -->
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            {{$error}}
        </div>
    @endforeach
@endif

@if (session('success'))
    <div class="aler alert-success">
        {{session('success')}}
    </div>
@endif

@if (session('error'))
    <div class="aler alert-danger">
        {{session('error')}}
    </div>
@endif

<!-- colocar include no container da app -->