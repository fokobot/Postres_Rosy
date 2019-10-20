<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trabajo extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'nombre', 'costo',
  ];

  public function usuario()
  {
    return $this->belongsTo('App\User', 'user_id');
  }
}
