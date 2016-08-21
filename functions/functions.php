<?php

define("DB_HOST","localhost");
define("DB_USER","root");
define("DB_PASS","12345");
define("DB_NAME","online");

define("ROOT_PATH","/on");
define("ROOT_URL","http://localhost/on");
//establish a connection to database
try{
    $con=new PDO("mysql:host=".DB_HOST.";dbname=". DB_NAME, DB_USER, DB_PASS);
}catch(PDOException $e){
	
	echo $e->getMessage();
}

function getIp() {

    $ip = $_SERVER['REMOTE_ADDR'];
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
   return $ip;
}

function cart(){
    global $con;
    $ip=getIp();
    if (isset($_GET['add_cart'])){
        $pro_id= $_GET['add_cart'];
        $query="select * from cart where ip_add= :ip_add AND p_id = :pro_id";
        $stmt=$con->prepare($query);
        $stmt->bindValue(':pro_id',$pro_id,PDO::PARAM_INT);
        $stmt->bindValue(':ip_add',$ip,PDO::PARAM_STR);
        $stmt->execute();
        $pros=$stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($pros))
        {
            
        }
        else{
            $query='INSERT INTO cart (p_id,ip_add)  VALUES(:p_id, :ip_add)';
            $stmt=$con->prepare($query);
            $stmt->bindValue(':p_id',$pro_id,PDO::PARAM_INT);
            $stmt->bindValue(':ip_add',$ip,PDO::PARAM_STR);
            $out=$stmt->execute();
            echo '<script>window.open("index.php","_self")</script>';
            
        }
    }
}
function total_items(){
    global $con;
    $ip=getIp(); 
    $query="select * from cart where ip_add= :ip_add ";
    $stmt=$con->prepare($query);
    $stmt->bindValue(':ip_add',$ip,PDO::PARAM_STR);
    $stmt->execute();
    $products=array();
    
    while ($item=$stmt->fetch(PDO::FETCH_ASSOC)){
            $pro_id=$item['p_id'];
            $query1="select * from products where product_id = :p_id ";
            $stmt1=$con->prepare($query1);
            $stmt1->bindValue(':p_id',$pro_id,PDO::PARAM_INT);
            $stmt1->execute();  
            $product=$stmt1->fetch(PDO::FETCH_ASSOC);
            $products[]=$product;
  
    }
    return $products;
}
 
function total_price(){
    global $con;
    $ip=  getIp();
    $query="select * from cart where ip_add= :ip_add ";
    $stmt=$con->prepare($query);
    $stmt->bindValue(':ip_add',$ip,PDO::PARAM_STR);
    $stmt->execute();
    $total_price=array();
    while ($item=$stmt->fetch(PDO::FETCH_ASSOC)){
    $pro_id=$item['p_id'];
    //after getting the product id ,we will use it to get the price of the product 
    $query1="select product_price from products where product_id = :p_id ";
    $stmt1=$con->prepare($query1);
    $stmt1->bindValue(':p_id',$pro_id,PDO::PARAM_INT);
    $stmt1->execute();
    if ($stmt1){ 
    $price=$stmt1->fetch(PDO::FETCH_COLUMN);
    $total_price[]=$price*$item['qty'];
    }
    else{
        $price=0;
    }
    
    $product_price[]=$price;
   
        }
    return array_sum($total_price);
   
    }
    
function getCats(){
    global $con;
    $query="select * from categories";
    $stmt=$con->prepare($query);
    $stmt->execute();
    $cats=$stmt->fetchAll(PDO::FETCH_ASSOC);
    return $cats;       
}
function getBrands(){
    global $con;
    $query="select * from brands";
    $stmt=$con->prepare($query);
    $stmt->execute();
    $brands=$stmt->fetchAll(PDO::FETCH_ASSOC);
    return $brands;       
}
function getCustomers(){
    global $con;
    $query="select * from customers";
    $stmt=$con->prepare($query);
    $out=$stmt->execute();
    if ($out){
        $customers=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $customers;       
    }

    }
