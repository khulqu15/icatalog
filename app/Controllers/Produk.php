<?php 

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class Produk extends Controller 
{
    use ResponseTrait;

    public function index()
    {
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM tb_produk');
        $results = $query->getResultArray();

        return $this->respond($results);
    }

    public function view($id = null) 
    {
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM tb_produk WHERE id = '.$id);
        $results = $query->getResultArray();

        if(!$results) {
            $api = [
                'message' => 'Maaf Produk tidak ditemukan'
            ];
    
            return $this->respond($api);   
        }

        return $this->respond($results);
    }

    public function store()
    {
        try {
            helper('text');
     
            $db = \Config\Database::connect();
    
            $nama = $this->request->getVar('nama');
            $deskripsi = $this->request->getVar('deskripsi');
            $id_kate = $this->request->getVar('id_kate');
            $link = $this->request->getVar('link');
            $gambar1 = $this->request->getFile('gambar1');
            $gambar2 = $this->request->getFile('gambar2');
            $gambar3 = $this->request->getFile('gambar3');
            $id_akun = $this->request->getVar('id_akun');
    
            if(!isset($gambar1)) {
                $gambarName1 = null;
            } else {
                $gambarName1 = $gambar1->getRandomName();
                $gambar1->move(WRITEPATH.'produk', $gambarName1);
            }
            if(!isset($gambar2)) {
                $gambarName2 = null;
            } else {
                $gambarName2 = $gambar2->getRandomName();
                $gambar2->move(WRITEPATH.'produk', $gambarName2);
            }
            if(!isset($gambar3)) {
                $gambarName3 = null;
            } else {
                $gambarName3 = $gambar3->getRandomName();
                $gambar3->move(WRITEPATH.'produk', $gambarName3);
            }

            $sql = 'INSERT INTO tb_produk ( nama, deskripsi, id_kate, link, gambar1, gambar2, gambar3, id_akun ) VALUES ('
                        .$db->escape($nama).','
                        .$db->escape($deskripsi).','
                        .$db->escape($id_kate).','
                        .$db->escape($link).','
                        .$db->escape($gambarName1).','
                        .$db->escape($gambarName2).','
                        .$db->escape($gambarName3).','
                        .$db->escape($id_akun).
                    ')';
    
            $db->query($sql);
    
            $api = [
                'success' => true,
                'message' => 'Data Berhasil ditambah',
            ];
    
            return $this->respond($api);
        } catch (\Exception $th) {
            
            $path = WRITEPATH.'produk/';
            @unlink($path.$gambarName1);
            @unlink($path.$gambarName2);
            @unlink($path.$gambarName3);

            $api = [
                'success' => false,
                'message' => 'Data gagal ditambah',
                'error' => $th
            ];
    
            return $this->respond($api);
        }
    }

    public function destroy($id = null) 
    {
        $db = \Config\Database::connect();
        $sql = 'DELETE FROM tb_produk WHERE id = '.$id;
    
        $d_sql = 'SELECT * FROM tb_produk WHERE id ='.$id;
        $d_query = $db->query($d_sql);
        $d_data = $d_query->getRowObject();

        $path = WRITEPATH.'produk/';
        @unlink($path.$d_data->gambar1);
        @unlink($path.$d_data->gambar2);
        @unlink($path.$d_data->gambar3);

        $db->query($sql);

        $api = [
            'success' => true,
            'message' => 'Data berhasil dihapus',
        ];

        return $this->respond($api);
    }

    public function update($id = null)
    {
        try {
            helper('text');
     
            $db = \Config\Database::connect();
    
            $nama = $this->request->getVar('nama');
            $deskripsi = $this->request->getVar('deskripsi');
            $id_kate = $this->request->getVar('id_kate');
            $link = $this->request->getVar('link');
            $gambar1 = $this->request->getFile('gambar1');
            $gambar2 = $this->request->getFile('gambar2');
            $gambar3 = $this->request->getFile('gambar3');
            $id_akun = $this->request->getVar('id_akun');
    
            $sqlGambar = 'SELECT * FROM tb_produk WHERE id ='.$id;
            $queryGambar = $db->query($sqlGambar);
            $dGambar = $queryGambar->getRowObject();
            $dGambar1 = $dGambar->gambar1;
            $dGambar2 = $dGambar->gambar2;
            $dGambar3 = $dGambar->gambar3;

            $path = WRITEPATH.'produk/';

            if(!isset($gambar1)) { //jika gambar tidak diubah
                $gambarName1 = $dGambar1; //gambar tetap
            } else { //jika tidak (gambar diubah)
                $gambarName1 = $gambar1->getRandomName(); //ubah gambar 
                $gambar1->move(WRITEPATH.'produk', $gambarName1);
                //hapus gambar lama
                @unlink($path.$dGambar1);

            }
            if(!isset($gambar2)) {
                $gambarName2 = $dGambar2;
            } else {
                $gambarName2 = $gambar2->getRandomName();
                $gambar2->move(WRITEPATH.'produk', $gambarName2);
                @unlink($path.$dGambar2);
            }
            if(!isset($gambar3)) {
                $gambarName3 = $dGambar3;
            } else {
                $gambarName3 = $gambar3->getRandomName();
                $gambar3->move(WRITEPATH.'produk', $gambarName3);
                @unlink($path.$dGambar3);
            }

            $sql = 'INSERT INTO tb_produk ( nama, deskripsi, id_kate, link, gambar1, gambar2, gambar3, id_akun ) VALUES ('
                        .$db->escape($nama).','
                        .$db->escape($deskripsi).','
                        .$db->escape($id_kate).','
                        .$db->escape($link).','
                        .$db->escape($gambarName1).','
                        .$db->escape($gambarName2).','
                        .$db->escape($gambarName3).','
                        .$db->escape($id_akun).
                    ')';

            $db->query($sql);
    
            $api = [
                'success' => true,
                'message' => 'Data Berhasil ditambah',
            ];
    
            return $this->respond($api);
        } catch (\Exception $th) {
            
            $path = WRITEPATH.'produk/';
            @unlink($path.$gambarName1);
            @unlink($path.$gambarName2);
            @unlink($path.$gambarName3);

            $api = [
                'success' => false,
                'message' => 'Data gagal ditambah',
                'error' => $th
            ];
    
            return $this->respond($api);
        }
    }

}