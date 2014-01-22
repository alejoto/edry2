<?php

class Permission extends Eloquent {

	/*Relationships*/
	

	/*scopes*/
	public function scopeName($query,$name){
		return $query->where('permissionname','=',$name);
	}


	protected $guarded = array();

	public static $rules = array();
}