function insertProduct(){
    global $con;
    
    //using prepare statements and binding values protestc against sql injection
    if (isset($_POST['insert_post'])){
    $post=  $_POST;
    $product_image=$_FILES['product_image']['name'];
    $product_image_tmp=$_FILES['product_image']['tmp_name'];
    $query='INSERT INTO products (product_title, product_cat, product_brand, product_price,product_desc,product_image,product_keywords) VALUES(:product_title, :product_cat, :product_brand, :product_price,:product_desc,:product_image,:product_keywords)';
    $stmt=$con->prepare($query);
    $stmt->bindValue(':product_title',$post['product_title'],PDO::PARAM_STR);
    $stmt->bindValue(':product_cat',$post['product_cat'],PDO::PARAM_INT);
    $stmt->bindValue(':product_brand',$post['product_brand'],PDO::PARAM_INT);
    $stmt->bindValue(':product_price',$post['product_price'],PDO::PARAM_INT);
    $stmt->bindValue(':product_desc',$post['product_desc'],PDO::PARAM_STR);
    $stmt->bindValue(':product_image',$product_image,PDO::PARAM_STR);
    $stmt->bindValue(':product_keywords',$post['product_keywords'],PDO::PARAM_STR);
    $out=$stmt->execute();
    if ($out){
        $uploaded=move_uploaded_file($product_image_tmp, "product_images/$product_image");
        if($uploaded){
            echo "<script>alert('product inserted')<script>";
    }
    
        }
}
}
function getPro(){
    global $con;
    if (isset($_GET['cat'])){
         $query="select * from products where product_cat= :cat_id";
         
         $stmt=$con->prepare($query);
         $stmt->bindValue(':cat_id',$_GET['cat'],PDO::PARAM_INT);

    }
    elseif (isset($_GET['brand'])) {

         $query="select * from products where product_brand= :brand_id";
         $stmt=$con->prepare($query);
         $stmt->bindValue(':brand_id',$_GET['brand'],PDO::PARAM_INT);
    }
    else
    {
        $query="select * from products order by RAND() LIMIT 0,6";
        $stmt=$con->prepare($query);
    }
    $stmt->execute();
    $products=$stmt->fetchAll(PDO::FETCH_ASSOC);
    if($products){
    return $products; 
    }
    else{
        echo "<h1>No available products</h1>";
    }
}
//this function is used to edit product as well in admin_area
function getDetails($product_id){
        global $con;
        $query="select * from products where product_id= :product_id";
        $stmt=$con->prepare($query);
        $stmt->bindValue(':product_id',$product_id,PDO::PARAM_INT);
        $stmt->execute();
        $product=$stmt->fetch(PDO::FETCH_ASSOC);
        var_dump($product);
        return $product;
       
}
function updateProduct(){
            //print_r($_POST);
        global $con;
    if (isset($_POST['edit_post'])){
        $product_id=$_POST['product_id'];
        $update_product="update products set product_title=:product_title,product_price=:product_price,product_brand=:product_brand,product_cat=:product_cat,product_desc=:product_desc,product_keywords=:product_keywords where product_id=:p_id";
        $stmt=$con->prepare($update_product);
        $stmt->bindValue(':product_title',$_POST['product_title'],PDO::PARAM_STR);
        $stmt->bindValue(':product_desc',$_POST['product_desc'],PDO::PARAM_STR);
        $stmt->bindValue(':product_keywords',$_POST['product_keywords'],PDO::PARAM_STR);
        $stmt->bindValue(':p_id',$product_id,PDO::PARAM_INT);
        $stmt->bindValue(':product_brand',$_POST['product_brand'],PDO::PARAM_INT);
        $stmt->bindValue(':product_cat',$_POST['product_cat'],PDO::PARAM_INT);
        $stmt->bindValue(':product_price',$_POST['product_price'],PDO::PARAM_INT);

        $t1=$stmt->execute();
            $p_image=$_FILES['product_image']['name'];
            $p_image_tmp=$_FILES['product_image']['tmp_name'];
        if (isset($p_image)){
            $update_image="update products set product_image=:product_image where product_id=:p_id";
            $stmt1=$con->prepare($update_image);
            $stmt1->bindValue(':p_id',$product_id,PDO::PARAM_INT);
            $stmt1->bindValue(':product_image',$p_image,PDO::PARAM_STR);
            $t2=$stmt1->execute();
            if ($t1 && $t2){
                $uploaded=move_uploaded_file($p_image_tmp, "product_images/$p_image");
                if ($uploaded){
                   echo "<script>alert('product has been uploaded successfully,thanks!')</script>";

                    
                }
            }
            
        }
    
    }
}
function editCategory(){
        global $con;
        $query="select * from categories where cat_id= :cat_id";
        $stmt=$con->prepare($query);
        $stmt->bindValue(':cat_id',$_GET['edit_cat'],PDO::PARAM_INT);
        $oo=$stmt->execute();
        if ($oo){
            $cat=$stmt->fetch(PDO::FETCH_ASSOC);
            return $cat;
        }else{
            echo '<h2>cannot retrieve data</h2>';
        }

        }
