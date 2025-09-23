<?php
session_start();

// ✅ Check if user is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: ../");
    exit();
}

include '../includes/db.php';

// ✅ Fetch all currencies
$currencies = [];
$currency_sql = "SELECT id, Symbol FROM currencies ORDER BY id ASC";
$currency_result = $conn->query($currency_sql);

if ($currency_result && $currency_result->num_rows > 0) {
    while ($c = $currency_result->fetch_assoc()) {
        $currencies[$c['id']] = $c['Symbol']; // map id => Symbol
    }
}
// ✅ Today's Gold Prices (last 24 hours)
$today_sql = "SELECT g.id AS gold_id, g.currency_id, g.Purity, g.Prices, g.created_at, c.Symbol
              FROM gold_prices g
              LEFT JOIN currencies c ON g.currency_id = c.id
              WHERE g.created_at >= NOW() - INTERVAL 24 HOUR
              ORDER BY g.Purity ASC, g.currency_id ASC";

$today_result = $conn->query($today_sql);

// ✅ History Gold Prices (older than 24 hours)
$history_sql = "SELECT g.id AS gold_id, g.currency_id, g.Purity, g.Prices, g.created_at, c.Symbol
                FROM gold_prices g
                LEFT JOIN currencies c ON g.currency_id = c.id
                WHERE g.created_at < NOW() - INTERVAL 24 HOUR
                ORDER BY g.Purity ASC, g.currency_id ASC";

$history_result = $conn->query($history_sql);


// ✅ Function to group data by purity
function groupByPurity($result) {
    $data = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $purity = $row['Purity'];
            if (!isset($data[$purity])) {
                $data[$purity] = [
                    'id' => $row['gold_id'], // keep one id for edit
                    'prices' => []
                ];
            }
            $data[$purity]['prices'][$row['currency_id']] = $row['Prices'];
        }
    }
    return $data;
}

$today_data   = groupByPurity($today_result);
$history_data = groupByPurity($history_result);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Gold Rates </title>
  <style>
a.purity-link {
    color: #4c9fbbff; /* light blue */
    text-decoration: none;
}
a.purity-link:hover {
    color: black;
}
</style>

</head>
<body>

<?php include '../includes/sidebar.php'; ?>
<div class="table-wrapper">

  <!-- ✅ Success message -->
  <?php if (isset($_GET['success'])): ?>
    <p class="success-msg">✅ Gold rate added successfully!</p>
  <?php endif; ?>

  <!-- ✅ Today's Gold Prices -->
  <div class="table-container">
    <h2>📊 Today’s Gold Prices</h2>
    <table>
      
      <thead>
        <tr>
          <th>Purity</th>
          <?php foreach ($currencies as $symbol): ?>
            <th><?= htmlspecialchars($symbol) ?></th>
          <?php endforeach; ?>
          <th>Action</th>
        </tr>
      </thead>
   <tbody> 
    <?php if (!empty($today_data)): ?> 
      <?php foreach ($today_data as $purity => $info): ?>
         <tr>
           <td><?= htmlspecialchars($purity) ?></td>
            <?php foreach ($currencies as $cid => $symbol): ?>
               <td><?= isset($info['prices'][$cid]) ? number_format($info['prices'][$cid], 2) : '-' ?></td>
                <?php endforeach; ?>
                 <td><a href="edit_gold2.php?id=<?= $info['id'] ?>" title="Edit">✏️</a></td>
                 </tr> <?php endforeach; ?>
                  <?php else: ?> <tr>
                    <td colspan="<?= count($currencies) + 2 ?>" style="text-align:center;">❌ No records found for Today</td>
                  </tr> <?php endif; ?> </tbody>
    </table>
  </div>

  <!-- ✅ History Gold Prices -->
  <div class="table-container">
    <h2>📜 History Gold Prices</h2>
    <table>
      <thead>
        <tr>
          <th>Purity</th>
          <?php foreach ($currencies as $symbol): ?>
            <th><?= htmlspecialchars($symbol) ?></th>
          <?php endforeach; ?>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($history_data)): ?>
          <?php foreach ($history_data as $purity => $info): ?>
            <tr>
              <td><?= htmlspecialchars($purity) ?></td>
              <?php foreach ($currencies as $cid => $symbol): ?>
                <td><?= isset($info['prices'][$cid]) ? number_format($info['prices'][$cid], 2) : '-' ?></td>
              <?php endforeach; ?>
              <td><a href="edit_gold2.php?id=<?= $info['id'] ?>" title="Edit">✏️</a></td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr><td colspan="<?= count($currencies) + 2 ?>" style="text-align:center;">❌ No historical data found</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

</div>

<style>
  body { font-family: 'Segoe UI', Arial, sans-serif; background: #f0f2f5; margin: 0; padding: 0; }
  .table-wrapper { margin-left: 400px; padding: 40px 20px; width: 1000px; }
  .table-container { background: #fff; padding: 25px; border-radius: 14px; margin-bottom: 40px; box-shadow: 0 6px 20px rgba(0,0,0,0.08); }
  h2 { text-align: center; margin-bottom: 20px; color: #1e3a8a; font-size: 24px; font-weight: 700; }
  .success-msg { text-align: center; background: #d1fae5; color: #065f46; padding: 10px; border-radius: 6px; margin-bottom: 15px; font-weight: 600; }
  table { width: 100%; border-collapse: collapse; }
  thead { background: #1e3a8a; color: #fff; }
  th, td { padding: 12px 14px; border: 1px solid #ddd; text-align: center; }
  tbody tr:nth-child(even) { background: #f9f9f9; }
  tbody tr:hover { background: #eef2ff; }
  a { text-decoration: none; font-size: 18px; color: #1e3a8a; }
  a:hover { color: #0d1a3a; }
</style>

<script>
document.querySelectorAll('.dropdown-toggle').forEach(item => {
  item.addEventListener('click', function(e) {
    e.preventDefault();
    this.parentElement.classList.toggle('open');
  });
});
</script>
</body>
</html>
