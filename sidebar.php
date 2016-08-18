                <div id="sidebar">
                    <div id="sidebar_title">Categories </div>
                    <ul id="cats">
                        <?php   $cats=getCats(); ?>
                        <?php foreach($cats as $item) :?>
                        <li><a href="index.php?cat=<?= $item['cat_id']; ?>"><?= $item['cat_title']?></a></li> 
                            <?php endforeach; ?> 

                    </ul>
                    <div id="sidebar_title">Brands </div>
                    <ul id="cats">
                        <?php   $brands=getBrands(); ?>
                        <?php foreach($brands as $item) :?>
                                <li><a href="index.php?brand=<?= $item['brand_id']; ?>"><?= $item['brand_title']?></a></li> 
                        <?php endforeach; ?> 
                    </ul>
                </div>
