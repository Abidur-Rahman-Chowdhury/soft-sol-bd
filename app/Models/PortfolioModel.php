<?php
namespace App\Models;

use CodeIgniter\Model;

class PortfolioModel extends Model {

    protected $table = 'portfolio';

    protected $primaryKey = 'id';

    protected $allowedFields = ['title','meta_key_word','description','file_name'];
    
  public  function portfolioImageUpload($FILES, $folderPath = '', $targetWidth=200, $targetHeight=200){
  
  
        $file = $FILES['image']['tmp_name']; 
    
        $sourceProperties = getimagesize($file);
        
        if(empty($folderPath)){
            $folderPath = "admin-template/upload/";  
        }
        $ext = pathinfo($FILES['image']['name'], PATHINFO_EXTENSION);
        $fileNewName = 'image'.'-'.time().'.'.$ext;
        $imageType = $sourceProperties[2];
        switch ($imageType) {
    
            case IMAGETYPE_PNG:
                $imageResourceId = imagecreatefrompng($file); 
                $targetLayer = $this->imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1], $targetWidth, $targetHeight);
                imagepng($targetLayer,$folderPath. $fileNewName);
                return $fileNewName;
    
            case IMAGETYPE_GIF:
                $imageResourceId = imagecreatefromgif($file); 
                $targetLayer = $this->imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1], $targetWidth, $targetHeight);
                imagegif($targetLayer,$folderPath. $fileNewName);
                return $fileNewName;
    
            case IMAGETYPE_JPEG:
                $imageResourceId = imagecreatefromjpeg($file); 
                $targetLayer = $this->imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1], $targetWidth, $targetHeight);
                imagejpeg($targetLayer,$folderPath. $fileNewName);
                return $fileNewName;
    
            default:
            return "Invalid Image type.";
        }
    }
    
    
    function imageResize($imageResourceId,$width,$height, $targetWidth, $targetHeight) {
        $targetLayer=imagecreatetruecolor($targetWidth,$targetHeight);
        imagecopyresampled($targetLayer,$imageResourceId,0,0,0,0,$targetWidth,$targetHeight, $width,$height);
        return $targetLayer;
    }
}



?>