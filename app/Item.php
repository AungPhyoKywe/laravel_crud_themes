<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
   protected $table = 'items';
	protected $fillable = [
	'id',
	'name',
	'description',
	'type',
	'original_price',
	'selling_price'
];
}
