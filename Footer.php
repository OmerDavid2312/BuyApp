
<style>
       #sticky-footer {
  flex-shrink: none;
}
.searchbar{
    background-color: #f0ad4e
;
}
.fixed-bottom{
    margin-top: 3rem!important;
   
    
}
.hover :hover{color: #343a40!important;}
.pb-4, .py-4 {
    padding-bottom: 0!important;
}
.pt-4, .py-4 {
    padding-top: 0.2rem!important;
}
form{margin-bottom: 0 !important;}





   </style>
   <footer id="sticky-footer" class="py-4 bg-secondary text-white-50 fixed-bottom" dir="ltr">
    <div class="container text-center">
        <div class="">
            <form method="POST" dir="ltr"><input type="text" name="search" id='search' class="bg-dark text-warning" placeholder=" Search Product.." style="height:35px"><button class="btn btn-warning" style="height:35px"><i class="fas fa-search"></i></button></form>
        </div>
        <?php $city = getmycity($_SESSION['uid']); $finalmycity = $city['cityname']; echo "<div class='text-warning bold hover '> <span class='fas fa-home'></span> $finalmycity</div>";?>
    </div>
  </footer>



