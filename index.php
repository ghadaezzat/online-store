

<?php
require ('functions/functions.php');
?><html>
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
                    <li><a href="#">Home</a></li>
                    <li><a href="#">All products</a></li>
                    <li><a href="#">My account</a></li>
                    <li><a href="#">sign up</a></li>
                    <li><a href="#">shopping cart</a></li>
                    <li><a href="#">contact us</a></li>
                </ul>
                <div id="form">
                    <form method="post" action="results.php" enctype="multipart/form-data"/>
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
                                <li><a href="#"><?= $item['cat_title']?></a></li> 
                            <?php endforeach; ?> 

                    </ul>
                    <div id="sidebar_title">Brands </div>
                    <ul id="cats">
                        <?php   $brands=getBrands(); ?>
                        <?php foreach($brands as $item) :?>
                                <li><a href="#"><?= $item['brand_title']?></a></li> 
                        <?php endforeach; ?> 
                    </ul>
                </div>
                <div id="content_area">
                    <div id="products_box">
                        <?php $products=getPro(); ?>
                        <?php foreach($products as $item) :?>
                                <div id="single_product">
                                    <h3><?= $item['product_title']?></h3>
                                    <img src="admin_area/product_images/<?= $item['product_image'] ?>" width="180" height="180"/>
                                    <p>$<?= $item['product_price'] ?></p>
                                    <a href="details.php?pro_id=<?= $item['product_id'] ?>" style="float: left;">Details</a>
                                            <a href="index.php?pro_id=<?= $item['product_id'] ?>">
                                                <button style='float: right;'>Add to cart
                                                </button>
                                            </a>
                                </div> 
                        <?php endforeach; ?> 
                        
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
