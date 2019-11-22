<?php
session_start(); 
require_once 'Databasefuncs.php';
//if we dont have session, go to home
if (!isset($_SESSION["email"]) || !isset($_SESSION["username"]))
{
    header("Location:home.php");
}



if (!isset($_SESSION["categoryselected"])) 
{
    $_SESSION["categoryselected"]=false;
}       
      
    if ($_SESSION["categoryselected"]==false) 
    {

        $categories = getCatagories();
        $usrcategories =array();
      
    foreach ($categories as $category)
     {    
     $usrcategories[$category["categoryid"]]=0;
    }
        
    $_SESSION["categories"] = $usrcategories;
    $_SESSION["categories"][0]=0;
    }
      
    
    
    
    
                    
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
    $usrcategoryselected=$_POST["category"];
    
    if(!($_SESSION["categoryselected"]))
    {
    $_SESSION["categoryselected"]=true;
    }
   
    if ( $usrcategoryselected==0&&  $_SESSION["categories"][$usrcategoryselected]==0) {
     for($i=1;$i< count($_SESSION["categories"]);$i++)
     {
           $_SESSION["categories"][$i] =0;   
     }            
    } 
    
    if($usrcategoryselected!==0)
    { 
    $_SESSION["categories"][0]=0;    
    
    if($_SESSION["categories"][$usrcategoryselected]==0)
      {
          $_SESSION["categories"][$usrcategoryselected]=1;   
      }
      else
      {
        $_SESSION["categories"][$usrcategoryselected]=0;   
      }
      
    }     
     
    
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

        <title>Categories</title>
    </head>
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="icon" type="image/ico" href="imgs/buy.png">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<body dir="ltr">
    <br>
             <h1 class="text-warning mb-3 mt-3 header1 font-weight-bold">What are you looking for ?  </h1>
             <p class="font-weight-bold lead">Choose categories</p>
             <p class="font-weight-bold lead">Only products in the categories you select will appear on your shopping screen</p>
       
             <div class="fluid-container">
             
                 
             <div class="category p-2  <?php if($_SESSION["categories"][0]==1){
        echo "bg-warning";
    }
    else{
        echo "bg-secondary";
    }       
    ?> rounded-pill m-5" > <form method="post"> <input type="hidden" name="category" value="0" > <a href="" class="selection mt-4" onclick="this.parentNode.submit();return false;"> All Categories</a><br> <img  id="catimg" class="p-2 mt-2" src="category/shopping-cart.png" ></form></div> 
         <?php 
          $categories = getCatagories();
         foreach ($categories as $category): ?>
        <div class="category p-2 container 
           
    
     <?php if($_SESSION["categories"][$category["categoryid"]]==1){
        echo "bg-warning";
    }
    else{
        echo "bg-secondary";
    }       
           ?> rounded-pill m-5 container" > <form method="post"> <input type="hidden" name="category" value="<?=$category["categoryid"] ?>"> <a href="" class="selection mt-4 " onclick="this.parentNode.submit();return false;"> <?=$category["categoryname"] ?> </a> 
                <br> <img  id="catimg" class="p-2 mt-2" src="category/<?= $category["categoryid"]."."."jpg"?>" > </form>
        </div> 
        <?php endforeach;?>

                 <br>  
                 
                 <a href="shopping.php" id="continuebtn" class="btn btn-warning btn-lg px-5 pr5 <?php 
                if(!$_SESSION["categoryselected"]){
                    echo "invisible";
                }
                
                ?>">Start</a> 
             
          </div>   
             
    </body>

    <style>
        body{
            text-align: center;
            background-color: #f2f2f2;
        }
        
        .category{
      text-align: center;
      width: 200px;
      height: 200px;
      align-items: center;
      display: inline-block;
    }
    
    .selection:hover{
     color: black; 
     font-weight: bold;
     text-decoration: none;
     font-size: 1.5em;
     transition: 0.2s;
    }
    
    .selection{
     color: black; 
     font-size: 22px;
     transition: 0.2s;  
    }
    
    #catimg{
    height: 80px !important;
    width: 80px !important;    
    align-self: flex-end;   
    }
    
    .invisible{
        display: none;
    }
    /* desktop */
    #continuebtn{
     text-align: center;

        bottom: 5%;   
     position: fixed;
     left: 45% !important;
     
    }
    /* smart=phones */
    @media (max-width: 767px) {
    #continuebtn{
     text-align: center;

        bottom: 5%;   
     position: fixed;
     left: 30% !important;
     
    }
    }
    /* tablets */
    @media (min-width: 768px) and (max-width: 1024px) {
       #continuebtn{
     text-align: center;

        bottom: 5%;   
     position: fixed;
     left: 40% !important;
     
    } 
    }
    
    
    .header1{
        
        font-size: 3.5em;
    }
 
   
    
      </style>
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>
