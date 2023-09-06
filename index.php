<?php
session_start();
 
require_once "db.php";
require_once "functions.php";

mysqli_query($connection,"set names utf8");
$query="select * from shourma";
$req = mysqli_query($connection, $query);
$data_from_db = [];
while($result = mysqli_fetch_assoc($req)){
$data_from_db[]=$result;
}
//var_dump($data_from_db);


$query="select * from burger";
$req = mysqli_query($connection, $query);
$data_from_db2 = [];
while($result = mysqli_fetch_assoc($req)){
$data_from_db2[]=$result;
}
//var_dump($data_from_db2);

$query="select * from sendvich";
$req = mysqli_query($connection, $query);
$data_from_db3 = [];
while($result = mysqli_fetch_assoc($req)){
$data_from_db3[]=$result;
}
//var_dump($data_from_db3);

$query="select * from tatmak";
$req = mysqli_query($connection, $query);
$data_from_db4 = [];
while($result = mysqli_fetch_assoc($req)){
$data_from_db4[]=$result;
}
//var_dump($data_from_db4);



if (isset($_GET['delete_id']) && isset($_SESSION['cart_list'])){

    foreach ($_SESSION['cart_list'] as $key=>$value){
        if ($value['id']==$_GET['delete_id']){
            unset($_SESSION['cart_list'][$key]);  }   
        }
    }
 # $key записивается индекс а на $value массив   unset-удаляет из памяти рнр данную историю
 # удалить элемент массива нужним ключиком $key


if (isset($_GET['course_id']) && !empty($_GET['course_id'])){

$current_add=get_by_id($_GET['course_id']);


if (!empty($current_add)){
    if ( !isset($_SESSION['cart_list'])){
      $_SESSION['cart_list'][]=$current_add;
    }
# добавляем в конец массива данные на cart list когда 1-ый товар, если есть уже товар это не выполняется



    $c_check=false;

    if (isset($_SESSION['cart_list'])){
         foreach ($_SESSION['cart_list'] as $value){
               if ($value['id']==$current_add['id']){
                 $c_check=true;
              }      }
            }
# если id товаров из базы и из корзини совпадают то добавляем на корзину товаров чтоб не дублировались товары
    if (!$c_check) {
         $_SESSION['cart_list'][]=$current_add;
    }  
}   
    else  { header("Location:404.php");} 
}
 
  








?>


 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <link rel="stylesheet" type="text/css" href="css/modal.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600&&display=swap"
    rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;600;700;800;900&display=swap"
    rel="stylesheet">
    
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;600;700;800;900&display=swap"
    rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="icon" href="favicon.png">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet"   href="css/media_1024.css" media="all and (max-width:1024px)">
  <link rel="stylesheet"   href="css/media_900.css" media="all and (max-width:900px)">
  <link rel="stylesheet" href="css/media_768.css" media="all and (max-width:768px)">
 <link rel="stylesheet" href="css/media_640.css" media="all and (max-width:640px)">
   <link rel="stylesheet" href="css/media_480.css" media="all and (max-width:480px)">
   <link rel="stylesheet" href="css/media_420.css" media="all and (max-width:420px)">
   <link rel="stylesheet" href="css/media_380.css" media="all and (max-width:380px)">
   <script src="http://code.jquery.com/jquery-3.5.1.min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

 
    <title>DonerBig</title>
</head>
<body>
<div class="section">
 
 
  <div class="content">
     <input type="checkbox" id="toggle">
<label for="toggle"><i class="fa fa-bars" aria-hidden="true"></i>  </label>
<div class="header">
  <div class="nav">
 <div class="navbar">
  <ul class="ul1">
  <li class="li1"><img src="/img/1.png"></li>
  <li class="li2"><table><tr><td>Доставка по городу <b>Благовещенску </td><td><img src="/img/2.png"></td></tr>
                         <tr><td>10<sup>00</sup>-23<sup>00</sup> без выходных</td><td></td></tr></table>
       
     </li>
  <li  class="li3">
    <table><tr><td><a class="tel"><i class="fa fa-phone" aria-hidden="true"></i>
 (+7) 9273224414 </a> </td></tr>
   <tr><td>
 <a class="carz" href="#openModal">Корзина<span id="cart_count" class="span_id">
<?php 
if (isset($_SESSION['cart_list'])){
echo count($_SESSION['cart_list']);}?>
</span></a>
</td></tr></table>
</li>
  </ul>

 







 </div>
</div>
</div> <!--- end header ----->

<div id="openModal" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">  Ваш заказ </h3>
        <a href="#close" title="Close" class="close">×</a>
      </div>
      <div class="modal-body">    
 
  
 <div class="cart-wrapper">
 

<?php
if (isset($_SESSION['cart_list']) && count($_SESSION['cart_list']) !=0):?>
  <ul class="nav"> 
