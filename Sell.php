<?php 

 require_once 'Databasefuncs.php';
session_start();
$err='';
if (!isset($_SESSION["email"]) || !isset($_SESSION["username"]))
{
    header("Location:home.php");
}
//delete item
if(isset($_REQUEST['deleteProd']))
    {
        $prodidD=$_REQUEST['deleteProd'];
        deleteProd($prodidD);
       
        $err='<script>swal({
                title: "Product was successfully deleted",
                 text: "Product has been deleted from your account",
                icon: "success",buttons: false
                });</script>';
       
                    header("refresh:3;sell.php");
    }
    //update prod
    if(isset($_REQUEST['updateProd']))
    {
        $prodidD=$_REQUEST['updateProd'];
        
        header("location:Updateprod.php?update=dsasd$prodidD");
    }
     if(isset($_REQUEST['accept'])||isset($_REQUEST['pid']))
        {
        
        $idaccpt= updateProdSold($_REQUEST['pid']);
        
         date_default_timezone_set('Asia/Tel_Aviv');
         $dateaccept=new DateTime();
         $dateformat= $dateaccept->format("Y-m-d");
        $acceptrequest=acceptRequest( $dateformat,$_REQUEST['accept']);
        if($idaccpt>0 && $acceptrequest>0){$err='<script>swal({
                title: "Product was sold successfully",
                 text: "You can contact the buyer by email",
                icon: "success",buttons: false
                });</script>';
       
                    header("refresh:3;sell.php");}
         
     }
     $rows= getitemsbyuid($_SESSION["uid"]);
     $totalprice=0;
     $requestes=0;
     foreach($rows as $d)
     {
         $totalprice = $d['price'] + $totalprice;
         $r = requestperItem($d['prodid']);
         $re = count($r);
         $requestes = $re + $requestes;
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

        <title>Sales Status</title>
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
         
          <div class="container">     
            
               <div class="card mb-4">
                       <div class="d-sm-flex justify-content-center card-body">
            <h2 class="text-warning bold font-weight-bold text-center">Sales Status</h2>
                       </div>
                   </div>
            <div class="card-deck">
                <div class="mb-3 overflow-hidden card">
                    <div class="position-relative card-body">
                        <h6><span class="rounded-capsule fs--1 badge badge-soft-success"><i class="fas fa-dollar-sign"></i></span>&nbspTotal price</h6>
                        <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif text-countmoney"><?=$totalprice?>$</div>
                    </div>
                </div>
                <div class="mb-3 overflow-hidden card">
                    <div class="position-relative card-body">
                        <h6><span class="rounded-capsule fs--1 badge badge-soft-buy"><i class="fas fa-shopping-cart"></i></span>&nbspSelling products Amount</h6>
                        <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif text-buy"><?=count($rows)?></div>
                    </div>
                </div>
                <div class="mb-3 overflow-hidden card">
                    <div class="position-relative card-body">
                        <h6><span class="rounded-capsule fs--1 badge badge-soft-status"><i class="far fa-handshake"></i></span>&nbspBids Amount</h6>
                        <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif text-info"><?=$requestes?></div>
                    </div>
                </div>
                
                
            </div>
            
            
            
              
          
             <div class="table-responsive">
            <table class="table table-hover mx-auto bg-white text-center">
            
            <thead dir="" class="bg-warning">
        <tr> 
            
            
            
           
            
            
            
            <th>ID</th>
            <th>Product Name</th>
            <th>Picture</th>
            <th>Category</th>
              <th>Price</th>
              <th>Condition</th>
              <th>Description</th>
              <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        
      
      
      foreach($rows as $row)
        {
        
          $requests=requestperItem($row["prodid"]);
              $numr = count($requests); 
              
              if ($numr==0) {
              $norequests="invisible";

              }
              else{$norequests="";}
              
            
              
      ?>       
        <tr>
            
              
                <td><span class="badge badge-pill badge-warning"><?php echo $row['prodid']?></span></td>
                 <td><?php echo $row['prodname']?></td>
                <td><?php if($row['prodpicture']=='jpg'){ echo "<img src=usrpictures/".$row['prodid'].'.'.$row['prodpicture'].">";} else{ echo "<img src='imgs/noimg.png' class='card-img-top' alt=...'>";}?></td>
                 <td><?php echo $row['categoryname'];?></td>
                <td><?php echo $row['price'].'$';?></td>
                <td><?php echo $row['prodcondition'];?></td>
                <td><?php echo $row['description'];?></td>
                <td>
                <a href="?updateProd=<?php echo $row['prodid']?>"onclick="parentNode.submit();" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#x270f;</i></a>
                            <a href="?deleteProd=<?php echo $row['prodid']?>" onclick="return confirm('Are You Sure?')" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE5C9;</i></a>
                            <a href="?showrequest=<?php echo $row['prodid']?>"><span class="badge badge-danger <?= $norequests ?>"><?php if($numr>0){echo $numr;} ?></span> </a>           
            </td>
                
                
        </tr>
        <?php if(isset($_REQUEST['showrequest'])&&$_REQUEST['showrequest']==$row['prodid'])
        {
            
        ?>
            
    <thead dir="ltr" class="thead-dark text-center <?= $norequests ?> ">
        <tr>      
         
                <th colspan="1">Purchase ID</th>
               <th colspan="2">Buyer Name</th>
                <th colspan="1">Price</th>
                 <th colspan="2">Bid Date</th>
                 <th colspan="1">City</th>
                 <th colspan="1">Accept</th>
        </tr>
    </thead>
        
    <tbody class="table table-striped <?= $norequests ?>"> 
        
         <?php 
    
     

    if($numr>0){
    
    foreach($requests as $request)
    
      {   
         ?>
         <tr class="table-warning text-center">
            </td>
                
                <td colspan="1" class="text-center"><?php echo $request['idPurchase']?></td>
                <td colspan="2" class="text-center"><?php echo $request['username']; ?></td>
                 <td class="text-center"><?php echo $request['currentlyprice'].'₪';?></td>
                  <td colspan="2" class="text-center"><?php echo $request['request_date'];?></td>
                  <td colspan="1" class="text-center"><?php echo $request['cityname'];?></td>
                  <td colspan="1" class="text-center"><a href="?accept=<?php echo $request['idPurchase']?>&pid=<?php echo $row['prodid']?>"<span class="fas fa-check"></span></td>

               
        </tr>
        
        
       <?php
       }
    }
      
        
        }
      }  
       ?>
        
 
        
    
          

   
        
    </tbody>       
       
    </tbody>
        </table>
             </div>
    
               </div>
                <button id="print" onclick="window.print()" class="btn btn-lg btn-outline-warning font-weight-bold px-5 mt-4 mb-4">Print  <li class="fas fa-print"></li></button>

       
         
        
        
      
        
        <style>td img {width: 50px !important; height: 50px !important;}
            table{
                width: 80%;
            }
            table.table td a.edit {
            color: orange;
        }
        
        table.table td a.delete {
            color: #F44336;
        }
        .invisible{
            display: none;
        }
        .rounded-capsule{border-radius:3.125rem !important;}
            .badge-soft-warning{color:#c46632 !important;background-color: #fde6d8 !important;}
            .badge-soft-success{color:#00864e !important;background-color: #ccf6e4 !important;}
            .badge-soft-buy{color:#c46632 !important;    background-color: #fde6d8;}
            .badge-soft-status{color:#247086 !important;    background-color: #d7eff6;}
            .text-countmoney{color:#00864e;}
            .fs-4{font-size: 2.4rem !important;}
            .text-buy{color:#c46632;}
            .card:hover{border: 1px solid #ffc107;transition: all 0.1s ease;
   opacity: 1;transform: scale(1.02) ;    box-shadow: 0 1px 1px 0 #ffc107;}
        

        
        </style> 
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?= $err ?>
    </body>
</html>
 