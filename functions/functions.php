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
    global $con;
    $query="select * from products order by RAND() LIMIT 0,6";
    $stmt=$con->prepare($query);
    $stmt->execute();
    $products=$stmt->fetchAll(PDO::FETCH_ASSOC);
    return $products; 
            
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
?>
