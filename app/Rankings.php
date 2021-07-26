<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Rankings extends Model
{
    public function user() {
	return $this->belongsTo(User::class);
    }
}
