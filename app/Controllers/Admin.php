<?php

namespace App\Controllers;

use App\Models\AboutusModel;
use App\Models\DynamicModel;
use App\Models\PortfolioModel;
use App\Models\SoftsolModel;


use CodeIgniter\Validation\Validation;
use CodeIgniter\HTTP\Session\Flashdata;

class Admin extends BaseController
{

    private $imageWidth = 200;
    private $imageHeight = 200;


    public function index()
    {

        return view('admin/index');
    }
    public function login()
    {

        return view('admin/login');
    }

    /* this method is to show aboutus page data.
    and $routes->get('/admin/about-us/(:any)', 'Admin::aboutus/$1');
    above is the route
     */
    public function aboutus($page_name)
    {
        $model = new SoftsolModel();
        $dynamic_model = new DynamicModel();
        if($page_name === 'slide') {
            $aboutus = $dynamic_model->dynamicCheckExist(['page_name' => $page_name], 'softsol_data');
           
            foreach ($aboutus as &$about) {
                $about['images'] = $dynamic_model->dynamicCheckExist(['page_id' => $about['id']], 'images');
            }
           
        } 
        elseif($page_name !== 'slide') {
            $aboutus = $dynamic_model->dynamicCheckExist(['controller_name' => $page_name], 'softsol_data');
            foreach ($aboutus as &$about) {
                $about['images'] = $dynamic_model->dynamicCheckExist(['page_id' => $about['id']], 'images');
            }
        }

        $data['aboutus'] = $aboutus; 
        // dd($data);

        return view('admin/aboutus/aboutus', $data);
    }



    /* services our-services  data show in table  */
    public function services_our_services($page_name)
    {
        $model = new SoftsolModel();
        $dynamic_model = new DynamicModel();

        $aboutus = $dynamic_model->dynamicCheckExist(['controller_name' => $page_name], 'softsol_data');
        foreach ($aboutus as &$about) {
            $about['images'] = $dynamic_model->dynamicCheckExist(['page_name' => $about['page_name']], 'images');
        }

        $data['aboutus'] = $aboutus;

        return view('admin/services/our-services', $data);
    }

    /* this method is to show create aboutus page data.
    and $routes->get('/admin/softsol-data', 'Admin::create_softsol_data');
    above is the route
     */
    public function create_softsol_data()
    {
        return view('admin/create-softsol-data');
    }

    public function insert_softsol_data()
    {

        $validation = \Config\Services::validation();

        $dynamic_model = new DynamicModel();
        $validation->setRules([
            'page_name' => 'required',
            'controller_name' => 'required',
            'page_title' => 'required',
            'meta_key_word' => 'required',
            'description' => 'required',
            
        ]);
       
        $page_name = $this->request->getVar('page_name');
        $controller_name = $this->request->getVar('controller_name');

        $data['softsol_data'] = $dynamic_model->dynamicCheckExist(['controller_name' => $controller_name], 'softsol_data');

        if ($data['softsol_data']) {
            session()->setFlashdata('error', 'Data already exists.');
            return redirect()->to(base_url('admin/softsol-data'));
        } else {
            if (!$validation->withRequest($this->request)->run()) {
                // Validation failed, display errors
                $errors = $validation->getErrors();
                return view('admin/create-softsol-data', ['errors' => $errors]);
            } else {
                // Validation passed, continue with data insertion
                $model = new SoftsolModel();
                $data = [
                    'page_name' => $this->request->getVar('page_name'),
                    'controller_name' => $this->request->getVar('controller_name'),
                    'page_title' => $this->request->getVar('page_title'),
                    'meta_key_word' => $this->request->getVar('meta_key_word'),
                    'description' => $this->request->getVar('description'),
                    
                ];

                $pageId = $model->insertSoftsolData($data);

                if ($pageId) {
                    if ($page_name === 'slide') {
                        $this->imageWidth = 1600;
                        $this->imageHeight = 800;
                        if ($files = $this->request->getFiles()) {
                            $uploadedImages = [];

                            if (isset($files['image'])) {
                                foreach ($files['image'] as $image) {
                                    if ($image->isValid() && !$image->hasMoved()) {
                                        $newName = $image->getRandomName();

                                        // Resize the image before uploading
                                        $resizedImage = $this->resizeImage($image->getTempName(), $this->imageWidth, $this->imageHeight);

                                        $image->move(ROOTPATH . 'public/admin-template/slide/', $newName);

                                        $uploadedImages[] = [
                                            'page_name' => $page_name,
                                            'page_id' => $pageId,
                                            'file_name' => $newName,
                                            'image_title' => $image->getClientName(),
                                            
                                        ];
                                    }
                                }
                            }

                            if (!empty($uploadedImages)) {
                                $model->insertImages($uploadedImages);
                            }
                        }
                    } elseif ($page_name !== 'slide') {
                        if ($files = $this->request->getFiles()) {
                            $uploadedImages = [];

                            if (isset($files['image'])) {
                                foreach ($files['image'] as $image) {
                                    if ($image->isValid() && !$image->hasMoved()) {
                                        $newName = $image->getRandomName();

                                        // Resize the image before uploading
                                        $resizedImage = $this->resizeImage($image->getTempName(), $this->imageWidth, $this->imageHeight);

                                        $image->move(ROOTPATH . 'public/admin-template/upload/', $newName);

                                        $uploadedImages[] = [
                                            'page_name' => $page_name,
                                            'page_id' => $pageId,
                                            'file_name' => $newName,
                                            'image_title' => $image->getClientName(),
                                            
                                        ];
                                    }
                                }
                            }

                            if (!empty($uploadedImages)) {
                                $model->insertImages($uploadedImages);
                            }
                        }
                    }


                    session()->setFlashdata('success', 'Data inserted successfully.');
                    return redirect()->to(base_url('admin/softsol-data'));
                }
            }
        }
    }


