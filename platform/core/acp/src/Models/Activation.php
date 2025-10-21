<?php

namespace Bng\Acp\Models;

use Illuminate\Database\Eloquent\Model;

class Activation extends Model
{
  protected $table = 'activations';

  protected $fillable = [
    'code',
    'completed',
    'completed_at',
  ];

  protected $casts = [
    'completed' => 'bool',
  ];
}
