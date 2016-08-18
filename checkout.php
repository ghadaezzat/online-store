

<?php
require ('functions/functions.php');
session_start();

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
