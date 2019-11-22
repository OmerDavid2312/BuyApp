<?php
session_start();
//check if we have session admin
if ($_SESSION["admin"]==0 || !isset($_SESSION['admin']))
{
    header("Location:Shopping.php");
}
$err='';

require_once 'Databasefuncs.php';
$cities = getCities();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $citycode=$_POST['city'];
    $userid=$_POST['userid'];
    $password=$_POST['pwd'];
    $manage = manageUser($userid, $citycode,$password);
    if($manage>0)
    {
         $err='<script>swal({
                title: "User successfully updated",
                 text: "You will immediately be taken to the user management page",
                icon: "success",buttons: false
                });</script>';
       
                    header("refresh:3;ManageUsers.php");
    }
}
else if(isset($_REQUEST['deleteUser']))
    {
        $userid=$_REQUEST['deleteUser'];
        deleteUser($userid);
        $err='<script>swal({
                title: "User successfully deleted",
                 text: "You will immediately be taken to the user management page",
                icon: "success",buttons: false
                });</script>';
       
                    header("refresh:3;ManageUsers.php");
    }
?>
<style>.swal-button{background-color: #ffc107 !important;
}</style>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <title>Manage Users</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="icon" type="image/ico" href="imgs/buy.png">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
               <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
                  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
                 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

          <style type="text/css">
        body {
            
            font-size: 16px;
        }
        
        .table-wrapper {
            background: rgba(255, 255, 255, 0.507);
            padding: 20px 25px;
            margin: 100px;
            border-radius: 10px;
            box-shadow: 0 3px 3px rgba(0, 0, 0, .05);
        }
        
        .table-title {
            padding-bottom: 15px;
            background: #ffbb33;
            color: #fff;
            padding: 16px 30px;
            margin: -20px -25px 10px;
            border-radius: 3px 3px 0 0;
        }
        
        .table-title h2 {
            margin: 3px 0 0;
            float: right;
            font-size: 24px;
        }
        
        .table-title .btn {
            color: #566787;
            float: left;
            font-size: 13px;
            background: #fff;
            border: none;
            min-width: 50px;
            border-radius: 2px;
            border: none;
            outline: none !important;
            margin-left:  -200px;
        }
        
        .table-title .btn:hover,
        .table-title .btn:focus {
            color: #566787;
            background: #f2f2f2;
        }
        
        table.table tr th,
        table.table tr td {
            border-color: #e9e9e9;
            padding: 12px 35px;
            vertical-align: middle;
        }
        
        table.table tr th:first-child {
            width: 15px;
        }
        
        table.table tr th:first-child+th {
            width: 25px;
        }
        
        table.table tr th:first-child+th+th {
            width: 15px;
            padding-left: 70px;
        }
        
        table.table tr th:first-child+th+th+th {
            width: 10px;
            padding-left: 100px;
        }
        
        table.table tr th:first-child+th+th+th+th {
            width: 10px;
            padding-left: 70px;
        }
        
        table.table tr th:last-child {
            width: 10px;
        }
        
        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }
        
        table.table-striped.table-hover tbody tr:hover {
            background: #f5f5f5;
        }
        
        table.table td:last-child i {
            opacity: 0.9;
            font-size: 30px;
            margin: 0 5px;
        }
        
        table.table td a {
            font-weight: bold;
            color: #566787;
            display: inline-block;
            text-decoration: none;
        }
        
        table.table td a.edit {
            color: orange;
        }
        
        table.table td a.delete {
            color: #F44336;
        }
        
    </style>
    <script type="text/javascript">
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
        function hidePrint(){
            $('#print').hide();
        }
    </script>
    </head>
    <body dir="rtl" class="text-center" style="background-color: #f2f2f2">
       <?php  require_once 'header.php';?>
         <div class="container"> 
         
             <div class="card mb-4 text-center">
                       <div class="d-sm-flex justify-content-center card-body">
            <h2 class="text-warning bold font-weight-bold text-center">Manage Users</h2>
                       </div>
                   </div>
        
    
          
                     
                 
             <div class="table-responsive">        
            <table class="table table-hover mx-auto bg-white text-center">
                <thead class="table-title bg-warning">
                    <tr>
                        <th>Actions</th>
                        <th>Type</th>
                        <th>Email</th>
                        <th>City</th>
                        <th>Username</th>
                        <th>#</th>
                        
                    </tr>
                </thead>
                <tbody>
                      <?php 
        $rows= getUsersDetails($_SESSION['uid']);
        foreach($rows as $row)
        {
            ?>
                    <tr>
                        
                        
                        
                        
                        
                        <td>
                            <a href="?updateUser=<?php echo $row['email']?>&city=<?php echo $row['cityname']?>&id=<?php echo $row['userID']?>" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#x270f;</i></a>
                            <a href="?deleteUser=<?php echo $row['userID']?>" onclick="return confirm('Are You Sure?')" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE5C9;</i></a>
                        </td>
                        <td><?php if($row['admin']==0){echo 'User';}else{ echo '<span class="fas fa-user">Admin</span>';}?></td>
                        <td><?= $row['email']?></td>
                        <td> <?= $row['cityname']?></td>
                        <td>
                            <?= $row['username']?>
                        </td>
                        <td><?= $row['userID']?></td>
                    </tr>
                    <?php 
        }
        ?>
                </tbody>
            </table>
                 </div>
        </div>
       
          
        <button id="print" onclick="window.print()" class="btn btn-lg btn-outline-warning font-weight-bold px-5 mt-4 mb-4">Print  <li class="fas fa-print"></li></button>
       
               <?php
               
     if(isset($_REQUEST['updateUser']))
    {
         echo '<script>hidePrint();</script>';
        $email=$_REQUEST['updateUser'];
        $city=$_REQUEST['city'];
        $uid=$_REQUEST['id'];
        ?>
           <div class="container"> 
               <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                   <form method="post" action="ManageUsers.php">
                                         <div class="form-group">
                                             <input type="hidden" class="form-control" name="userid" value='<?php echo $uid;?>'>
          </div>
                          <div class="form-group">
                              <input type="email" class="form-control" name="mail" readonly value='<?php echo $email;?>'>
          </div>
                       <div class="form-group">
      
           <input type="password" class="form-control" id="pwd" style="text-align: center" placeholder="Password" name="pwd">
         </div>
             <div class="form-group">
                 <select class='btn btn-outline-secondary btn-md btn-block' name='city'>
                     <?php foreach($cities as $c)
                     {
                         ?>
                     <option value="<?php echo $c['citycode']?>"<?php if($city==$c['cityname']) {echo 'selected';}?>><?php echo $c['cityname']?></option>
                     
                     <?php
                     }
                     ?>
                 </select>
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
                
         
         <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?= $err ?>
    </body>
</html>
