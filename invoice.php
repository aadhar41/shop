<?php include 'includes/overall/oheader.php';

protect_page();

$id = $_REQUEST['id'];
$user =	$_SESSION['user_id'];

//fetching products
$db = new Db();
$query = "SELECT * FROM products WHERE id = '$id'";
$data = $db->runQueryObj($query);

//fetching users
$sql = "SELECT * FROM users WHERE email = '$user'";
$u_row = $db->runQueryAssoc($sql);

$u_name = $u_row['name'];
$u_email = $u_row['email'];
$u_mobile = $u_row['mobile'];
if ($data) {
?>
	<div class="wrapper">
		<div class="in_image">
			<img src="<?php $img = $data->image;
						echo substr($img, 1); ?>" alt="<?php echo $data->name; ?>" width="450px" height="300px" />
		</div>
		<div class="p_tab">
			<table align="right" width="600px">
				<tr>
					<th colspan="2">Users name:</th>
					<td colspan="2"><?php echo $u_name; ?></td>
				</tr>
				<tr>
					<th colspan="2">Email:</th>
					<td colspan="2"><?php echo $u_email; ?></td>
				</tr>
				<tr>
					<th colspan="2">Contact Info:</th>
					<td colspan="2"><?php echo $u_mobile; ?></td>
				</tr>
				<tr>
					<th colspan="2">Product name:</th>
					<td colspan="2"><?php echo $data->name; ?></td>
				</tr>
				<tr>
					<th colspan="2">Product title:</th>
					<td colspan="2"><?php echo $data->title; ?></td>
				</tr>
				<tr>
					<th colspan="2">Price:</th>
					<td colspan="2"><?php echo $data->price; ?></td>
				</tr>
				<tr>
					<th colspan="2">Product Description:</th>
					<td colspan="2"><?php echo $data->description; ?></td>
				</tr>

			</table>
		</div>

		<div class="clear"></div>

		<div class="terms">
			<form action="agree.php" method="POST">
				<ol>
					<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
					<li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
						Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</li>
					<li>Quisque vel erat venenatis, tincidunt ligula dapibus, bibendum neque.</li>
					<li>There are many variations of passages of Lorem Ipsum available,
						but the majority have suffered alteration in some form, by injected humour,
						or randomised words which don't look even slightly believable.</li>
					<li>Pellentesque maximus magna non rutrum congue.</li>
				</ol>
				<span style="color:red;"><input type="checkbox" name="agree" value="agree"> Select if you are Agree with are Terms and Conditions.</span><span class="error"><?php /* echo $agreeErr */ ?></span><br /><br />

				<input type="submit" value="Submit" class="myButton" align="middle">
			</form>
		</div>
	</div>
<?php
}
$db->close();
?>
<?php include 'includes/overall/ofooter.php'; ?>