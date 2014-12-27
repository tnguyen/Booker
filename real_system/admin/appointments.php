<?php
$title = "Appointments";
$menutype = "admin_dashboard";
$require_admin = true;
include_once("../includes/core.php");
include("../functions/list_appointment_results.php");
$date = date("Y-m-d");
$query = "SELECT booking.id, booking.date, users.forename, 
users.surname, booking.time, booking.comments, booking.confirmedbystaff, 
booking.staff_id, service.type, service.price, staff.s_forename, staff.s_surname
FROM booking
 INNER JOIN users ON booking.username = users.username
 INNER JOIN staff ON booking.staff_id = staff.id
 INNER JOIN service ON booking.service_id = service.id 
 ORDER BY DATE(booking.date) DESC, booking.time DESC
 ";



$count_rows = "SELECT count(*) FROM booking";
$db->DoQuery($count_rows);
$count = $db->fetch();

// echo $count[0];
//Add following after it
$per_page =10;//define how many games for a page
$pages = ceil($count[0]/$per_page);

if($_GET['page']==""){
$page="1";
}else{
$page=$_GET['page'];
}
$start = ($page - 1) * $per_page;
$query = $query . " LIMIT $start, $per_page";
$db->DoQuery($query);
$num = $db->fetchAll();



include '../includes/header.php';
?>

<h1>Appointments</h1>


<ul id="pagination">
<?php
//Show page links
for ($i = 1; $i <= $pages; $i++)
  {?>
  <li id="<?php echo $i;?>"><a href="appointments.php?page=<?php echo $i;?>"><?php echo $i;?></a></li>
  <?php           
  }
?>

      </ul>


<?php
list_appointments($num);
include '../includes/footer.php';
?>






<script>
$( "#accordion" ).accordion();
$(".pinToggles").click(function(event){
    event.stopPropagation();
});
</script>
