<?php 
session_start();
//check if we have session admin
if ($_SESSION["admin"]==0)
{
    header("Location:Shopping.php");
}
$err='';
require_once 'Databasefuncs.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hvfile=false;
    $ctgID = $_POST['ctgID'];
    $ctg=trim(filter_input(INPUT_POST,"ctg",FILTER_SANITIZE_SPECIAL_CHARS));
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
          if(isset($ctg)&&$ctg!=""){
                 $ctgUpdate= updateCategory($ctg,$pict,$ctgID);
        
                if($ctgUpdate>0)
                  {
                  $rc2 = false;
                if ($hvfile) {
                    $target = getcwd() . "/category/" . $ctgID . ".jpg";
                    $rc2 = move_uploaded_file($tempnm, $target);
                    
                }
                  $err='<script>swal({
                title: "Category successfully updated",
                 text: "You will immediately be taken to the categories manage page",
                icon: "success",buttons: false
                });</script>';
       
                    header("refresh:3;ManageCategory.php");
                
                  }
              
          }
          else{
              $err='<script>swal({
        title: "Error",
             text: "Faild updating category",
             icon: "error",button: "Close"
                });</script>'; 
              
          }
            
}
  else if(isset($_REQUEST['deleteCategory']))
    {
        $categoryname=$_REQUEST['deleteCategory'];
        deleteCategory($categoryname);
         $err='<script>swal({
                title: "Category successfully Deleted",
                 text: "You will immediately be taken to the categories manage page",
                icon: "success",buttons: false
                });</script>';
         header("refresh:2;ManageCategory.php");
    }
    
?>
<style>.swal-button{background-color: #ffc107 !important;
}</style>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <title>Manage Category</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="icon" type="image/ico" href="imgs/buy.png">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
               <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
                  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    </head>
    <body  class="text-center" style="background-color: #f2f2f2">
               <?php require_once 'header.php'; ?>

         <div class="container"> 
             <center>
             <div class="card mb-4 text-center" style="width: 35%">
                       <div class="d-sm-flex justify-content-center card-body">
            <h2 class="text-warning bold font-weight-bold text-center">Manage Category</h2>
                       </div>
                   </div>
           
          
    
        <div class="table-responsive">
        <table class="table table-hover mx-auto bg-white text-center" style="width: 35%">
            
            <thead class="bg-warning">
        <tr>
            <th style="width: 30%">Category</th>
            <th style="width: 30%">Picture</th>
           <th style="width: 10%">Edit</th>
            <th style="width: 10%">Delete</th>
            
            
            
        </tr>
    </thead>
    <tbody>
        <?php 
        $rows= getCategoryAdmin();
        foreach($rows as $row)
        {
            ?>
        <tr>
            <td><?php echo $row['categoryname'];?></td>
            <td><?php if($row['imgicon']=='jpg'){ echo "<img src=category/".$row['categoryid'].'.'.$row['imgicon'].">";} else{echo $row['imgicon'];}?></td>
            <td><a href='?updateCategory=<?php echo $row['categoryname']?>&cc=<?php echo $row['categoryid']?>' class='btn btn-secondary'>Edit</a></td>
            <td><a href='?deleteCategory=<?php echo $row['categoryname']?>' onclick="return confirm('Are You Sure?')" class='btn btn-danger'>Delete</a></td>
            
            
        </tr>
        <?php
        }
        ?>
    </tbody>
        </table>
            </div>
        
          <a href="AddCategory.php" class="btn btn-lg btn-warning mt-4">  Add Category<li class="fas fa-plus"></li> </a>
    </center>
              
         </div>
    <?php
     if(isset($_REQUEST['updateCategory']))
    {
        $categoryname=$_REQUEST['updateCategory'];
        $categoryid=$_REQUEST['cc'];
        ?>
           <div class="container"> 
               <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                   <form class="align-middle" method="post" dir="rtl" enctype="multipart/form-data" action="ManageCategory.php">
                          <div class="form-group">
                              <input type="text" class="form-control" name="ctgID" readonly value='<?php echo $categoryid;?>'>
          </div>
             <div class="form-group">
             <input type="text" class="form-control" name="ctg" value='<?php echo $categoryname;?>'>
          </div>
                <div class="form-group">
      
                    <input type="file" name="pict" style="text-align: center" accept="image/jpeg"  />

                </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9 m-t-15">
                    <input type="submit" name ="subUpdate" class="btn btn-success" value="Update">
                    &nbsp&nbsp&nbsp&nbsp
                    <input type="reset" name="rstUpdate" class="btn btn-danger" value="Cancel">
                </div>
            </div>
        </form>
               </div>
           </div>
        <?php
        }
        
    ?>
        <style>td img {width: 50px; height: 50px;}</style>
         <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?= $err ?>
    </body>
</html>
