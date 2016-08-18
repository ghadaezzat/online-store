<?php
include "index.php";
$qty_array = updateQty();
?>
<script type="text/javascript">


    $view = '\<br>\n\
            <form action="" method="post" enctype="multipart/form-data">\n\
                <table align="center" bgcolor="skyblue" width="700">\n\
                    <tr align="center">\n\
                        <td colspan="5"><h2 class="card ">update your cart or checkout<h2></td>\n\
                    </tr>\n\
                    <tr>\n\
                        <th>remove</th>\n\
                        <th>product(s)</th>\n\
                        <th>quantity</th>\n\
                        <th>total price</th>\n\
                    </tr>\n\
                        <?php foreach ($purchased_items as $key => $purchased_item) : ?>\n\
                        <?php if ($qty_array[$key] == 0){$qty_array[$key] = 1;} ?>\n\
                        <tr align="center">\n\
                        <td><input type="checkbox" name="remove[]" value="<?= $purchased_item['product_id']; ?>" /></td>\n\
                        <td><?= $purchased_item["product_title"] ?>\n\
                         <br>\n\
                        <img src="admin_area/product_images/<?= $purchased_item["product_image"]; ?>" width="60" height="60"/>\n\
                            \n\
                         </td>\n\
                        <td><input type="text" name="qty[]" size="3" value="<?= $qty_array[$key]; ?> " /></td>\n\
                        <input type="hidden" name="id[]" value="<?= $purchased_item['product_id'] ?>" /></td>\n\
    \n\
                        <input type="hidden" name="total_price[]" value="<?= $purchased_item['product_price'] * $qty_array[$key]; ?>" />\n\
    \n\
                        <td><?php 
                        echo "$" . $purchased_item["product_price"] * $qty_array[$key]; ?></td>\n\
                        </tr>\n\
                    <?php endforeach; ?>\n\
                    <tr align="center">\n\
                    <td><input type="submit" name="update_cart" value="update cart"/></td>\n\
                    <td><a href="all_products.php"><input type="button" name="continue" value="continue shopping" /></a></td>\n\
                    <td><a href="checkout.php"><button type="button">checkout</button></a></td>\n\
                    </tr>\n\
                \n\
                </table>\n\
                \n\
           </form>\n\
'
            document.getElementById("products_box").innerHTML = $view;
</script>


