<?php

namespace App\Controllers;


use App\Models\SoftsolModel;


use CodeIgniter\Validation\Validation;
use CodeIgniter\HTTP\Session\Flashdata;

class Client extends BaseController
{
   

     public function aboutus()
    {
        $model = new SoftsolModel();
        
        $controllerNames = ['who-are-we','our-company','what-we-do','dedicated-support']; // Add the controller names you need here
        
        $data['aboutus'] = $model->getSoftsolDataByControllerNames($controllerNames);
            // dd($data);
        return view('client/aboutus/aboutus', $data);
    }

}
