<?php
    include "index.php";
if ($_GET['pro_id']){
    $product_id=$_GET['pro_id'];
    $product=getDetails($product_id);

?>
<script type="text/javascript">
    $view='<img src="admin_area/product_images/<?= $product["product_image"]; ?>" width="400" height="300"/>\n\
            <p><b>$<?= $product["product_price"]; ?></b></p>\n\
            <p><?= $product["product_desc"]; ?></p>\n\
            '
    document.getElementById("products_box").innerHTML=$view;
</script>
<?php } ?>
    
