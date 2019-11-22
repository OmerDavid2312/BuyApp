<?php
//Connect DB
try
{
    $db=new PDO("mysql:host=localhost;dbname=buyapp","root","");
    $db->exec("set names utf8");
} 
catch (PDOException $ex) 
{
    echo "db Connection problem".$ex->GetMessage();
    exit;
}

//Fucntions Login Register

function credentialOk($uid)
{
    try
    {
        global $db;
        $cmd="select email,username,admin,password from users where email=:email";
        $qry=$db->prepare($cmd);
        $qry->bindValue(':email',$uid);
        
        $qry->execute();
        $result=$qry->fetch();
        return $result;
    }
    catch (PDOException $ex)
    {
        echo "db single user select credentional problem".$ex->GetMessage();
        exit;
    }
}
function userexist($rqstdusrid)
{
     try
    {
        global $db;
        $cmd="select count(*) from users where email=:usrid";
        $qry=$db->prepare($cmd);
        $qry->bindValue(':usrid',$rqstdusrid);
        $qry->execute();
        $result=$qry->fetch();
        return $result[0]!=0;
    }
    catch (PDOException $ex)
    {
        echo "db exist user select problem".$ex->GetMessage();
        exit;
    }
}
function adduser($uid,$pwd,$actlnm,$city)
{
  
    try 
    {
        global $db;
        $cmd="insert into users (email,password,username,citycode) values (:usrid,:rqstdpwd,:actlname,:city)";
        $qry=$db->prepare($cmd);
        $qry->bindValue(':usrid',$uid);
        $qry->bindValue(':rqstdpwd',password_hash($pwd,PASSWORD_DEFAULT));
        $qry->bindValue(':actlname',$actlnm);
        $qry->bindValue(':city',$city);
        $qry->execute();
        $rowcount=$qry->rowCount();
        return ($rowcount==0)?0:$db->lastInsertId();
    } 
    catch (PDOException $ex)
    {
        echo "db add user problem".$ex->GetMessage();
        exit;
    }
}
//get cities
function getCities()
{
    try 
    {
        global $db;
        $cmd="select citycode,cityname from cities";
        $qry=$db->prepare($cmd);
        $qry->execute();
        $result=$qry->fetchAll();
        return $result;
    } 
    catch (PDOException $ex)
    {
        echo "db multi user select problem".$ex->GetMessage();
        exit;
    }
}
//get catagories
function getCatagories()
{
    try 
    {
        global $db;
        $cmd="select categoryid,categoryname from categories";
        $qry=$db->prepare($cmd);
        $qry->execute();
        $result=$qry->fetchAll();
        return $result;
    } 
    catch (PDOException $ex)
    {
        echo "db multi user select problem".$ex->GetMessage();
        exit;
    }
}
//funtions for add prod
function addProducts($prodname,$category,$price,$condition,$desc,$pic,$userid)
{
  
    try 
    {
        global $db;
        $cmd="insert into products (prodname,categoryid,price,prodcondition,description,prodpicture,userid) values (:prodname,:category,:price,:condition,:desc,:pic,:userid)";
        $qry=$db->prepare($cmd);
        $qry->bindValue(':prodname',$prodname);
        $qry->bindValue(':category',$category);
        $qry->bindValue(':price',$price);
        $qry->bindValue(':condition',$condition);
        $qry->bindValue(':desc',$desc);
        $qry->bindValue(':pic',$pic);
        $qry->bindValue(':userid',$userid);
        $qry->execute();
        $rowcount=$qry->rowCount();
        return ($rowcount==0)?0:$db->lastInsertId();
    } 
    catch (PDOException $ex)
    {
        echo "db add user problem".$ex->GetMessage();
        exit;
    }
}
function getUseridByEmail($email)
{
    try 
    {
        global $db;
        $cmd="select userID from users where email=:ml";
        $qry=$db->prepare($cmd);
        $qry->bindValue(':ml',$email);
        $qry->execute();
        $result=$qry->fetch();
        return $result;
    } 
    catch (PDOException $ex)
    {
        echo "db multi user select problem".$ex->GetMessage();
        exit;
    }
}
function getUserDetailByEmail($email)
{
    try 
    {
        global $db;
        $cmd="select email,username,citycode from users where email=:ml";
        $qry=$db->prepare($cmd);
        $qry->bindValue(':ml',$email);
        $qry->execute();
        $result=$qry->fetch();
        return $result;
    } 
    catch (PDOException $ex)
    {
        echo "db multi user select problem".$ex->GetMessage();
        exit;
    }
}
//setting.php update user
function updateUser($email,$password,$username,$city)
{
  
    try 
    {
        global $db;
        $cmd="update users set password=:password,username=:username,citycode=:citycode where email=:email";
        $qry=$db->prepare($cmd);
        $qry->bindValue(':email',$email);
        $qry->bindValue(':password',password_hash($password,PASSWORD_DEFAULT));
        $qry->bindValue(':username',$username);
        $qry->bindValue(':citycode',$city);
        $qry->execute();
        $rowcount=$qry->rowCount();
        return $rowcount;
    } 
    catch (PDOException $ex)
    {
        echo "db upd user problem".$ex->GetMessage();
        exit;
    }
}
//for updates products updateprod.php
function getProdByProdId($prodid)
{
    try 
    {
        global $db;
        $cmd="select prodname,prodpicture,userid,categoryid,price,prodcondition,description from products where prodid=:prodid";
        $qry=$db->prepare($cmd);
        $qry->bindValue(':prodid',$prodid);
        $qry->execute();
        $result=$qry->fetch();
        return $result;
    } 
    catch (PDOException $ex)
    {
        echo "db multi user select problem".$ex->GetMessage();
        exit;
    }
}
//update products
function updateP($name,$category,$price,$condition,$desc,$pic,$userid,$prodid)
{
  
    try 
    {
        global $db;
        $cmd="update products set prodname=:prodname,categoryid=:category,price=:price,prodcondition=:condition,description=:desc,prodpicture=:pic,userid=:userid where prodid=:prodid";
        $qry=$db->prepare($cmd);
        $qry->bindValue(':prodname',$name);
        $qry->bindValue(':category',$category);
        $qry->bindValue(':price',$price);
        $qry->bindValue(':condition',$condition);
        $qry->bindValue(':desc',$desc);
        $qry->bindValue(':pic',$pic);
        $qry->bindValue(':userid',$userid);
         $qry->bindValue(':prodid',$prodid);
        $qry->execute();
        $rowcount=$qry->rowCount();
        return $rowcount;
    } 
    catch (PDOException $ex)
    {
        echo "db add user problem".$ex->GetMessage();
        exit;
    }
}
//Admin catagories Manager
function getCategoryAdmin(){
    global $db;
    try{
    $qry =$db->prepare('SELECT categoryid,imgicon,categoryname FROM categories ORDER BY categoryid ASC');
    $qry->execute();
    $rows=$qry->fetchAll();
    return $rows;
        
    } catch (Exception $ex) {
        echo 'get category problem'.$ex->getMessage();
        

    }
   
}
function deleteCategory($categoryname){
      global $db;
      try{
      $qry=$db->prepare('DELETE FROM categories WHERE categoryname=:categoryname');
      $qry->bindValue(':categoryname',$categoryname);
      $qry->execute();
      $rowcount = $qry->rowCount();
      return $rowcount;
          
      } catch (Exception $ex) {
          echo 'delete category problem'.$ex->getMessage();

      }
      
}
function insertCategory($ctgname,$pict){
      global $db;
      try{
      $qry = $db->prepare('INSERT INTO categories(categoryname,imgicon) VALUES(:ctgname,:pict)');
      $qry->bindValue(':ctgname',$ctgname);
      $qry->bindValue(':pict',$pict);
      $qry->execute();
      $ctgID= $db->lastInsertId();
      return $ctgID;
          
      } catch (Exception $ex) {
          echo 'insert category problem'.$ex->getMessage();

      }
      
}
function updateCategory($ctgname,$pict,$ctg){
      global $db;
      try{
      $qry = $db->prepare('UPDATE categories SET categoryname=:ctgname, imgicon=:pict WHERE categoryid=:ctg');
      $qry->bindValue(':ctgname',$ctgname);
      $qry->bindValue(':pict',$pict);
      $qry->bindValue(':ctg',$ctg);
      $qry->execute();
      $rowcount = $qry->rowCount();
      return $rowcount;
          
      } catch (Exception $ex) {
          echo 'insert category problem'.$ex->getMessage();

      }
      
}