function updateCategory(){
    if (isset($_POST['edit_cat'])){
        global $con;
        $query="update categories set cat_title=:cat_title where cat_id=:c_id";
        $stmt=$con->prepare($query);
        $stmt->bindValue(':cat_title',$_POST['category_title'],  PDO::PARAM_STR);
        $stmt->bindValue(':c_id',$_GET['edit_cat'],  PDO::PARAM_INT);
        $output=$stmt->execute();
        if($output){
            echo "<script>alert('category has updated successfully!')</script>";
            echo "<script>window.open('index.php?view_cats','_self')</script>";

        }
        
        
    }
}
function editBrand(){
        global $con;
        $query="select * from brands where brand_id= :brand_id";
        $stmt=$con->prepare($query);
        $stmt->bindValue(':brand_id',$_GET['edit_brand'],PDO::PARAM_INT);
        $oo=$stmt->execute();
        if ($oo){
            $brand=$stmt->fetch(PDO::FETCH_ASSOC);
            return $brand;
        }else{
            echo '<h2>cannot retrieve data</h2>';
        }

        }
function updateBrand(){
    if (isset($_POST['edit_brand'])){
        global $con;
        $query="update brands set brand_title=:brand_title where brand_id=:brand_id";
        $stmt=$con->prepare($query);
        $stmt->bindValue(':brand_title',$_POST['brand_title'],  PDO::PARAM_STR);
        $stmt->bindValue(':brand_id',$_GET['edit_brand'],  PDO::PARAM_INT);
        $output=$stmt->execute();
        if($output){
            echo "<script>alert('brand has updated successfully!')</script>";
            echo "<script>window.open('index.php?view_brands','_self')</script>";

        }
        
        
}

        }
function insertCategory(){
    if (isset($_POST['insert_cat'])){
        global $con;
        $query='INSERT INTO categories (cat_title) VALUES(:cat_title)';
        $stmt=$con->prepare($query);
        $stmt->bindValue(':cat_title',$_POST['category_title'],  PDO::PARAM_STR);
        $output=$stmt->execute();
        if($output){
            echo "<script>alert('category has been added successfully!')</script>";

        }
        
}

        }
function insertBrand(){
    if (isset($_POST['insert_brand'])){
        global $con;
        $query='INSERT INTO brands (brand_title) VALUES(:brand_title)';
        $stmt=$con->prepare($query);
        $stmt->bindValue(':brand_title',$_POST['brand_title'],  PDO::PARAM_STR);
        $output=$stmt->execute();
        if($output){
            echo "<script>alert('brand has been added successfully!')</script>";

        }
        
    }    
}
function deleteProduct(){
        global $con;
        $delete_query="delete from products where product_id=:p_id";
            $stmt=$con->prepare($delete_query);
            $stmt->bindValue(':p_id',$_GET['delete_pro'],  PDO::PARAM_INT);
            $exec=$stmt->execute();
            if ($exec){
                    echo "<script>alert('product deleted successfully!')</script>";
                    //_window.open =>opens new window,_self replaces current window with the new window
                    echo "<script>window.open('index.php?view_products','_self')</script>";

            
            }
        
    }
