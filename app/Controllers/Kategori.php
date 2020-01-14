<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class Kategori extends Controller {
    use ResponseTrait;

    public function index()
    {
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM tb_kategori');
        $result = $query->getResultArray();
        if($result) {
            return $this->respond($result);
        } else {
            $api = [
                'message' => 'Data tidak ditemukan',
            ];
            return $this->respond($api);
        }
    }

    public function show($id_kategori = null)
    {
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM tb_kategori WHERE id = '.$id_kategori);
        $result = $query->getResultArray();
        if($result) {
            return $this->respond($result);
        } else {
            $api = [
                'message' => 'Data tidak ditemukan',
            ];
            return $this->respond($api);
        }
    }

    public function create()
    {
        try {
            helper('text');

            $db = \Config\Database::connect();
    
            $kategori = $this->request->getVar('kategori');
            $id_akun = $this->request->getVar('id_akun');
            
            $sql = 'INSERT INTO tb_kategori ( kategori, id_akun ) VALUES ('
                        .$db->escape($kategori).','
                        .$db->escape($id_akun).  
                    ')';
            $db->query($sql);   
    
            $api = [
                'success' => true,
                'message' => 'Data Berhasil disimpan',
            ];
    
            return $this->respond($api);
        } catch (\Exception $th) {
            $api = [
                'success' => false,
                'message' => $th,
            ];
    
            return $this->respond($api);
        }
    }

    public function update($id_kategori = null)
    {
        try {
            helper('text');

            $db = \Config\Database::connect();
    
            $kategori = $this->request->getVar('kategori');
            $id_akun = $this->request->getVar('id_akun');
            
            $sql = 'UPDATE tb_kategori SET kategori = '.$db->escape($kategori).'WHERE id ='.$id_kategori;
            $db->query($sql);   
    
            $api = [
                'success' => true,
                'message' => 'Data Berhasil diupdate',
            ];
    
            return $this->respond($api);
        } catch (\Exception $th) {
            $api = [
                'success' => false,
                'message' => $th,
            ];
    
            return $this->respond($api);
        }
    }
    public function destroy($id_kategori = null)
    {
        try {
            $db = \Config\Database::connect();
            $sql = 'DELETE FROM tb_kategori WHERE id ='.$id_kategori;
            $db->query($sql);

            $api = [
                'success' => true,
                'message' => 'Data Berhasil dihapus',
            ];
    
            return $this->respond($api);
        } catch (\Exception $th) {
            $api = [
                'success' => false,
                'message' => $th,
            ];
    
            return $this->respond($api);
        }
    }
}