function getsolditemsbyuid($uid)
{
    try 
    {
        global $db;
        $cmd='select pr.prodid, pr.prodname, pr.prodpicture, pr.prodcondition,  pr.description, cat.categoryname, purchases.currentlyprice, purchases.idPurchase FROM products as pr, categories as cat, purchases WHERE cat.categoryid=pr.categoryid and purchases.prodid=pr.prodid and sold="1" AND pr.userid=:uid AND purchases.accept_date IS NOT NULL';
        $qry=$db->prepare($cmd);
        $qry->bindValue(':uid',$uid);
        $qry->execute();
        $result=$qry->fetchAll();
        return $result;
    } 
    catch (PDOException $ex)
    {
        echo "db problem ".$ex->GetMessage();
        exit;
    }
}





function getUsersDetails($id){
    global $db;
    try{
        $qry = $db->prepare('SELECT u.userID,u.username,c.cityname,u.email,u.admin FROM users u, cities c WHERE u.citycode=c.citycode AND userID<>:id ');
        $qry->bindValue(':id',$id);
        $qry->execute();
         $rows=$qry->fetchAll();
          return $rows;
        
    } catch (Exception $ex) {
        echo 'get User Details problem'.$ex->getMessage();
        

    }
        
}
function deleteUser($userid){
      global $db;
      try{
      $qry=$db->prepare('DELETE FROM users WHERE userID=:userid');
      $qry->bindValue(':userid',$userid);
      $qry->execute();
      $rowcount = $qry->rowCount();
      return $rowcount;
          
      } catch (Exception $ex) {
          echo 'delete user problem'.$ex->getMessage();

      }
      
}

