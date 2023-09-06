<?php

session_start();
require_once "db.php";
require_once "functions.php";
 
if (isset($_POST['course_id'])){
    $current_add=get_by_id($_POST['course_id']);  // данные полученнҷе по  id 
    $current_cart_value=0;
    if ( !isset($_SESSION['cart_list'])){
      $_SESSION['cart_list'][]=$current_add;  // на новую сессия добавим товары по полученном id
      $current_cart_value=count($_SESSION['cart_list']);
    }
# добавляем в конец массива данные на cart list когда 1-ый товар, если есть уже товар это не выполняется

    $c_check=false;

    if (isset($_SESSION['cart_list'])){
         foreach ($_SESSION['cart_list'] as $value){
               if ($value['id']==$current_add['id']){
                echo $value[text];
                 $c_check=true;                
                            }    
            }
          
# если id товаров из базы и из корзини совпадают то добавляем на корзину товаров чтоб не дублировались товары
    if (!$c_check) {
         $_SESSION['cart_list'][]=$current_add;
             $current_cart_value=count($_SESSION['cart_list']); // количество товаров
    } 
$current_cart_value=count($_SESSION['cart_list']); 

}
echo $current_cart_value;
}   
 


?>