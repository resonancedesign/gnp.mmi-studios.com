<?php
	// Local connection (comment out when deploying to live server)
    mysql_connect("localhost","rezinunts","Mungching1!") or die(mysql_error());
    mysql_select_db("mmistudios_store") or die(mysql_error());

    // Live connection (uncomment when deploying to live server)
    /*mysql_connect("68.178.143.153","mmistudioscom","DrJ0n3s1!") or die(mysql_error());
    mysql_select_db("mmistudioscom") or die(mysql_error());*/

	///////////////////////////
    //  ADD PRODUKT TO CART  //
    ///////////////////////////
	if(isset($_GET['action']) && $_GET['action'] == "add") {
		$id = intval($_GET['id']);
		if(isset($_SESSION['cart'][$id])) {
			$_SESSION['cart'][$id]['quantity']++;
		} else {
			$sqlAdd = "SELECT * FROM mmi_products WHERE id={$id}";
			$queryAdd = mysql_query($sqlAdd);

			if(mysql_num_rows($queryAdd) != 0) {
				$rowAdd = mysql_fetch_array($queryAdd);
				$_SESSION['cart'][$rowAdd['id']] = array("quantity" => 1, "price" => $rowAdd['price'], "format" => "(CD)");
			} else {
				$message = "This product ID is invalid.";
			}
		}
	}

	////////////////////////
    //  PRODUKTS DISPLAY  //
    ////////////////////////
    $sqlTalks = mysql_query("SELECT * FROM mmi_products WHERE category != 'Shipping' ORDER BY cat_num DESC");
    $produktsDisplayList = ""; // Initialize the variable to display the list of products
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
        $produktsDisplayList .='
            <div class="col-sm-4 produkt-item">
            	<img src="imgs/albums/' . $img . '" class="img-responsive img-thumbnail" alt="' . $title . '">
            	<a href="javascript:RequestContent(' . $content . ')" class="produkt-button">
            		<h5 class="produkt-items">' . $title . '</h5>
        		</a>
        		<a href="index.php?page=produkts&action=add&id=' . $id . '" class="btn btn-default">Add To Cart - $' . $price . ' (' . $category . ')</a>
        		<h4 class="produkt-items">Or Via 3rd Party:</h4>
	        	' . $third_party . '
            </div>
        ';
    }
?>
<div class="col-lg-12 remove-padding target-content">
    <h3>Produkts</h3>
    <div class="container-fluid">
	    <div class="row-fluid">
            <p>Shipping is included in price and all orders are sent USPS First Class if within the United States. Unforunately, for all international orders we must add an additional $9.13 USPS First Class International shipping fee.</p>
	    	<?php print "$produktsDisplayList"; ?>
	    </div>
	</div>
</div>
<h1 class="error-msg"><?php if(isset($message)) { echo $message; } ?></h1>