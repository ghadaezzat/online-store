<?php if(!isset($_SESSION['user_email'])){
    echo '<script>window.open("admin_login.php?NOT_ADMIN=you are not an admin")</script>';
}else{
?>

<html>
    <head>
        <title>
            inserting product
        </title>
    </head>
    <body >
        <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
            <table align="center" style="background-color:lightgoldenrodyellow;width: 795px;height:100%" >
                <thead align="center">
                    <td colspan="8">
                        <h3 class="admin-page-title" > Insert new Brand</h3>
                    </td>
                </thead>
                <tr>
                    <td align="right">
                        <b>brand title</b>
                    </td> 
                    <td>
                        <input type="text" name="brand_title" required/>
                    </td>
                </tr>
                    
                <tr  align="center">

                    <td colspan="8">
                        <input type="submit" name="insert_brand" value="insert brand" class="btn btn-lg btn-success"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
<?php

}
insertBrand();
?>
