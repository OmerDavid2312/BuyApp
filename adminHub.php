<?php
session_start();
//check if we have session admin
if ($_SESSION["admin"]==0 || !isset($_SESSION['admin']))
{
    header("Location:Shopping.php");
}
$err='';

require_once 'Databasefuncs.php';
//count users
$counterusers= countusers();
//count category
$countercategories= countcategory();
//count activeprods
$countprods = countactiveprods();
//get activeproducts details
$rows = allactiveprods();
//delete item
if(isset($_REQUEST['deleteProd']))
    {
        $prodidD=$_REQUEST['deleteProd'];
        deleteProd($prodidD);
       
        header('location:sell.php');
    }
    //update prod
    if(isset($_REQUEST['updateProd']))
    {
        $prodidD=$_REQUEST['updateProd'];
        
        header("location:Updateprod.php?update=dsasd$prodidD");
    }
//count solds
$countsolds = countsolds();  
//best bidder
$bestbidder= bestbidder();
//best add prods
$bestaddprods = bestaddprods();
//get total money solds items in site
$soldsitems= allsoldsitems();
$totalpricesolds=0;
foreach($soldsitems as $se)
{
    $totalpricesolds = $totalpricesolds + $se['currentlyprice'];
    
}
//ratio solds-notsolds
$soldsc=$countsolds['count(prodid)'];
$totalitemsinsite=$countprods['count(prodid)']+$countsolds['count(prodid)'];
$ratiosolds=round(($soldsc/$totalitemsinsite)*100);




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

        <title>Manage <?=$_SESSION['username']?></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="icon" type="image/ico" href="imgs/buy.png">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
               <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
                  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
                 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    </head>
    <body class="text-center" style="background-color: #f2f2f2">
       <?php require_once 'header.php'; ?>
        <div class="jumbotron jumbotron-fluid bg-white">
  <div class="container">
    <h1 class="display-4 text-warning">Hello, <?=$_SESSION['username']?></h1>
    <p class="lead font-weight-bold mt-3">In this page you can see data and manage the app</p>
  </div>
