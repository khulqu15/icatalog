<?php declare(strict_types = 1);
namespace App\Controllers;

use function time;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Config\Config;
use CodeIgniter\Controller;

class Profil extends Controller 
{
    use ResponseTrait;
    public function index()
    {
        $db = \Config\Database::connect();
        $sql = 'SELECT * FROM tb_profil';
        $query = $db->query($sql);
        $results = $query->getResultArray();

        if(!$results) {
            $api = [
                'message' => 'Maaf, Akun profil kosong',
            ];
            return $this->respond($api);
        }

        $api = [
            'data' => $results,
        ];
        return $this->respond($api);        
    }

    public function view($id = null)
    {
        $db = \Config\Database::connect();
        $sql = 'SELECT * FROM tb_profil WHERE id ='.$id;
        $query = $db->query($sql);
        $results = $query->getResultArray();

        if(!$results) {
            $api = [
                'message' => 'Maaf, Akun profil tidak ditemukan',
            ];
            return $this->respond($api);
        }

        $api = [
            'data' => $results,
        ];
        return $this->respond($api);     
    }

    public function update($id = null)
    {
        try {
            $db = \Config\Database::connect();

            $nama_perusahaan = $this->request->getVar('nama_perusahaan');
            $deskripsi = $this->request->getVar('deskripsi');
            $misi = $this->request->getVar('misi');
            $logo = $this->request->getFile('logo');
            $alamat = $this->request->getVar('alamat');
            $telp = $this->request->getVar('telp');
            $email = $this->request->getVar('email');
            $instagram = $this->request->getVar('instagram');
            $facebook = $this->request->getVar('facebook');
            $youtube = $this->request->getVar('youtube');
            $banner = $this->request->getFile('banner');
            $id_akun = $this->request->getVar('id_akun');
        
    
            $d_sql = 'SELECT * FROM tb_profil WHERE id ='.$id;
            $d_query = $db->query($d_sql);
            $d_result = $d_query->getRowObject();
    
            if(isset($logo)) {
                $l_path = WRITEPATH.'profil/logo/';
                $l_imgName = $nama_perusahaan.'-'.time().'.'.$logo->getExtension();
                @unlink($l_path.$d_result->logo);
                $logo->move($l_path, $l_imgName);
            } else {
                $l_imgName = $d_result->logo;
            }
    
            if(isset($banner)) {
                $b_path = WRITEPATH.'profil/banner/';
                $b_imgName = $nama_perusahaan.'-'.time().'-banner-'.'.'.$banner->getExtension();
                @unlink($b_path.$d_result->banner);
                $banner->move($b_path, $b_imgName);
            } else {
                $b_imgName = $d_result->banner;
            }
     
            $sql = "UPDATE tb_profil SET 
                        nama_perusahaan = ".$db->escape($nama_perusahaan).",
                        deskripsi = ".$db->escape($deskripsi).",
                        misi = ".$db->escape($misi).",
                        logo = ".$db->escape($l_imgName).",
                        alamat = ".$db->escape($alamat).",
                        telp = ".$db->escape($telp).",
                        email = ".$db->escape($email).",
                        instagram = ".$db->escape($instagram).",
                        facebook = ".$db->escape($facebook).",
                        youtube = ".$db->escape($youtube).",
                        banner = ".$db->escape($b_imgName).",
                        id_akun = ".$db->escape($id_akun)."
                    WHERE id = ".$id;
        
            $db->query($sql);
    
            return $this->respond([
                'Success' => true,
                'Message' => 'Data berhasil diubah'
            ]);
    
        }
         catch (\Throwable $th) {
            $b_path = WRITEPATH.'profil/banner/';
            $l_path = WRITEPATH.'profil/logo/';
            @unlink($b_path.$b_imgName);
            @unlink($l_path.$l_imgName);
            return $this->respond([
                'Success' => true,
                'Message' => 'Data berhasil diubah'
            ]);
        }
    }
}