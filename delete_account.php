


<?php
require ('functions/functions.php');
session_start();
deleteAccount();
?>


    <body>
        <div class="main_wrapper">
            <?php include 'header.php'; ?>
            <div class="content_wrapper">
                <div id="sidebar" style="height: auto;">
                    <div id="sidebar_title">My account </div>
                    <ul id="cats">

                        <li><a href="cart.php">My orders</a></li> 
                        <li><a href="edit.php">Edit account</a></li> 
                        <li><a href="edit_passwd.php">Change password</a></li> 
                        <li><a href="delete_account.php">Delete account</a></li> 
                        

                    </ul>
                </div>
                
                <div id="content_area">
                    <div id='shopping_cart'>
                      
                        <span style="font-size: 18px;padding: 5px;line-height: 40px;">
                            <span style="float:left;padding-left: 10px;">
                            Welcome <?php if (isset($_SESSION['customer_name'])){
                                echo $_SESSION['customer_name']."!";
                            }else{
                             echo 'Guest!';   
                            }?>
                            </span>
                            <span style="float:right;padding-right: 10px;padding-top: 5px;">
                                <?php
                                    if (!(isset($_SESSION['customer_email']))){ 
                               ?>
                                <a href="checkout.php"><button class="btn btn-sm btn-default">login</button></a>
                                <?php } else {?>
                                <a href="logout.php"><button class="btn btn-sm btn-default">logout</button></a>
                                <?php }?>
                            
                            </span>
                       
                        </span> 
                    </div>

<div class="card card-container">
    <form action="delete_account.php" method="post" enctype="multipart/form-data">
                            <h3> Are you sure you wanna delete your account?</h3>
                          
                        

                
                      
                            <input type="submit" name="yes" value="Yes" class="btn btn-lg btn-danger  " />
                            <input type="submit" name="no" value="No" class="btn btn-lg btn-success  " />
 
                        </form>

                    </div>
                </div>
            </div>

              <?php include 'footer.php';?>

        </div>


    </body>
</html>

