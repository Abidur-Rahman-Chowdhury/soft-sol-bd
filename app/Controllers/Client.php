<?php

namespace App\Controllers;

use App\Models\DynamicModel;
use App\Models\SoftsolModel;


use CodeIgniter\Validation\Validation;
use CodeIgniter\HTTP\Session\Flashdata;

class Client extends BaseController
{
   
    /* show home banner data */
    // public function index() {
    //     $dynamic_model = new DynamicModel();
    //     $homeBanner = $dynamic_model->dynamicCheckExist(['page_title' => 'home-slide'], 'softsol_data');
        
    //     foreach ($homeBanner as &$banner) {
    //         $banner['images'] = $dynamic_model->dynamicCheckExist(['page_id' => $banner['id'], 'is_active' => 1], 'images');

             
    //     }
    
    //     $data['data'] = $homeBanner;
       
    //     dd($data);
    //     return view('client/index.php', $data);

    // }
    public function index()
{
    $dynamic_model = new DynamicModel();

    $slideImages = $dynamic_model->getSlideImages();
    

    
    $data['images'] = $slideImages; 
    // dd($data);
    return view('client/index.php', $data);
}


     public function aboutus()
    {
        $model = new SoftsolModel();
        
        $controllerNames = ['who-are-we','our-company','what-we-do','dedicated-support','aboutus-banner']; // Add the controller names you need here
        
        $data['aboutus'] = $model->getSoftsolDataByControllerNames($controllerNames);
            // dd($data);
        return view('client/aboutus/aboutus', $data);
    }

    
}
