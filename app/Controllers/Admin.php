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

    /* this method is to show aboutus page data.
    and $routes->get('/admin/about-us', 'Admin::aboutus');
    above is the route
    */
    public function aboutus()
    {
        $model = new AboutusModel();
	    $data['aboutus'] = $model->findAll();
       
        return view('admin/aboutus', $data);
    }

    /* this method is to show create aboutus page data.
    and $routes->get('/admin/create-about', 'Admin::createaboutus');
    above is the route
    */
    public function createaboutus() {
        return view('admin/create-about-us');
    }

    public function insert_about_us () {
        $createAt = $this->request->getVar('created_at');
        $updateAt = $this->request->getVar('updated_at');
        $createAt = strtotime($createAt);
        $updateAt = strtotime($updateAt);
        $createTimeStamp = date("Y-m-d H:i:s", $createAt);
        $updateTimeStamp =date("Y-m-d H:i:s", $updateAt);
      

		$data = [
			/* getVar(varibale) which is the assign value in the form name attribute */
			'title'=>$this->request->getVar('title'),
			'meta_key_word'=>$this->request->getVar('meta_key_word'),
			'description'=>$this->request->getVar('description'),
			'is_active'=>$this->request->getVar('is_active'),
			'created_at'=>$createTimeStamp,
			'updated_at'=>$updateTimeStamp,
		];

//         $timestamp = strtotime("2023-06-25 10:30:00");
// echo $timestamp;


        // dd($data);
       /* making the objects of my user model */
		$model = new AboutusModel();

		$model->insert($data);
        return redirect()->to(base_url('admin/about-us'));
		// echo "<h1>Data sent successfylly</h1>";
	}

}
