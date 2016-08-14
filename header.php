    <head>
        <title>
            online store
        </title>
         <link href="styles/bootstrap.css" rel="stylesheet"/>       
        <link rel="stylesheet" href="bower_components/bootstrap-select/dist/css/bootstrap-select.min.css" />
                 <script src="js/jquery.min.js"></script> 

               <script src="js/bootstrap.min.js"></script> 

        <script src="bower_components/bootstrap-select/dist/js/bootstrap-select.min.js" ></script>
           <link rel="stylesheet" href="styles/style.css" media="all"/>

    </head>           
<div class="header_wrapper">
                <div>
                    <img class="logo" src="images/target.jpg"/>
                    <img class="banner" src="images/banner.jpg"/>
                </div>
            </div>
            
            <div class="menubar">
                <ul id="menu">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="all_products.php">All products</a></li>
                    <li><a href="account.php">My account</a></li>
                    <li><a href="register.php">sign up</a></li>
                    <li><a href="cart.php">shopping cart</a></li>
                    <li><a href="#">contact us</a></li>
                </ul>
                <div id="form">
                    <form method="get" action="results.php" enctype="multipart/form-data">
                        <input type="text" name="user_query" placeholder="search for a product"/>
                        <input type="submit" name="search" value="search"/>
                    </form>
                </div>
            </div>