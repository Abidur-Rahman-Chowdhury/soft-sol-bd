<?php

namespace App\Models;
use CodeIgniter\Model;

class DynamicModel extends Model
{
    protected $db;

    function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public Function dynamicInsert(array $data, string $table){
        $query = $this->db->table($table);
        return $query->insert($data);
    }

    public Function dynamicCheckExist(array $where, string $table){
        $query = $this->db->table($table);
        $query->where($where);
        return $query->select()->get()->getResultArray();
    }


    public Function dynamicUpdate(array $where, string $table, array $data){
        $query = $this->db->table($table);
        $query->where($where);
        return $query->update($data, $where);
    }

    public function getSlideImages(){
        $query = $this->db->query("select images.file_name  from softsol_data 
        inner join images on softsol_data.id = images.page_id 
        where  softsol_data.page_title = 'home-slide' and images.is_active = 1");
        return $query->getResultArray();
    }


    // public function imageUpload($FILES, $folderPath = '', $targetWidth=200, $targetHeight=200){
    //     $file = $FILES['image']['tmp_name']; 
    //     $sourceProperties = getimagesize($file);
        
    //     if(empty($folderPath)){
    //         $folderPath = "test-img/";  
    //     }
    //     $ext = pathinfo($FILES['image']['name'], PATHINFO_EXTENSION);
    //     $fileNewName = HOTEL_NAME.'-'.time().'.'.$ext;
    //     $imageType = $sourceProperties[2];
    //     switch ($imageType) {

    //         case IMAGETYPE_PNG:
    //             $imageResourceId = imagecreatefrompng($file); 
    //             $targetLayer = $this->imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1], $targetWidth, $targetHeight);
    //             imagepng($targetLayer,$folderPath. $fileNewName);
    //             return $fileNewName;

    //         case IMAGETYPE_GIF:
    //             $imageResourceId = imagecreatefromgif($file); 
    //             $targetLayer = $this->imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1], $targetWidth, $targetHeight);
    //             imagegif($targetLayer,$folderPath. $fileNewName);
    //             return $fileNewName;

    //         case IMAGETYPE_JPEG:
    //             $imageResourceId = imagecreatefromjpeg($file); 
    //             $targetLayer = $this->imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1], $targetWidth, $targetHeight);
    //             imagejpeg($targetLayer,$folderPath. $fileNewName);
    //             return $fileNewName;

    //         default:
    //         return "Invalid Image type.";
    //     }
    // }


    // function imageResize($imageResourceId,$width,$height, $targetWidth, $targetHeight) {
    //     $targetLayer=imagecreatetruecolor($targetWidth,$targetHeight);
    //     imagecopyresampled($targetLayer,$imageResourceId,0,0,0,0,$targetWidth,$targetHeight, $width,$height);
    //     return $targetLayer;
    // }

}