<?php 
require ('../functions/functions.php');


adminLogin(); ?>  
<head>
        <title>
            admin panel
        </title>
         <link href="../styles/bootstrap.css" rel="stylesheet"/>       
                 <script src="../js/jquery.min.js"></script> 
                <link rel="stylesheet" href="css/style.css"/>

               <script src="../js/bootstrap.min.js"></script> 


    </head> 
<div class="login">
	<h1> Admin Login</h1>
    <form method="post">
    	<input type="email" name="email" placeholder="Email" required="required" />
        <input type="password" name="pass" placeholder="Password" required="required" />
        <button type="submit" name="admin_login" value="Login" class="btn btn-primary btn-block btn-large">Let me in.</button>
    </form>
</div>