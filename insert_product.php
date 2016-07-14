<?php
require ('../functions/functions.php');

?>
<html>
    <head>
        <title>
            inserting product
        </title>
    </head>
    <body bgcolor="skyblue">
        <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <table align="center" width="750" border="2" bgcolor="lightgrey">
                <tr align="center">
                    <td colspan="8">
                        Insert new product here
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <b>product title</b>
                    </td> 
                    <td>
                        <input type="text" name="product_title"/>
                    </td>
                </tr>
                    <tr>
                    <td align="right">
                        <b> product category</b>
                    </td> 
                    <td>
                        <select name="product_cat">
                            <option>select a category</option>
                               <?php   $cats=getCats(); ?>
                                    <?php foreach($cats as $item) :?>
                                        <option><?= $item['cat_title']?></option> 
                                    <?php endforeach; ?> 
                        </select>
                    </td>
                </tr>                <tr>
                    <td align="right">
                        <b> product brand</b>
                    </td> 
                    <td>
                        <input type="text" name="product_brand"/>
                    </td>
                </tr>                <tr>
                    <td align="right">
                        <b> product image</b>
                    </td> 
                    <td>
                        <input type="text" name="product_image"/>
                    </td>
                </tr>                <tr>
                    <td align="right">
                        <b> product price</b>
                    </td> 
                    <td>
                        <input type="text" name="product_price"/>
                    </td>
                </tr>                <tr>
                    <td align="right">
                        <b>product description</b>
                    </td> 
                    <td>
                        <input type="text" name="product_description"/>
                    </td>
                </tr>                <tr>
                    <td align="right">
                        <b>product keywords</b>
                    </td> 
                    <td>
                        <input type="text" name="product_keywords"/>
                    </td>
                </tr> 
                <tr  align="center">

                    <td colspan="8">
                        <input type="submit" name="insert_post" value="insert product"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
