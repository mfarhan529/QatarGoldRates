<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: ../"); // Redirect to login if not logged in
    exit();
}

include '../includes/db.php';
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Emerald Table</title>
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous"> -->
  </head>
  <body>

   
    <?php
include '../includes/sidebar.php';
?>
 
<?php
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo '<div class="alert-success" id="successAlert">✅ Record added successfully!</div>';
}
// ✅ Show delete alert
if (isset($_GET['deleted']) && $_GET['deleted'] == 1) {
    echo '<div class="alert-danger" id="deleteAlert">🗑️ Record deleted successfully!</div>';
}
?>



<?php
// ✅ Today Data (last 24 hours) - Show created_at, Quantity, Currency, Price
$today_sql = "SELECT id, Gemstone, Weight, Currency, Price, created_at 
              FROM emerald_prices 
              WHERE created_at >= NOW() - INTERVAL 1 DAY 
              ORDER BY created_at DESC";
$today_result = $conn->query($today_sql);

// ✅ History Data (older than 24 hours)
$history_sql = "SELECT id, Gemstone, Weight, Currency, Price, created_at 
                FROM emerald_prices
                WHERE created_at < NOW() - INTERVAL 1 DAY 
                ORDER BY created_at DESC";
$history_result = $conn->query($history_sql);
?>

<style>
.alert-success {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background-color: #28a745;
    color: #fff;
    padding: 15px 20px;
    text-align: center;
    font-weight: 600;
    z-index: 9999;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    animation: slideDown 0.5s ease-in-out;
}

.alert-danger {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background-color: #dc3545;
    color: #fff;
    padding: 15px 20px;
    text-align: center;
    font-weight: 600;
    z-index: 9999;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    animation: slideDown 0.5s ease-in-out;
}


/* Slide down animation */
@keyframes slideDown {
    from { transform: translateY(-100%); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

/* Fade out animation */
@keyframes fadeOut {
    from { opacity: 1; }
    to { opacity: 0; transform: translateY(-20px); }
}




.tables-container {
  display: block;
  margin-left: 350px; /* space for sidebar */
  margin-right: 20px;
  padding: 20px;
  width: 900px;
}

.tables-container table {
  border-collapse: collapse;
  width: 100%; /* full width inside container */
  background: #fff;
  border-radius: 8px;
  margin-bottom: 30px;
  overflow: hidden;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}


.tables-container th {
  background: #1e3a8a;
  color: #fff;
  padding: 10px;
  text-align: center;
}

.tables-container td {
  padding: 10px;
  text-align: center;
  border: 1px solid #ddd;
}

.delete-btn {
  color: red;
  cursor: pointer;
  font-size: 18px;
  text-decoration: none;
}
.delete-btn:hover {
  color: darkred;
}
h2 {
  text-align: center;
}


</style>




<div class="tables-container">
  <!-- ✅ Today’s Emerald Prices -->
  <div class="today-table">
    <h2>Today’s Emerald Prices</h2>
    <table class="table">
      <tr>
        <th scope="col" >Gemstone</th>
        <th scope="col" >Weight</th>
        <th scope="col">Currency</th>
        <th scope="col">Price</th>
        <th scope="col">Action</th>
      </tr>
      <?php if ($today_result->num_rows > 0) { 
        while($row = $today_result->fetch_assoc()) { ?>
      <tr>
        <td><?= $row['Gemstone'] ?></td>
        <td><?= $row['Weight'] ?></td>
        <td><?= $row['Currency'] ?></td>
        <td><?= $row['Price'] ?></td>
     <td>
  <a href="delete.php?id=<?= $row['id'] ?>&type=emerald"
     class="delete-btn"
     onclick="return confirm('Are you sure you want to delete this entry?')">🗑</a>
</td>

      </tr>
      <?php } } else { ?>
      <tr><td colspan="4">No data available for Today</td></tr>
      <?php } ?>
    </table>
  </div>

  <!-- ✅ History Emerald Prices -->
  <div class="history-table">
    <h2>History Emerald Prices</h2>
    <table>
      <tr>
        <th>Date</th>
        <th>Gemstone</th>
        <th>Weight</th>
        <th>Currency</th>
        <th>Price</th>
        <th>Action</th>
      </tr><?php if ($history_result->num_rows > 0) { 
    while($row = $history_result->fetch_assoc()) { 
        // Format date into 12-Sep-2025
        $formatted_date = date("d-M-Y", strtotime($row['created_at']));
?>
      <tr>
        <td><?= $formatted_date ?></td>
        <td><?= $row['Gemstone'] ?></td>
        <td><?= $row['Weight'] ?></td>
        <td><?= $row['Currency'] ?></td>
        <td><?= $row['Price'] ?></td>
        <td>
  <a href="delete.php?id=<?= $row['id'] ?>&type=emerald" 
     class="delete-btn" 
     onclick="return confirm('Are you sure you want to delete this entry?')">🗑</a>
</td>

      </tr>
      <?php } } else { ?>
      <tr><td colspan="5">No historical data available</td></tr>
      <?php } ?>
    </table>
  </div>
</div>



     <script>
document.querySelectorAll('.dropdown-toggle').forEach(item => {
  item.addEventListener('click', function(e) {
    e.preventDefault();
    this.parentElement.classList.toggle('open');
  });
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const alerts = document.querySelectorAll("#successAlert, #deleteAlert");
    alerts.forEach(alertBox => {
        setTimeout(() => {
            alertBox.style.animation = "fadeOut 0.8s forwards";
            setTimeout(() => alertBox.remove(), 800);
        }, 3000); // 3 seconds
    });
});
</script>




  </body>

  </html>