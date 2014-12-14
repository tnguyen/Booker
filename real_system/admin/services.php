<?php 
  $title = "Services";
  $menutype = "admin_dashboard";
  include_once("../includes/core.php");
  
 if ($_POST) {
 $type = $_POST['service_name'];
 $price = $_POST['service_price'];
 $description = $_POST['service_description'];
  $query = " INSERT INTO service (type, price, description) VALUES (:type, :price, :description)";
  $query_params = array(
  ':type' => $type,
  ':price' => $price,
  ':description' => $description
  );
  $db->DoQuery($query, $query_params);
  header("Location: services.php");
  } 
  
//  if (isset($_POST['idtodelete'])) {
//  $deleteid = $_POST['idtodelete'];
//  echo $deleteid;
//  } 

include($directory . '/includes/header.php');
$query = "SELECT * FROM service";
$db->DoQuery($query);
$num = $db->fetchAll(PDO::FETCH_NUM);
//$roww = $db->RowCount($query);
?>
<h1>Services</h1>
<script type="text/javascript" src="../assets/jquery.js"></script>
<script src="../assets/modernizr.js"></script> 

<?php 
echo "<table id='mytable' style='width:100%'>";
echo "<tr>
		<th>Name</th>
		<th>Price</th>
		<th>Description</th>
	 </tr>";
foreach ($num as $row) {
	echo '<tr>';
    echo '<td>'.$row[1].'</td>';
    echo '<td>'.$row[2].'</td>';
    echo '<td>'.$row[3].'</td>';
    echo '<td><button name="'.$row[0].'">Delete</button></td>';
	echo '</tr>';
	}
?>


<form action="services.php" method="post" autocomplete="off">
<tr>
<td><input type="text" name="service_name" placeholder="Name"/></td>
<td><input type="number" name="service_price" size="4" placeholder="Price"/></td>
<td><input type="text" name="service_description" placeholder="Description"/></td>
<td><input type="submit" value="Add"></td>
</tr>
</form>
</table>
