<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Str;

class Employee extends Model {

	protected $fillable = ['user_id', 'name', 'station', 'department', 'position', 'status', 'email'];

	public static function option()
	{
		return static::where('name', '<>', user()->employee->name)
			->pluck('name');
	}

	/**
	 * Get the account record associated with the employee.
	 */

	public function getRouteKeyName()
	{
		return 'user_id';
	}
	public function user() {
		return $this->hasOne('App\User', 'employee_id', 'user_id');
	}   

	public function question() {
		return $this->hasOne('App\Question', 'user_id', 'user_id'); // this matches the Eloquent model
	}

	public function scopeFindBy($query, $column, $keyword) {
		return $query->where($column, $keyword);
	}

	public static function byName($name) {
		return Employee::whereName($name)->first();
	}

	public function setDepartmentAttribute($value) {
		return $this->attributes['department'] = strtolower($value);
	}

	public function getDepartmentAttribute($value) {
		return strtolower($value);
	}

	public function setStationAttribute($value) {
		return $this->attributes['station'] = strtolower($value);
	}

	public function getStationAttribute($value) {
		return Str::upper($value);
	}

	public function setPositionAttribute($value) {
		return $this->attributes['position'] = strtolower($value);
	}

	public function getPositionAttribute($value) {
		return Str::title($value);
	}

	public function setNameAttribute($value) {
		return $this->attributes['name'] = strtolower($value);
	}

	public function getNameAttribute($value) {
		return Str::title($value);
	}
}
