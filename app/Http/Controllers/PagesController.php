<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $title='welcome';
        //return view('pages.index',compact('title'));      //view>pages>index.blade.php| envia var para a view com o compact
        return view('pages.index')->with('title',$title);       //with igual ao compact
    }
    
    public function about()
    {
        $data= array(
            'title' => 'About',
            'content'=> ['1','2','3']
        );
        return view('pages.about')->with($data); //view>pages>about.blade.php  o with vai passar a var data['xpto']
    }
}