function deleteCat(){
        global $con;
        $delete_query="delete from categories where cat_id=:c_id";
            $stmt=$con->prepare($delete_query);
            $stmt->bindValue(':c_id',$_GET['delete_cat'],  PDO::PARAM_INT);
            $exec=$stmt->execute();
            if ($exec){
                    echo "<script>alert('category deleted successfully!')</script>";
                    //_window.open =>opens new window,_self replaces current window with the new window
                    echo "<script>window.open('index.php?view_categories','_self')</script>";

            
            }
        
    }
function deleteBrand(){
        global $con;
        $delete_query="delete from brands where brand_id=:b_id";
            $stmt=$con->prepare($delete_query);
            $stmt->bindValue(':b_id',$_GET['delete_brand'],  PDO::PARAM_INT);
            $exec=$stmt->execute();
            if ($exec){
                    echo "<script>alert('brand deleted successfully!')</script>";
                    //_window.open =>opens new window,_self replaces current window with the new window
                    echo "<script>window.open('index.php?view_','_self')</script>";

            
            }
        
    }    
function get_all_products(){
        global $con;
        $query="select * from products ";
        $stmt=$con->prepare($query);
        $stmt->execute();
        $all_products=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $all_products;
    
}

function searchProducts(){
    global $con;
    if (isset($_GET['search'])){
        $user_query=$_GET['user_query'];
        $query="select * from products where product_keywords like :product_keywords ";
        $stmt=$con->prepare($query);

        $stmt->bindValue(':product_keywords',"%$user_query%",PDO::PARAM_STR);
        $stmt->execute();
        $products=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }
}/*
function updateCart(){
    global $con;
    $IP=  getIp();
    if (isset($_POST['update_cart'])){
        print_r($_POST['update_cart']);

    foreach ($_POST['remove'] as $remove_id){
            $delete_query="delete from cart where p_id=:remove_id and ip_add=:ip";
            var_dump($delete_query);
            $stmt=$con->prepare($delete_query);
            $stmt->bindValue(':remove_id',"$remove_id",PDO::PARAM_INT);
            $stmt->bindValue(':ip',"$IP",PDO::PARAM_STR);
            $output=$stmt->execute();
            if ($output){
                //refresh the page by redirecting it to same page _self variable
               // echo '<script>window.open("cart.php","_self")</script>';
    echo "<script>window.location.href='cart.php'</script>";
                }
  }
    
    }            }
*/
function updateQty(){
    global $con;
    $ip=  getIp();
    if ((isset($_POST['update_cart']))){
         foreach ($_POST['id'] as $key=>$id){
             if(!empty($_POST['remove'][$key])){
                $delete_query="delete from cart where p_id=:remove_id and ip_add=:ip";
                $stmt=$con->prepare($delete_query);
                $stmt->bindValue(':remove_id',"$id",PDO::PARAM_INT);
                $stmt->bindValue(':ip',"$ip",PDO::PARAM_STR);
                $output=$stmt->execute();
                if ($output){
                //refresh the page by redirecting it to same page _self variable
               // echo '<script>window.open("cart.php","_self")</script>';
                    echo "<script>window.location.href='cart.php'</script>";                 
             }
             
                }
             if (!empty($_POST['qty'][$key])){
                $qty=$_POST['qty'][$key];
                $update_query="update cart set qty=:qty where p_id=:p_id and ip_add=:ip_add";
                $stmt=$con->prepare($update_query);
                $stmt->bindValue(':qty',"$qty",PDO::PARAM_INT);
                $stmt->bindValue(':p_id',$id,PDO::PARAM_INT);
                $stmt->bindValue(':ip_add',$ip,PDO::PARAM_STR);
                $stmt->execute();
                if ($stmt->execute()){
                //refresh the page by redirecting it to same page _self variable
             //echo '<script>window.open("cart.php","_self")</script>';
                echo "<script>window.location.href='cart.php'</script>";
                 }
             }
                         }
        }

        $query3="select qty from cart where ip_add= :ip";
        $stmt=$con->prepare($query3);
        $stmt->bindValue(':ip',$ip,PDO::PARAM_STR);
        $stmt->execute();
        $qty_array=$stmt->fetchAll(PDO::FETCH_COLUMN);            
        return $qty_array;
             }
             
    function register(){
        global $con;
        if (isset($_POST['register'])){
            $ip=  getIp();
            $c_image=$_FILES['c_image']['name'];
            $c_image_tmp=$_FILES['c_image']['tmp_name'];
            $query='INSERT INTO customers (customer_ip, customer_name, customer_email, customer_pass,customer_country,customer_city,customer_contact,customer_address,customer_image) VALUES(:ip, :c_name, :c_email, :c_pass,:c_country,:c_city,:c_contact,:c_address,:c_image)';
            $stmt=$con->prepare($query);
            $stmt->bindValue(':ip',$ip,PDO::PARAM_STR);
            $stmt->bindValue(':c_name',$_POST['c_name'],PDO::PARAM_STR);
            $stmt->bindValue(':c_email',$_POST['c_email'],PDO::PARAM_STR);
            $stmt->bindValue(':c_pass',$_POST['c_pass'],PDO::PARAM_STR);
            $stmt->bindValue(':c_country',$_POST['c_country'],PDO::PARAM_STR);
            $stmt->bindValue(':c_city',$_POST['c_city'],PDO::PARAM_STR);
            $stmt->bindValue(':c_contact',$_POST['c_contact'],PDO::PARAM_STR);
            $stmt->bindValue(':c_address',$_POST['c_address'],PDO::PARAM_STR);
            $stmt->bindValue(':c_image',$c_image,PDO::PARAM_STR);
    
            $out=$stmt->execute();
    if ($out){
        move_uploaded_file($c_image_tmp, "customer/customer_images/$c_image");
        $sel_cart="select * from cart where ip_add =:ip";
        $stmt_sel=$con->prepare($sel_cart);
        $stmt_sel->bindValue(':ip',$ip,PDO::PARAM_STR);
        $oo=$stmt_sel->execute();
        $out_cart=$stmt_sel->fetchAll(PDO::FETCH_ASSOC);
        $out_count=  count($out_cart);
        if($out_count == 0){
            $_SESSION['customer_email']=$_POST['c_email'];
            $_SESSION['customer_name']=$_POST['c_name'];

            echo "<script>alert('account has been created successfully,thanks!')</script>";
            echo "<script>window.location.href('account.php')</script>";            

            
            
        }else{
           $_SESSION['customer_email']=$_POST['c_email'];
           $_SESSION['customer_name']=$_POST['c_name'];

            echo "<script>alert('account has been created successfully,thanks!')</script>";
            echo "<scriptwindow.location.href(('checkout.php')</script>";
            
        }

        
        //echo "<script>window.open('cart.php','_self')</script>";
    }
            
        }
        
    }
    function login(){
        global $con;
        $ip=  getIp();
        if (isset($_POST['login'])){
            $sel_query="select * from customers where customer_email=:c_email and customer_pass=:c_pass";
            $stmt=$con->prepare($sel_query);
            $stmt->bindValue(':c_email',$_POST['c_email'],PDO::PARAM_STR);
            $stmt->bindValue(':c_pass',$_POST['c_pass'],PDO::PARAM_STR);
            $out=$stmt->execute();
            if($out){
            $user=$stmt->fetch(PDO::FETCH_ASSOC); 
            $_SESSION['customer_name']=$user['customer_name'];
            $_SESSION['customer_email']=$user['customer_email'];
            //////////////////////////
            $sel_cart="select * from cart where ip_add =:ip";
            $stmt_sel=$con->prepare($sel_cart);
            $stmt_sel->bindValue(':ip',$ip,PDO::PARAM_STR);
            $oo=$stmt_sel->execute();
            if ($oo){
                echo "<script>alert('you logged in successfully,thanks!')</script>";
                echo "<script>window.open('checkout.php','_self')</script>";   
            }else{
                echo "<script>alert('you logged in successfully,thanks!')</script>";
                echo "<script>window.open('account.php','_self')</script>";
                
            }
            }else{
                echo '<script>alert("password or email not correct")</h3>';
            }
            
        }
        
        
    }
    function customerData(){
        global $con;
        $sel_query="select * from customers where customer_email=:c_email ";
        $stmt=$con->prepare($sel_query);
        $stmt->bindValue(':c_email',$_SESSION['customer_email'],PDO::PARAM_STR);
        $out=$stmt->execute();
        if($out){
            $user=$stmt->fetch(PDO::FETCH_ASSOC); 
            return $user;    
            
            }
    }
    function updateAccount(){
        global $con;
        $c_email=$_SESSION['customer_email'];

        if (isset($_POST['update'])){
           $update_query="update customers set customer_name=:c_name,customer_city=:c_city,customer_address=:c_address where customer_email=:c_email";
           $stmt=$con->prepare($update_query);
           $stmt->bindValue(':c_name',$_POST['c_name'],  PDO::PARAM_STR);
           $stmt->bindValue(':c_city',$_POST['c_city'],  PDO::PARAM_STR);
           $stmt->bindValue(':c_address',$_POST['c_address'],  PDO::PARAM_STR);
           $stmt->bindValue(':c_email',$c_email,  PDO::PARAM_STR);
 
           $out=$stmt->execute();
            if (isset($_POST['c_image'])){
            $update_image="update customers set customer_image=:c_image where customer_email=:c_email";
            $stmt1=$con->prepare($update_image);
            $stmt1->bindValue(':c_image',$_FILES['c_image']['name']);
            $stmt1->bindValue(':c_email',$c_email);
            $out2=$stmt1->execute();

           }
           if ($out && $out2){
               move_uploaded_file($_FILES['c_image']['tmp_name'], "customer/customer_images/"+$_FILES['c_image']['name']);
               echo "<script>alert('your info updated successfully!')</script>";
               echo "<script>window.open('account.php','_self')</script>";

           }


        }
        
    }
    function updatePasswd(){
        global $con;
        if (isset($_POST['update_passwd'])){
                    $user=customerData();
        if ($_POST['c_pass'] == $user['customer_pass']){
            if ($_POST['c_pass1'] == $_POST['c_pass2']){

                $update_passwd="update customers set customer_pass=:c_pass1 where customer_email=:c_email";
                $stmt_update=$con->prepare($update_passwd);
                $stmt_update->bindValue(':c_pass1',$_POST['c_pass1'],PDO::PARAM_STR);
                $stmt_update->bindValue(':c_email',$_SESSION['customer_email'],PDO::PARAM_STR);

                $out3=$stmt_update->execute();
      
                if ($out3){
                    echo "<script>alert('password updated successfully!')</script>";
                    echo "<script>window.open('account.php','_self')</script>";
                    
                }

            }
        }
                
        }
        
    }
function deleteAccount(){
        global $con;
        if (isset($_POST['yes'])){
            $delete_query="delete from customers where customer_email=:c_email";
            $stmt=$con->prepare($delete_query);
            $stmt->bindValue(':c_email',$_SESSION['customer_email'],  PDO::PARAM_STR);
            $exec=$stmt->execute();
            if ($exec){
                    echo "<script>alert('account deleted successfully!')</script>";
                    session_destroy();
                    echo "<script>window.open('index.php','_self')</script>";

            
            }
            
        }
            if (isset($_GET['delete_customer'])){
            $delete_query="delete from customers where customer_id=:c_id";
            $stmt=$con->prepare($delete_query);
            $stmt->bindValue(':c_id',$_GET['delete_customer'],  PDO::PARAM_STR);
            $exec=$stmt->execute();
            if ($exec){
                    echo "<script>alert('customer deleted successfully!')</script>";
                    session_destroy();
                    echo "<script>window.open('index.php?view_customers','_self')</script>";

            
            }
}

            }
?>
