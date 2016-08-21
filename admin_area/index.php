<?php
include ('../functions/functions.php');

?>
<body>        
    <div class="main_wrapper">
            <?php include 'header.php'; ?>
        <div id="right">
            <p style="font-family: fantasy;font-size: 22px;padding: 10px;text-align: center;background: lightgoldenrodyellow;color: black">Manage content</p>
            <ul>
                <li>
            <a href="index.php?insert_product">Insert Product</a>
                </li>
                <li>
            <a href="index.php?view_products">View products</a>
                </li>
                <li>
            <a href="index.php?insert_cat">Insert Category</a>
                </li>
                <li>
            <a href="index.php?view_cats">View Categories</a>
                </li>
                <li>
            <a href="index.php?insert_brand">Insert Brand</a>
                </li>
                <li>
            <a href="index.php?view_brands">View Brands</a>
            </li>
            <li>
            <a href="index.php?view_customers">View Customers</a>
            </li>
            <li>
            <a href="index.php?view_orders">View Orders</a>
            </li>
            <li>
            <a href="index.php?view_payments">View Payments</a>
            </li>
            <li>
            <a href="logout.php">Admin Logout</a>
            </li>
            </ul>
            
        </div>
        <div id="left">
            <?php if (isset($_GET['insert_product'])){
                include 'insert_product.php';
            }elseif (isset ($_GET['view_products'])) {
                include 'view_products.php';
            }elseif(isset ($_GET['edit_pro'])){
                include 'edit_pro.php';
            }elseif(isset ($_GET['delete_pro'])){
                deleteProduct();
            } elseif(isset ($_GET['insert_cat'])){
                include 'insert_cat.php';
            }elseif(isset ($_GET['insert_brand'])){
                include 'insert_brand.php';
            }elseif(isset ($_GET['view_cats'])){
                include 'view_cats.php';
            }elseif(isset ($_GET['view_brands'])){
                include 'view_brands.php';
            }elseif(isset ($_GET['edit_cat'])){
                include 'edit_cat.php';
            }elseif(isset ($_GET['delete_cat'])){
                deleteCat();
            }elseif(isset ($_GET['edit_brand'])){
                include 'edit_brand.php';;
            }elseif(isset ($_GET['delete_brand'])){
                deleteBrand();
            }elseif(isset ($_GET['view_customers'])){
                include 'view_customers.php';
            }elseif(isset ($_GET['delete_customer'])){
                deleteAccount();            }
                
             ?>
        </div>
    </div>
 
</body>
