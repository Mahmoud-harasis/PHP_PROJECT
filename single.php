<?php require('./AdminLTE_master/config/connect.php');

session_start ();

$user_id= $_SESSION['user_id'];


$id = $_GET['id'];



$query='SELECT * FROM products WHERE id= :id';
$stmt= $db->prepare($query) ;
$stmt->bindValue(':id', $id);
$stmt->execute();
$products=$stmt->fetchAll(PDO::FETCH_ASSOC);


// $query='SELECT * FROM categories WHERE id= :id';
// $stmt= $db->prepare($query) ;
// $stmt->bindValue(':id', $id);
// $stmt->execute();
// $categories=$stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<!--
    - favicon
  -->
  <link rel="shortcut icon" href="./assets/images/logo/logo.png" type="image/x-icon">

  <!--
    - custom css link
  -->
  <link rel="stylesheet" href="./assets/css/style-prefix.css">

  <!--
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

<style>
   .card{border:none}.product{background-color: #eee}.brand{font-size: 13px}.act-price{color:red;font-weight: 700}.dis-price{text-decoration: line-through}.about{font-size: 14px}.color{margin-bottom:10px}label.radio{cursor: pointer}label.radio input{position: absolute;top: 0;left: 0;visibility: hidden;pointer-events: none}label.radio span{padding: 2px 9px;border: 2px solid #ff0000;display: inline-block;color: #ff0000;border-radius: 3px;text-transform: uppercase}label.radio input:checked+span{border-color: #ff0000;background-color: #ff0000;color: #fff}.btn-danger{background-color: #ff0000 !important;border-color: #ff0000 !important}.btn-danger:hover{background-color: #da0606 !important;border-color: #da0606 !important}.btn-danger:focus{box-shadow: none}.cart i{margin-right: 10px}
   
</style>
<body>
<header>



<div class="header-main">


  <div class="container">

    <a href="#" class="header-logo">
      <img src="./assets/images/logo/logo.png" alt="power home logo" width="55" height="55">
    </a>





    <div>

      <nav class="desktop-navigation-menu">



  
        <div class="container">
  
          <ul class="desktop-menu-category-list">
  
            <li class="menu-category">
              <a href="http://localhost/PHP_PROJECT/index.php" class="menu-title">Home</a>
            </li>
  
            
  
            
  
    
  
            <li class="menu-category">
              <a href="http://localhost/PHP_PROJECT/abouttt.php" class="menu-title">About </a>
            </li>
  
  
            <li class="menu-category">
              <a href="http://localhost/PHP_PROJECT/contactUs/conta.php" class="menu-title">Contact</a>
            </li>
            <li class="menu-category">
              <a href="./all_product.php" class="menu-title">Shop</a>
            </li>
    <?php if(isset($_SESSION['user_id'])){ 
      $query='SELECT * FROM users where id = :id';
      $stmt= $db->prepare($query) ;
      $stmt->bindValue(':id', $_SESSION['user_id']);
      $stmt->execute();
      $user=$stmt->fetch(PDO::FETCH_ASSOC);
        if($user['is_admin'] == 1){
      ?>
            <li class="menu-category">
              <a href="http://localhost/PHP_PROJECT/AdminLTE_master/admindashboard/users/users.php" class="menu-title">dashboard</a>
            </li>
  <?php }} ?>



  <?php
                if(!isset($_SESSION['user_id'])){
                  echo
                '<li class="menu-category"> 
                  <a href="AdminLTE_master/admindashboard/users/login.php" class="menu-title">Sign in</a>
                </li>'; 
                echo
                '<li class="menu-category">
                  <a href="AdminLTE_master/admindashboard/users/signup.php" class="menu-title">Registration</a>
                </li>'; 
              }else{
                if(isset($_SESSION['user_id'])){
                echo 
                '<li class="menu-category">
                  <a href="destroysession.php" class="menu-title">Logout</a>
                </li>';
              }}
              ?>
            
          </ul>
  
        </div>
  
      </nav>


    </div>

    <div class="header-user-actions">
<?php if(isset($_SESSION['user_id'])){ ?>
  <a href="http://localhost/PHP_PROJECT/AdminLTE_master/admindashboard/users/profile.php?id=<?php echo $_SESSION['user_id'] ?>">
    <button class="action-btn">
      <ion-icon name="person-outline"></ion-icon>
    </button>
  </a>
      <?php }else{ ?>
        <button class="action-btn">
          <ion-icon name="person-outline"></ion-icon>
        </button>
        <?php } ?>

      

      <button class="action-btn">
        
        <?php if (isset ($_SESSION['cart'])) {?>
      <a href="http://localhost/PHP_PROJECT/viewcart.php"><ion-icon name="bag-handle-outline"></ion-icon></a>
      <span class="count"><?php echo count($_SESSION['cart']) ?></span>
       <?php } else { ?>
        <a href=""><ion-icon name="bag-handle-outline"></ion-icon></a>
<span class="count">0</span>
      <?php }  ?>
      </button>

    </div>

  </div>

</div>









<div class="mobile-bottom-navigation">

  <button class="action-btn" data-mobile-menu-open-btn>
    <ion-icon name="menu-outline"></ion-icon>
  </button>

  <button class="action-btn">
    <ion-icon name="bag-handle-outline"></ion-icon>

    <span class="count">0</span>
  </button>

  <button class="action-btn">
    <ion-icon name="home-outline"></ion-icon>
  </button>

 

  <button class="action-btn" data-mobile-menu-open-btn>
    <ion-icon name="grid-outline"></ion-icon>
  </button>

</div>

<nav class="mobile-navigation-menu  has-scrollbar" data-mobile-menu>

  <div class="menu-top">
    <h2 class="menu-title">Menu</h2>

    <button class="menu-close-btn" data-mobile-menu-close-btn>
      <ion-icon name="close-outline"></ion-icon>
    </button>
  </div>

  <ul class="mobile-menu-category-list">

    <li class="menu-category">
      <a href="#" class="menu-title">Home</a>
    </li>

    <li class="menu-category">

      <button class="accordion-menu" data-accordion-btn>
        <p class="menu-title">Men's</p>

        <div>
          <ion-icon name="add-outline" class="add-icon"></ion-icon>
          <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
        </div>
      </button>

      <ul class="submenu-category-list" data-accordion>

        <li class="submenu-category">
          <a href="#" class="submenu-title">Shirt</a>
        </li>

        <li class="submenu-category">
          <a href="#" class="submenu-title">Shorts & Jeans</a>
        </li>

        <li class="submenu-category">
          <a href="#" class="submenu-title">Safety Shoes</a>
        </li>

        <li class="submenu-category">
          <a href="#" class="submenu-title">Wallet</a>
        </li>

      </ul>

    </li>

    <li class="menu-category">

      <button class="accordion-menu" data-accordion-btn>
        <p class="menu-title">Women's</p>

        <div>
          <ion-icon name="add-outline" class="add-icon"></ion-icon>
          <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
        </div>
      </button>

      <ul class="submenu-category-list" data-accordion>

        <li class="submenu-category">
          <a href="#" class="submenu-title">Dress & Frock</a>
        </li>

        <li class="submenu-category">
          <a href="#" class="submenu-title">Earrings</a>
        </li>

        <li class="submenu-category">
          <a href="#" class="submenu-title">Necklace</a>
        </li>

        <li class="submenu-category">
          <a href="#" class="submenu-title">Makeup Kit</a>
        </li>

      </ul>

    </li>

    <li class="menu-category">

      <button class="accordion-menu" data-accordion-btn>
        <p class="menu-title">Jewelry</p>

        <div>
          <ion-icon name="add-outline" class="add-icon"></ion-icon>
          <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
        </div>
      </button>

      <ul class="submenu-category-list" data-accordion>

        <li class="submenu-category">
          <a href="#" class="submenu-title">Earrings</a>
        </li>

        <li class="submenu-category">
          <a href="#" class="submenu-title">Couple Rings</a>
        </li>

        <li class="submenu-category">
          <a href="#" class="submenu-title">Necklace</a>
        </li>

        <li class="submenu-category">
          <a href="#" class="submenu-title">Bracelets</a>
        </li>

      </ul>

    </li>

    <li class="menu-category">

      <button class="accordion-menu" data-accordion-btn>
        <p class="menu-title">Perfume</p>

        <div>
          <ion-icon name="add-outline" class="add-icon"></ion-icon>
          <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
        </div>
      </button>

      <ul class="submenu-category-list" data-accordion>

        <li class="submenu-category">
          <a href="#" class="submenu-title">Clothes Perfume</a>
        </li>

        <li class="submenu-category">
          <a href="#" class="submenu-title">Deodorant</a>
        </li>

        <li class="submenu-category">
          <a href="#" class="submenu-title">Flower Fragrance</a>
        </li>

        <li class="submenu-category">
          <a href="#" class="submenu-title">Air Freshener</a>
        </li>

      </ul>

    </li>

    <li class="menu-category">
      <a href="#" class="menu-title">Blog</a>
    </li>

    <li class="menu-category">
      <a href="#" class="menu-title">Hot Offers</a>
    </li>

  </ul>

  <div class="menu-bottom">

    <ul class="menu-category-list">

      <li class="menu-category">

        <button class="accordion-menu" data-accordion-btn>
          <p class="menu-title">Language</p>

          <ion-icon name="caret-back-outline" class="caret-back"></ion-icon>
        </button>

        <ul class="submenu-category-list" data-accordion>

          <li class="submenu-category">
            <a href="#" class="submenu-title">English</a>
          </li>

          <li class="submenu-category">
            <a href="#" class="submenu-title">Espa&ntilde;ol</a>
          </li>

          <li class="submenu-category">
            <a href="#" class="submenu-title">Fren&ccedil;h</a>
          </li>

        </ul>

      </li>

      <li class="menu-category">
        <button class="accordion-menu" data-accordion-btn>
          <p class="menu-title">Currency</p>
          <ion-icon name="caret-back-outline" class="caret-back"></ion-icon>
        </button>

        <ul class="submenu-category-list" data-accordion>
          <li class="submenu-category">
            <a href="#" class="submenu-title">USD &dollar;</a>
          </li>

          <li class="submenu-category">
            <a href="#" class="submenu-title">EUR &euro;</a>
          </li>
        </ul>
      </li>

    </ul>

    <ul class="menu-social-container">

      <li>
        <a href="#" class="social-link">
          <ion-icon name="logo-facebook"></ion-icon>
        </a>
      </li>

      <li>
        <a href="#" class="social-link">
          <ion-icon name="logo-twitter"></ion-icon>
        </a>
      </li>

      <li>
        <a href="#" class="social-link">
          <ion-icon name="logo-instagram"></ion-icon>
        </a>
      </li>

      <li>
        <a href="#" class="social-link">
          <ion-icon name="logo-linkedin"></ion-icon>
        </a>
      </li>

    </ul>

  </div>

</nav>

</header>
<div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm p-3 mb-5 bg-body-tertiary rounded" style="margin-left: -13%;">
                    <div class="row">
                        <div class="col-md-6">
                        <?php
      foreach($products as $product) { 
        $query = "SELECT category_name, product_name, product_desc, price, discount, price_after, product_img FROM categories INNER JOIN products ON categories.id = category_id WHERE products.id =  ? ";
       $stmt = $db->prepare($query);
       $stmt->execute([$id]);
       $products=$stmt->fetchAll(PDO::FETCH_ASSOC);

      
        ?>

                            <div class="images p-3" >
                                <div class="text-center "> <img id="main-image" src="./AdminLTE_master/upload/<?php echo $product['product_img']; ?>" width="300" /> </div>
                               
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="product p-4">
                                
                              

                                <div class="mt-4 mb-3"> <span class="text-uppercase text-muted brand"><?PHP echo  $products['0']['category_name'];?></span>
                              
                          
                                    <h5 class="text-uppercase"><?PHP echo $product['product_name']?></h5>
                                    <div class="price d-flex flex-row align-items-center"> <span class="act-price"><?PHP echo $product['price_after'] .'JD'; ?></span>
                                       <div class="ml-2" style="width: 50%;"> <small style="margin-left:3.5%;" class="dis-price"><?PHP echo $product['price'] .'JD' ;?></small><span  style="margin-left: 9.5%;"><?PHP echo $product['discount']; ?>% OFF</span> </div>
                                    
                                     
                                      </div>
                                      <p class="about"><?PHP echo $product['product_desc'] ?></p>  
                                      <div class="cart mt-4 align-items-center">
                                      <a href="addtocart.php?pro_id=<?php echo $product['id'] ?>&action=add"> <button class="btn btn-primary text-uppercase mr-2 px-4">Add to cart</button></a> <i class="fa fa-heart text-muted"></i> <i class="fa fa-share-alt text-muted"></i> </div>                               
                                      </div>
                                
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <?php }
  
    ?>



<!-- review section -->

<?php
$query = "SELECT * 
               FROM reviews 
               INNER JOIN users ON (reviews.user_id = users.id) WHERE product_id = ? ";
                $stmt = $db->prepare($query);
                $stmt->execute([$id]);
                
           
                ?>

                  <section class="shadow-sm p-3 mb-5 bg-body-tertiary rounded" style="background-color:#eee;width:75%;margin-left:6%;border-radius: 5px;">
                  <h1 class ="text-center">Review For Products</h1>
  <div class="container my-5 py-5 " >
    <div class="row d-flex justify-content-center" style="margin-top: -8%;">
      <div class="col-md-12 col-lg-12 ">
        <div class="card text-dark ">
          <div class="card-body p-4 ">
            <h4 class="mb-0" style="font-size: 22px;">Recent Comments</h4>



            <?php while ($comment = $stmt->fetch()) {
            $comment_id = $comment['id'];
            $product_id = $comment['product_id'];
            $comment_date = $comment['review_date'];
            $comment_content = $comment['comment'];
            $user_name = $comment['user_name'];
            ?>



            <div class="card-body p-4">
            <div class="d-flex flex-start">
              <div>


                <h6 class="fw-bold mb-1" style="font-size: 19px;"><?php echo $user_name ?></h6>

                <div class="d-flex align-items-center mb-3">
                  <p class="mb-0" style="font-size: 12px;">
                  
                  
                  <?php echo $comment_date ?>


                  </p>
                </div>
                <p class="mb-0" style="font-size: 18px;">
                
                
                <?php echo  $comment_content; ?>


                </p>
              </div>
            </div>
          </div>

          <hr class="my-0" /><?php } ?>
        </div>
      </div>
    </div>
  </div>



  <?php

         if(isset($_SESSION['user_id'])){ ?>
            <form action="" method="post"  >
            <div class="card-body p-4 " >
               <div class="d-flex flex-start" style="margin-left: -3%;">
                  <textarea style="width:1300px; border:2px solid silver"  class="form-control text-center" name="comment_text" cols="12"  rows="3" placeholder="Add your comment" value=""></textarea>
               </div>
            </div>
            <div class="col-md-12 text-right"  style="margin-left: 2%;">
               <button type="submit" name="submit_comment" class="btn submit_btn" style="background-color: #0d6efd; font-size : 20px;color:white;">
                  Submit Now
               </button>
            </div>
            </form>
         <?php } ?> 

         <?php 
         if (isset($_POST['comment_text'])) {
            if (isset($_SESSION['user_id'])) {
               $comment_text = $_POST['comment_text'];
               $sqlInserComment = "INSERT INTO reviews (user_id,product_id,comment,review_date) 
                                 VALUES ('$user_id','$id','$comment_text ', NOW())";
               $stmt = $db->query($sqlInserComment);
               $return_to_page =  $_SERVER['PHP_SELF'];
               
              //  header("location:./single.php?id=$id");
              echo "<script>window.location='./single.php?id=$id'</script>";
            }
         }
         ?> 


</section>





<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>