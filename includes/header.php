<?php session_start();
// error_reporting(E_ERROR);
include './includes/database/Doctrine.php';
include './includes/database/dbconfig.php';
include './includes/database/db.php';
include './includes/functions/user.php';
include './includes/functions/general.php';
$user_id = !empty($_SESSION['user_id']) ? $_SESSION['user_id'] : "";
$pd = !empty($_GET['proid']) ? $_GET['proid'] : "";

if (isset($_GET['pid'])) {
	$ids = $_GET['pid'];
	if (!isset($_SESSION['cart_item'])) {
		$_SESSION['cart_item'] = array();
	}
	if (in_array($ids, $_SESSION['cart_item'])) {
		$already = 'Already added to the cart. Please adjust the quantity.';
	} else {
		array_push($_SESSION['cart_item'], $ids);
	}
} else {
	if (!isset($_SESSION['cart_item'])) {
		$_SESSION['cart_item'] = array();
	}
}

$count = !empty($_SESSION['cart_item']) ? count($_SESSION['cart_item']) : "";
$_SESSION['quantity'] = !empty($_REQUEST['quantity']) ? $_REQUEST['quantity'] : "";

//echo $quantity;
?>
<header>
	<div class="wrapper">
		<div class="logo">
			<a href="index.php"><img src="./assets/images/shop.png" alt="Logo" width="200px" height="59" px></a>
		</div>
		<div class="title">
			<span><?php if (!empty($user_id)) {
						echo 'Welcome, ' . $user_id . ' !!';
					} ?></span>
		</div>
		<div class="top_menu">
			<a href="index.php">Home</a>
			<a href="cart.php"> Cart <?php echo '(' . $count . ')'; ?></a>
			<?php if (!empty($user_id)) { ?>
				<a href='logout.php'>Logout</a>
			<?php } else { ?>
				<a href="login.php">Login</a>
			<?php } ?>
		</div>
	</div>
</header>
<?php
if (!empty($_GET['action'])) {
	switch ($_GET['action']) {
		case "add":
			if (!empty($_POST['quantity'])) {
				$query = "SELECT * FROM products WHERE p_id='" . $_GET["pid"] . "'";
				$db = new Db();
				$result = $db->query($sql)->fetchAll($sql);
				$result = mysql_query($query);
				while ($row = mysql_fetch_assoc($result)) {
					$productByCode = $row;
				}
				$itemArray = array($productByCode["p_id"] => array('name' => $productByCode["name"], 'p_id' => $productByCode["p_id"], 'quantity' => $_POST["quantity"], 'price' => $productByCode["price"]));
				$_SESSION['itemArray'] = array();
				$_SESSION['itemArray'] = $itemArray;
			}
			break;
		case "remove":
			$index = array_search($pd, $_SESSION['cart_item'], true);
			unset($_SESSION['cart_item'][$index]);
			break;
		case "empty":
			unset($_SESSION["cart_item"]);
			break;
	}
}

?>