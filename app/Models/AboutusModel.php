<?php
namespace App\Models;

use CodeIgniter\Model;
class AboutusModel extends Model {

    protected $table = 'about_us';

    protected $primaryKey = 'id';

    protected $allowedFields = ['title','meta_key_word','description','is_active','created_at','updated_at'];

}



?>