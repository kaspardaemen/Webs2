<?php
/**  
 * @author Leon Daamen 
 * @author Koen Vervoordeldonk 
 * @version 1.0
 */
class UserModel 
{
    /**
     * Creates a new user record in the database.
     * 
     * @global Database $db
     * @param Array $data
     * @return INT
     */
    public function createAccount($data)
    {
        try 
        {
            global $db;

            $sql = "INSERT INTO user (username, email, password) VALUES (:Username, :Email, :Password)";
            $query = $db->prepare($sql);
            $query->bindParam(':Username', $data['username'], PDO::PARAM_STR);
            $query->bindParam(':Email', $data['email'], PDO::PARAM_STR);
            $query->bindParam(':Password', $data['password'], PDO::PARAM_STR);                        
            $query->execute();
            
            return $db->lastInsertId();
        } 
        catch (PDOException $e)
        {            
            print_r($e->getTraceAsString());
        }      
    }

    /**
     * Get address id for inserting the account from the register function.
     * @TODO: fix sql query?! 
     * @global Database $db
     * @param Array $zipcode,$housenumber,$housenumber_appendix
     * @return INT
     */
    public function getAddressId($zipcode,$housenumber,$housenumber_appendix)
    {
        try
        {
            global $db;
            $sql = "SELECT id FROM address WHERE zipcode = '5467AA' AND housenumber = 2";
            $query = $db->prepare($sql);

            $query->bindParam(':ZipCode', $zipcode, PDO::PARAM_STR);
            $query->bindParam(':HouseNumber', $housenumber, PDO::PARAM_INT);
            $query->bindParam(':HouseNumber_Appendix', $housenumber_appendix, PDO::PARAM_STR);
            $query->execute();
            $result = $query->fetchColumn();
            return $result;
        }
        catch (PDOException $e)
        {
            print_r($e->getTraceAsString());
        }
    }

     /**
     * Login with username and password and returns a string with username and status.
     * @example 11:INCORRECT
     * 
     * @global Database $db
     * @param String $username
     * @param String $password
     * @return String (id:STATUS)
     */
    public function SignIn($username, $password)
    {
        try
        {
            global $db; 
            $sql = "SELECT LOGIN(:Username, :Password) AS result;";
            $query = $db->prepare($sql);            
            $query->bindParam(':Username', $username, PDO::PARAM_STR);
            $query->bindParam(':Password', $password, PDO::PARAM_STR);              
            $query->execute();                       
            $result = $query->fetch();
            return $result["result"];
        }
        catch (PDOException $e)
        {
            print_r($e->getTraceAsString());
        }    
    }
    
