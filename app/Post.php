<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //table name "proteger o nome da tabela" 
    protected $table='posts';
    //mudar a primary key 
    public $primaryKey='id';
    //timestamps se quero que apareca
    public $timestamps=true;

    //relation~
    public function user()
    {
        // a Post(1) has a relatioon that belongs with model User(1) 
        return $this->belongsTo('App\User');
    }


}
