<?php
    include "index.php";
    updateCart();
    ?>
<script type="text/javascript">


    $view='\<br>\n\
            <form action="" method="post" enctype="multipart/form-data">\n\
                <table align="center" bgcolor="skyblue" width="700">\n\
                    <tr align="center">\n\
                        <td colspan="5">update your cart or checkout</td>\n\
                    </tr>\n\
                    <tr>\n\
                        <th>remove</th>\n\
                        <th>product(s)</th>\n\
                        <th>quantity</th>\n\
                        <th>total price</th>\n\
                    </tr>\n\
                    <?php foreach($purchased_items as $purchased_item) :?>\n\
                    <tr align="center">\n\
                    <td><input type="checkbox" name="remove[]" value="<?= $purchased_item['product_id']; ?>" /></td>\n\
                    <td><?= $purchased_item["product_title"] ?>\n\
                     <br>\n\
            <img src="admin_area/product_images/<?= $purchased_item["product_image"]; ?>" width="60" height="60"/>\n\
                        \n\
                     </td>\n\
                    <td><input type="text" name="qty" size="3" /></td>\n\
                    <td><?= "$".$purchased_item["product_price"] ?></td>\n\
                    </tr>\n\
                    <?php endforeach; ?>\n\
                    <tr align="center">\n\
                    <td><input type="submit" name="update_cart" value="update cart"/></td>\n\
                    <td><input type="submit" name="continue" value="continue shopping" /></td>\n\
                    <td><a href="checkout.php"><button>checkout</button></a></td>\n\
                    </tr>\n\
                </table>\n\
           </form>'
    document.getElementById("products_box").innerHTML=$view;
</script>


