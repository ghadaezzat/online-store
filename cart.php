<?php
    include "index.php";
    ?>
<script type="text/javascript">
         
    $view='<?php foreach($products as $product) :?><div id="single_product">\n\
            <h3><b><?= $product["product_title"]; ?></b></h3>\n\
            <img src="admin_area/product_images/<?= $product["product_image"]; ?>" width="180" height="180"/>\n\
            <p><b>$<?= $product["product_price"]; ?></b></p>\n\
            <a href="details.php?pro_id=<?= $product['product_id'] ?>" style="float:left;">Details</a>\n\
            <a href="index.php?add_cart=<?= $product['product_id'] ?>"><button style="float: right;margin-right:20px">Add to cart</button></a>\n\
            </div><?php endforeach; ?>'

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
                    <td><input type="checkbox" name=remove[] /></td>\n\
                    <td><?= $purchased_item["product_title"] ?>\n\
                     <br>\n\
            <img src="admin_area/product_images/<?= $purchased_item["product_image"]; ?>" width="60" height="60"/>\n\
                        \n\
                     </td>\n\
                    <td>hello</td>\n\
                    <td><?= $purchased_item["product_price"] ?></td>\n\
                    </tr>\n\
                    <?php endforeach; ?>\n\
                </table>\n\
           </form>'
    document.getElementById("products_box").innerHTML=$view;
</script>


