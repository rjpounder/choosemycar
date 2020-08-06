<?php

namespace ChooseMyCar\Models;

use Framework\Models\Model;

class VehicleFeed extends Model
{
    public $fields = [
        'manufacturer' =>  'required',
        'model' =>  'required',
        'registration_plate' =>  'required',
        'year' =>  'required',
        'type' =>  'required',
        'colour' =>  'optional',
    ];
}
