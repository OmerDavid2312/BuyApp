<?php 

 require_once 'Databasefuncs.php';
session_start();

if (!isset($_SESSION["email"]) || !isset($_SESSION["username"]))
{
    header("Location:home.php");
}
$totalprice=0;
$accept=0;
$notaccept=0;
$rows=getBuyerProd($_SESSION["uid"]);
foreach($rows as $d)
{
    
    $check=checkStatusorder($d['idPurchase']);$finalcheck=$check['accept_date']; if ($finalcheck==NULL){$notaccept++;}else{$accept++;$totalprice= $d['currentlyprice']+$totalprice;}
    
    
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

        <title>My Shopping</title>
           <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="icon" type="image/ico" href="imgs/buy.png">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
               <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
                  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
                 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    </head>
    <body class="text-center" style="background-color: #f2f2f2" dir="ltr">
       <?php require_once 'header.php'; ?>
        
               <div class="container">
            
                   <div class="card mb-4">
                       <div class="d-sm-flex justify-content-center card-body">
            <h2 class="text-warning bold font-weight-bold text-center">My Shopping</h2>
                       </div>
                   </div>
            
            <div class="card-deck">
                <div class="mb-3 overflow-hidden card">
                    <div class="position-relative card-body">
                        <h6><span class="rounded-capsule fs--1 badge badge-soft-success"><i class="fas fa-dollar-sign"></i></span>&nbspTotal Expenditure</h6>
                        <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif text-countmoney"><?=$totalprice?>$</div>
                    </div>
                </div>
                <div class="mb-3 overflow-hidden card">
                    <div class="position-relative card-body">
                        <h6><span class="rounded-capsule fs--1 badge badge-soft-buy"><i class="fas fa-shopping-cart"></i></span>&nbspTotal Bids</h6>
                        <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif text-buy"><?=count($rows)?></div>
                    </div>
                </div>
                <div class="mb-3 overflow-hidden card">
                    <div class="position-relative card-body">
                        <h6><span class="rounded-capsule fs--1 badge badge-soft-status"><i class="far fa-handshake"></i></span>&nbspApproved Bids</h6>
                        <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif text-info"><?=$accept?></div>
                    </div>
                </div>
                
                
            </div>
          
    <center>
        <div class="table-responsive">
            <table class="table table-hover mx-auto text-center bg-white" dir="ltr">
            
            <thead dir="ltr" class="font-weight-bold bg-warning">
        <tr>
           
           
            <th>Purchase ID</th>
             <th>Product Name</th>
             <th>Picture</th>
             <th>Category</th>
             <th>Price</th>
             <th>Condition</th>
             <th>Offer Date</th>
              <th>Status</th>
             
        </tr>
    </thead>
    <tbody>
        <?php 
        
      
      
      foreach($rows as $row)
        {
            $check1= checkdenied($row['userbuyerid'], $row['prodid']);$finalcheck1=$check1['accept_date'];//for the check
            $getsellers = getsellerdetails($row['prodid']); $mailseller=$getsellers['email'];$nameseller=$getsellers['username'];//seller info for send mail
            ?>
        <tr>
          
                <td><span class="badge badge-pill badge-warning"><?php echo $row['idPurchase']?></span></td>
                <td><?php echo $row['prodname']?></td>
               <td><?php if($row['prodpicture']=='jpg'){ echo "<img src=usrpictures/".$row['prodid'].'.'.$row['prodpicture'].">";} else{echo "<img src='imgs/noimg.png' class='card-img-top' alt=...'>";}?></td>
               <td class="text-center"><?php echo $row['categoryname'];?></td>
               <td><?php echo $row['currentlyprice'].'$';?></td>
               <td><?php echo $row['prodcondition'];?></td>
               <td class="text-center"><?php echo $row['request_date'];?>&nbsp<span class="far fa-calendar-alt"></span></td>
               <td><?php $check=checkStatusorder($row['idPurchase']);$finalcheck=$check['accept_date']; if ($finalcheck!=NULL){echo"<a href='mailto:{$getsellers['email']}?Subject={$row['prodname']}&amp;body=Dear {$getsellers['username']},%20Purchase%20Detail:%0D%0APurchaseID:%20{$row['idPurchase']}%0D%0APrice:{$row['currentlyprice']}%20$%0D%0AApproved%20Date:{$finalcheck}%0D%0A%0D%0AThanks,{$_SESSION['username']}%0D%0ABuyApp' target='_blank'><span class='rounded-capsule fs--1 badge badge-soft-success' title='Contact Seller'><i class='fas fa-envelope'></i>&nbspApproved</span></a>";
}else if($finalcheck==NULL && $finalcheck1 != NULL ){echo'<span class="rounded-capsule fs--1 badge badge-soft-red">Rejected</span>';}else{echo'<span class="rounded-capsule fs--1 badge badge-soft-warning">Pending</span>';} ?></td>
               
                
        </tr>
        <?php
        }
        ?>
    </tbody>
        </table>
            </div>
    </center>
            
         
               </div>
                <button id="print" onclick="window.print()" class="btn btn-lg btn-outline-warning font-weight-bold px-5 mt-4 mb-4">Print  <li class="fas fa-print"></li></button>

      
        


      
        
        <style>td img {width: 50px !important; height: 50px !important;}
            table{
                width: 80%;
            }
            .rounded-capsule{border-radius:3.125rem !important;}
            .badge-soft-warning{color:#c46632 !important;background-color: #fde6d8 !important;}
            .badge-soft-success{color:#00864e !important;background-color: #ccf6e4 !important;}
            .badge-soft-buy{color:#c46632 !important;    background-color: #fde6d8;}
            .badge-soft-status{color:#247086 !important;    background-color: #d7eff6;}
            .badge-soft-red{color: #dc2929 !important;    background-color: #ffdede;}
            .text-countmoney{color:#00864e;}
            .fs-4{font-size: 2.4rem !important;}
            .text-buy{color:#c46632;}
            .card:hover{border: 1px solid #ffc107;transition: all 0.1s ease;
   opacity: 1;transform: scale(1.02) ;    box-shadow: 0 1px 1px 0 #ffc107;}
            
            
           
        
        </style> 
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
