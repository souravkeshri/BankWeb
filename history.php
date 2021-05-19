<?php


$tablename="transaction";
$conn=mysqli_connect('localhost','root');
mysqli_select_db($conn,'login');
$q1="SELECT * from $tablename ";

$result=mysqli_query($conn,$q1);
if(! $result)
{
	die("coudn't get data :".mysql_error());
	
}
else{
echo "";


}

?>

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="style1.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<style>
#liststudent {
  font-family: 'Roboto', sans-serif;
  border-collapse: collapse;
  width: 80%;
  margin-bottom:50px;
}

#liststudent td, #liststudent th {
  border: 1px solid #ddd;
  padding: 8px;
  font-size:15px;
}

#liststudent tr:nth-child(even){background-color: #f2f2f2;}

#liststudent tr:hover {background-color: #ddd;}

#liststudent th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #11A996;
  color: white;
  font-size:20px;
}
a{
	color:black;
	text-decoration:none;
}
}
</style>
    <meta charset="utf-8" />
    <title>Transaction History</title>
</head>
<body>
<div class="container-fluid main_menu">
		<div class="row">
			<div class="col-md-10 col-12 mx-auto">
			    <nav class="navbar navbar-expand-lg  ">
				  <a class="navbar-brand" href="#" > <span class="main_text">The Sparks Bank</span></a>
				  
					 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					  </button>
				  <div class="collapse navbar-collapse" id="navbarSupportedContent">
				    <ul class="navbar-nav ml-auto">
				    	
				      <li class="nav-item active">
				        <a class="nav-link" href="index.php">Home </a>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link" href="userlist.php">Users</a>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link" href="transaction.php">Transfer</a>
				      </li> <li class="nav-item">
				        <a class="nav-link" href="history.php">Transaction History</a>
				      </li>
				       
				    </ul>

				  </div>
				</nav>
			</div>
			
		</div>
	</div>



<form>
<center><h1 style="margin-top:20px;font-weight:bold;font-size:40px;">Transaction History</h1><br>

<table border="2" id="liststudent">
<th>Sl.No.</th>
<th>Sender</th>
<th>Receiver</th>
<th>Amount Transferred</th>
<th>Time</th>
<th>Status</th>
<?php
$i=1;

while ($row=mysqli_fetch_array($result))
{
       
		  echo "<tr>";
	      echo "<td><label >$i</label></td>";
	      echo "<td>{$row['sender']}</td>";
	      echo "<td>{$row['receiver']}</td>";
	      echo "<td>{$row['amount']}</td>"; 
		  echo "<td>{$row['date']}</td>";
		  echo "<td>{$row['status']}</td>";
          echo "</tr>";

	$i++;
	
}
?>




</table></center>
</form>
<footer >
		<p>Created By Sourav ❤</p>
    </footer>
</body>
</html>