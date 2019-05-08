<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
use Titan\Models\TitanCMSModel;

/**
 * Class NewsletterSubscriber
 * @mixin \Eloquent
 */
class Club extends TitanCMSModel
{
//    use SoftDeletes;

    protected $table = 'clubs';

    protected $guarded = ['id'];

    /**
     * Validation rules for this model
     */
    static public $rules = [
        'name' => 'required|max:240',     
        'address' => 'required',  
        'zipcode' => '', 
        'location' => '', 
        'email' => 'email', 
        'website' => '', 
        'manager' => '',       
    ];
}