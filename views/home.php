
<!doctype html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="/assets/js/home.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>  
     
    <link rel="stylesheet" href="assets\css\style.css">   
</head>
<body>
<nav class = "TopHeader">
    <div class="nav-wrapper">
      <div class="brand-logo center">LAB 2</div>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
      <li><input class="form-control" type="text" placeholder="Search" id="search-text" onkeyup="tableSearch()"></li>
      <li><button class="btn waves-effect   indigo lighten-1" id="reset" type="submit" name="action">Reset</button></li>
      
      </ul>
      <ul class="left hide-on-med-and-down">
      <?php if(!array_key_exists('auth', $_SESSION)) : ?>
        <li><a class=" modal-trigger indigo" href="#modal2">Sign In</a>
        <div id="modal2" class="modal">
    <div class="modal-content">
    <form action="?controller=login&action=login" method="post">
           <div class="row">
               <div class="field">
                   <label>Email: <input type="email" name="email" required></label>
               </div>
           </div>
           <div class="row">
               <div class="field">
                   <label>Password: <input type="password" name="password" required><br></label>
               </div>
           </div>
           <input type="submit" class="btn indigo" value="Login" required>
       </form>
     </li>
        <li><a class=" modal-trigger indigo" href="#modal1">Sign Up</a>
        <div id="modal1" class="modal">
    <div class="modal-content">
      <!-- Form to add User -->
       <form action="?controller=users&action=add" method="post" enctype="multipart/form-data">
           <div class="row">
               <div class="field">
                   <label>First name: <input type="text" name="name" required></label>
               </div>
           </div>
           <div class="row">
               <div class="field">
                   <label>Second name: <input type="text" name="secondName" required></label>
               </div>
           </div>
           <div class="row">
                <div class="field">
                <label>Password: <input type="password" minlength="8" name="password" required></label>
            </div>
           </div> 
           <div class="row">
                <div class="field">
                <label>Password: <input type="password" minlength="8" name="dupPassword" required></label>
            </div>
           </div> 
           <div class="row">
               <div class="field">
                   <label>E-mail: <input type="email" name="email" required><br></label>
               </div>
           </div>
           <div class="row">
                                <div class="field">
                                    <div class="input-field">
                                        <p class="black-text">Role ID</p>
                                        <select name="role">
                                          <option value="" disabled selected>Choose your id</option>
                                          <option value="0">User</option>
                                          <option value="1">Admin</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
        </div>
           <div class="row">
               <div class="field">
                   <label>
                       <input class="with-gap" type="radio" name="gender" value="female"/>
                       <span>Female</span>
                   </label>
               </div>
               <div class="field">
                   <label>
                       <input class="with-gap"  type="radio" name="gender" value="male"/>
                       <span>Male</span>
                   </label>
               </div>
           </div>
           <div class="row">
               <div class="file-field input-field">
                   <div class="btn indigo">
                       <span>Photo</span>
                       <input type="file" name="photo"  accept="image/png, image/gif, image/jpeg">
                   </div>
                   <div class="file-path-wrapper">
                       <input class="file-path validate" type="text">
                   </div>
               </div>
           </div>
           <input type="submit" class="btn indigo" value="Sign Up">
       </form>
    </div>
  </div>
    </li>
    <?php else :?>
                <li><?=$_SESSION['name'] . ' ' . $_SESSION['secondName']?></li>
                <li> | </li>
                <li><a href="?controller=logout&action=logout">Logout</a></li>
     <?php endif;?>
      </ul>
    </div>
  </nav>
  <div class = "error">
<div class ="row">
  <div class="field">
  <?php if (isset($error)): ?>
    <?= $error ?>
    <?php endif ?>
  </div>
  </div>
  </div>
  <table class="striped" id="info-table">
        <thead>
          <tr>
              <th>#</th>
              <th>First name</th>
              <th>Second name</th>
              <th>Email</th>
              <th>Photo</th>
          </tr>
        </thead>
        <tbody>
         <?php foreach ($users as $user):?>
              <tr><td><a href="?controller=users&action=show&id=<?=$user['id']?>"><?php echo $user['id']?></a></td>
                  <td><?=$user['name']?></td>
                  <td><?=$user['secondName']?></td>
                  <td><?=$user['email']?></td>
                  <td><img width="50" height="50" src='<?=$user['path_to_img']?>'/></td>
                  <?php if(array_key_exists('auth', $_SESSION) && ($_SESSION['id_role'] == 1 || $_SESSION['id'] == $user['id'] ) ) : ?>
                  <td><a href="?controller=users&action=delete&id=<?=$user['id']?>">X</a></td>
                  <?php endif;?>
              </tr>
           <?php endforeach;?>
        </tbody>
      </table>
      <div>
      </div>

  <script src="./assets/js/home.js"></script>
</body>
</html>