<li class="l1">Наименование</li>
<li class="l2">Цена за шт.</li>
<li class="l3">Количество</li>
<li class="l4">Сумма</li>
<li class="l5">  </li>
  </ul>

  <?php foreach($_SESSION['cart_list'] as $product) :?>
 <div class="item_grid">
      <div class="item_img">    <img src="<?php echo $product["img"]?>"> </div>    </li> 
      <div class="item_title"><b><?php echo $product['title'];?> </b></div>
      <div class="item_text"> <?php echo $product['text'];?> </div>  
      <div class="item_price">    <?php echo $product['price'];?> <i class="fa fa-rub" aria-hidden="true"></i>   </div> 
      <div class="item_timer">  <div class="timer"> <button class="minus" data-action="minus" >-</button> <b data-counter><?php echo $product['counter'];?> </b> <button class="plus" data-action="plus">+</button></div> </div>       
      <div class="item_price-all">    <?php echo $product['price'];?> <i class="fa fa-rub" aria-hidden="true"></i>  </div> 
      <div class="item_delete"> <a href="index.php?delete_id=<?php echo $product['id'];?>"><i class="fa fa-trash-o" aria-hidden="true"></i> </a> </div>
 </div>
  <?php endforeach;?>
  <p class="summa"> Итого :  <span class="total-price">0</span>&ensp;<i class="fa fa-rub" aria-hidden="true"></i></p>
<div class=foot>
<a class="right" href="index.php">Оформить заказ <i class="fa fa-angle-right" aria-hidden="true"></i></a>
 <a class="left"   title="Close" href="#close"><i class="fa fa-angle-left" aria-hidden="true"></i> Вернутся в каталог </a>   
</div> 
<?php else: ?>
      <p class="empty"> Ваша корзина пока пуста</p>
    <a class="empty-left" href="index.php">В каталог </a>
<?php endif; ?>

</div>
 
 



      </div> <!---- end modal-body--->
    </div>  <!---- end modal-content--->
  </div>  <!---- end modal-dialog--->
</div>  <!---- end modal-modal--->
 
 

 

 
 
<script src="js/calcPrice.js"></script>
         <script src="js/counter.js"></script>
 
<div class="main"> 
  <div class="carusel">
  <div class="img-slider">
      <div class="slide active">
        <img class="img1" src="/img/sl1.jpg" alt="">
        <div class="info">
          <h2> Шаурмы</h2>
          <p><img class="img2" src="/img/sl.png"></p>
        </div>
      </div>
      <div class="slide">
          <img class="img1" src="/img/sl2.jpg" alt="">
        <div class="info">
          <h2>  Бургеры</h2>
          <p><img class="img2" src="/img/sl.png"></p>
        </div>
      </div>
      <div class="slide">
         <img class="img1" src="/img/sl3.jpg" alt="">
        <div class="info">
          <h2> Шаурмы</h2>
          <p><img class="img2" src="/img/sl.png"></p>
        </div>
      </div>
      <div class="slide">
     <img class="img1" src="/img/sl4.jpg" alt="">
        <div class="info">
          <h2>Крылышки</h2>
          <p><img class="img2" src="/img/sl.png"></p>
        </div>
      </div>
      
      <div class="navigation">
        <div class="btn active"></div>
        <div class="btn"></div>
        <div class="btn"></div>
        <div class="btn"></div>
        
      </div>
    </div>

    
       

</div>

</div>
 


 
<div class="zakaz">
  <div class="zakazchik">
    <div class="text1">
<div class="kak">
 
  <a>Как заказать?</a> <img class="korzina" src="img/Korzina2.png">
  <br><br>
  <p> Вы можете позвонить нам по номеру <span> (+7)9273224414</span>  <br>  и оставить нам свой заказ</p>
    
 </div>
    </div>
    <div class="text2">
    
    <p>Добро пожаловать к нам, <br> у нас вкусно и не дорого.</p>
    <img src="img/shef.png">
    </div>
    
 
  
  </div>
</div>
 
<div class="container"> 
  <div class="wrapper">
    <div id="shaurma" class="title_text"> Шаурмы </div>  

 <?php foreach($data_from_db as $item): ?>
         <div class="item">
        <div class="item_1">
          <img src="<?php echo $item["img"]?>">
          <div class="text"><span> <?php echo $item["title"]?></span><br><a><?php echo $item["text"]?></a></div>
          <div class="price"><h3><?php echo $item["price"]?>&ensp;<i class="fa fa-rub" aria-hidden="true"></i></h3></div>
            <div class="counter">1</div>
          <button class="add-card" data-id="<?php echo $item["id"]?>"><span class="vb">Выбрать</span></button> 
          </div>
        </div>
 <?php endforeach; ?>
 
</div><!---end wrapper--->

<div class="midle"></div>


