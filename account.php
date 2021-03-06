


<?php
require ('functions/functions.php');
session_start();
$user=customerData();
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
                    <div id="products_box">
                         <div class="row">
                            <div class="col-md-5  toppad  pull-right col-md-offset-3 ">
                                <A href="edit.php" >Edit Profile</A>

                                <br>
                                <p class=" text-info"><?=date("Y/m/d");?> </p>
                            </div>
         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6  " >
   
   
          <div class="panel panel-info "  style="width: 750px;" >
            <div class="panel-heading">
              <h3 class="panel-title"> <?= $user['customer_name'];?></h3>
            </div>
              <div class="panel-body"  >
                <div class="row">
                    <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="customer/customer_images/<?= $user['customer_image'];?>" class="img-circle img-responsive" style="border:4px solid lightskyblue"> </div>
                    <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>customer email</td>
                        <td><?= $user['customer_email']?></td>
                      </tr> 
                      <tr>
                        <td>country</td>
                        <td><?= $user['customer_country'];?></td>
                      </tr>
                      <tr>
                        <td>city</td>
                        <td><?= $user['customer_city'];?></td>
                      </tr>
                      <tr>
                        <td>phone</td>
                        <td><?= $user['customer_contact'];?></td>
                      </tr>
                  </table>
                </div>
                </div>
         </div>
          </div>
                            </div>
                         </div>
                    </div>
                </div>
</div>

              <?php include 'footer.php';?>

        </div>


    </body>
</html>
