<?php 
session_start();
require_once 'Databasefuncs.php';

if (!isset($_SESSION["email"]) || !isset($_SESSION["username"]))
{
    header("Location:home.php");
}

if(!isset($_SESSION["categoryselected"]) )
{
    header("Location:Categories.php");
}   
else if($_SESSION["categoryselected"]==false) 
{
    header("Location:Categories.php"); 
}
$pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';


if ($pageWasRefreshed) {

}
$err="";
$selectedcategories="";

$usrcategories=$_SESSION["categories"];
$usrcategoriesID=array_keys($usrcategories);
$lastcategory=count($usrcategories);
 
foreach($usrcategoriesID as $categoryID){
    if($categoryID!=0){
        
            if ($usrcategories[$categoryID]==1) {
            $selectedcategories.= $categoryID.",";    
            }      
    }    
    if ($categoryID==0){
        if ($usrcategories[$categoryID]==1)
        {
          foreach($usrcategoriesID as $categoryID){  
             $selectedcategories.= $categoryID.",";   
          }
        }
        }
   }
$selectedcategories= rtrim($selectedcategories,',');






$items=getitemsforshopping($selectedcategories,$_SESSION["uid"]);
if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
    if(isset($_POST['search']))
    {
        $type = $_POST['search'];
        $items=searchprod($selectedcategories,$_SESSION["uid"],$type);
        
    }
    else
    {
    if(empty($_POST["price"]) || $_POST["price"]==0){$err='<script>swal({
        title: "Error",
             text: "The bid field is empty",
             icon: "warning",button: "Close"
                });</script>'; }
    else{
    $userbuyerid= $_SESSION["uid"];//userbuyerid
    $prodid=$_POST["prodid"];//prodid
    $price= $_POST["price"];//price
    $date=new DateTime();
    $finalrequestdate= $date->format("Y-m-d"); //final request date
    $addbid=addBidProd($userbuyerid, $prodid, $price, $finalrequestdate);
    if($addbid>0)
    {
       
        $err='<script>swal({
                title: "Bid was sent successfully!",
                 text: "Great News",
                icon: "success",button:"Close"
                });</script>';
       
        
    }
 else {
   //  header("refresh:0");
       $err='<script>swal({
        title: "Error",
             text: "Bid not sent",
             icon: "error",button: "סגור"
                });</script>';
    } 
    }}
}








?>
<style>.swal-button{background-color: #ffc107 !important;
}</style>
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

        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
        <title>Buyapp</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="icon" type="image/ico" href="imgs/buy.png">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
               <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
                  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
                 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    </head>
    <body class="text-center" dir='ltr'>
        
        
      
        <?php require_once 'header.php'; ?>
<?php     
       
      
        ?>
             <div class="container">
                 <div class="row avoid">
                    
                     
                
            <?php 
  
foreach($items as $item)
{
    ?>
                     
                        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <div class="card">
                <?php if($item["prodpicture"]==NULL)
                {
                    ?>
                 <img height="200px"src="imgs/noimg.png" class="card-img-top" alt="...">
                <?php
                }
 else {
      ?>
                   <img height="200px"src="usrpictures/<?= $item["prodid"]."."."jpg"?>" class="card-img-top" alt="..."> 
               
      <?php
 }
 ?>
 
               
              <div class="card-body" id='searchdiv'>
                <h4 class="card-title font-weight-bold"id='itemfor'>
                  <?=$item["prodname"] ?>
                  
                </h4>
                  <div>
                  <span class="fas fa-allergies text-warning"></span>&nbsp<?=$item["categoryname"]?>&nbsp<span class="fab fa-cuttlefish text-warning"></span>&nbsp<?=$item["prodcondition"]?>
                <p class="card-text"><?=$item["description"] ?></p>
              </div>
                <span class="price text-success"> <?=$item["price"] ?>$</span>
                <form method="post"><div class="form-group">
      
            <input type="number" class="form-control" id="price" placeholder="Offer" style="text-align: center" name="price" min="<?php echo $item["price"]?>">
            <input type="hidden" name="prodid" value="<?=$item["prodid"]?>">
                    </div><button class="btn btn-warning">Bid Now !&nbsp<span class="fas fa-coins"></span></button></form>
              </div>
              
            </div>
          </div>
     
                 
        <?php 
}
        ?>
            
       
    </div>  
             </div>
        
        
        
        <style>
          
           
            
            .price{
                font-size: 1.4em;
                font-family: sans-serif;
            }   
            body{background-color: #f2f2f2 !important;}
            .card:hover{border: 1px solid #ffc107;transition: all 0.1s ease;
   opacity: 1;transform: scale(1.02) ;    box-shadow: 0 1px 1px 0 #ffc107;

            
            }
 .card-body {
  /*display: grid;
  grid-template-rows: 65px 55px 40px auto;
  */
  display: flex;
  flex-direction: column;
  -ms-flex-direction: column;
}
h4{
  flex-basis: 60px;
}




            
        </style>
        
       
            <?php require_once 'Footer.php'; ?>
   <style>
    body, .sticky-footer-wrapper {
   min-height:100vh;
}

.flex-fill {
   flex:1 1 auto;
}
.container{
    max-height: 50%;
}
.avoid{margin-bottom: 20%;}
.card-title{margin-bottom: 3px !important;}
p{margin-bottom: 0 !important; margin-top: 5px;}




   
</style>

   
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?= $err ?>
    </body>
</html>
 