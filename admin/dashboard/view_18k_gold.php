<?php
session_start();

// ✅ Check if user is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: ../"); 
    exit();
}

include '../includes/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>18K Gold Table</title>
</head>
<body>

<?php include '../includes/sidebar.php'; ?>

<?php
// ✅ Show success alert
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo '<div class="alert-success" id="successAlert">✅ Record added successfully!</div>';
}
// ✅ Show delete alert
if (isset($_GET['deleted']) && $_GET['deleted'] == 1) {
    echo '<div class="alert-danger" id="deleteAlert">🗑️ Record deleted successfully!</div>';
}
?>

<style>
.alert-success, .alert-danger {
    position: fixed;
    top: 0; left: 0;
    width: 100%;
    padding: 15px 20px;
    text-align: center;
    font-weight: 600;
    z-index: 9999;
    animation: slideDown 0.5s ease-in-out;
}
.alert-success { background-color: #28a745; color: #fff; }
.alert-danger { background-color: #dc3545; color: #fff; }

@keyframes slideDown { from {transform: translateY(-100%);opacity:0;} to {transform: translateY(0);opacity:1;} }
@keyframes fadeOut { from {opacity:1;} to {opacity:0;transform:translateY(-20px);} }

.tables-container {
  display: block;
  margin-left: 350px; 
  margin-right: 20px;
  padding: 20px;
  width: 900px;
}
.tables-container table {
  border-collapse: collapse;
  width: 100%;
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
.delete-btn:hover { color: darkred; }
h2 { text-align: center; }
</style>

<div class="tables-container">
  <!-- ✅ Today’s 18K Gold Prices -->
  <div class="today-table">
    <h2>Today’s 18K Gold Prices</h2>
    <table class="table">
      <tr>
        <th>Weight</th>
        <th>QAR</th>
        <th>USD</th>
        <th>INR</th>
        <th>Action</th>
      </tr>
      <?php
      // ✅ Pivot for today’s entries
      $pivot_sql = "
        SELECT Weight,
          MAX(CASE WHEN Currencies = 'QAR' THEN Prices END) AS QAR,
          MAX(CASE WHEN Currencies = 'USD' THEN Prices END) AS USD,
          MAX(CASE WHEN Currencies = 'INR' THEN Prices END) AS INR,
          MAX(created_at) AS created_at
        FROM `18k_gold`
        WHERE created_at >= NOW() - INTERVAL 1 DAY
        GROUP BY Weight
        ORDER BY created_at DESC
      ";
      $pivot_result = $conn->query($pivot_sql);

      if ($pivot_result->num_rows > 0) {
        while($row = $pivot_result->fetch_assoc()) { ?>
          <tr>
            <td><?= $row['Weight'] ?></td>
            <td><?= $row['QAR'] ? 'QAR ' . number_format($row['QAR'], 2) : '-' ?></td>
            <td><?= $row['USD'] ? '$ ' . number_format($row['USD'], 2) : '-' ?></td>
            <td><?= $row['INR'] ? '₹ ' . number_format($row['INR'], 2) : '-' ?></td>
            <td>
              <a href="delete.php?weight=<?= urlencode($row['Weight']) ?>&type=18k_gold"
                 class="delete-btn"
                 onclick="return confirm('Are you sure you want to delete this entry?')">🗑</a>
            </td>
          </tr>
      <?php } } else { ?>
        <tr><td colspan="5">No data available for Today</td></tr>
      <?php } ?>
    </table>
  </div>

  <!-- ✅ History 18K Gold Prices -->
  <div class="history-table">
    <h2>History 18K Gold Prices</h2>
    <table>
      <tr>
        <th>Date</th>
        <th>1 Gram</th>
        <th>1 Tola</th>
        <th>1 Ounce</th>
        <th>Action</th>
      </tr>
      <?php  
      $history_pivot_sql = "
        SELECT DATE(created_at) AS PriceDate,
          MAX(CASE WHEN Weight = '1 Gram' THEN Prices END)   AS `1_Gram`,
          MAX(CASE WHEN Weight = '1 Tola' THEN Prices END)   AS `1_Tola`,
          MAX(CASE WHEN Weight = '1 Ounce' THEN Prices END)  AS `1_Ounce`
        FROM `18k_gold`
        WHERE created_at < NOW() - INTERVAL 1 DAY
          AND Currencies = 'QAR'
        GROUP BY DATE(created_at)
        ORDER BY PriceDate DESC
      ";
      $history_pivot_result = $conn->query($history_pivot_sql);

      if ($history_pivot_result && $history_pivot_result->num_rows > 0) { 
        while($row = $history_pivot_result->fetch_assoc()) { 
            $formatted_date = date("d-M-Y", strtotime($row['PriceDate']));
        ?>
          <tr>
            <td><?= $formatted_date ?></td>
            <td><?= $row['1_Gram']   ? 'QAR ' . number_format($row['1_Gram'], 2) : '-' ?></td>
            <td><?= $row['1_Tola']   ? 'QAR ' . number_format($row['1_Tola'], 2) : '-' ?></td>
            <td><?= $row['1_Ounce']  ? 'QAR ' . number_format($row['1_Ounce'], 2) : '-' ?></td>
            <td>
              <a href="delete.php?date=<?= urlencode($row['PriceDate']) ?>&type=18k_gold_history"
                 class="delete-btn"
                 onclick="return confirm('Are you sure you want to delete all records for <?= $formatted_date ?>?')">🗑</a>
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

document.addEventListener("DOMContentLoaded", function() {
    const alerts = document.querySelectorAll("#successAlert, #deleteAlert");
    alerts.forEach(alertBox => {
        setTimeout(() => {
            alertBox.style.animation = "fadeOut 0.8s forwards";
            setTimeout(() => alertBox.remove(), 800);
        }, 3000);
    });
});
</script>

</body>
</html>