//sell omer 26/8 sell.php
function getitemsbyuid($uid)
{
    try 
    {
        global $db;
        $cmd='select pr.prodid, pr.prodname, pr.prodpicture,  pr.price,  pr.prodcondition,  pr.description, cat.categoryname FROM products as pr, categories as cat WHERE cat.categoryid=pr.categoryid and sold="0" AND userid=:uid';
        $qry=$db->prepare($cmd);
        $qry->bindValue(':uid',$uid);
        $qry->execute();
        $result=$qry->fetchAll();
        return $result;
    } 
    catch (PDOException $ex)
    {
        echo "db problem ".$ex->GetMessage();
        exit;
    }
}
function deleteProd($prodid){
      global $db;
      try{
      $qry=$db->prepare('DELETE FROM products WHERE prodid=:prodid');
      $qry->bindValue(':prodid',$prodid);
      $qry->execute();
      $rowcount = $qry->rowCount();
      return $rowcount;
          
      } catch (Exception $ex) {
          echo 'delete user problem'.$ex->getMessage();

      }
}
// 27.8 - sell
function requestperItem($prodid){
      global $db;
      try{
      $qry=$db->prepare('SELECT p.idPurchase,u.username,p.currentlyprice,p.request_date,c.cityname FROM purchases as p,users as u, cities as c  WHERE p.accept_date IS NULL AND p.prodid=:prodid AND p.userbuyerid=u.userID AND c.citycode=u.citycode');
      $qry->bindValue(':prodid',$prodid);
      $qry->execute();
      $result=$qry->fetchAll();
      return $result;
          
      } catch (Exception $ex) {
          echo 'Show request wrong'.$ex->getMessage();

      }
}
function acceptRequest($aDate,$idP)
{
  
    try 
    {
        global $db;
        $cmd="UPDATE purchases set accept_date=:aDate where idPurchase=:idp  ";
        $qry=$db->prepare($cmd);
        $qry->bindValue(':aDate',$aDate);
        $qry->bindValue(':idp',$idP);
        
        $qry->execute();
        $rowcount=$qry->rowCount();
        return $rowcount;
    } 
    catch (PDOException $ex)
    {
        echo "WRONG".$ex->GetMessage();
        exit;
    }
}
function updateProdSold($prodid)
{
  
    try 
    {
        global $db;
        $cmd="UPDATE products set sold=1 where prodid=:prodid";
        $qry=$db->prepare($cmd);
        $qry->bindValue(':prodid',$prodid);
        $qry->execute();
        $rowcount=$qry->rowCount();
        return $rowcount;
    } 
    catch (PDOException $ex)
    {
        echo "WRONG".$ex->GetMessage();
        exit;
    }
}
/*

function countrequests($prodid){
      global $db;
      try{
      $qry=$db->prepare('SELECT count(p.idPurchase) FROM purchases p  WHERE p.prodid=:prodid');
      $qry->bindValue(':prodid',$prodid);
      $qry->execute();
      $result=$qry->fetch();
      return $result;
          
      } catch (Exception $ex) {
          echo 'Show request wrong'.$ex->getMessage();

      }
}
 * 
 */
