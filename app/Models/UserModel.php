<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{

    protected $table = 'tb_akun';

    protected $allowedFields = ['username', 'email', 'password'];
    
    function __construct()
    {
        parent::__construct();
    }

    public function getUsers($id_akun = false)
    {  
        if($id_akun === false) 
        {
            return $this->findAll();
        }
        
        return $this->asArray()->where(['id_akun' => $id_akun])->get();
    
    }
}