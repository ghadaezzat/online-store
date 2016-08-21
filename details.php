<?php
    include "index.php";
if ($_GET['pro_id']){
    $product_id=$_GET['pro_id'];
    $product=getDetails($product_id);

?>
<script type="text/javascript">
    $view=' <h2><b><?= $product["product_title"]; ?></b></h2>\n\
            <img src="admin_area/product_images/<?= $product["product_image"]; ?>" width="400" height="300"/>\n\
            <p><b>$<?= $product["product_price"]; ?></b></p>\n\
            <?= $product["product_desc"]; ?>\n\
            <a href="index.php" style="float:left;">Go Back</a>\n\
            <a href="#"><button style="float: right;margin-right:20px">Add to cart</button>\n\
            '
    document.getElementById("products_box").innerHTML=$view;
</script>
<?php } ?>
    
