<?php

namespace App\Controllers;
use App\Models\AboutusModel;

class Admin extends BaseController
{
    public function index()
    {
        // dd("this is admin");
        return view('admin/index');
    }
    public function login()
    {
      
        return view('admin/login');
    }
    public function aboutus()
    {
        // $data['about'] = [
        //     'title' => 'About Us',
        //     'meta_key_word' => 'About Us',
        //     'description' => 'About Us',
        //     'is_active' => 'About Us',
        //     'created_at' => 'About Us',
        //     'updated_at' => 'About Us'
        // ];
        $model = new AboutusModel();
	    $data['aboutus'] = $model->findAll();
       
        return view('admin/aboutus', $data);
    }
    public function createaboutus() {
        return view('admin/create-about-us');
    }

}
