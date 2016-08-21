<?php $brands=getBrands(); ?>    
    <table class="table table-bordered table-striped" style="background-color: lightgoldenrodyellow">
        <thead>
            <th colspan="4" ><h3 class="admin-page-title">View All Brands</h3></th>
        </thead>
        <tr align="center">
            <td>S.N</td>
            <td>title</td>
            <td>Edit</td>
            <td>Delete</td>
        </tr>
        <?php foreach($brands as $brand) :?>
        <tr align="center">
            <td><?= $brand['brand_id']; ?></td>
            <td><?= $brand['brand_title']; ?></td>
            <td><a href="index.php?edit_brand=<?=$brand['brand_id']; ?>">Edit</a></td>
            <td><a href="index.php?delete_brand=<?= $brand['brand_id']; ?>">Delete</a></td>   
        </tr>
        <?php endforeach; ?>
    </table>


