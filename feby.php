<?php
require_once "database/db.php";
$pageTitle = "Home";
$styles = ["feby.css"];
$scripts = [];

require_once "includes/header.php";
require_once "includes/navbar.php";

?>
<div class="clear"></div>
    <div class="father">
        <div class="cat">
            <div>
                <div class="cat-head">
                 <i class="fa-solid fa-magnifying-glass"></i>
                  <input  type="search" placeholder="search..." >
                </div>
               <div>
                <ol>
                    <li><a href="">hot drinks</a></li>
                    <li><a href="">cold drinks</a></li>
                    <li><a href="">food</a></li>
                    <li><a href="">cheese</a></li>
                </ol>
               </div>   
            </div>
            <div></div>
        </div>
        <div class="menue">
            <div class="menue-head"><p>coffe</p></div>
            <div class="two">
              <div class="item1">
                <div>
                    <div><img src="./lemon .jpg"></div>
                </div >
                <div class="sub-item">
                  <p>Panner Biriyani</p>
                  <div>50$</div>
                  <button>Choose</button>
                </div>
            </div>
            <div class="item2">
                <div >
                    <div><img src="./lemon .jpg"></div>
                </div>
                <div class="sub-item">
                  <p>Panner Biriyani</p>
                  <div>50$</div>
                  <button>Choose</button>
                </div>
            </div>
            </div>
           
        </div>
         <div class="cart">
            <div class="cart-head"> <p>Cart</p></div>
            <div></div>
            <div><button type="button">Cheack out</button></div>
          </div>
    </div>      
    <button class="learn" type="button">Learn More</button>


<?php include "../includes/footer.php";  ?>