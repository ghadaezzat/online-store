

<?php
require ('functions/functions.php');
?>
<html>
    <head>
        <title>
            online store
        </title>
        <link rel="stylesheet" href="styles/style.css" media="all"/>
    </head>
    <body>
        <div class="main_wrapper">
            <div class="header_wrapper">
                <div>
                    <img class="logo" src="images/target.jpg"/>
                    <img class="banner" src="images/banner.jpg"/>
                </div>
            </div>
            
            <div class="menubar">
                <ul id="menu">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="all_products.php">All products</a></li>
                    <li><a href="#">My account</a></li>
                    <li><a href="#">sign up</a></li>
                    <li><a href="#">shopping cart</a></li>
                    <li><a href="#">contact us</a></li>
                </ul>
                <div id="form">
                    <form method="get" action="results.php" enctype="multipart/form-data"/>
                    <input type="text" name="user_query" placeholder="search for a product"/>
                    <input type="submit" name="search" value="search"/>
                </div>
            </div>
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
                        <?php $purchased_items=total_items(); 
                        $count=count($purchased_items);
                        $sum=total_price(); ?>
                        <span style="float: right;font-size: 18px;padding: 5px;line-height: 40px;">
                            Welcome Guest!<b style="color:yellow;">shopping cart</b>
                            Total items :<?= $count; ?> Total price :$<?= $sum ?> <a href="cart.php" style="color:yellow;">Go to cart </a>
                        </span> 
                    </div>
                    <div id="products_box">
               <?php
                require  "products_page.php";
          
               ?>
                    </div>
                </div>
         </div>

            


            <div id="footer">
            <h2 style="text-align: center;padding-top: 30px;">
                &copy;2016 by Ghada ezzat
            </h2>
            </div>
</div>
    </body>
</html>
