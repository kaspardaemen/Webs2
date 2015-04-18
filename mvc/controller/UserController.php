<?php
/**
 * User Controller
 * Controls the registration and login processes
 *
 * @author Leon Daamen <lmadaame@avans.nl>
 * @version 1.0
 */
class UserController {

    private $model;

    public function __construct() 
    {        
        $this->model = new UserModel();           
    }

    /**
     * Show login form
     * @return string 
     */
    public function Login() 
    {   
        $data["title"] = "Login";        
        return $data;
    }

    /**
     * The login action
     * @return string
     */
    public function Login_Post() 
    {
        global $validator;
        $data = $this->Login();        
        
        $username = $_POST['username'];
        
        if($this->model->usernameExists($username) || $this->model->emailExists($username))
        {
            list($userid, $status) = explode(":", $this->model->SignIn($username, $_POST['password']));
        
            switch($status)
            {
                case "ACTIVE":
                    if($this->model->createLoginSessionForUser($this->model->getUserById($userid)))
                    {
                        header('location: ' . Url::build("Home", "Index"));
                    }
                    break;
                case "INCORRECT":
                    $validator->setMessage("login", "Het wachtwoord dat u heeft ingevoerd is onjuist. Klik <a href=".Url::build("User", "RequestPassword").">hier</a> als u uw wachtwoord bent vergeten.");
                    break;
                case "TIMEOUT":
                    $validator->setMessage("login", "U heeft te vaak proberen in te loggen met het verkeerde wachtwoord: probeer het later nog eens of klik <a href=".Url::build("User", "RequestPassword").">hier</a> als u uw wachtwoord bent vergeten.");
                    break;            
                case "PENDING":
                    $validator->setMessage("login", "U registratie moet nog worden geaccepteerd door de beheerder");
                    break;            
            }
        }
        else
        {
            if(filter_var($username, FILTER_VALIDATE_EMAIL))
            {
                $validator->setMessage("login", "Er is nog geen account geregistreerd op het emailadres: ".$username.". Klik <a href=".Url::build("User", "Register").">hier</a> om te registreren.");
            }
            else
            {
                $validator->setMessage("login", "Er is nog geen account geregistreerd met username: ".$username.". Klik <a href=".Url::build("User", "Register").">hier</a> om te registreren.");
            }
        }
        return $data;
    }
        
    
    /**
     * Show logout confirmation
     * @return string
     */
    public function Logout()
    {
        $data["title"] = "Uitloggen";
        return $data;
    }
    
    /**
     * The logout action
     * 
     * Unsets all session values
     * Deletes current cookie
     * Destroys session 
     * Sends user to the homepage
     */
    public function Logout_Post()
    {        
        $_SESSION = array(); 
        $params = session_get_cookie_params(); 
        setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
        session_destroy();        
        header('location: ' . Url::build("Home", "Index"));
    }
    
    public function Details()
    {
        $data["title"] = "Account Details";
        $data["user"] = $this->model->checkLoginString() ? $this->model->getUserById($_SESSION['user']['id']) : NULL;             
        return $data;
    }
    
    public function RequestPassword()
    {
        $data["title"] = "Wachtwoord vergeten";
        return $data;
    }
    
    public function RequestPassword_Post()
    {
        global $validator;
        $data = $this->RequestPassword();
        
        $email = $this->validateFormInput($_POST['email']);
        
        if(filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            if($this->model->emailExists($email))
            {
                if($this->sendMailWithActivationKey($email))
                {   
                    $data["email_sent_to"] = $email;                    
                }
            }
            else
            {
                $validator->setMessage("RequestPassword", "U emailadres is niet bij ons bekend!");
            }
        }   
        else 
        {
            $validator->setMessage("RequestPassword", "U heeft een ongeldig emailadres ingevoerd!");
        }           
        return $data;         
    }
    
