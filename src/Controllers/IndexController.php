<?php

namespace ChooseMyCar\Controllers;

use ChooseMyCar\Models\VehicleFeed;
use Framework\Controllers\Controller;
use Framework\ViewManager\ViewManager;

class IndexController extends Controller
{
    public function index($errors = [])
    {
        return ViewManager::view('index', ['errors' => $errors]);
    }

    public function load()
    {
        $csvHeaders = ['manufacturer','model','registration_plate','year','type','colour'];
        $vehicles = [];
        if ($_FILES["upload"]["tmp_name"]) {
            $data = csv_to_array($_FILES["upload"]["tmp_name"], $csvHeaders);
            $vehicleFeed = new VehicleFeed($data);
            $vehicles = $vehicleFeed->where('manufacturer', 'Ford')->where('year', '>=', '2016')->get();
        }
        $data = [
            'file_loaded' => true,
            'vehicles' => $vehicles
        ];

        return ViewManager::view('load', $data);
    }
}
