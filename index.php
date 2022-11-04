<?php include 'includes/overall/oheader.php';
error_reporting(0);
error_reporting(E_ERROR);
session_start();
$_SESSION['user_id'] = $_GET['id'];

?>
<div class="wrapper">
	<section class="container">

		<?php
		$sql = "SELECT * FROM products ORDER BY id ASC";
		$result = $conn->query($sql);

		// output data of each row
		while ($row = $result->fetch_assoc()) {
			$resultset[] = $row;
			$products = $resultset;
		}

		if (!empty($resultset)) {
			foreach ($products as $key => $value) {
				/*print_r($products);
				echo $products[$key]["image"];*/
		?>
				<div class="img">
					<form method="post" action="index.php?quantity=<?php echo $_REQUEST['quantity']; ?>&action=add&pid=<?php echo $products[$key]["p_id"]; ?>">
						<img src="<?php $img = $products[$key]["image"];
									echo substr($img, 1); ?>" alt="<?php echo $products[$key]["name"]; ?>" width="250" height="150">
						<div class="desc">
							<b><?php echo $products[$key]["title"]; ?></b>
						</div>
						<div>
							<input type="hidden" name="pkey" value="<?php echo $products[$key]["p_id"]; ?>" />
							<!--<div class="buy">-->
							<p><a href="poduct.php?id=<?php echo $products[$key]["id"]; ?>" class="myButton">Buy Now</a></p>
							<!--<p><a href="index.php?action=add&pid=<?php //echo $products[$key]["id"]; 
																		?>" class="cart">Add to cart</a></p>-->
							<div> <input type="submit" value="Add to cart" name="submit" class="cart" /></div>
						</div>

					</form>
				</div>
		<?php }
		} ?>
		<div class="clear"></div>

	</section>
</div>
<?php include 'includes/overall/ofooter.php'; ?>