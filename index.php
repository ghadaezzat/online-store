

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
                <div id="content_area"> </div>
                          </div>

            


            <div id="footer">this is footer</div>
</div>
    </body>
</html>