<div class="wrapper">
    <div id="shaurma" class="title_text"> Бургеры </div>  

 <?php foreach($data_from_db2 as $item): ?>
         <div class="item">
        <div class="item_1">
          <img src="<?php echo $item["img"]?>">
          <div class="text"><span> <?php echo $item["title"]?></span><br><a><?php echo $item["text"]?></a></div>
          <div class="price"><h3><?php echo $item["price"]?>&ensp;<i class="fa fa-rub" aria-hidden="true"></i></h3></div>
         <button class="add-card" data-id="'.$item["id"].'"><span class="vb">Выбрать</span></button> 
       
			 
        </div>
        </div>
 <?php endforeach; ?>
 
</div><!---end wrapper--->




<div class="midle"></div>
   
<div class="wrapper">
    <div id="shaurma" class="title_text"> Сэндвичи </div>  

 <?php foreach($data_from_db3 as $item): ?>
         <div class="item">
        <div class="item_1">
          <img src="<?php echo $item["img"]?>">
          <div class="text"><span> <?php echo $item["title"]?></span><br><a><?php echo $item["text"]?></a></div>
          <div class="price"><h3><?php echo $item["price"]?>&ensp;<i class="fa fa-rub" aria-hidden="true"></i></h3></div>
        
          <button class="add-card" data-id="'.$item["id"].'"><span class="vb">Выбрать</span></button>
         
        </div>
        </div>
 <?php endforeach; ?>
 
</div><!---end wrapper--->


<div class="midle"></div>
   
 <div class="wrapper">
    <div id="shaurma" class="title_text"> Другие.. </div>  

 <?php foreach($data_from_db4 as $item): ?>
         <div class="item">
        <div class="item_1">
          <img src="<?php echo $item["img"]?>">
          <div class="text"><span> <?php echo $item["title"]?></span><br><a><?php echo $item["text"]?></a></div>
          <div class="price"><h3><?php echo $item["price"]?>&ensp;<i class="fa fa-rub" aria-hidden="true"></i></h3></div>
          <button class="add-card" data-id="'.$item["id"].'"><span class="vb">Выбрать</span></button>
         
        </div>
        </div>
 <?php endforeach; ?>
 
</div><!---end wrapper--->   

<div class="midle"></div>
   



 

 

  </div> <!-----end container   -->


 

 
 </div>  <!-----end content   -->
  <div class="footer">
        <div class="finish">
        <div class="ff"> 
<div class="f1"><img src="/img/5.png" alt=""></div>


<div class="f1">
<ul class="menu">
  <li><b>Меню</b></li>
  <li><a href="">Шаурма</a></li>
  <li><a href="">Напитки</a></li>
</ul>


</div>
<div class="f1">
<ul class="contact">
  <li><b>Контакты</b></li>
  <li>Тел:&ensp;(+7) 9273224414 </li>
  <li>Адрес:&ensp; г.Благовещенск, Седова 112/2</li>
</ul>

</div>
<div class="f1">
<div class="social-container">
<a href="#" class="twitter"><i class="fa fa-vk fa-2x"></i>Вконтакте</a>
<a href="#" class="facebook"><i class="fa fa-facebook"></i>Facebook</a>
<a href="#" class="twitter"><i class="fa fa-odnoklassniki fa-2x"></i>Одноклассники</a>
<a href="#" class="whatsapp"><i class="fa fa-whatsapp" aria-hidden="true"></i>
Whatsapp</a>
</div>
</div>



</div>
      </div>
     <div class="inline">
     <a> © 2023. DonerBig </a>
      <img src="/img/f.png" alt="">
     </div>
  </div> <!---end footer------->
  
</div>  <!-----end section  -->

 
    <script src="js/cart.js"></script>
</body>


<script type="text/javascript">
    var slides = document.querySelectorAll('.slide');
    var btns = document.querySelectorAll('.btn');
    let currentSlide = 1;

    // Javascript for image slider manual navigation
    var manualNav = function(manual){
      slides.forEach((slide) => {
        slide.classList.remove('active');

        btns.forEach((btn) => {
          btn.classList.remove('active');
        });
      });

      slides[manual].classList.add('active');
      btns[manual].classList.add('active');
    }

    btns.forEach((btn, i) => {
      btn.addEventListener("click", () => {
        manualNav(i);
        currentSlide = i;
      });
    });

    // Javascript for image slider autoplay navigation
    var repeat = function(activeClass){
      let active = document.getElementsByClassName('active');
      let i = 1;

      var repeater = () => {
        setTimeout(function(){
          [...active].forEach((activeSlide) => {
            activeSlide.classList.remove('active');
          });

        slides[i].classList.add('active');
        btns[i].classList.add('active');
        i++;

        if(slides.length == i){
          i = 0;
        }
        if(i >= slides.length){
          return;
        }
        repeater();
      }, 5000);
      }
      repeater();
    }
    repeat();




 















    </script>
 
</html>



