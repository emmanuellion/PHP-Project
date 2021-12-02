<?php

namespace App\Controllers;

use CodeIgniter\Database\Database;

class Form extends BaseController
{
    public function index()
    {
        $this->start();
        model(Database::class);
        helper(['form', 'url']);
        if(isset($_SESSION['source'])){
            $str = $_SESSION['source'];
        }else{
            return view('c_sign_in');
        }
        if($str == "sign_up"){
            $rules = [
                'login' => [
                    'rules' => 'required|min_length[2]',
                    'errors' => [
                        'required' => 'Veuillez renseigner un pseudo valide (2 caractères minimum)',
                    ]
                ],
                'mdp' => [
                    'rules' => 'required|min_length[5]',
                    'errors' => [
                        'required' => 'Veuillez renseigner un mot de passe valide (5 caractères minimum)',
                    ]
                ]
            ];
        }else if($str == "sign_in"){
            $rules = [
                'nom' => [
                    'rules' => 'required|min_length[2]',
                    'errors' => [
                        'required' => 'Veuillez renseigner un nom valide (2 caractères minimum)',
                    ]
                ],
                'prenom' => [
                    'rules' => 'required|min_length[2]',
                    'errors' => [
                        'required' => 'Veuillez renseigner un prénom valide (2 caractères minimum)',
                    ]
                ],
                'login' => [
                    'rules' => 'required|min_length[2]',
                    'errors' => [
                        'required' => 'Veuillez renseigner un pseudo valide (2 caractères minimum)',
                    ]
                ],
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => 'Veuillez renseigner un email valide',
                    ]
                ],
                'mdp' => [
                    'rules' => 'required|min_length[5]',
                    'errors' => [
                        'required' => 'Veuillez renseigner un mot de passe valide (5 caractères minimum)',
                    ]
                ],
                'mdp_confirm' => [
                    'rules' => 'required|min_length[5]|matches[mdp]',
                    'errors' => [
                        'required' => 'Les mots de passe doivent être similaire',
                    ]
                ]
            ];
        }
        foreach($rules as $key => $val)
            if(isset($_SESSION[$key]))
                $_SESSION[$key] = "";
        $_SESSION['non-existant_account'] = "";
        $_SESSION['already_exist'] = "";
        if ($this->validate($rules)) {
            var_dump($this->db);
            /*$builder = $this->$db->table('users');
            
            if($str == "sign_up"){
                $tab = [
                    'u_pseudo' => $_POST['login'],
                    'u_mdp' => $_POST['mdp']
                ];
                $builder->where('u_pseudo', $tab['u_pseudo']);
                $builder->where('u_mdp', $tab['u_mdp']);
            }else{
                $tab = [
                    'u_nom' => $_POST['nom'],
                    'u_prenom' => $_POST['prenom'],
                    'u_pseudo' => $_POST['login'],
                    'u_email' => $_POST['email'],
                    'u_password' => $_POST['mdp'],
                    'u_admin' => 0
                ];
                $builder->where('u_email', $tab['u_email']);
            }
            $query = $builder->get();
            if($str == "sign_up"){
                if(count($query->getResultArray()) == 1)
                    echo view('c_index');
                else{
                    $_SESSION['non-existant_account'] = "Veuillez d'abord vous créer un compte";
                    echo view('c_sign_up');
                }
            }else{
                if(count($query->getResultArray()) == 0){
                    $this->$db->insert('users', $tab);
                    echo view('c_index');
                }else{
                    $_SESSION['already_exist'] = "Un comtpe avec cet email existe déjà !";
                    echo view('c_sign_in');
                }
            }*/
        } else {
            foreach($rules as $key => $val){
                if(isset($this->validator->getErrors()[$key])){
				    $_SESSION[$key] = $rules[$key]['errors']['required']; 
                    var_dump($rules[$key]['errors']['required']);
                }
            }
            echo view("c_".$str);
        }
    }
}