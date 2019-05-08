<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
use Titan\Models\TitanCMSModel;

/**
 * Class NewsletterSubscriber
 * @mixin \Eloquent
 */
class Report extends TitanCMSModel
{
//    use SoftDeletes;

    protected $table = 'isha_spielplan';

    protected $guarded = ['id'];

}