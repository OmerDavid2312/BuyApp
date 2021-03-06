<?php 
session_start();
//if we have session, go to shopping
if (isset($_SESSION["email"]) || isset($_SESSION["username"]))
{
    header("Location:Shopping.php");
}
require_once 'Databasefuncs.php';
$err="";
$uid="";
$username="";


$cities = getCities();

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $uid=trim(filter_input(INPUT_POST,"eml",FILTER_SANITIZE_SPECIAL_CHARS));
    $username=trim(filter_input(INPUT_POST,"username",FILTER_SANITIZE_SPECIAL_CHARS));
    $pwd=trim(filter_input(INPUT_POST,"pwd",FILTER_SANITIZE_SPECIAL_CHARS));
    $city=trim(filter_input(INPUT_POST,"city",FILTER_SANITIZE_SPECIAL_CHARS));
    
            
if (empty($uid) || empty($pwd) || empty($username) || $city=="empty")
    {
      $err='<script>swal({
        title: "Error",
             text: "Empty inputs",
             icon: "warning",button: "Close"
                });</script>';  
    }
    else //user typed data
    {
        if(userexist($uid))
        {
           $err='<script>swal({
        title: "Error",
             text: "Email was taken",
             icon: "warning",button: "Close"
                });</script>';
        }
        else
        {
            $x=adduser($uid, $pwd, $username,$city);
            if(!$x)
            {
             $err='<script>swal({
  title: "Error",
  text: "Can not register",
  icon: "error",button: "סגור"
});</script>'; 
            }
            else
            {
                 $err='<script>swal({
                title: "You have successfully registered",
                 text: "You will immediately be taken to the category selection page",
                icon: "success",buttons: false
                });</script>';
                $_SESSION["email"]=$uid;
                $_SESSION["username"]=$username;
                $_SESSION["newuser"]="ok";
                $_SESSION["admin"]=0;
                $_SESSION["uid"]=$x;
                header("Refresh:2;url=categories.php");
            }
        }
    }
        
}
?>
<style>.swal-button{background-color: #ffc107 !important;
}</style>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <title>Register</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="icon" type="image/ico" href="imgs/buy.png">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    </head>
    <body class="text-center" style="background-color: #f2f2f2">
    <div class="container">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <br><br><br><br><br><br>
            <img class="mb-4" src="https://image.flaticon.com/icons/svg/180/180923.svg" alt="" width="80" height="80">
            <hr class="my-4">
            <h2 class="text-warning bold font-weight-bold">Register</h2>
            <br>
            <form method="POST" >
           <div class="form-group">
      
               <input type="email" class="form-control" id="eml" style="text-align: center" placeholder="name@buyApp.com" name="eml" value="<?= $uid?>">
          </div>
          <div class="form-group">
      
              <input type="text" class="form-control" id="username" style="text-align: center" placeholder="Username" name="username" value="<?= $username?>">
          </div>
          
          <div class="form-group">
      
           <input type="password" class="form-control" id="pwd" style="text-align: center" placeholder="Password" name="pwd">
         </div>
          <div class="form-group">
               
                <?php 
                echo "<select class='btn btn-outline-secondary btn-md btn-block' name='city'>";
                echo '<option value="empty">City</option>';
                foreach ($cities as $c){echo '<option value="'; echo $c['citycode'].'"if($c["citycode"]==$citycode){echo "selected"}>'; echo $c['cityname']."</option>" ;}
                echo "</select>"; 
                
                ?>
           </div>       
                
    
                <button type="submit" class="btn btn-lg btn-warning btn-block ">Register Now</button>
                <a href="login.php" class="btn btn-lg btn-secondary btn-block">Have an account ? Login here</a>
                
          </form>
          </div>
            </div>
        
        <style>select {
  text-align: center;
  text-align-last: center;
}

        </style>
        
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?= $err ?>
    </body>
</html>