    /**
     * Creates a login session for a user
     * 
     * @param object $user
     * @return boolean
     */
    public function createLoginSessionForUser($user)
    {
        try 
        {
            if($user != null)
            {
                $_SESSION['user']['id'] = preg_replace("/[^0-9]+/", "", $user->id);                
                $_SESSION['user']['username'] = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $user->username);
                $_SESSION['user']['loginstring'] = $this->createLoginString($user->password);
                $_SESSION['user']['roles'] = $this->getNeighbourhoodsWithRolesByUserId($user->id);  
                return true;
            }
            else
            {
                return false;
            }
        } 
        catch (Exception $e) 
        {
            print_r($e->getTraceAsString());
        }
    }
    
    /**
     * Checks if the loginString in the current_user session is still valid.
     * 
     * @global Database $db
     * @return boolean
     */
    public function checkLoginString()
    {
        try
        {
            global $db;       
            if(isset($_SESSION['user']['id'], $_SESSION['user']['username'], $_SESSION['user']['loginstring']))
            {
                $sql = "SELECT * FROM user WHERE id = :Id LIMIT 1";
                $query = $db->prepare($sql);
                $query->bindParam(':Id', $_SESSION['user']['id'], PDO::PARAM_INT);
                $query->execute();
            
                if($query->rowCount() == 1)
                {
                    $user = $query->fetch(PDO::FETCH_OBJ); 
                    
                    if($this->createLoginString($user->password) === $_SESSION['user']['loginstring'])
                    {
                        return true;
                    }                
                }
            }
            return false;
        }
        catch (PDOException $e)
        {
            print_r($e->getTraceAsString());
        }   
    }
       
    /**
     * Checks if an email exists in the database.
     * 
     * @global Database $db
     * @param String $email
     * @return boolean
     */
    public function emailExists($email)
    {
        try
        {
            global $db;
            $sql = "SELECT email FROM user WHERE email = :Email";
            $query = $db->prepare($sql);
            $query->bindParam(':Email', $email, PDO::PARAM_STR);     
            $query->execute();
            if($query->fetch(PDO::FETCH_COLUMN) == $email)
            {
                return true;
            }
            return false;
        }
        catch (PDOException $e)
        {
            print_r($e->getTraceAsString());
        }        
    }
    
    /**
     * Checks if an username exists in the database.
     * 
     * @global Database $db
     * @param String $username
     * @return boolean
     */
    public function usernameExists($username)
    {
        try
        {
            global $db;        
            $sql = "SELECT username FROM user WHERE username = :Username";        
            $query = $db->prepare($sql);
            $query->bindParam(':Username', $username, PDO::PARAM_STR);                       
            $query->execute();
            if($query->fetch(PDO::FETCH_COLUMN) == $username)
            {
                return true;
            }
            return false;
        }
        catch (PDOException $e)
        {
            print_r($e->getTraceAsString());
        }        
    }
    
    /**
     * @param String $password
     * @return String
     */
    public function createLoginString($password)
    {       
        $browser = filter_input(INPUT_SERVER, 'http_user_agent'); // misschien nog filters/filter flags toevoegen
        $loginString = $password + hash('sha512', $browser);
        return $loginString;
    }       
    
    public function updateActivationKeyByEmail($activationKey, $email)
    {
        try 
        {
            global $db;
            $sql = "UPDATE user SET activation_key = :ActivationKey WHERE email = :Email;";           
            $query = $db->prepare($sql);

            $query->bindParam(':ActivationKey', $activationKey, PDO::PARAM_STR);
            $query->bindParam(':Email', $email, PDO::PARAM_STR);
            $query->execute();            
            return true;
        } 
        catch (PDOException $e)
        {            
            print_r($e->getTraceAsString());
            return false;
        }           
    }
    
    public function updatePasswordByUserId($password, $id)
    {
        try 
        {
            global $db;
            $sql = "UPDATE user SET password = :Password, activation_key = NULL WHERE id = :Id;";           
            $query = $db->prepare($sql);

            $query->bindParam(':Password', $password, PDO::PARAM_STR);
            $query->bindParam(':Id', $id, PDO::PARAM_INT);
            $query->execute();            
            return true;
        } 
        catch (PDOException $e)
        {            
            print_r($e->getTraceAsString());
            return false;
        }           
    }
    
    public function checkActivationKeyForUser($activationkey, $user)
    {
        try
        {
            global $db;        
            $sql = "SELECT activation_key FROM user WHERE id = :Id";        
            $query = $db->prepare($sql);
            $query->bindParam(':Id', $user->id, PDO::PARAM_INT);                       
            $query->execute();
            if($query->fetch(PDO::FETCH_COLUMN) == $activationkey)
            {
                return true;
            }
            return false;
        }
        catch (PDOException $e)
        {
            print_r($e->getTraceAsString());
        }       
    }
                                
    /**
     * 
     * @global Database $db
     * @param INT $id
     * @return (user)Object
     */
    public function getUserById($id) 
    {
        try
        {
            global $db;
            $sql = "SELECT * FROM user WHERE id = :Id";
            $query = $db->prepare($sql);
            $query->bindParam(':Id', $id, PDO::PARAM_INT);                
            $query->execute();
            if($query->rowCount() == 1)
            {
                return $query->fetch(PDO::FETCH_OBJ);
            }
            return NULL;
        }
        catch(PDOException $e)
        {
            print_r($e->getTraceAsString());
        }
    }
    
    /**
     * UserIdentification: username OR email
     * 
     * @global Database $db
     * @param string $userIdentification
     * @return (user)object
     */
    public function getUserByUserIdentification($userIdentification)
    {
        try
        {
            global $db;
            $sql = "SELECT * FROM user WHERE email = :Email OR username = :Username";
            $query = $db->prepare($sql);
            $query->bindParam(':Email', $userIdentification, PDO::PARAM_STR);                
            $query->bindParam(':Username', $userIdentification, PDO::PARAM_STR); 
            $query->execute();
            if($query->rowCount() == 1)
            {
                return $query->fetch(PDO::FETCH_OBJ);
            }
            return NULL;
        }
        catch(PDOException $e)
        {
            print_r($e->getTraceAsString());
        }
    }
    
    /**
     * 
     * 
     * @global Database $db
     * @param INT $userId
     * @return Array
     */
    public function getNeighbourhoodsWithRolesByUserId($userId)
    {      
        try
        {
            global $db;
            $sql = "SELECT nbh.name, r.name FROM user_has_role_in_neighbourhood AS uhrin
                    JOIN neighbourhood AS nbh ON uhrin.neighbourhood_id = nbh.id
                    JOIN role AS r ON uhrin.role_id = r.id
                    WHERE user_id = :UserId;";     
            
            
            $query = $db->prepare($sql);
            $query->bindParam(':UserId', $userId, PDO::PARAM_INT);        
            $query->execute();
            return $query->fetchAll(PDO::FETCH_COLUMN|PDO::FETCH_GROUP);
        }
        catch(PDOException $e)
        {
            print_r($e->getTraceAsString());
        }        
    }

    /**
     * Checks if the registration postalcode exists in the possible neighborhood postalcodes.
     *
     * @global Database $db
     * @return int (street_id)
     */
    public function checkPostalCode($zipcode)
    {
        try
        {
            global $db;
            $sql = "SELECT street_id FROM zipcode WHERE code = :ZipCode";
            $query = $db->prepare($sql);
            $query->bindParam(':ZipCode', $zipcode, PDO::PARAM_STR);
            $query->execute();
            return $query->fetch();
        }
        catch (PDOException $e)
        {
            print_r($e->getTraceAsString());
        }
    }

}
