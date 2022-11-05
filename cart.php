<?php include 'includes/overall/oheader.php';
//protect_page();

//print_r($_SESSION["cart_item"]);

//print_r($_SESSION['itemArray']);
// echo $quantity = $_REQUEST['quantity'];
$quantity = !empty($_REQUEST['quantity']) ? $_REQUEST['quantity'] : "";
if (!empty($_SESSION['cart_item'])) {
	$a = implode("','", $_SESSION['cart_item']);
	$sql = "SELECT * FROM products WHERE p_id IN(" . "'" . $a . "'" . ")";
	$db = new Db();
	$result = $db->query($sql)->fetchAll();
}

?>
<div class="wrapper">
	<?php if (!empty($result)) { ?>
		<div id="shopping-cart">
			<div>
				<h2 align="center">Shopping Cart <a class="myButton" href="cart.php?action=empty">Empty Cart</a></h2>
			</div>
			<hr />
			<?php
			if (isset($_SESSION["cart_item"])) {
				$item_total = 0;
			?>
				<table cellpadding="10" cellspacing="1" align="center">
					<tbody>
						<tr>
							<th colspan="1"><strong>Image</strong></th>
							<th colspan="1"><strong>Name</strong></th>
							<th colspan="1"><strong>Code</strong></th>
							<th colspan="1"><strong>Quantity</strong></th>
							<th colspan="1"><strong>Price/Unit</strong></th>
							<th colspan="1"><strong>Total</strong></th>
							<th colspan="1"><strong>Action</strong></th>
						</tr>
						<?php
						$data_total = 0;
						foreach ($result as $key => $data) {
							// echo "<pre>"; print_r($data); die;
						?>
							<tr>
								<td><img src="<?php $img = $data["image"];
												echo substr($img, 1); ?>" width="120px" height="80px" /></td>
								<td><strong><?php echo $data['name']; ?></strong></td>
								<td><?php echo strtoupper($data["p_id"]); ?></td>
								<td><input type="number" id="quantity_<?= $data['id']; ?>" data-uid="<?= $data['id']; ?>" class="js-quantity" name="quantity" value="1" size="1" /></td>
								<td align=right><input type="hidden" name="price_<?= $data['id']; ?>" id="price_<?= $data['id']; ?>" value="<?php echo $data["price"]; ?>" /> <?php echo $data["price"]; ?></td>
								<td align=right><input type="hidden" name="total_unit_price_<?= $data['id']; ?>" class="total_unit_price" id="total_unit_price_<?= $data['id']; ?>" value="0" /> <span id="total_unit_price__<?= $data['id']; ?>">0</span> </td>
								<td><a href="cart.php?action=remove&proid=<?php echo $data["p_id"]; ?>" class="myButton">Remove Item</a></td>
							</tr>
						<?php
						}
						?>

						<tr>
							<input type="hidden" name="total_amount" id="total_amount" value="0" />
							<td colspan="6" align=right><strong>Total:</strong> <span id="js-total-amount">$ 0</span> </td>
						</tr>
					</tbody>
				</table>
			<?php
			}

			?>
		</div>
	<?php } else { ?>
		<div class="empty-cart">
			<h2 class="h2-empty-cart">Cart Empty</h2>
		</div>
	<?php } ?>
</div>
<script>
	
</script>
<?php include 'includes/overall/ofooter.php'; ?>