<!DOCTYPE html>
<html>
<head>
	 <!-- Bootstrap core CSS-->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<title></title>
</head>
<body>
	<div class="container">
		<div class="card">
		  <div class="card-header">
		    LOGIN
		  </div>
		  <div class="card-body">
		  	<form method="post" action="../controller/login.php">
			    <div class="form-group">
				    <label for="email">Email</label>
				    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
				  </div>
				  <div class="form-group">
				    <label for="password">Password</label>
				    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
				  </div>
				  <div class="form-group">
				    <button class="btn btn-primary">LOGIN</button>
				  </div>
				</form>
		  </div>
		</div>
	</div>
</body>
</html>