</div>
        <div class="container">
        <h3 class="bold font-weight-bold text-center text-warning">Shortcuts</h3>
        <hr class="new5"width="8%">
          <div class="card-deck">
                <div class="mb-3 overflow-hidden card">
                    <div class="position-relative card-body">
                        <h6><span class="rounded-capsule fs--1 badge badge-pill badge-warning"><i class="fas fa-edit"></i></span>&nbspManage Categories</h6>
                        <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif text-warning"><?= $countercategories['count(categoryid)']?></div>
                        <a href="ManageCategory.php" class="text-warning"> <i class="fas fa-angle-left text-warning"></i>&nbspMove Now</a>
                    </div>
                </div>
                <div class="mb-3 overflow-hidden card">
                    <div class="position-relative card-body">
                        <h6><span class="rounded-capsule fs--1 badge badge-pill badge-warning"><i class="fas fa-plus"></i></span>&nbspAdd Categories</h6>
                        <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif text-warning"><?= $countercategories['count(categoryid)']?></div>
                        <a href="AddCategory.php" class="text-warning"> <i class="fas fa-angle-left text-warning"></i>&nbspMove Now</a>
                    </div>
                </div>
                <div class="mb-3 overflow-hidden card">
                    <div class="position-relative card-body">
                        <h6><span class="rounded-capsule fs--1 badge badge-pill badge-warning"><i class="fas fa-users"></i></span>&nbspManage Users</h6>
                        <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif text-warning"><?=$counterusers['count(userID)']?></div>
                        <a href="ManageUsers.php" class="text-warning"> <i class="fas fa-angle-left text-warning"></i>&nbspMove Now</a>
                    </div>
                </div>
                
                
            </div>
        
        <h3 class="bold font-weight-bold text-center text-warning mt-2">Selling Products</h3>
        <hr class="new5"width="8%">
        
        <div class="table-responsive">
            <table class="table table-hover mx-auto bg-white">
            
            <thead dir="rtl" class="bg-warning">
        <tr> 
            <th>ID</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Picture</th>
            <th>Price</th>
            <th>Condition</th>
            <th>Desciption</th>
            <th>Actions</th>
            
            
            
            
            
            
            
             
        </tr>
            </thead>
         <tbody>
             <?php 
        
      
      
      foreach($rows as $row)
        {?>
             <tr>
                 <td><span class="badge badge-pill badge-warning"><?php echo $row['prodid']?></span></td>
                 <td><?php echo $row['prodname']?></td>
                <td><?php if($row['prodpicture']=='jpg'){ echo "<img src=usrpictures/".$row['prodid'].'.'.$row['prodpicture']." height='50px' width='50px'>";} else{ echo "<img src='imgs/noimg.png' height='50px' width='50px' class='card-img-top' alt=...'>";}?></td>

                 <td><?php echo $row['categoryname'];?></td>
                 <td><?php echo $row['price'].'₪';?></td>
                 <td><?php echo $row['prodcondition'];?></td>
                 <td><?php echo $row['description'];?></td>
            <td>
                <a href="?updateProd=<?php echo $row['prodid']?>"onclick="parentNode.submit();" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#x270f;</i></a>
                            <a href="?deleteProd=<?php echo $row['prodid']?>" onclick="return confirm('Are You Sure?')" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE5C9;</i></a>
                                     
            </td>
               
        </tr>
             
             
             
        <?php }?>
        
        </tbody>
            </table>
        </div>
        
         <h3 class="bold font-weight-bold text-center text-warning mt-4">More Data</h3>
        <hr class="new5"width="8%">
        <p class="lead font-weight-bold mt-3" dir='ltr'>We Love Data ! </p>
         <div class="card-deck">
                <div class="mb-3 overflow-hidden card">
                    <div class="position-relative card-body">
                        <h6><span class="rounded-capsule fs--1 badge badge-pill badge-warning"><i class="far fa-handshake"></i></span>&nbspSold Products Amount</h6>
                        <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif text-warning"><?= $countsolds['count(prodid)']?></div>
                       
                    </div>
                </div>
                <div class="mb-3 overflow-hidden card">
                    <div class="position-relative card-body">
                        <h6><span class="rounded-capsule fs--1 badge badge-pill badge-warning"><i class="fas fa-tags"></i></span>&nbspSelling Products Amount</h6>
                        <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif text-warning"><?=$countprods['count(prodid)']?></div>
                        
                    </div>
                </div>
             
                
                
                
            </div>
         <div class="card-deck">
                <div class="mb-3 overflow-hidden card">
                    <div class="position-relative card-body">
                        <h6><span class="rounded-capsule fs--1 badge badge-pill badge-warning"><i class="fas fa-shekel-sign"></i></span>&nbspSold Expenditure</h6>
                        <div class="sizeration fs-4 mb-2 font-weight-normal text-sans-serif text-warning"><?= $totalpricesolds?>₪</div>
                       
                    </div>
                </div>
                <div class="mb-3 overflow-hidden card">
                    <div class="position-relative card-body">
                        <h6><span class="rounded-capsule fs--1 badge badge-pill badge-warning"><i class="fas fa-tags"></i></span>&nbspRation Sold/Selling</h6>
                        <div class="fs-4 mb-2 font-weight-normal text-sans-serif text-warning sizeration"><?=$ratiosolds?>%</div>
                        
                    </div>
                </div>
              <div class="mb-3 overflow-hidden card">
                    <div class="position-relative card-body">
                        <h6><span class="rounded-capsule fs--1 badge badge-pill badge-warning"><i class="fas fa-money-check-alt"></i></span>&nbspBid King</h6>
                        <div class="fs-4 mb-2 font-weight-normal text-sans-serif text-warning bestbidder"><?=$bestbidder['username']?></div>
                        
                    </div>
                </div>
              <div class="mb-3 overflow-hidden card">
                    <div class="position-relative card-body">
                        <h6><span class="rounded-capsule fs--1 badge badge-pill badge-warning"><i class="fab fa-product-hunt"></i></span>&nbspPosting King</h6>
                        <div class=" fs-4 mb-2 font-weight-normal text-sans-serif text-warning bestbidder"><?=$bestaddprods['username']?></div>
                        
                    </div>
                </div>
             
                
                
                
            </div>
        
        
        </div>
        
        
        
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <style>
        hr.new5 {
  border: 2px solid #ffc107!important;
  
}
.rounded-capsule{border-radius:3.125rem !important;}
td img {width: 50px !important; height: 50px !important;}
table.table td a.edit {
            color: orange;
        }
        
        table.table td a.delete {
            color: #F44336;
        }
        .bestbidder{font-size: 2.5rem;}
        .sizeration{font-size: 3rem;}
        @media (min-width: 768px) and (max-width: 1024px) {
       .sizeration{font-size: 2rem;}.bestbidder{font-size: 2rem;}
    }
        
        
    </style>
    </body>
</html>
