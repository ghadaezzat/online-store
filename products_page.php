
                        <?php $products=getPro(); ?>
                        <?php foreach($products as $item) :?>
                                <div id="single_product">
                                    <h3><?= $item['product_title']?></h3>
                                    <img src="admin_area/product_images/<?= $item['product_image'] ?>" width="180" height="180"/>
                                    <p>$<?= $item['product_price'] ?></p>
                                    <a href="details.php?pro_id=<?= $item['product_id'] ?>" style="float: left;">Details</a>
                                    <a href='index.php?pro_id=<?= $item['product_id'] ?>'>
                                                <button style='float: right;'>Add to cart
                                                </button>
                                            </a>
                                </div> 
                        <?php endforeach; ?> 
                        
