

<?php
session_start();
require ('functions/functions.php');
?>

    <body>
        <div class="main_wrapper">
            <?php include 'header.php'; ?>
            <div class="content_wrapper">
                <?php include 'sidebar.php'; ?>

                
                <div id="content_area">
                    <?php include 'shopping_cart.php'; ?>

                    <div id="products_box">
                        <?php
                         //var_dump($_SERVER['REQUEST_URI']);
                         $homepage = "/on/index.php";
                         $homepage2='/on/';
                         $currentpage = $_SERVER['REQUEST_URI'];
                         if ((strcmp($homepage2, $currentpage) == false)||(strcmp($homepage, $currentpage) == false)||(strpos($currentpage, "/on/index.php?add_cart") !==false)||(strpos($currentpage, "/on/index.php?cat") !==false)||(strpos($currentpage, "/on/index.php?brand") !==false)){
                             require  "products_page.php";
                         }

                        ?>
                    </div>
                </div>
         </div>

              <?php include 'footer.php';?>

        </div>
    </body>
