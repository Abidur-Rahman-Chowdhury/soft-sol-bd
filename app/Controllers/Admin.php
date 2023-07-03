<?php

namespace App\Controllers;

use App\Models\AboutusModel;
use CodeIgniter\Validation\Validation;
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
    public function createaboutus()
    {
        return view('admin/create-about-us');
    }

    public function insert_about_us()
    {
       
        $validation = \Config\Services::validation();
        $validation->setRules([
            'title' => 'required',
            'meta_key_word' => 'required',
            'description' => 'required',
            'is_active' => 'required|integer',
        ]);
        if (!$validation->withRequest($this->request)->run()) {
            // Validation failed, display errors
            $errors = $validation->getErrors();
            // var_dump($errors);
            // Handle the errors as needed, such as displaying them in the view
            // For example:
            return view('admin/create-about-us', ['errors' => $errors]);
        } 
        else {
            // Validation passed, continue with data insertion
            $model = new AboutusModel();
            if($this->request->getVar('image')){
                    $upload_image = $model->imageUpload($_FILES, '', 400, 200);
                } else {
                    $upload_image = '';
                }
            $data = [
                'title' => $this->request->getVar('title'),
                'meta_key_word' => $this->request->getVar('meta_key_word'),
                'description' => $this->request->getVar('description'),
                'is_active' => $this->request->getVar('is_active'),
                'file_name' => $upload_image
            ];

            $model->insert($data);
            return redirect()->to(base_url('admin/about-us'));
        }

        
    }

     /* update about us data */

     public function update_aboutus() {

        /* update validation start */
        $id = $this->request->getVar('id');

        $validation = \Config\Services::validation();
        $validation->setRules([
            'title' => 'required',
            'meta_key_word' => 'required',
            'description' => 'required',
            'is_active' => 'required|integer',
        ]);
        if (!$validation->withRequest($this->request)->run()) {
            // Validation failed, display errors
            $errors = $validation->getErrors();
            // var_dump($errors);
            // Handle the errors as needed, such as displaying them in the view
            // For example:
            return view('admin/edit-about-us', ['errors' => $errors]);
        } 
        else {
            // Validation passed, continue with data insertion
            $model = new AboutusModel();
            if($this->request->getVar('image')){
                    $upload_image = $model->imageUpload($_FILES, '', 400, 200);
                } else {
                    $upload_image = '';
                }
           
            $data = [
                'title' => $this->request->getVar('title'),
                'meta_key_word' => $this->request->getVar('meta_key_word'),
                'description' => $this->request->getVar('description'),
                'is_active' => $this->request->getVar('is_active'),
                'file_name' => $upload_image
            ];

            
            $model->update($id,$data);
    
            return redirect()->to(base_url('admin/about-us'));
            
        }


        /* end */


        // $model = new AboutusModel();
        // $upload_image = $model->imageUpload($_FILES, '', 400, 200);
		// $createAt = $this->request->getVar('created_at');
        // $updateAt = $this->request->getVar('updated_at');
       
		// $data = [
		// 	/* getVar(varibale) which is the assign value in the form name attribute */
		// 	'title'=>$this->request->getVar('title'),
		// 	'meta_key_word'=>$this->request->getVar('meta_key_word'),
		// 	'description'=>$this->request->getVar('description'),
		// 	'is_active'=>$this->request->getVar('is_active'),
		// 	'created_at'=>$createAt,
		// 	'updated_at'=>$updateAt,
        //     'file_name' => $upload_image,
		// ];
		// $id = $this->request->getVar('id');
		// $model->update($id,$data);

		// return redirect()->to(base_url('admin/about-us'));

	}


    /* show data editable data for aboutus  */

    public function editaboutus($id = null)
    {
        $model = new AboutusModel();
        $data['about'] = $model->where('id', $id)->first();

        return view('admin/edit-about-us', $data);
    }
}
