<?php

namespace App\OptionModels;

use Illuminate\Database\Eloquent\Model;
use Str;

class Option extends Model {
	protected $fillable = ['customer'];

	public static function option()
	{
		return static::all()->pluck('customer')->push('OTHER');
	}

	public function setCustomerAttribute($value) {
		return $this->attributes['customer'] = strtolower($value);
	}
	public function getCustomerAttribute($value) {
		return Str::upper($value);
	}
}
