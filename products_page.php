
<?php
$products=getPro();
cart();

?>

<?php foreach($products as $item) :?>
        <div id="single_product">
            <h3><?= $item['product_title']?></h3>
            <img src="admin_area/product_images/<?= $item['product_image'] ?>" width="180" height="180"/>
            <p>$<?= $item['product_price'] ?></p>
            <a href="details.php?pro_id=<?= $item['product_id'] ?>" style="float: left;">Details</a>
            <a href='index.php?add_cart=<?= $item['product_id'] ?>' >      
            <button type="button">add to cart</button></a>
        </div> 
<?php endforeach; ?> 
                        
