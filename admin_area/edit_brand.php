<?php $brand=editBrand();?>

<html>
    <head>
        <title>
            edit brand
        </title>
    </head>
    <body >
        <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <table align="center" style="background-color:lightgoldenrodyellow;width: 795px;height:100%" >
                <thead align="center">
                    <td colspan="8">
                        <h3 class="admin-page-title" > Edit Brand</h3>
                    </td>
                </thead>
                <tr>
                    <td align="right">
                        <b>brand title</b>
                    </td> 
                    <td>
                        <input type="text" name="brand_title" value="<?= $brand['brand_title']; ?>" required/>
                    </td>
                </tr>
                    
                <tr  align="center">

                    <td colspan="8">
                        <input type="submit" name="edit_brand" value="Edit brand" class="btn btn-lg btn-success"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
<?php


updateBrand();
?>

