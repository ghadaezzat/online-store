<?php


require 'config.php';
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
?>
