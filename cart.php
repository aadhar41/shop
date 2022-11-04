<?php include 'includes/overall/oheader.php';
	//protect_page();
	session_start();
	//print_r($_SESSION["cart_item"]);

	//print_r($_SESSION['itemArray']);
	echo $quantity = $_REQUEST['quantity'];
	$a = implode("','", $_SESSION['cart_item']);

	$sql = "SELECT * FROM products WHERE p_id IN(". "'" .$a. "'" .")";
	$row = mysql_query($sql);
	
	//print_r($data);
?>
	<div class="wrapper">
    	<div id="shopping-cart">
			<div><h2 align="center">Shopping Cart  <a class="myButton" href="cart.php?action=empty">Empty Cart</a></h2></div>
            <hr/>
<?php
if(isset($_SESSION["cart_item"])){
    $item_total = 0;
?>	
<table cellpadding="10" cellspacing="1" align="center">
<tbody>
<tr>
<th colspan="1"><strong>Image</strong></th>
<th colspan="1"><strong>Name</strong></th>
<th colspan="1"><strong>Code</strong></th>
<th colspan="1"><strong>Quantity</strong></th>
<th colspan="1"><strong>Price</strong></th>
<th colspan="1"><strong>Action</strong></th>
</tr>	
<?php		
    while($data = mysql_fetch_assoc($row)) {
		?>
				<tr>
                <td><img src="<?php $img = $data["image"]; echo substr($img, 1); ?>" width="120px" height="80px" /></td>
				<td><strong><?php echo $data[name]; ?></strong></td>
				<td><?php echo $data["p_id"]; ?></td>
				<td><input type="text" name="quantity" value="1" size="2" /></td>
				<td align=right><?php echo $data["price"]; ?></td>
				<td><a href="cart.php?action=remove&proid=<?php echo $data["p_id"]; ?>" class="myButton">Remove Item</a></td>
				</tr>
				<?php
        $data_total += ($data["price"]*$data["quantity"]);
		}

		?>

<tr>
<td colspan="5" align=right><strong>Total:</strong> <?php echo "$".$data_total; ?></td>
</tr>
</tbody>
</table>		
  <?php
}
	
?>
</div>
    </div>
<?php include 'includes/overall/ofooter.php'; ?>