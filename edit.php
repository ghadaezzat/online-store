

<?php
require ('functions/functions.php');
session_start();

$user=customerData();
updateAccount(); ?>

<html>

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
                        <form action="edit.php" method="post" enctype="multipart/form-data">
                            <h3> &nbsp;&nbsp;update your account</h3>
                            <br>

                            <div class="form-group">
                                <label for="fName" class="col-sm-3 control-label">Full Name</label>
                                <div class="col-sm-9">
                                    <input type="text" id="fName" name="c_name" placeholder="Full Name" value="<?= $user['customer_name'];?>" class="form-control autofocus">
                                    <span class="help-block">Last Name, First Name, eg.: Smith, Harry</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" id="email" name="c_email" placeholder="Email" value="<?= $user['customer_email'];?>" class="form-control autofocus" disabled>
                                    <span class="help-block">ahmed@gmail.com</span>

                                </div>
                            </div>
                            <div class="form-group">
                                 <label for="password" class="col-sm-3 control-label">Password</label>
                                 <div class="col-sm-9">
                                     <input type="password" id="password" name="c_pass" placeholder="Password" class="form-control autofocus" value="<?= $user['customer_pass'];?>">
                                 </div>
                             </div>
                            <div class="form-group">
                                <label for="country" class="col-sm-3 control-label">Country</label>
                                <div class="col-sm-9">                            
                                    <select class="selectpicker" name="c_country" data-width="270px" disabled>
                                            <option selected disabled hidden >select a country</option>    
                                            <option>Egypt</option>
                                            <option>India</option>
                                            <option>Chad</option>
                                        </select>
                                 </div>
                            </div>
                            <div class="form-group">
                                 <label for="city" class="col-sm-3 control-label">city</label>
                                 <div class="col-sm-9">
                                     <input type="text" value="<?= $user['customer_city'];?>" id="city" name="c_city" placeholder="city" class="form-control autofocus" >
                                 </div>
                             </div>   
                            <div class="form-group">
                                 <label for="mobile" class="col-sm-3 control-label">phone number</label>
                                 <div class="col-sm-9">
                                     <input type="text" id="mobile" name="c_contact" placeholder="contact phone number" class="form-control autofocus" value="<?= $user['customer_contact'];?>">
                                 </div>
                            </div> 
                            <div class="form-group">
                                 <label for="address" class="col-sm-3 control-label">address</label>
                                 <div class="col-sm-9">
                                     <textarea  id="address" name="c_address" placeholder="address" class="form-control autofocus" >v<?= $user['customer_address'];?></textarea>
                                 </div>
                             </div>
                             <div class="form-group" >
                                 <label for="image" class="col-sm-3 control-label">image</label>
                                 <div class="col-sm-6">
                                     <input type="file"  id="image" name="c_image" >
                                 </div>    
                                 <div class="col-sm-3">
                                     <img src="customer/customer_images/<?= $user['customer_image'];?>" width="50" height="50" style="float:right;"/>
                                 </div>
                             </div> 
                            <br>
                            <input type="submit" name="update" value="Update" class="btn btn-lg btn-primary btn-block " />
                        </form>

                    </div>
                </div>
         </div>

              <?php include 'footer.php';?>

</div>
<script>
    $(document).ready(function(e) {
  $('.selectpicker').selectpicker();
});
</script>
    </body>
</html>




  



