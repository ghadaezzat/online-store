<?php
    include "index.php";
    $products =  searchProducts();
    ?>
<script type="text/javascript">
         
    $view='<?php foreach($products as $product) :?><div id="single_product">\n\
            <h3><b><?= $product["product_title"]; ?></b></h3>\n\
            <img src="admin_area/product_images/<?= $product["product_image"]; ?>" width="180" height="180"/>\n\
            <p><b>$<?= $product["product_price"]; ?></b></p>\n\
            <a href="details.php?pro_id=<?= $product['product_id'] ?>" style="float:left;">Details</a>\n\
            <a href="index.php?add_cart=<?= $product['product_id'] ?>"><button style="float: right;margin-right:20px">Add to cart</button></a>\n\
            </div><?php endforeach; ?>'

    
    document.getElementById("products_box").innerHTML=$view;
</script>

