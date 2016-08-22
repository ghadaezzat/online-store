
<?php


$product=getDetails($_GET['edit_pro']);
?>
<html>
    <head>
        <title>
            edit product
        </title>
         <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
         <script>tinymce.init({ selector:'textarea' });</script>
    </head>
    <body>
        <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <input type="hidden" name="product_id" value="<?= $product['product_id']; ?>"/>
            <table align="center" style="background-color:lightgoldenrodyellow;width: 795px;" >
                <thead align="center">
                    <td colspan="8">
                        <h3 class="admin-page-title" > Edit Product here</h3>
                    </td>
                </thead>
                <tr>
                    <td align="right">
                        <b>product title</b>
                    </td> 
                    <td>
                        <input type="text" name="product_title"  value="<?=$product['product_title']; ?>" required/>
                    </td>
                </tr>
                    <tr>
                    <td align="right">
                        <b> product category</b>
                    </td> 
                    <td>
                        <select name="product_cat" style="width: 200px;" required>
                            <option>select a category</option>
                               <?php   $cats=getCats(); ?>
                                    <?php foreach($cats as $item) :?>
                                        <option value="<?= $item['cat_id'] ?>" <?php if($product['product_cat'] == $item['cat_id']){ echo ' selected="selected"'; } ?>><?= $item['cat_title']?></option> 
                                    <?php endforeach; ?> 
                        </select>
                    </td>
                </tr>                <tr>
                    <td align="right">
                        <b> product brand</b>
                    </td> 
                    <td>
                        <select name="product_brand" style="width: 200px;" required>
                            <option>select a brand</option>
                               <?php   $brands=getBrands(); ?>
                                    <?php foreach($brands as $item) :?>
                            <option value="<?= $item['brand_id'] ?>" <?php if($product['product_brand'] == $item['brand_id']){ echo ' selected="selected"'; } ?>> <?= $item['brand_title']?></option> 
                                    <?php endforeach; ?> 
                        </select>                    </td>
                </tr>                <tr>
                    <td align="right">
                        <b> product image</b>
                    </td> 
                    <td><div class="row">
                            <div class="col-xs-4">
                        <input type="file" name="product_image"/>
                            </div>
                            <div class="col-xs-8">
                                <img src="product_images/<?= $product['product_image'];?>" width="50" height="50" style="float: left;"/>
                            </div>
                        </div>
                    </td>
                </tr>                <tr>
                    <td align="right">
                        <b> product price</b>
                    </td> 
                    <td>
                        <input type="text" name="product_price" value="<?= $product['product_price']; ?>" required/>
                    </td>
                </tr>                <tr>
                    <td align="right">
                        <b>product description</b>
                    </td> 
                    <td>
                        <textarea name="product_desc" cols="20" rows="10" ><?= $product['product_desc'];?></textarea>
                    </td>
                </tr>                <tr>
                    <td align="right">
                        <b>product keywords</b>
                    </td> 
                    <td>
                        <input type="text" name="product_keywords" value="<?= $product['product_keywords'];?>" required/>
                    </td>
                </tr> 
                <tr  align="center">

                    <td colspan="8">
                        <input type="submit" name="edit_post" value="edit product"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
<?php updateProduct();
?>