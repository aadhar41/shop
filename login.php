<?php include 'includes/overall/oheader.php';	$err ="";	?>
		
<div class="wrapper">
		<div class="inner1">
			<span class="error" style="text-align:center;"><?php $loginErr; ?></span>
			<form action="plogin.php" method="post">
				
					<table id="t01" align="center" width="400px">
						<tr>
							<th colspan="6" align="center" bgcolor="#F8F8F8" >Login</th>
						</tr>
						<tr>
							<th>Email: </th>
							<td><input type="email" name="email" required></td>
						</tr>
						<tr>
							<th>Password: </th>
							<td><input type="password" name="password"></td>
						</tr>
						<tr>
							<td align="center" colspan="2"><input type="submit" name="submit" value="Login" class="myButton" required>       <input type="reset" name="reset" value="Reset" class="myButton" /></td>
						</tr>
						
					</table>
				
			</form>
		</div>
		
		
		
		<div class="inner2">
			
			<span class="error" style="text-align:center;"><?php echo $err; ?></span>
				<form action="pregister.php" method="post">
			   
				<table id="t01" align="center" width="400px">
					<tr>
						<th colspan="6" align="center" bgcolor="#F8F8F8" >Registeration</th>
					</tr>
					<tr>
						<th>Name: </th>
						<td><input type="text" name="name" required/></td>
					</tr>
					<tr>
						<th>Email: </th>
						<td><input type="email" name="email" required/></td>
					</tr>
					<tr>
						<th>Password: </th>
						<td><input type="password" name="password" required/></td>
					</tr>
					<tr>
						<th>Re-Password: </th>
						<td><input type="password" name="repassword" required/></td>
					</tr>
					<tr>
						<th>Gender: </th>
						<td><input type="radio" name="gender" value="male" required/>Male
							<input type="radio" name="gender" value="female" required/>Female</td>
					</tr>                
				  
					<tr>
						<th>Mobile: </th>
						 <td><input type="text" name="mobile"/></td>
					</tr>

					<tr>
						<th colspan="6" align="center"><input type="submit" value="Register" class="myButton">
						<input type="reset" value="reset" class="myButton" /></th>
						
					</tr>
					
				</table>
			</form><br/><br/>
		</div>
	
</div>

<?php include 'includes/overall/ofooter.php'; ?>