//buy.php 29.8
function getBuyerProd($buyerid){
      global $db;
      try{
      $qry=$db->prepare('SELECT purchases.idPurchase,purchases.userbuyerid,products.prodname,purchases.prodid,products.prodpicture,categories.categoryname,products.prodcondition,purchases.currentlyprice,request_date,products.prodid FROM products,purchases,categories WHERE products.prodid=purchases.prodid AND products.categoryid=categories.categoryid AND purchases.userbuyerid=:buyerid ORDER BY purchases.idPurchase DESC');
      $qry->bindValue(':buyerid',$buyerid);
      $qry->execute();
      $result=$qry->fetchAll();
      return $result;
          
      } catch (Exception $ex) {
          echo 'Show request wrong'.$ex->getMessage();

      }
}
function checkStatusorder($idPurchases)
{
  
    try 
    {
        global $db;
        $cmd="SELECT accept_date FROM purchases WHERE idPurchase=:id";
        $qry=$db->prepare($cmd);
        $qry->bindValue(':id',$idPurchases);
        $qry->execute();
        $result=$qry->fetch();
        return $result;
    } 
    catch (PDOException $ex)
    {
        echo "WRONG".$ex->GetMessage();
        exit;
    }
}

function manageUser($userid,$citycode,$password){
      global $db;
      try{
      $qry=$db->prepare('UPDATE users set citycode=:citycode,password=:pwd  WHERE userID=:userid');
      $qry->bindValue(':userid',$userid);
      $qry->bindValue(':citycode',$citycode);
      $qry->bindValue(':pwd',password_hash($password,PASSWORD_DEFAULT));
      $qry->execute();
      $rowcount = $qry->rowCount();
      return $rowcount;
          
      } catch (Exception $ex) {
          echo 'delete user problem'.$ex->getMessage();

      }
    
}
//shopping
function getitemsforshopping($categories,$userid)
{
    
       
    try 
    {
        global $db;
        $cmd="select pr.prodid, pr.prodname, pr.prodpicture,  pr.price,  pr.prodcondition,  pr.description, cat.categoryname, cat.imgicon, cities.cityname FROM products as pr, categories as cat, users as usr ,cities WHERE cat.categoryid=pr.categoryid AND pr.userid=usr.userID AND usr.citycode=cities.citycode AND sold='0' AND cat.categoryid IN($categories) AND pr.userid<>:userid";
        
        $qry=$db->prepare($cmd);

        $qry->bindValue(':userid',$userid);
        $qry->execute();
      
        
        $result=$qry->fetchAll();
       
        
        return $result;
    } 
    catch (PDOException $ex)
    {
        echo "db problem ".$ex->GetMessage();
        exit;
    }
}
function addBidProd($userbuyerid,$prodid,$price,$requestdate){
      global $db;
      try{
      $qry = $db->prepare('INSERT INTO purchases(userbuyerid,prodid,currentlyprice,request_date) VALUES(:userid,:prodid,:price,:date)');
      $qry->bindValue(':userid',$userbuyerid);
      $qry->bindValue(':prodid',$prodid);
      $qry->bindValue(':price',$price);
      $qry->bindValue(':date',$requestdate);
      $qry->execute();
      $ctgID= $db->lastInsertId();
      return $ctgID;
          
      } catch (Exception $ex) {
          echo 'insert category problem'.$ex->getMessage();

      }
      
}
//serach prod
function searchprod($categories,$userid,$type)
{
    
        
    try 
    {
        global $db;
        $cmd="select pr.prodid, pr.prodname, pr.prodpicture,  pr.price,  pr.prodcondition,  pr.description, cat.categoryname, cat.imgicon, cities.cityname FROM products as pr, categories as cat, users as usr ,cities WHERE cat.categoryid=pr.categoryid AND pr.userid=usr.userID AND usr.citycode=cities.citycode AND sold='0' AND cat.categoryid IN($categories) AND pr.userid<>:userid and pr.prodname LIKE :prodname";
        $qry=$db->prepare($cmd);
        $qry->bindValue(':userid',$userid);
        $qry->bindValue(':prodname','%'.$type.'%');
        $qry->execute();
        $result=$qry->fetchAll();
        return $result;
    } 
    catch (PDOException $ex)
    {
        echo "db problem ".$ex->GetMessage();
        exit;
    }
}
//get my city
function getmycity($userid)
{
    try 
    {
        global $db;
        $cmd="select cityname from cities,users where users.citycode=cities.citycode and userID=:userid ";
        $qry=$db->prepare($cmd);
        $qry->bindValue(':userid',$userid);
        $qry->execute();
        $result=$qry->fetch();
        return $result;
    } 
    catch (PDOException $ex)
    {
        echo "db multi user select problem".$ex->GetMessage();
        exit;
    }
}
function checkdenied($userbuyerid,$prodid)
{
  
    try 
    {
        global $db;
        $cmd="SELECT accept_date from purchases where userbuyerid<>:user AND prodid=:prodid ORDER BY accept_date DESC limit 1";
        $qry=$db->prepare($cmd);
        $qry->bindValue(':prodid',$prodid);
        $qry->bindValue(':user',$userbuyerid);
        $qry->execute();
        $result=$qry->fetch();
        return $result;
    } 
    catch (PDOException $ex)
    {
        echo "WRONG".$ex->GetMessage();
        exit;
    }
}
//for the popup buy.php 13/10
function getsellerdetails($prodid)
{
  
    try 
    {
        global $db;
        $cmd="SELECT users.username,users.email FROM users,products WHERE users.userID=products.userid and products.prodid=:id";
        $qry=$db->prepare($cmd);
        $qry->bindValue(':id',$prodid);
        $qry->execute();
        $result=$qry->fetch();
        return $result;
    } 
    catch (PDOException $ex)
    {
        echo "WRONG".$ex->GetMessage();
        exit;
    }
}
function getbuyerdetails($purid)
{
  
    try 
    {
        global $db;
        $cmd="SELECT users.email FROM users,purchases WHERE users.userID=purchases.userbuyerid AND purchases.idPurchase=:id";
        $qry=$db->prepare($cmd);
        $qry->bindValue(':id',$purid);
        $qry->execute();
        $result=$qry->fetch();
        return $result;
    } 
    catch (PDOException $ex)
    {
        echo "WRONG".$ex->GetMessage();
        exit;
    }
}
//admin panel 15/10
function countusers()
{
  
    try 
    {
        global $db;
        $cmd="SELECT count(userID) FROM users";
        $qry=$db->prepare($cmd);
        
        $qry->execute();
        $result=$qry->fetch();
        return $result;
    } 
    catch (PDOException $ex)
    {
        echo "WRONG".$ex->GetMessage();
        exit;
    }
}
function countcategory()
{
  
    try 
    {
        global $db;
        $cmd="SELECT count(categoryid) FROM categories";
        $qry=$db->prepare($cmd);
        
        $qry->execute();
        $result=$qry->fetch();
        return $result;
    } 
    catch (PDOException $ex)
    {
        echo "WRONG".$ex->GetMessage();
        exit;
    }
}
function countactiveprods()
{
  
    try 
    {
        global $db;
        $cmd="select count(prodid) FROM products where sold=0";
        $qry=$db->prepare($cmd);
        
        $qry->execute();
        $result=$qry->fetch();
        return $result;
    } 
    catch (PDOException $ex)
    {
        echo "WRONG".$ex->GetMessage();
        exit;
    }
}
function allactiveprods()
{
  
    try 
    {
        global $db;
       $cmd='select pr.prodid, pr.prodname, pr.prodpicture,  pr.price,  pr.prodcondition,  pr.description, cat.categoryname FROM products as pr, categories as cat WHERE cat.categoryid=pr.categoryid and sold="0"';

        $qry=$db->prepare($cmd);
        
        $qry->execute();
        $result=$qry->fetchAll();
        return $result;
    } 
    catch (PDOException $ex)
    {
        echo "WRONG".$ex->GetMessage();
        exit;
    }
}
function countsolds()
{
  
    try 
    {
        global $db;
        $cmd="select count(prodid) FROM products where sold=1";
        $qry=$db->prepare($cmd);
        
        $qry->execute();
        $result=$qry->fetch();
        return $result;
    } 
    catch (PDOException $ex)
    {
        echo "WRONG".$ex->GetMessage();
        exit;
    }
}
function bestbidder()
{
  
    try 
    {
        global $db;
        $cmd="select count(userbuyerid),users.username from purchases,users where purchases.userbuyerid=users.userID GROUP by userbuyerid limit 1";
        $qry=$db->prepare($cmd);
        
        $qry->execute();
        $result=$qry->fetch();
        return $result;
    } 
    catch (PDOException $ex)
    {
        echo "WRONG".$ex->GetMessage();
        exit;
    }
}
function bestaddprods()
{
  
    try 
    {
        global $db;
        $cmd="select count(products.userid) as c,users.username from products,users where products.userid=users.userID GROUP by products.userid ORDER BY c DESC limit 1";
        $qry=$db->prepare($cmd);
        
        $qry->execute();
        $result=$qry->fetch();
        return $result;
    } 
    catch (PDOException $ex)
    {
        echo "WRONG".$ex->GetMessage();
        exit;
    }
}
function allsoldsitems()
{
  
    try 
    {
        global $db;
        $cmd='select purchases.currentlyprice FROM purchases WHERE purchases.accept_date IS NOT NULL';
        $qry=$db->prepare($cmd);
        
        $qry->execute();
        $result=$qry->fetchAll();
        return $result;
    } 
    catch (PDOException $ex)
    {
        echo "WRONG".$ex->GetMessage();
        exit;
    }
}








        
        
  
  