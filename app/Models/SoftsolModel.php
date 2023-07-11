<?php
namespace App\Models;

use CodeIgniter\Model;

class SoftsolModel extends Model {

    protected $table = 'softsol_data';

    protected $primaryKey = 'id';

    protected $allowedFields = [ 'page_name','controller_name','page_title','meta_key_word','description'];
    public function insertSoftsolData($data)
    {
        $this->insert($data);
        return $this->insertID();
    }

    public function insertImages($data)
    {
        $db = db_connect();
        $builder = $db->table('images');
        $builder->insertBatch($data);
    }

    public function updateSoftsolData($pageId, $data)
    {
        $this->update($pageId, $data);
    }
    public function getAllAboutusData()
    {
        $db = db_connect();
        $query = $db->table($this->table)->get();
        $aboutus = $query->getResultArray();

        foreach ($aboutus as &$about) {
            $about['images'] = $this->getImagesByPageName($about['page_name']);
        }

        return $aboutus;
    }

    public function getImagesByPageName($pageName)
    {
        $db = db_connect();
        $query = $db->table('images')->where('page_name', $pageName)->get();
        return $query->getResultArray();
    }



    public function getSoftsolDataByControllerNames($controllerNames)
    {
        $db = db_connect();
        $query = $db->table($this->table)->whereIn('controller_name', $controllerNames)->get();
        $aboutus = $query->getResultArray();

        foreach ($aboutus as &$about) {
            $about['images'] = $this->getImagesByPageId($about['id']);
        }

        return $aboutus;
    }

    public function getImagesByPageId($pageId)
    {
        $db = db_connect();
        $query = $db->table('images')->where('page_id', $pageId)->get();
        return $query->getResultArray();
    }


//   public  function imageUpload($FILES, $folderPath = '', $targetWidth=200, $targetHeight=200){
  
  
//         $file = $FILES['image']['tmp_name']; 
    
//         $sourceProperties = getimagesize($file);
        
//         if(empty($folderPath)){
//             $folderPath = "admin-template/upload/";  
//         }
//         $ext = pathinfo($FILES['image']['name'], PATHINFO_EXTENSION);
//         $fileNewName = 'image'.'-'.time().'.'.$ext;
//         $imageType = $sourceProperties[2];
//         switch ($imageType) {
    
//             case IMAGETYPE_PNG:
//                 $imageResourceId = imagecreatefrompng($file); 
//                 $targetLayer = $this->imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1], $targetWidth, $targetHeight);
//                 imagepng($targetLayer,$folderPath. $fileNewName);
//                 return $fileNewName;
    
//             case IMAGETYPE_GIF:
//                 $imageResourceId = imagecreatefromgif($file); 
//                 $targetLayer = $this->imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1], $targetWidth, $targetHeight);
//                 imagegif($targetLayer,$folderPath. $fileNewName);
//                 return $fileNewName;
    
//             case IMAGETYPE_JPEG:
//                 $imageResourceId = imagecreatefromjpeg($file); 
//                 $targetLayer = $this->imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1], $targetWidth, $targetHeight);
//                 imagejpeg($targetLayer,$folderPath. $fileNewName);
//                 return $fileNewName;
    
//             default:
//             return "Invalid Image type.";
//         }
//     }
    
    
//     function imageResize($imageResourceId,$width,$height, $targetWidth, $targetHeight) {
//         $targetLayer=imagecreatetruecolor($targetWidth,$targetHeight);
//         imagecopyresampled($targetLayer,$imageResourceId,0,0,0,0,$targetWidth,$targetHeight, $width,$height);
//         return $targetLayer;
//     }
}



?>