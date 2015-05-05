<?php
    // Local connection (comment out when deploying to live server)
    mysql_connect("localhost","rezinunts","Mungching1!") or die(mysql_error());
    mysql_select_db("mmistudios_store") or die(mysql_error());

    // Live connection (uncomment when deploying to live server)
    /*mysql_connect("68.178.143.153","mmistudioscom","DrJ0n3s1!") or die(mysql_error());
    mysql_select_db("mmistudioscom") or die(mysql_error());*/

    //////////////////////////
    //  CART ITEMS DISPLAY  //
    //////////////////////////
    $cartDisplayList = ""; // Initialize the variable for displaying a list of items in the cart
    $cartDisplayNone = ""; // Initialize the variable for displaying message when cart is empty
    $cartDisplayLink = ""; // Initialize the variable for displaying the link to the cart page

    if(isset($_SESSION['cart'])) {
        $sqlCart = "SELECT * FROM mmi_products WHERE id IN (";
            foreach($_SESSION['cart'] as $id => $value) {
                $sqlCart .= $id . ",";
            }
            $sqlCart = substr($sqlCart, 0, -1) . "
        ) ORDER BY id ASC";
        $queryCart = mysql_query($sqlCart);  
        while($row = mysql_fetch_array($queryCart)){
            $id = $row["id"];
            $artist = $row["artist"];
            $title = $row["title"];
            $cat_num = $row["cat_num"];
            $description = $row["description"];
            $img = $row["img"];
            $content = $row["content"];
            $physical = $row["physical"];
            $digital = $row["digital"];
            $third_party = $row["third_party"];
            $cartDisplayList .='
                <p class="cart-sidebar">' . $title . ' ' . $_SESSION['cart'][$id]['format'] . '<span class="small orange-group"> x ' . $_SESSION['cart'][$id]['quantity'] . '</span></p>
            ';
        }
    } else {
        $cartDisplayNone .='
            <p class="cart-sidebar">Your cart is empty.</p>
        ';
    }
    if(!empty($cartDisplayList)) {
        $cartDisplayLink .='
            <a href="index.php?page=cart">Go to Cart</a>
        '; 
    } else {
        $cartDisplayLink .= '
            <p class="cart-sidebar orange-group">Add something to the cart!</p>
        ';
    }

    //////////////////////////////
    //  PRODUKT SLIDER DISPLAY  //
    //////////////////////////////
    $sqlTalks = mysql_query("SELECT * FROM mmi_products WHERE category != 'Shipping' ORDER BY cat_num DESC");
    $produktsSlider = ""; // Initialize the variable to display the produkt slider
    while($row = mysql_fetch_array($sqlTalks)){
        $id = $row["id"];
        $category = $row["category"];
        $artist = $row["artist"];
        $title = $row["title"];
        $cat_num = $row["cat_num"];
        $description = $row["description"];
        $img = $row["img"];
        $content = $row["content"];
        $price = $row["price"];
        $third_party = $row["third_party"];
        $produktsSlider .='
            <li>
                <div class="produkts-side">
                    <a href="javascript:RequestContent(' . $content . ')" class="produkt-button">
                        <img src="imgs/albums/' . $img . '" alt="' . $title . '" class="img-responsive img-thumbnail center-block produkt-side">
                    </a>
                    <a href="javascript:RequestContent(' . $content . ')" class="produkt-button">
                        <h5>' . $title . '</h5>
                    </a>
                    <a href="index.php?page=produkts&action=add&id=' . $id . '" class="btn btn-info btn-buy btn-block pull-right">Add To Cart - $' . $price . ' (' . $category . ')</a>
                    <h4 class="produkt-items text-center">Or Via 3rd Party:</h4>
                    <p class="text-center" style="font-size: 0.9em;">' . $third_party . '</p>
                </div>
            </li>
        ';
    }
?>
<div class="col-md-3 pull-right">
    <h3>Your Cart</h3>
    <?php print "$cartDisplayList"; ?>
    <?php print "$cartDisplayNone"; ?>
    <?php print "$cartDisplayLink"; ?>
    <h3>Produkts</h3>
    <!-- product slider -->
    <div class="ajax-loader">
        <img src="imgs/ajax-loader.gif" alt="Loading..." class="img-responsive center-block loading-graphic">
    </div>
    <ul id="produkts-slider" class="remove-padding hidden-content">
        <?php print "$produktsSlider"; ?>
    </ul>
</div>