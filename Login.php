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
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
 $uid=trim(filter_input(INPUT_POST,"eml",FILTER_SANITIZE_SPECIAL_CHARS));
 $pwd=trim(filter_input(INPUT_POST,"pwd",FILTER_SANITIZE_SPECIAL_CHARS));
 if(empty($uid) || empty($pwd))
 {
    $err='<script>swal({
        title: "Error",
             text: "Empty inputs",
             icon: "warning",button: "Close"
                });</script>'; 
 }
 else//user enter data
 {
     
            $sql = 'select email,username,admin,password from users where email=:eml';
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':eml',$uid);
            
            //do the query in db execute it !
            $stmt->execute();
            //count if we got data. if we got 1 so we have this user in our data
            $count = $stmt->rowCount();
            //fetch the data
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $hashcheck = password_verify($pwd,$result['password']);
             //if we got data count above 0 (we should get 1) AND the hash password = typed password
            
            
            if ($count ==1 && $hashcheck==TRUE) {
                $err='<script>swal({
                title: "You have Successfully logged in",
                 text: "You will immediately be taken to the category selection page",
                icon: "success",buttons: false
                });</script>';
               
                //create session after login currect and go to cms master Email,Password,Username
                $userid= getUseridByEmail($result["email"])["userID"];
                 
                 $_SESSION["email"]=$result["email"];
                 $_SESSION["username"]=$result["username"];
                 $_SESSION["uid"]=$userid;
                 $_SESSION["admin"]=$result["admin"];
                header("Refresh:2;url=Categories.php");
                
                
            }else{
                $err='<script>swal({
  title: "Login error",
  text: "Incorrect email or password",
  icon: "error",button: "Close"
});</script>';
                
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

        <title>Login</title>
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
            <h2 class="text-warning bold font-weight-bold">Login</h2>
            <br>
            <form method="POST" >
           <div class="form-group">
      
               <input type="email" class="form-control" id="eml" placeholder="name@buyApp.com" style="text-align: center" name="eml" value="<?= $uid?>">
              
            
          </div>
          <div class="form-group">
      
              <input type="password" class="form-control" id="pwd" style="text-align: center" placeholder="Password" name="pwd">
         </div>
    
                <button type="submit" class="btn btn-lg btn-warning btn-block ">Login Now</button>
                <a href="Signup.php" class="btn btn-lg btn-secondary btn-block">Don't have an account ? Register here </a>
                
          </form>
          </div>
            </div>
        
       
        
        
        
        
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?= $err ?>
    

    </body>
</html>
