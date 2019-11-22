<?php
session_start();
//if we dont have session, go to home
if (!isset($_SESSION["email"]) || !isset($_SESSION["username"]))
{
    header("Location:home.php");
}
require_once 'Databasefuncs.php';
$prodname="";
$desc="";
$err="";
//get userID by Session
$emailsession =$_SESSION["email"];
$getUserId = getUseridByEmail($emailsession);
$finaluserid= $getUserId['userID'];


//get catagories
$catagories = getCatagories(); //for the form
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    //sanitize
    $prodname=trim(filter_input(INPUT_POST,"prodname",FILTER_SANITIZE_SPECIAL_CHARS));
    $category=trim(filter_input(INPUT_POST,"category",FILTER_SANITIZE_SPECIAL_CHARS));
    $price=trim(filter_input(INPUT_POST,"price",FILTER_SANITIZE_NUMBER_FLOAT));
    $condition=trim(filter_input(INPUT_POST,"condition",FILTER_SANITIZE_SPECIAL_CHARS));
    $desc=trim(filter_input(INPUT_POST,"desc",FILTER_SANITIZE_SPECIAL_CHARS));
   
    if(empty($prodname) || empty($desc) || $price<0 || empty($price) ||$category=="empty" ||$condition=="empty1")//check errors
    {
        $err='<script>swal({
        title: "Error",
             text: "Empty inputs",
             icon: "warning",button: "Close"
                });</script>';
    }
    if($err=="")
    {
     $hvfile = false;
   if (isset($_FILES['imgupldr'])) //check if we have pic
       {
                $type = $_FILES["imgupldr"]["type"];
                $size = $_FILES["imgupldr"]["size"];
                $tempnm = $_FILES["imgupldr"]["tmp_name"];
                $error = $_FILES["imgupldr"]["error"];
                if (isset($error) && $error > 0) {
                    $err = "<script>alert('Error upload picture')</script>";
                } else {
                    if ($type != "image/jpeg" || $size >= 10000000) {
                        $err = "<script>alert('Picture too big or wrong type')</script>";
                    } else {
                        $hvfile = true; //pic is ok
                    }
                }
            }
            
            $b;
           if($hvfile)
           {
              $b="jpg";
           }
           else{$b=NULL;}
            $rc = addProducts($prodname,$category,$price,$condition,$desc,$b,$finaluserid);
            if ($rc == 0) {
                $err='<script>swal({
        title: "Error",
             text: "Adding product failed",
             icon: "error",button: "Close"
                });</script>';
            } else {
                 $err='<script>swal({
                title: "Product successfully posted",
                 text: "Now wait for bids",
                icon: "success",button:"Close"
                });</script>';
                $rc2 = false;
                if ($hvfile) {
                    $target = getcwd() . "/usrpictures/" . $rc . ".jpg";
                    $rc2 = move_uploaded_file($tempnm, $target);
                    
                }
                
            }
    }
   
    
    
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

        <title>Add Product</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="icon" type="image/ico" href="imgs/buy.png">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    </head>
    <body class="text-center" style="background-color: #f2f2f2">
        
        <?php require_once 'header.php'; ?>
        
    <div class="container mb-5">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            
            <img class="mb-4 mt-5" src="https://image.flaticon.com/icons/svg/651/651992.svg" alt="" width="90" height="90">
            <hr class="my-4">
            <h2 class="text-warning bold font-weight-bold">Add Product</h2>
           
            
            <br>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
      
                    <input type="text" class="form-control" id="prodname" placeholder="Product Name" style="text-align: center" name="prodname" value="<?= $prodname?>">
                </div>
                <div class="form-group" style="text-align: center">
               
                <?php 
                echo '<select class="btn btn-outline-secondary btn-md btn-block" style="text-align: center" name="category">';
                echo '<option value="empty" style="text-align: center">Category</option>';
                foreach ($catagories as $ca){echo '<option value="'; echo $ca['categoryid'].'">'; echo $ca['categoryname']."</option>" ;}
                echo "</select>"; 
                
                ?>
               </div>
                <div class="form-group">
      
                    <input type="number" class="form-control" id="price" placeholder="Price" style="text-align: center" name="price">
                </div>
                <div class="form-group">
      
                    <select class="btn btn-outline-secondary btn-md btn-block" style="text-align: center" name="condition">
                        <option value="empty1">Condition</option>
                        <option value="New">New</option>
                        <option value="Used">Used</option>
                        <option value="Renewed">Renewed</option>
                    </select>
                </div>
                <div class="form-group">
      
                    <input type="text" class="form-control" id="desc" placeholder="Description" style="text-align: center" name="desc" value="<?= $desc?>">
                </div>
                
                
                
        
                

                <div class="form-group">
      
                    <input type="file" name="imgupldr" style="text-align: center" accept="image/jpeg"  />

                </div>
                
                <button type="submit" class="btn btn-lg btn-warning btn-block">Add Now !</button>
                
                
                
                
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
