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
function insertProduct(){
    global $con;
    
    //using prepare statements and binding values protestc against sql injection
    if (isset($_POST['insert_post'])){
    $post=  filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
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
        move_uploaded_file($product_image_tmp, "product_images/$product_image");
        echo "<script>alert('product inserted')<script>";
        echo "<script>window.open('insert_product.php','_self')</script>";
    }
}
}
function getPro(){
    global $con;/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
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
function getDetails($product_id){
        global $con;
        $query="select * from products where product_id= :product_id";
        $stmt=$con->prepare($query);
        $stmt->bindValue(':product_id',$product_id,PDO::PARAM_INT);
        $stmt->execute();
        $product=$stmt->fetch(PDO::FETCH_ASSOC);
        return $product;
       
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
        print_r($_POST);
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
            echo "<script>alert('account has been created successfully,thanks!')</script>";
            echo "<script>window.open('account.php','_self')</script>";            
        }else{
            echo "<script>alert('account has been created successfully,thanks!')</script>";
            echo "<script>window.open('checkout.php','_self')</script>";
            
        }

        
        //echo "<script>window.open('cart.php','_self')</script>";
    }
            
        }
        
    }
?>
