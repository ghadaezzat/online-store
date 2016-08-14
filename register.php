

<?php
require ('functions/functions.php');
session_start();

register();
?>
<html>

    <body>
        <div class="main_wrapper">
            <?php include 'header.php'; ?>
            <div class="content_wrapper">
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
                
                <div id="content_area">
                    <div id='shopping_cart'>
                        <?php 
                        
                        $purchased_items=total_items();
                        $count=count($purchased_items);
                        $sum=total_price(); ?>
                        <span style="float: right;font-size: 18px;padding: 5px;line-height: 40px;">
                            Welcome Guest!<b style="color:yellow;">shopping cart</b>
                            Total items :<?= $count; ?> Total price :$<?= $sum; ?> <a href="cart.php" style="color:yellow;">Go to cart </a>
                        </span> 
                    </div>
                    <div class="card card-container">
                        <form action="register.php" method="post" enctype="multipart/form-data">
                            <h3> &nbsp;&nbsp;Create an account</h3>
                            <br>
                            <div class="form-group">
                                <label for="Name" class="col-sm-3 control-label">Full Name</label>
                                <div class="col-sm-9">
                                    <input type="text" id="Name" name="c_name" placeholder="Full Name" class="form-control autofocus" required>
                                    <span class="help-block">Last Name, First Name, eg.: Smith, Harry</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" id="email" name="c_email" placeholder="Email" class="form-control autofocus" required>
                                    <span class="help-block">ahmed@gmail.com</span>

                                </div>
                            </div>
                            <div class="form-group">
                                 <label for="password" class="col-sm-3 control-label">Password</label>
                                 <div class="col-sm-9">
                                     <input type="password" id="password" name="c_pass" placeholder="Password" class="form-control autofocus" required>
                                 </div>
                             </div>
                            <div class="form-group">
                                <label for="country" class="col-sm-3 control-label">Country</label>
                                <div class="col-sm-9">                            
                                    <select class="selectpicker" name="c_country" data-width="270px" required>
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
                                     <input type="text" id="city" name="c_city" placeholder="city" class="form-control autofocus" required>
                                 </div>
                             </div>   
                            <div class="form-group">
                                 <label for="mobile" class="col-sm-3 control-label">phone number</label>
                                 <div class="col-sm-9">
                                     <input type="text" id="mobile" name="c_contact" placeholder="contact phone number" class="form-control autofocus" required>
                                 </div>
                            </div> 
                            <div class="form-group">
                                 <label for="address" class="col-sm-3 control-label">address</label>
                                 <div class="col-sm-9">
                                     <textarea  id="address" name="c_address" placeholder="address" class="form-control autofocus" required></textarea>
                                 </div>
                             </div>
                             <div class="form-group">
                                 <label for="image" class="col-sm-3 control-label">image</label>
                                 <div class="col-sm-9">
                                     <input type="file"  id="image" name="c_image" required>
                                 </div>
                             </div> 
                            <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" required>I accept <a href="#">terms</a>
                                        </label>
                                    </div>
                                </div>
                            </div> 
                            <input type="submit" name="register" value="Register" class="btn btn-lg btn-primary btn-block " />
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




  


