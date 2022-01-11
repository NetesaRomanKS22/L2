<?php
class UsersController
{
   private $conn;
   public function __construct($db)
   {
       $this->conn = $db->getConnect();
   }

   public function index()
   {
       include_once 'app/Models/UserModel.php';

       // отримання користувачів
       $users = (new User())::all($this->conn);
       $comments = (new User())::allCom($this->conn);

       include_once 'views/home.php';
   }

   public function addForm(){
       include_once 'views/addUser.php';
   }

   public function add()
   {
       include_once 'app/Models/UserModel.php';
       // блок з валідацією
       $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $secondName = filter_input(INPUT_POST, 'secondName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
       $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       
       $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $dupPassword = filter_input(INPUT_POST, 'dupPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $hash = password_hash($password, PASSWORD_BCRYPT);

       $id_role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $target_dir = 'public/uploads/';
       $target_file = $target_dir . basename($_FILES["photo"]["name"]);
       $path_to_img = '';

       if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
          $path_to_img = $target_dir . basename($_FILES["photo"]["name"]);
        }
            
        if (strcmp($password, $dupPassword) !== 0) {
            $error = "Typing of different passwords!";
                $users = (new User())::all($this->conn);
                include_once 'views/home.php';  
                return;
        }

        
            $user = new User($name, $secondName, $email, $gender,$hash, $path_to_img, $id_role);
            if((new User())::byEmail($this->conn, $email)){
                $error = "The email already exists!";
                $users = (new User())::all($this->conn);
                include_once 'views/home.php';  
                return;
            }



            $user->add($this->conn);
        
        header('Location: ?controller=users');
   }

   public function delete(){
    include_once 'app/Models/UserModel.php';  

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (trim($id) !== "" && is_numeric($id)) {
        (new User())::delete($this->conn, $id);
    }

    header('Location: ?controller=users');
}

public function show(){
include_once 'app/Models/UserModel.php';  

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


if (trim($id) !== "" && is_numeric($id)) {
  $user = (new User())::byId($this->conn, $id);
}
include_once 'views/showUser.php';
}


    public function edit(){
        include_once 'app/Models/UserModel.php';
       // блок з валідацією
       $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $sName = filter_input(INPUT_POST, 'sName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
       $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $id_role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

       if($id === $_SESSION['id']){
           $_SESSION['name'] = $name;
           $_SESSION['secondName'] = $sName;
       }
       
         $target_dir = 'public/uploads/';
         $target_file = $target_dir . basename($_FILES["photo"]["name"]);
         $path_to_img = '';

       if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
          $path_to_img = $target_dir . basename($_FILES["photo"]["name"]);
        }
    
       
       

           // додати користувача
           $user = new User();
           $user->edit($this->conn, $id,$name,$sName,$email,$gender,$path_to_img, $id_role);
       

       header('Location: ?controller=users');
    }

   



    

 
}
