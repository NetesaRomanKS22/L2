<?php
class User {
   private $name;
   private $secondName;
   private $email;
   private $gender;
   private $path_to_img;
   private $password;
   private $id_role;

   public function __construct($name = '',$secondName = '', $email = '', $gender = '', $password = '',$path_to_img = '', $id_role = '')
   {
       $this->name = $name;
       $this->secondName = $secondName;
       $this->email = $email;
       $this->gender = $gender;
       $this->password = $password;
       $this->path_to_img = $path_to_img;
       $this->id_role = $id_role;
   }

   public function add($conn) {
       $sql = "INSERT INTO users (email, name, secondName, gender, password, path_to_img, id_role)
            VALUES ('$this->email', '$this->name','$this->secondName', '$this->gender', '$this->password', '$this->path_to_img', '$this->id_role')";
           $res = mysqli_query($conn, $sql);
           if ($res) {
               return true;
           }
   }

   public static function all($conn) {
       $sql = "SELECT * FROM users";
       $result = $conn->query($sql); //виконання запиту
       if ($result == TRUE ) {
           $arr = [];
           while ( $db_field = $result->fetch_assoc() ) {
               $arr[] = $db_field;
           }
           return $arr;
       } else {
           return [];
       }
   }

 


   



   public static function delete($conn, $id) {
    $sql = "DELETE FROM users WHERE id=$id";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        return true;
    }
    }


    public static function byId($conn, $id) {

        $sql = "SELECT * FROM users WHERE id=$id";
        $result = $conn->query($sql);   
        
        if ($result->num_rows > 0) {
            $arr = [];

            while($db_field = $result->fetch_assoc()) {
                $arr = $db_field;
            }
    
            return $arr;
        }else{
            return [];
        } 
        
    }

    public static function edit($conn, $id,$name,$sName,$email,$gender,$path_to_img, $id_role){
        if($path_to_img !== ''){
            $sql = "UPDATE users SET email= '$email', name='$name', secondName='$sName', gender='$gender', path_to_img='$path_to_img', id_role='$id_role' WHERE id=$id";
        }else{
            $sql = "UPDATE users SET email= '$email', name='$name', secondName='$sName', gender='$gender', id_role='$id_role' WHERE id=$id";
        }
        
           $res = mysqli_query($conn, $sql);
           if ($res) {
               return true;
           }
    }

    public static function auth($conn, $email, $password) {

        $users = self::all($conn);
        
            foreach ($users as $user) {
                if ($user['email'] == $email && password_verify($password, $user['password']) == true){
                    return $user;
                }
            }
        
    }

 

    public static function byEmail($conn, $email) {

        $sql = "SELECT email FROM users WHERE email='$email'";
        $result = $conn->query($sql);  

        
        if ($result->num_rows > 0) {
            return true;
        }else{
            return false;
        } 
        
    }



    



}
