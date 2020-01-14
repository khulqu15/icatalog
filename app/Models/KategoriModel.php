<?php namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model {
    protected $table = 'tb_kategori';
    protected $allowedFields = ['kategori', 'id_akun'];
}