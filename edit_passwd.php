


<?php
require ('functions/functions.php');
session_start();
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
                        <form action="edit_passwd.php" method="post" enctype="multipart/form-data">
                            <h3> &nbsp;&nbsp;Change your password</h3>
                            <br>



                            <div class="form-group">
                                 <label for="password" class="col-sm-5 control-label">Enter current password</label>
                                 <div class="col-sm-7">
                                     <input type="password" id="password" name="c_pass" placeholder="Password" class="form-control autofocus" required>
                                 </div>
                             </div>
                            <div class="form-group">
                                 <label for="password" class="col-sm-5 control-label">Enter new password</label>
                                 <div class="col-sm-7">
                                     <input type="password" id="password" name="c_pass1" placeholder="Password" class="form-control autofocus" required>
                                 </div>
                             </div>
                            <div class="form-group" style="margin-bottom: 20px;">
                                 <label for="password" class="col-sm-5 control-label">Enter new password again</label>
                                 <div class="col-sm-7">
                                     <input type="password" id="password" name="c_pass2" placeholder="Password" class="form-control autofocus"required >
                                 </div>
                            </div>
                        

                
                      
                            <input type="submit" name="update_passwd" value="Update" class="btn btn-lg btn-primary btn-block " />
                       
                        </form>

                    </div>
                </div>
            </div>

              <?php include 'footer.php';?>

        </div>


    </body>
</html>

