<?php
session_start();
//check if we have session admin
if ($_SESSION["admin"]==0)
{
    header("Location:Shopping.php");
}
$err='';
require_once 'Databasefuncs.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    
    $hvfile=false;
    $ctgname=trim(filter_input(INPUT_POST,"ctg",FILTER_SANITIZE_SPECIAL_CHARS));
     if (isset($_FILES['pict'])) //check if we have pic
       {
                $type = $_FILES["pict"]["type"];
                $size = $_FILES["pict"]["size"];
                $tempnm = $_FILES["pict"]["tmp_name"];
                $error = $_FILES["pict"]["error"];
                if (isset($error) && $error > 0) {
                    $err = "<script>alert('Error Upload Pic')</script>";
                } else {
                    if ($type != "image/jpeg" || $size >= 10000000) {
                        $err = "<script>alert('Size too big or type wrong')</script>";
                    } else {
                        $hvfile = true; //pic is ok
                    }
                }
            }
            
            $pict;
           if($hvfile)
           {
              $pict="jpg";
           }
           else{
               $pict = NULL;
           }
            
            if(isset($ctgname)&&$ctgname!="")
            {
                $ctgID = insertCategory($ctgname,$pict);
                if($ctgID>0)
                {
                   $rc2 = false;
                if ($hvfile) {
                    $target = getcwd() . "/category/" . $ctgID . ".jpg";
                    $rc2 = move_uploaded_file($tempnm, $target);
                    
                }
                           $err='<script>swal({
                title: "Category successfully added",
                 text: "You will immediately be taken to the categories manage page",
                icon: "success",buttons: false
                });</script>';
       
                    header("refresh:3;ManageCategory.php");
                    
                }
                
            }
            else{
                $err='<script>swal({
        title: "Error",
             text: "Faild adding category",
             icon: "error",button: "Close"
                });</script>'; 
                
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

        <title>Add Category</title>
  
         <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="icon" type="image/ico" href="imgs/buy.png">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    </head>
    <body dir="rtl" class="text-center" style="background-color: #f2f2f2">
        <?php require_once 'header.php';?>
    <div class="container">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <br><br><br><br><br><br>
             <img class="mb-4" src="https://image.flaticon.com/icons/svg/476/476043.svg" alt="" width="80" height="80">
            <hr class="my-4">
            <h2 class="text-warning bold font-weight-bold">Add Category</h2>
        <form method="post" enctype="multipart/form-data">
             <div class="form-group">
             <input type="text" class="form-control" placeholder="Category Name" name="ctg">
          </div>
                <div class="form-group">
      
                    <input type="file" class="file" name="pict" style="text-align: center" accept="image/jpeg"  />

                </div>
            
            
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9 m-t-15">
                    <input type="submit" name ="subInst" class="btn btn-success" value="Add">
                    &nbsp&nbsp&nbsp&nbsp
                    <input type="reset" name="rstInst" class="btn btn-danger" value="Cancel">
                  
                </div>
            </div>
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
<style>.file{width: 50% !important;}</style>
