<?php 

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class Users extends Controller 
{

    use ResponseTrait;

    public function index()
    {
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM tb_akun');
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

    public function view($id_akun = null)
    {
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM tb_akun WHERE id_akun = '.$id_akun);
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
    public function register()
    {
        try {
            helper(['text','form']);

			if($this->validate([
				'username' => 'required|max_length[20]',
				'password' => 'required|max_length[20]'
				]
			)) 
			{
				$username = $this->request->getVar('username');
				$password = password_hash($this->request->getVar('password'), PASSWORD_BCRYPT);
				$token = random_string('alnum', 30);

				$db = \Config\Database::connect();
				$sql = 'INSERT INTO tb_akun (username, password, token) VALUES 
				('
				.$db->escape($username).','
				.$db->escape($password).','
				.$db->escape($token).
				')';
			
				$db->query($sql);

				$api = [
					'success' => true,
					'message' => 'Berhasil disimpan',
				];
		
				return $this->respond($api);
			} else {
				$api = [
					'success' => false,
					'message' => 'Isikan form sesuai ketentuan',
				];
				return $this->respond($api);

			}
        } catch (\Exception $err) {
            $api = [
                'success' => false,
                'message' => $err,
                'data' => null,
            ];
            return $this->respond($api);
        }
    }

    public function login()
    {
        helper('text');

		if($this->validate([
			'username' => 'required|max_length[20]',
			'password' => 'required|max_length[20]'
			]
		)) 
		{
			$username = $this->request->getVar('username');
			$password = $this->request->getVar('password');
			
			$session = session();
			$db = \Config\Database::connect();
			$queryUsername = $db->query('SELECT username FROM tb_akun WHERE username = '.'"'.$username.'"');
			$resultUsername = $queryUsername->getResult();

			if(! empty($resultUsername)) {
				$queryPassword = $db->query('SELECT password FROM tb_akun WHERE username = '.'"'.$username.'"');
				$resultPassword = $queryPassword->getRow('password');
				if(password_verify($password, $resultPassword)) {
					$getData = $db->query('SELECT * FROM tb_akun WHERE username = '.'"'.$username.'"');
					$resultData = $getData->getResult();
					$session->set($resultData);
					$api = [
						'success' => true,
						'message' => 'Berhasil Login',
					];
					return $this->respond($api);
				} else {
					$api = [
						'success' => false,
						'message' => 'Username atau Password Salah'
					];
					return $this->respond($api);
				}
			} else {
				$api = [
					'success' => false,
					'message' => 'Username atau Password Salah'
				];
				return $this->respond($api);
			}
			// $result = $queryUsername->getResult();

			// return $this->respond($result);
		} else {
			$api = [
				'success' => false,
				'message' => 'Isikan form sesuai ketentuan',
			];
			return $this->respond($api);

		}
	}
}