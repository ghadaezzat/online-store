<?php $customers=getCustomers(); ?>    
<?php if(!isset($_SESSION['user_email'])){
    echo '<script>window.open("admin_login.php?NOT_ADMIN=you are not an admin")</script>';
}else{
?>
    <table class="table table-bordered table-striped" style="background-color: lightgoldenrodyellow">
        <thead>
            <th colspan="5" ><h3 class="admin-page-title">View All Customers</h3></th>
        </thead>
        <tr align="center">
            <td>S.N</td>
            <td>Name</td>
            <td>Email</td>
            <td>image</td>
            <td>Delete</td>
        </tr>
        <?php foreach($customers as $customer) :?>
        <tr align="center">
            <td><?= $customer['customer_id']; ?></td>
            <td><?= $customer['customer_name']; ?></td>
            <td><?= $customer['customer_email']; ?></td>
            <td><img src="../customer/customer_images/<?= $customer['customer_image']; ?>" width="80" height="80"/></td>
            <td><a href="index.php?delete_customer=<?= $customer['customer_id']; ?>">Delete</a></td>   
        </tr>
        <?php endforeach; ?>
    </table>

<?php } ?>