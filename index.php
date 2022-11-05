<?php include 'includes/overall/oheader.php';

$_SESSION['user_id'] = !empty($_GET['id']) ? $_GET['id'] : "";
$quantity = !empty($_REQUEST['quantity']) ? $_REQUEST['quantity'] : "";

?>
<div class="wrapper">
	<section class="flexcontainer">
		<?php
		$db = new Db();
		$sql = "SELECT * FROM products ORDER BY id ASC";
		$data = $db->query($sql)->fetchAll($sql);
		if (!empty($data)) {
			foreach ($data as $key => $value) {
		?>
				<div class="img">
					<form method="post" action="index.php?quantity=<?php echo $quantity; ?>&action=add&pid=<?php echo $value["p_id"]; ?>">
						<img src="<?php $img = $value["image"];
									echo substr($img, 1); ?>" alt="<?php echo $value["name"]; ?>" width="250" height="150">
						<div class="desc">
							<b><?php echo $value["title"]; ?></b>
						</div>
						<div class="flexcontainer">
							<input type="hidden" name="pkey" value="<?php echo $value["p_id"]; ?>" />
							<!--<div class="buy">-->
							<p><a href="poduct.php?id=<?php echo $value["id"]; ?>" class="btn-buy-now">Buy Now</a></p>
							&nbsp;
							<!--<p><a href="index.php?action=add&pid=<?php //echo $value["id"]; 
																		?>" class="cart">Add to cart</a></p>-->
							<div> <input type="submit" value="Add to cart" name="submit" class="btn-add-to-cart" /></div>
						</div>

					</form>
				</div>
		<?php }
		}
		$db->close();
		?>
		<div class="clear"></div>

	</section>
</div>
<?php include 'includes/overall/ofooter.php'; ?>