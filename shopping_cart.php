                    <div id='shopping_cart'>
                        <?php 
                        
                        $purchased_items=total_items();
                        $count=count($purchased_items);
                        $sum=total_price(); ?>
                        <span style="float: right;font-size: 18px;padding: 5px;line-height: 40px;">
                            Welcome <?php if (isset($_SESSION['customer_name'])){
                                echo $_SESSION['customer_name']."!";
                            }else{
                             echo 'Guest!';   
                            }?>
                            <b style="color:yellow;">shopping cart</b>
                            
                            Total items :<?= $count; ?> Total price :$<?php echo $sum;
                                if (strcmp('/on/cart.php', $_SERVER['REQUEST_URI']) == false){  ?> 
                                     <a href="index.php" style="color:yellow;">Back to shop </a>
                                <?php }else{ ?>
                                     <a href="cart.php" style="color:yellow;">Go to cart </a>
                                <?php } 
                        if (!(isset($_SESSION['customer_email']))){ 
                            ?>
                            <a href="checkout.php"><button class="btn btn-sm btn-default">login</button></a>
                        <?php } else {?>
                            <a href="logout.php"><button class="btn btn-sm btn-default">logout</button></a>
                         <?php }?>
 
                            
                        
                       
                        </span> 
                    </div>
