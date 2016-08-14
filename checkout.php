

<?php
require ('functions/functions.php');
session_start();

?>

    <body>
        <div class="main_wrapper">
<?php include 'header.php'; ?>
            <div class="content_wrapper">
                <div id="sidebar">
                    <div id="sidebar_title">Categories </div>
                    <ul id="cats">
                        <?php   $cats=getCats(); ?>
                        <?php foreach($cats as $item) :?>
                        <li><a href="index.php?cat=<?= $item['cat_id']; ?>"><?= $item['cat_title']?></a></li> 
                            <?php endforeach; ?> 

                    </ul>
                    <div id="sidebar_title">Brands </div>
                    <ul id="cats">
                        <?php   $brands=getBrands(); ?>
                        <?php foreach($brands as $item) :?>
                                <li><a href="index.php?brand=<?= $item['brand_id']; ?>"><?= $item['brand_title']?></a></li> 
                        <?php endforeach; ?> 
                    </ul>
                </div>
                
                <div id="content_area">
                    <div id='shopping_cart'>
                        <?php 
                        
                        $purchased_items=total_items();
                        $count=count($purchased_items);
                        $sum=total_price(); ?>
                        <span style="float: right;font-size: 18px;padding: 5px;line-height: 40px;">
                            Welcome Guest!<b style="color:yellow;">shopping cart</b>
                            Total items :<?= $count; ?> Total price :$<?= $sum; ?> <a href="cart.php" style="color:yellow;">Go to cart </a>
                        </span> 
                    </div>
                    <div id="products_box">
               <?php
               if (!isset($_SESSION['customer_email'])){
                   include 'login.php';
                }  else {
                    include 'payment.php';
                }              
               ?>
                    </div>
                </div>
         </div>

              <?php include 'footer.php';?>

</div>
    </body>
</html>
