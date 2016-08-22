<?php $cats=getCats(); ?>
<?php if(!isset($_SESSION['user_email'])){
    echo '<script>window.open("admin_login.php?NOT_ADMIN=you are not an admin")</script>';
}else{
?>
    <table class="table table-bordered table-striped" style="background-color: lightgoldenrodyellow">
        <thead>
            <th colspan="4" ><h3 class="admin-page-title">View All Categories</h3></th>
        </thead>
        <tr align="center">
            <td>S.N</td>
            <td>title</td>
            <td>Edit</td>
            <td>Delete</td>
        </tr>
        <?php foreach($cats as $cat) :?>
        <tr align="center">
            <td><?= $cat['cat_id']; ?></td>
            <td><?= $cat['cat_title']; ?></td>
            <td><a href="index.php?edit_cat=<?=$cat['cat_id']; ?>">Edit</a></td>
            <td><a href="index.php?delete_cat=<?= $cat['cat_id']; ?>">Delete</a></td>   
        </tr>
        <?php endforeach; ?>
    </table>

<?php } ?>