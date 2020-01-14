<?php declare(strict_types = 1);
namespace App\Controllers;

use function time;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class Banner extends Controller 
{
    use ResponseTrait;

    public function index()
    {
        $db = \Config\Database::connect();
        $sql = 'SELECT * FROM tb_banner';
        $query = $db->query($sql);
        $results = $query->getResultArray();

        if(!$results) {
            $api = [
                'message' => 'Maaf banner belum ada'
            ];
    
            return $this->respond($api);   
        }

        $api = [
            'data' => $results
        ];

        return $this->respond($api);
    }

    public function create()
    {
        $db = \Config\Database::connect();
        $id_akun = $this->request->getVar('id_akun');
        $id_produk = $this->request->getVar('id_produk');
        $nama = $this->request->getVar('nama');

        $validate = $this->validate([
            'gambar' => 'uploaded[gambar]|max_size[gambar, 1024]|mime_in[gambar,image/png,image/jpg,image/jpeg]'
        ]);

        if($validate) {        
            $gambar = $this->request->getFile('gambar');
            $gambarName = $gambar->getRandomName();

            $sql = 'INSERT INTO tb_banner ( id, id_akun, nama, gambar, id_produk ) VALUES ('
                    .$db->escape(time()).','
                    .$db->escape($id_akun).','
                    .$db->escape($nama).','
                    .$db->escape($gambarName).','
                    .$db->escape($id_produk).
                ')';

            $db->query($sql);

            $gambar->move(WRITEPATH.'uploads', $gambarName);

            return $this->respond([
                'success' => true,
                'message' => 'Gambar berhasil dipindah',
            ]);
        } else {
            return $this->respond([
                'success' => false,
                'message' => 'Gambar gagal dipindah'
            ]);
        }
    }

    public function view($id = null)
    {
        $db = \Config\Database::connect();
        $sql = 'SELECT * FROM tb_banner WHERE id ='.$id;
        $query = $db->query($sql);
        $results = $query->getResultArray();

        if(!$results) {
            $api = [
                'message' => 'Maaf banner tidak ditemukan'
            ];
    
            return $this->respond($api);   
        }

        $api = [
            'data' => $results
        ];

        return $this->respond($api);
    }

    public function update($id = null)
    {
        helper('file');
        $db = \Config\Database::connect();

        $sqlBannerImg = 'SELECT gambar FROM tb_banner WHERE id ='. $id;
        $queryBannerImg = $db->query($sqlBannerImg);
        $resultsBannerImg = $queryBannerImg->getRowObject();

        $gambar = $this->request->getFile('gambar');

        if(isset($gambar)) {
            $id_akun = $this->request->getVar('id_akun');
            $nama = $this->request->getVar('nama');
            $id_produk = $this->request->getVar('id_produk');
            $gambar = $this->request->getFile('gambar');
            $validate = $this->validate([
                'gambar' => 'uploaded[gambar]|max_size[gambar, 1024]|mime_in[gambar,image/png,image/jpg,image/jpeg]'
            ]);
            if($validate) {
                $gambarName = $gambar->getRandomName();
                
                $sql = "UPDATE tb_banner SET 
                        id_akun = ".$db->escape($id_akun).", 
                        nama = ".$db->escape($nama).", 
                        gambar = ".$db->escape($gambarName).", 
                        id_produk = ".$db->escape($id_produk)."
                    WHERE id = ".$id;

                $path = WRITEPATH.'uploads/';
                @unlink($path.$resultsBannerImg->gambar);

                $gambar->move(WRITEPATH.'uploads', $gambarName);

                $db->query($sql);
            
                return $this->respond([
                    'Success' => true,
                    'Message' => 'Banner berhasil diubah'
                ]);
            }
        
        } else {
            $id_akun = $this->request->getVar('id_akun');
            $nama = $this->request->getVar('nama');
            $id_produk = $this->request->getVar('id_produk');
            $sql = "UPDATE tb_banner SET 
                    id_akun = ".$db->escape($id_akun).", 
                    nama = ".$db->escape($nama).", 
                    gambar = ".$db->escape($resultsBannerImg->gambar).", 
                    id_produk = ".$db->escape($id_produk)."
                WHERE id = ".$id;

            $db->query($sql);

            return $this->respond([
                'Success' => true,
                'Message' => 'Banner berhasil diubah'
            ]);
        }
    }

    public function destroy($id = null)
    {
        try {
            $db = \Config\Database::connect();
            $sql = 'DELETE FROM tb_banner WHERE id ='.$id;

            $deleteImageSql = 'SELECT gambar FROM tb_banner WHERE id ='.$id;
            $deleteImageQuery = $db->query($deleteImageSql);
            $resultsImage = $deleteImageQuery->getRowObject();
            
            $path = WRITEPATH.'uploads/';
            @unlink($path.$resultsImage->gambar);

            $db->query($sql);

            $api = [
                'success' => true,
                'message' => 'Banner berhasil dihapus'
            ];
    
            return $this->respond($api);
        } catch (\Throwable $th) {
            $api = [
                'success' => false,
                'message' => 'Banner gagal dihapus'
            ];
    
            return $this->respond($api);
        }
    }

}