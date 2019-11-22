<?php 
session_start();
//if we have session, go to shopping
if (isset($_SESSION["email"]) || isset($_SESSION["username"]))
{
    header("Location:Shopping.php");
}

?>



<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <title>BuyApp</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="icon" type="image/ico" href="imgs/buy.png">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
               <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
                  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
                 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>        <link rel="icon" type="image/ico" href="imgs/buy.png">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    </head>
    <body dir='ltr'>
          <nav class="navbar navbar-expand-lg navbar-light bg-nav fixed-top py-3" id="mainNav" dir="ltr">
    <div class="container">
        <a id="logo" class="navbar-brand" href="home.php" style="color:white;"><img class="" id="logoimg" src="https://image.flaticon.com/icons/svg/180/180923.svg" alt="" width="50" height="50">APP</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse " id="navbarResponsive">
        <ul class="navbar-nav ml-auto my-2 my-lg-0">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger text-white ml-1" href="#who">About </a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger text-white ml-1" href="#sell">Sell</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger text-white ml-2" href="#buy">Buy</a>
          </li>
          <li class="nav-item">
          <a href="Login.php" class="btn btn-outline-warning btn-lg ml-2">Login</a>
          </li>
          <li class="nav-item">
              <a href="Signup.php" class="btn btn-outline-secondary btn-lg ml-2">Register</a><li>
          
          
        </ul>
      </div>
    </div>
  </nav>
        <!-- Masthead -->
  <header class="masthead" id='home'>
    <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-10 align-self-end">
          <h1 class=" text-white font-weight-bold" dir="rtl">BuyApp</h1>
          <hr class="new5"width="8%">
        </div>
        <div class="col-lg-8 align-self-baseline">
          <p class="text-white font-weight-bold mb-3 lead">Discover a new world of brokerage between sellers and buyers</p>
          <a href="Login.php" class="btn btn-warning btn-lg flex-fill pr5 font-weight-bold" dir="rtl" style="font-size:1.25rem !important;" dir='rtl'>! Let's Go </a>
          
       
        
      </div>
        
    </div>
      
  </header>
         <!-- section 1-->
        <section id="who" class="page-section bg-who text-center">
            <div class="container">
        <h3 class="bold font-weight-bold text-center text-warning" >About </h3>
        <hr class="new5 mb-3"width="8%">
        <p class="font-weight-bold mb-1 lead">We are a brokerage system between sellers and buyers.</p>
        <p class="font-weight-bold mb-1 lead">In the system you can easily sell and buy products.</p>
           <p class="font-weight-bold mb-1 lead" >From anywhere in the world.</p>
        
        </div>
        </section>
         
         <!-- section 2-->
         
        <section id="sell" class="page-section bg-dark">
              <div class="container">
        <h3 class="bold font-weight-bold text-center text-warning" >Sell </h3>
        
        <hr class="new5"width="8%">
         <div class="row text-center mt-5">
      <div class="col-md-4">
        <span class="fa-stack fa-4x">
          <i class="fas fa-circle fa-stack-2x text-warning"></i>
          <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
        </span>
        <h4 class="service-heading text-white mt-3">Sell is easy</h4>
        <p class="text-muted text-white-50 font-weight-bold">Sell ​​many products that will expose to many buyers. You can sell products in different categories and condition</p>
      </div>
      <div class="col-md-4">
        <span class="fa-stack fa-4x">
          <i class="fas fa-circle fa-stack-2x text-warning"></i>
          <i class="fas fa-hand-holding-usd fa-stack-1x fa-inverse"></i>
        </span>
        <h4 class="service-heading text-white mt-3">Get Bids</h4>
        <p class="text-muted text-white-50 font-weight-bold">Many potential buyers will be exposed to your products. You can get bids on products you have posted</p>
      </div>
      <div class="col-md-4">
        <span class="fa-stack fa-4x">
          <i class="fas fa-circle fa-stack-2x text-warning"></i>
          <i class="far fa-handshake fa-stack-1x fa-inverse"></i>
        </span>
        <h4 class="service-heading text-white mt-3">Accept Bids</h4>
        <p class="text-muted text-white-50 font-weight-bold">You can confirm bids on products you have posted. Once approved, you can contact the buyer using their email</p>
      </div>
    </div>
              </div>
        </section>
         
          <!-- section 3-->
          
        <section id="buy" class="page-section bg-secondary">
              <div class="container">
        <h3 class="bold font-weight-bold text-center text-warning">Buy </h3>
        
        <hr class="new5"width="8%">
         <div class="row text-center mt-5">
      <div class="col-md-4">
        <span class="fa-stack fa-4x">
          <i class="fas fa-circle fa-stack-2x text-warning"></i>
          <i class="far fa-hand-point-up fa-stack-1x fa-inverse"></i>
        </span>
        <h4 class="service-heading text-white mt-3">Choose categories</h4>
        <p class="text-muted text-white-50 font-weight-bold">Only categories you select will appear on your shopping screen.
Choose categories that suit you from a variety of categories</p>
      </div>
      <div class="col-md-4">
        <span class="fa-stack fa-4x">
          <i class="fas fa-circle fa-stack-2x text-warning"></i>
          <i class="fas fa-shopping-cart fa-stack-1x fa-inverse"></i>
        </span>
        <h4 class="service-heading text-white mt-3">Products that suit to you</h4>
        <p class="text-muted text-white-50 font-weight-bold">After logging in and selecting categories, filtering is done for products that interest you for not wasting valuable product search time</p>
      </div>
      <div class="col-md-4">
        <span class="fa-stack fa-4x">
          <i class="fas fa-circle fa-stack-2x text-warning"></i>
          <i class="far fa-check-square fa-stack-1x fa-inverse"></i>
        </span>
        <h4 class="service-heading text-white mt-3">Start bidding </h4>
        <p class="text-muted text-white-50 font-weight-bold">Start bidding on products. Sellers can confirm your bids and you can then contact them through the seller's email</p>
      </div>
    </div>
              </div>
        </section>
         <!-- section 4-->
       
         
         <footer>
         <section id="customer" class="page-sectionbottom bg-warning">
              <div class="container text-center">
        <h3 class="bold font-weight-bold text-center text-white" dir="ltr">Well, you convinced ?
 </h3>
        <a href="#home" class='mt-3'><i class="fas fa-chevron-circle-up" style="font-size: 30px; color:white "></i></a>
        
        
        
        
              </div>
        </section>
         </footer>
     
       
        
    
        
        <style>
            
            .navbar-collapse{flex-grow: 0 !important;}
            nav{font-size: 1.3rem;}
            .masthead{ height: 100vh;}
            header.masthead{
                    text-align: center;
    color: #fff;
    background-image: url("https://images.unsplash.com/photo-1495423204732-e41dd10e53a5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1489&q=80");
    background-repeat: no-repeat;
    background-attachment: scroll;
    background-position: center center;
    background-size: cover;
            }
                 hr.new5 {
  border: 2px solid #ffc107!important;
  
}
#mainNav .navbar-nav .nav-item .nav-link:hover{color:#ffc107 !important;}
.bg-who{background-color: #f2f2f2 !important;}
.page-section{padding: 7rem 0;}
.page-sectionbottom{padding: 4rem 0;}
.btn{font-size: 1rem !important;}


           
        </style>
        
          <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>var navbar = document.getElementById("mainNav");


window.addEventListener("scroll", function(){
    navbar.style.background = "black";
});</script>
    </body>
</html>
