

<?php

if (isset($_GET["disconnect"])) {
    unset($_SESSION["username"]);
    unset($_SESSION["email"]);
    unset($_SESSION["admin"]);
     unset($_SESSION["uid"]);
     unset($_SESSION["categoryselected"]);
    echo "<script type='text/javascript'>window.top.location='home.php';</script>"; exit;
}
//varibale for change time
$greet="";
 date_default_timezone_set('Asia/Tel_Aviv');
$hour = date('H', time());

if( $hour > 7 && $hour <= 11) {
    $greet="Good Morning ";
    }
   else if($hour > 11 && $hour <= 17) {
    $greet="Good Afternoon ";
   }
   else if($hour > 17 && $hour <= 19) {
    $greet="Good Evening ";
   }
   else {
    $greet="Good Night ";
   }


if (!isset($_SESSION["admin"])||$_SESSION["admin"]==0) {
  $adminheader="invisible"  ;
}



    



?>
   
<nav dir="ltr" class="navbar navbar-expand-lg p-2 bg-secondary navbar-dark  mb-5 rounded ">
    
 
   
    <a id="logo" class="navbar-brand ml-5" href="/buyapp/shopping.php">  <img class="mr-2 ml-2" id="logoimg" src="https://image.flaticon.com/icons/svg/180/180923.svg" alt="" width="76" height="76">APP </a>
  <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
      aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button> 
    
      <div class="navbar-collapse collapse" id="collapsibleNavId">
          <ul  class="navbar-nav ml-auto mt-2 mt-lg-0">
          <li class="nav-item mr-2">
        <a class="nav-link float-left" id="disconnect" href="?disconnect=true"> <img src="imgs/logout.png"> Sign Out </a>
    </li>
    
      <li class="nav-item active">
          <a class="nav-link mr-2 float-left"  id="user" href="/buyapp/Settings.php"><img src="imgs/user.png"> <?=$greet. $_SESSION["username"] ?> </a>
    </li>
   
     <li class="nav-item active mr-2">
          <a class="nav-link float-left"  href="/buyapp/buy.php"><img src="imgs/shopping_cart.png"> My Shopping</a>
    </li>
     <li class="nav-item dropdown mr-2">
         <a class="nav-link dropdown-toggle float-left " href="/buyapp/sell.php"  id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">  <img src="imgs/sales.png"> My Sales</a>
         <div class="dropdown-menu bg-secondary text-warning" aria-labelledby="dropdownId"> 
               <a class="dropdown-item float-left" href="/buyapp/sell.php"><img src="imgs/sell_status.png"> Sales Status</a>
             <a class="dropdown-item float-left" href="/buyapp/sellhistory.php"><img src="imgs/history.png"> Sales History</a>
    </div>
         </li>
   <li class="nav-item active mr-2">
       <a class="nav-link float-left"  href="/buyapp/sellprod.php"><img src="imgs/add.png"> Add Product</a>
    </li>
    <li class="nav-item active mr-2  <?=$adminheader ?>">
        <a class="nav-link float-left"  href="adminHub.php"><img src="imgs/admin.png"> Admin Panel</a>
    </li>
    
        
  
       </div>
  </ul>
 
    <style>
        nav{
            min-height: 10%;
            font-size: 1.3em; 
        }  
        
        
        #disconnect{
         font-size: 0.9rem;
        }
        
        #disconnect img{
            width: 25px;
        }
        
        #user{
            color: white !important;
           
        } 
        
        #user img{
            width: 42px;
        }
        
         #user:hover{
            
            color:black !important;
            color:rgb(224, 168, 0) !important; 
        }     
        
      
        nav a {
            color:rgb(224, 168, 0) !important; 
            transition: 0.2s;
        }
        
       nav a.dropdown-item:hover{
 background-color: black !important;   
   
    } 
        nav a:hover {
         font-size: 1.2em;
        color: white !important; 
         transition: 0.1s;
        }
        
        nav a img{
            width: 32px;
        }
        
        nav{
            text-align: right;
        }
        
        #logo{
           
         
            color: white !important;
            font-size: 1.8em !important;
        }
        
        #logo img{
           
         
         transform: scale(2);
        }
        
        .invisible{
        display: none;
    }
    
    nav{
        direction: ltr;
        border-bottom: 3px #ffc107 solid !important;
    }
    .navbar-collapse{
        flex-grow: 0 !important;
    }
    
   
 
    </style>
   
</nav>
      