<?php
require_once dirname(__DIR__).'/Entities/User.php';
require_once dirname(__DIR__).'/Entities/Message.php';
require_once dirname(__DIR__).'/Helpers/Authentification.class.php';

require 'BaseController.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MainController
 *
 * @author pkpwang
 */
class MainController extends BaseController
{
    /**
     * 
     * @return type
     */
    public function defaultAction()
    {
        return $this->isAuthenticated() ? $this->render('home', array()) : $this->render('login', array());                
    }
    
    /**
     * Affiche le formulaire d'authentification
     * @return type
     */
    public function loginFormAction()
    {        
        if ($this->isAuthenticated())
        {
            //On redirige à la home ou à la page d'où on vient
            return $this->redirect("/");
        }
        //:On affiche le formulaire d'authentification
        return $this->render('loginForm', array());
    }
    
    /**
     * Authentification d'un utilisateur
     * @return type
     */
    public function loginAction()
    {
        if (isset($_POST['tokenconnexion']) && $_POST['tokenconnexion'] == 'tokenconnexion')
        {
            if (!$this->isAuthenticated())
            {
                $email = $this->text($_POST['email']);
                $mdp = $this->text($_POST['password']);
                $user = $this->authoriz($email, $mdp);                
                if (isset($user['id']) && isset($user['email']))
                {
                    $auth = new Authentification();
                    $auth->authenticated = true;                            
                    return $this->render('home', array());
                }
            }
        }
        //:On affiche le formulaire d'authentification
        return $this->render('loginForm', array());
    }
    
    /**
     * 
     * @param type $email
     * @param type $mdp
     * @return type
     */
    private function authoriz($email, $mdp)
    {        
        return Authentification::login($email, $mdp);     
    }

    /**
     * 
     * @return type
     */
    public function inscriptionAction()
    {        
        if (!$this->isAuthenticated() && !isset($_POST['token-inscription']))
        {
            return $this->render('inscription', array());
        }
        if (isset($_POST['token-inscription']) && $_POST['token-inscription'] == "token@inscription")
        {
            $email = $this->text($_POST['email']);
            $mdp = $this->text($_POST['password']);
            $confirm_mdp = $this->text($_POST['password2']);            
            $errors = $this->verifyValues($email, $mdp, $confirm_mdp);            
            if (count($errors) > 0 )
            {                
                return $this->render('inscription', $errors); 
            }
            //On insère le nouvel user
            $user = new \User();
            $user->setEmail($email);
            $user->setMdp(crypt($mdp, '@tchat'));
            try
            {
                $user->adduser();
                return $this->render("home", array("msg" => "Inscription terminée! merci de vous loguer avec votre email et mdp"));
            }
            catch (Exception $e)
            {
                exit("Erreur survenue lors de l'ajout du nouvel utilisateur" . $e->getMessage());
            }            
        }
    }    
    
    /**
     * 
     * @param type $email
     * @param type $mdp
     * @param type $confirm_mdp
     */
    private function verifyValues($email, $mdp, $confirm_mdp)
    {        
        $error = array();                
        if (!$this->is_email($email)) {
            $error[] = "Mauvais format de l'email";
        }
        elseif (\User::checkIfExistEmail('email', $email))
        {
            $error[]='Cet email existe deja';        
        }
        elseif ($mdp == "" || $confirm_mdp == "")
        {
            $error[] = "Mot de passe vide";
        }
        elseif($mdp != $confirm_mdp)
        {
            $error[] = "Les mots de passes dont différents";
        }
        return $error;
    }
    
    /**
     * Ajout d'un message
     */
    public function addmsgAction()
    {
        $msg = new Message();        
        $response = $msg->insertMessage($this->text($_POST['msg']), $this->text($_POST['user_id']));                
        echo json_decode($response);
    }
    
    public function logoutAction()
    {
        unset($_SESSION);
        $this->render('home', array('msg'=>'Vous êtes déconnecté'));
    }
}
