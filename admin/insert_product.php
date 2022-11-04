<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="css/admin.css" rel="stylesheet" type="text/css">
<title>Insert Product</title>
<script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
<script>tinymce.init({selector:'textarea'});</script>
</head>
<?php 
	include 'includes/dbconfig.php';
	if(isset($_POST['submit'])) {
		$name = $_POST['name'];
		$title = $_POST['title'];
		$description = $_POST['description'];
		$oprice = $_POST['price'];
		$price = $oprice.'$';
		
		$errors= array();
		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$file_tmp = $_FILES['image']['tmp_name'];
		$file_type = $_FILES['image']['type'];
		$file_ext = strtolower(end(explode('.',$_FILES['image']['name'])));
		
		$expensions= array("jpeg","jpg","png");
		
		$image_path = '../images/'.$file_name;
		
		if(in_array($file_ext,$expensions)=== false){
		 $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
		}
		
		if($file_size > 2097152){
		 $errors[] = 'File size must be exactly 2 MB';
		}
		
		if(empty($errors)==true){
		move_uploaded_file($file_tmp, $image_path);	
		
		$query = "INSERT INTO products(name, title, description, price, image) VALUES('$name', '$title', '$description', '$price', '$image_path')";
		mysql_query($query);
		$last_id = mysql_insert_id();
		//echo $last_id;
		$bb = 'pro'.str_pad($last_id,3,'0',STR_PAD_LEFT);
		$sql = "UPDATE products SET p_id = '$bb' WHERE id = '$last_id'";
		mysql_query($sql);
		
		 $success = "Successfully Updated!!";      
		 } else if ($name ="" || $price ="" || $title="" || $description =""){
			  echo "<script>alert('Please fill all details.')</script>";
		 	  exit();
		 } else {
		 print_r($errors);
		
		}	
	}
?>


<body>
	<form action="insert_product.php" method="post" enctype="multipart/form-data" id="description">
    	<table id="t01" align="center" width="700px">
        	<tr>
            	<th colspan="2" align="center">Insert Product</th>
            </tr>
            <tr>
            	<th>Name: </th>
            	<td><input type="text" name="name"></td>
            </tr>
            <tr>
            	<th>Title: </th>
            	<td><input type="text" name="title"></td>
            </tr>
            <tr>
            	<th>Description: </th>
            	<td><textarea rows="6" cols="70" name="description" form="description"  placeholder="Enter description here"></textarea></td>
			</tr>
            <tr>
            	<th>Price: </th>
            	<td><input type="text" name="price"></td>
            </tr>
            <tr>
            	<th>Image: </th>
            	<td><input type="file" name="image" required/></td>
            </tr>
            <tr>
            	<td colspan="2" align="center"><input type="submit" name="submit" value="Insert Product" class="insert">
                <input type="reset" value="Reset" class="myButton">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>