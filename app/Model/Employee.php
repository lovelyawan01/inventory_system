<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;



class Employee extends Model{

	 protected $table = 'employees';
    protected $connection = 'mysql';


    protected $fillable = [
        'name', 'email', 'phone', 'sallery', 'address', 'photo', 'nid', 'joining_date'
    ];
}