    /* updated softsol data */

    public function update_softsol_data()
    {
        $validation = \Config\Services::validation();
        $is_active = $this->request->getVar('is_active');
        $validation->setRules([
            'page_name' => 'required',
            'controller_name' => 'required',
            'page_title' => 'required',
            'meta_key_word' => 'required',
            'description' => 'required',
        ]);
       
        $pageId = $this->request->getVar('id');

        if (!$validation->withRequest($this->request)->run()) {
            // Validation failed, display errors
            $errors = $validation->getErrors();
            $data['errors'] = $errors;
            $data['data'] = [
                'id' => $pageId,
                'page_name' => $this->request->getVar('page_name'),
                'controller_name' => $this->request->getVar('controller_name'),
                'page_title' => $this->request->getVar('page_title'),
                'meta_key_word' => $this->request->getVar('meta_key_word'),
                'description' => $this->request->getVar('description'),
                
                
            ];
            return view('admin/edit-softsol-data', $data);
        } else {
            // Validation passed, continue with data update
            $model = new SoftsolModel();
            $data = [
                'page_name' => $this->request->getVar('page_name'),
                'controller_name' => $this->request->getVar('controller_name'),
                'page_title' => $this->request->getVar('page_title'),
                'meta_key_word' => $this->request->getVar('meta_key_word'),
                'description' => $this->request->getVar('description'),
               
            ];

            $model->updateSoftsolData($pageId, $data);

            if ($files = $this->request->getFiles()) {
                $uploadedImages = [];

                if (isset($files['image'])) {
                    foreach ($files['image'] as $image) {
                        if ($image->isValid() && !$image->hasMoved()) {
                            $newName = $image->getRandomName();

                            // Resize the image before uploading
                            $resizedImage = $this->resizeImage($image->getTempName(), 200, 200);

                            $image->move(ROOTPATH . 'public/admin-template/upload/', $newName);

                            $uploadedImages[] = [
                                'page_name' => $data['page_name'],
                                'page_id' => $pageId,
                                'file_name' => $newName,
                                'image_title' => $image->getClientName(),
                               
                            ];
                        }
                    }
                }

                if (!empty($uploadedImages)) {
                    $model->insertImages($uploadedImages);
                }
            }

            session()->setFlashdata('success', 'Data updated successfully.');
            return redirect()->to(base_url('admin/softsol-data'));
        }
    }

    /* show editable data  */
    public function edit_softsol_data($id = null)
    {
        $model = new SoftsolModel();
        $data['data'] = $model->where('id', $id)->first();

        return view('admin/edit-softsol-data', $data);
    }
    public function act_dec_softsol_data($id = null, $actDec = null)
    {
        // dd($id);
    
        $dynamic_model = new DynamicModel();
        $dynamic_model->dynamicUpdate(['id'=>$id],'softsol_data',['is_active' => $actDec]); 
        $dynamic_model->dynamicUpdate(['page_id'=>$id],'images',['is_active' => $actDec]); 
        
        return redirect()->to('admin/about-us/slide');
    }



    /* update about us data */

