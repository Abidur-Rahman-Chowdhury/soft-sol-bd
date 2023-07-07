<?php

namespace App\Controllers;

use App\Models\AboutusModel;
use App\Models\PortfolioModel;
use CodeIgniter\Validation\Validation;

class Admin extends BaseController
{
    public function index()
    {

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

            $model->insert($data);
            return redirect()->to(base_url('admin/about-us'));
        }
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
        // $model = new PortfolioModel();
        // $data['portfolio'] = $model->findAll();
        // return view('admin/portfolio/portfolio', $data);

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
                            'is_active' => 1,
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
