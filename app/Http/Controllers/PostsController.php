<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// trazer a pasta das imagens
use Illuminate\Support\Facades\Storage;
//trazer o model namespace\modelName
use App\Post;
// para usar as queries ,vou utilizar em index 
use DB;

class PostsController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth'); /* bloqueia para que tenho autenticacao*/
        $this->middleware('auth', ['except' => ['index','show']]); //vou ter acesso ao posts show e index à mesma
    }
    // index create store edit update show destroy feito com o --resources
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts= Post::all(); /* return Post::all(); vai retornar todo o data da tabela na página*/
        //$posts=DB::select('SELECT * FROM posts'); //usando o use DB em cima em vez do elequent
        //$posts= Post::orderBy('title','asc')->get(); //vai ao campo title da bd e ASCendete 'desc'-> descend
        //return Post::where('title','Post 2')->get(); //busca apenas a info de title="Post 2"
        //$posts= Post::orderBy('title','asc')->take(1)->get(); //retira 1 valor à query
        
        $posts= Post::orderBy('id','asc')->paginate(10); //fazer paginacao por id(BD) nr 10, mas ATENÇAO acrecentar na sua view {{$posts->links()}}
        return view('posts.index')->with('posts',$posts); /* var posts pode ser usada na view */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validar as coisas que vem do form com a action para este metodo
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999' /* ficheiro imagem, opcional, max:2mb(limite do laravel)*/
            ]);
        // inc.messages vai conter a verificação mensagens
        
        //file UPload
        if ($request->hasFile('cover_image')) {
            //filename.extension
            $filenameWithExt=$request->file('cover_image')->getClientOriginalName();
            //Just filename
            $filename= pathinfo($filenameWithExt,PATHINFO_FILENAME);
            //Just extension
            $extension=$request->file('cover_image')->guessClientExtension();
            //filename to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension; //tem um timestamp=123124124 para ser unico o nome
            //upload
            $path=$request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore); //vai para a pasta storage/public/..
            
        } else {
            $fileNameToStore='no_image.png'; // vai gravar com este mome, que é o mesmo do da pasta resources
        }
        

        //carregar o model
        $post= new Post;
        //campos da bd 
        $post->title =$request->input('title'); /* tudo o que vem do form no lugar do name fica guardado em $post */
        $post->body =$request->input('body');
        $post->user_id = auth()->user()->id; /* receber o id do utilizador logado no momento */
        $post->cover_image =$fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success','Post criado'); // redirecionar para /posts com msg de sucesso 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post= Post::find($id); // return Post::find($id); retorna tudo com o id
        return view('posts.show')->with('post',$post); // para a view na pasta posts>show.blade mandar usar a var post que tem valores da $post
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post= Post::find($id); // return Post::find($id); retorna tudo com o id

        //chekar o user q criou o post é o mesmo q edita
        if (auth()->user()->id !== $post->user_id) {
            return redirect('/posts')->with('error','Página não autorizada');    
        }
        return view('posts.edit')->with('post',$post); // para a view na pasta posts>edit.blade mandar usar a var post que tem valores da $post
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validar as coisas que vem do form com a action para este metodo
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            ]);
        
            //file UPload
        if ($request->hasFile('cover_image')) {
            //filename.extension
            $filenameWithExt=$request->file('cover_image')->getClientOriginalName();
            //Just filename
            $filename= pathinfo($filenameWithExt,PATHINFO_FILENAME);
            //Just extension
            $extension=$request->file('cover_image')->guessClientExtension();
            //filename to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension; //tem um timestamp=123124124 para ser unico o nome
            //upload
            $path=$request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore); //vai para a pasta storage/public/..
            

            
        }

        //carregar o model
        $post = Post::find($id);
        //campos da bd   tudo o que vem do form no lugar do name fica guardado em $post
        $post->title =$request->input('title'); 
        $post->body =$request->input('body');
            //se tem img é para continuar , se n tive rcarregar nova
        if ($request->hasFile('cover_image')) {
            Storage::delete('public/cover_images/' . $post->cover_image); // apaga a imagem antiga
            $post->cover_image=$fileNameToStore;
        }

        $post->save();

        return redirect('/posts')->with('success','Post Editado'); // redirecionar para /posts com msg de sucesso 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        //chekar o user q criou o post é o mesmo q elimina
        if (auth()->user()->id !== $post->user_id) {
            return redirect('/posts')->with('error','Página não autorizada');    
        }

        //se a imagem a apagar for != da no_image
        if ($post->cover_image != 'no_image.jpg') {
            //delete imagem
            Storage::delete('public/cover_images/'.$post->cover_image); //apaga a imagem
        }
        $post->delete();
        return redirect('/posts')->with('success','Post Removido'); // redirecionar para /posts com msg de sucesso 
    }
}