    public function update_aboutus()
    {

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
        } else {
            // Validation passed, continue with data insertion
            $model = new AboutusModel();
            if ($this->request->getVar('image')) {
                $upload_image = $model->imageUpload($_FILES, '', 400, 200);
            } else {
                $upload_image = '';
            }

            $data = [
                'title' => $this->request->getVar('title'),
                'meta_key_word' => $this->request->getVar('meta_key_word'),
                'description' => $this->request->getVar('description'),
                'is_active' => $this->request->getVar('is_active'),
                'file_name' => $upload_image,
            ];

            $model->update($id, $data);

            return redirect()->to(base_url('admin/about-us'));
        }
    }

    /* show data editable data for aboutus  */

    public function editaboutus($id = null)
    {
        $model = new AboutusModel();
        $data['about'] = $model->where('id', $id)->first();

        return view('admin/edit-about-us', $data);
    }
    /* portfolio controller  */

    /* this method is to show portfolio page data.
    and $routes->get('/admin/portfolio', 'Admin::portfolio');
    above is the route
     */

    public function portfolio()
    {

        $model = new PortfolioModel();
        $data['portfolio'] = $model->getAllPortfolios();
        // dd($data);
        return view('admin/portfolio/portfolio', $data);
    }

    /* this method is to show create aboutus page data.
    and $routes->get('/admin/create-portfolio', 'Admin::createportfolio');
    above is the route
     */
    public function createportfolio()
    {
        return view('admin/portfolio/create-portfolio');
    }

    /* this method is to insert portfolio  data.
    and $routes->get('admin/portfolio/insert', 'Admin::insert_portfolio');
    above is the route
     */
    public function insert_portfolio()
    {

        /* with image resize functionality  */

        $validation = \Config\Services::validation();
        $validation->setRules([
            'title' => 'required',
            'meta_key_word' => 'required',
            'description' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Validation failed, display errors
            $errors = $validation->getErrors();
            return view('admin/create-portfolio', ['errors' => $errors]);
        } else {
            // Validation passed, continue with data insertion
            $model = new PortfolioModel();
            $data = [
                'title' => $this->request->getVar('title'),
                'meta_key_word' => $this->request->getVar('meta_key_word'),
                'description' => $this->request->getVar('description'),
            ];

            $portfolioId = $model->insertPortfolio($data);

            if ($files = $this->request->getFiles()) {
                $uploadedImages = [];

                foreach ($files['image'] as $image) {
                    if ($image->isValid() && !$image->hasMoved()) {
                        $newName = $image->getRandomName();

                        // Resize the image before uploading
                        $resizedImage = $this->resizeImage($image->getTempName(), 200, 200);

                        $image->move(ROOTPATH . 'public/admin-template/upload/', $newName);

                        $uploadedImages[] = [
                            'page_name' => 'portfolio',
                            'page_id' => $portfolioId,
                            'file_name' => $newName,
                            'image_title' => $image->getClientName(),

                        ];
                    }
                }

                $model->insertImages($uploadedImages);
            }

            return redirect()->to(base_url('admin/portfolio'));
        }
    }

    /* image resize methods */
    protected function resizeImage($sourcePath, $targetWidth, $targetHeight)
    {
        $image = \Config\Services::image()
            ->withFile($sourcePath)
            ->resize($targetWidth, $targetHeight)
            ->convert(IMAGETYPE_JPEG)
            ->save();

        return $image;
    }

    /* this method is for update portfolio data

     */

    public function update_portfolio()
    {

        /* update validation start */
        $id = $this->request->getVar('id');

        $validation = \Config\Services::validation();
        $validation->setRules([
            'title' => 'required',
            'meta_key_word' => 'required',
            'description' => 'required',

        ]);
        if (!$validation->withRequest($this->request)->run()) {
            // Validation failed, display errors
            $errors = $validation->getErrors();
            // var_dump($errors);
            // Handle the errors as needed, such as displaying them in the view
            // For example:
            return view('admin/edit-portfolio', ['errors' => $errors]);
        } else {
            // Validation passed, continue with data insertion
            $pmodel = new PortfolioModel();

            $uploadedImages = [];

            if (isset($_FILES['image']) && !empty($_FILES['image']['tmp_name'])) {
                $files = $_FILES['image'];

                foreach ($files['tmp_name'] as $index => $tmpName) {
                    if (!empty($tmpName)) {
                        $uploadedImage = $pmodel->portfolioImageUpload($files, 'admin-template/upload/', 400, 200, $index);
                        $uploadedImages[] = $uploadedImage;
                    }
                }
            }

            $data = [
                'title' => $this->request->getVar('title'),
                'meta_key_word' => $this->request->getVar('meta_key_word'),
                'description' => $this->request->getVar('description'),
                'file_name' => implode(',', $uploadedImages), // Save the file names as a comma-separated string
            ];

            $pmodel->update($id, $data);

            return redirect()->to(base_url('admin/portfolio'));
        }
    }

    /* show editable data for portfolio
    routes  $routes->get('admin/edit/portfolio/(:num)', 'Admin::editportfolio/$1');
     */
    public function editportfolio($id = null)
    {
        $model = new PortfolioModel();
        $data['portfolio'] = $model->where('id', $id)->first();

        return view('admin/portfolio/edit-portfolio', $data);
    }
}