    private function sendMailWithActivationKey($email)
    {           
        $user = $this->model->getUserByUserIdentification($email);       
        
        if($user != null)
        {            
            $activationKey = md5($this->generateActivationKey(45));
            
            if($this->model->updateActivationKeyByEmail($activationKey, $email))
            {
                $url = (!empty($_SERVER['HTTPS']) ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'].Url::build("User", "ChangePassword", array("uid" => $user->id, "ak" => $activationKey));
                               
                $mail['to'] = $user->email;
                $mail['subject'] = "Nieuw wachtwoordverzoek De Bunders";
                $mail['message'] = "Beste ".$user->firstname." ".$user->surname.", <br><br>" 
                    . "U heeft zojuist verzocht om een nieuw wachtwoord in te stellen voor uw account op Wijkplatform De Bunders.<br><br>"
                    . "Klik <a href='".$url."'>hier</a> en kies een nieuw wachtwoord.<br><br> "
                    . "Heeft u zelf geen verzoek gedaan? Dan kunt u dit bericht negeren en zal er niets veranderen.<br><br>"
                    . "Met vriendelijke groet,<br><br>Wijkplatform De Bunders" ;
                $mail['headers'] = "MIME-Version: 1.0" . "\r\n"
                    . "Content-type:text/html;charset=UTF-8" . "\r\n"
                    . 'From: <noreply@debunders.nl>' . "\r\n";      
            
                if(mail($mail['to'], $mail['subject'], $mail['message'], $mail['headers']))
                {
                    return true;
                }
            }
        }        
        return false;   
    }
    
    public function ChangePassword()
    {        
        if(isset($_GET['uid'], $_GET['ak']) && strlen($_GET['uid']) >= 1 && strlen($_GET['ak']) == 32)
        {
            $data["title"] = "Wachtwoord wijzigen";
            $id = (int)htmlspecialchars(stripslashes(trim($_GET['uid'])));                                 
            $ak = htmlspecialchars(stripslashes(trim($_GET['ak'])));
                             
            $user = $this->model->getUserById($id);
        
            if($this->model->checkActivationKeyForUser($ak, $user))
            {
                $data["user"] = $user;
                return $data;
            }                
        }
        header('location: ' . Url::build("Home", "Index"));               
    }
    
    public function ChangePassword_Post()
    {
        global $validator;        
        $data = $this->ChangePassword();
        
        if (strlen($_POST['password']) == 0)
        {
            $validator->setMessage("ChangePassword", "Vul alsjeblieft een wachtwoord in");
        }
        else if($_POST['password'] != $_POST['password_repeat'])
        {
            $validator->setMessage("ChangePassword", "Wachtwoorden komen niet overheen");
        }
        
        if($validator->isValid()) 
        {
            if($this->model->updatePasswordByUserId($_POST['password'], $data["user"]->id))
            {
                $data["password_changed"] = true;                
            }            
        }        
        return $data;
    }
    
    private function validateFormInput($input)
    {
        # Strip unnecessary characters (extra space, tab, newline)
        $input = trim($input);
        # Remove backslashes (\)        
        $input = stripslashes($input);
        # convert some predefined characters to HTML entities
        $input = htmlspecialchars($input);        
        return $input;
    }

    public function Register()
    {
        $data["title"] = "Registreren";
        return $data;
    }
    public function Register_Post()
    {
        global $validator;
        $data = $this->Register();

        if (strlen($_POST['username']) == 0) {
            $validator->setMessage("username", "Vul alsjeblieft je gebruiksnaam in");
        }
        
        if(strlen($_POST['email']) == 0)
        {
            $validator->setMessage("email", "Vul alsjeblieft een email adres in");
        }
        else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        {
            $validator->setMessage("email", "Vul alsjeblieft een geldig email address in");
        }       

        if (strlen($_POST['password']) == 0)
        {
            $validator->setMessage("password", "Vul alsjeblieft een wachtwoord in");
        }
        else if($_POST['password'] != $_POST['password_repeat'])
        {
            $validator->setMessage("password", "Wachtwoorden komen niet overheen");
        }

        if($validator->isValid()) 
        {
            $data['accountInformation'] = $this->model->createAccount($_POST);
            header('location: ' . Url::build("Home", "Index"));               
        }

        return $data;
    }
    
     /**
      * 
      * @param int $length
      * @return String
      */
    private function generateActivationKey($length)
    {
        srand((double) microtime() * 10000000);       
        $input = array ("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
        
        $key = "";
        for($i = 1; $i < $length + 1; $i++)
        {
            if(rand(1,2) == 1)
            {
                $key .= $input[array_rand($input)];
            }
            else
            {
                $key .= rand(1, 10);
            }
        }        
        return $key;        
    }

}

?>
