
<?php login(); ?> 

        <div class="card card-container">
                    <h3 class="card-title">Login or Register to buy</h3>            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form method="post" action="checkout.php" class="form-signin">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" name="c_email" class="form-control" placeholder="Email address" required autofocus>
                <input type="password"  name="c_pass" class="form-control" placeholder="Password" required>
                <a href="checkout.php?forgot_pass" >forgot password
                </a>
                <div  class="checkbox" >
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
                <input type="submit" name="login" value="login" class="btn btn-lg btn-primary btn-block " />

            </form>
            <h5><a href="register.php">New?Register here</a>
            </h5>
        </div>
  


