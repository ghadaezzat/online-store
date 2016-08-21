<?php $products=get_all_products(); ?>    
    <table class="table table-bordered table-striped" style="background-color: lightgoldenrodyellow">
        <thead>
            <th colspan="6" ><h3 class="admin-page-title">View All Products</h3></th>
        </thead>
        <tr align="center">
            <td>S.N</td>
            <td>title</td>
            <td>price</td>
            <td>Image</td>
            <td>Edit</td>
            <td>Delete</td>
        </tr>
        <?php foreach($products as $product) :?>
        <tr align="center">
            <td><?= $product['product_id']; ?></td>
            <td><?= $product['product_title']; ?></td>
            <td>$<?= $product['product_price']; ?></td>
            <td><img src="product_images/<?= $product['product_image']; ?>" width="80" height="80"/></td>
            <td><a href="index.php?edit_pro=<?=$product['product_id']; ?>">Edit</a></td>
            <td><a href="index.php?delete_pro=<?= $product['product_id']; ?>">Delete</a></td>   
        </tr>
        <?php endforeach; ?>
    </table>
