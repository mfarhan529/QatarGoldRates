<?php
session_start();

// ✅ Check if user is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: ../");
    exit();
}

include '../includes/db.php';

// ✅ Delete success alert
if (isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
  <div id="alert" style="
        background: #4CAF50;
        color: white;
        padding: 12px;
        border-radius: 6px;
        text-align: center;
        margin-bottom: 15px;
        font-weight: bold;">
        ✅ Data deleted successfully
  </div>
  <script>
    setTimeout(function() {
        var alert = document.getElementById("alert");
        if (alert) {
            alert.style.display = "none";
        }
    }, 3000);
  </script>
<?php endif; ?>

<?php
// ✅ Fetch all currencies
$currencies = [];
$currency_sql = "SELECT id, Symbol FROM currencies ORDER BY id ASC";
$currency_result = $conn->query($currency_sql);

$weight_sql = "SELECT id, unit FROM weight ORDER BY id ASC";
$weight_result = $conn->query($weight_sql);

if ($currency_result && $currency_result->num_rows > 0) {
    while ($c = $currency_result->fetch_assoc()) {
        $currencies[$c['id']] = $c['Symbol']; // map id => Symbol
    }
}

// ✅ Today’s Silver Prices (last 24 hours, latest per weight+currency)
$today_sql = "SELECT s1.id AS silver_id, s1.Prices, s1.created_at,
                     w.unit AS weight_unit, 
                     c.Symbol, c.id AS currency_id
              FROM silver_prices s1
              INNER JOIN (
                  SELECT weight_id, currency_id, MAX(created_at) as max_date
                  FROM silver_prices
                  WHERE created_at >= NOW() - INTERVAL 24 HOUR
                  GROUP BY weight_id, currency_id
              ) s2
              ON s1.weight_id = s2.weight_id
              AND s1.currency_id = s2.currency_id
              AND s1.created_at = s2.max_date
              LEFT JOIN currencies c ON s1.currency_id = c.id
              LEFT JOIN weight w ON s1.weight_id = w.id
              ORDER BY w.id ASC, s1.currency_id ASC";

$today_result = $conn->query($today_sql);

// ✅ History Silver Prices (older than 24 hours, only QAR)
$history_sql = "SELECT g.id AS silver_id, g.currency_id, g.weight_id, g.Prices, g.created_at, 
                       c.Symbol, w.unit AS weight_unit
                FROM silver_prices g
                LEFT JOIN currencies c ON g.currency_id = c.id
                LEFT JOIN weight w ON g.weight_id = w.id
                WHERE c.Symbol = 'QAR'
                  
                ORDER BY g.created_at DESC, w.id ASC";

$history_result = $conn->query($history_sql);

// ✅ Group Today data
function groupByDateWeightCurrency($result) {
    $data = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $date   = date("d-M-Y", strtotime($row['created_at']));
            $weight = $row['weight_unit'];
            $key = $date . "|" . $weight;

            if (!isset($data[$key])) {
                $data[$key] = [
                    'id'     => $row['silver_id'],
                    'date'   => $date,
                    'weight' => $weight,
                    'prices' => []
                ];
            }
            $data[$key]['prices'][$row['currency_id']] = $row['Prices'];
        }
    }
    return $data;
}
$today_data = groupByDateWeightCurrency($today_result);

// ✅ Collect history rows
$history_rows = [];
if ($history_result && $history_result->num_rows > 0) {
    while ($r = $history_result->fetch_assoc()) {
        $history_rows[] = $r;
    }
}

// ✅ Group history by date
function groupHistoryByDate($rows) {
    $data = [];
    foreach ($rows as $row) {
        $date = date("d-M-Y", strtotime($row['created_at']));
        if (!isset($data[$date])) {
            $data[$date] = [];
        }
        $data[$date][$row['weight_unit']] = $row['Prices'];
    }
    return $data;
}
$history_data = groupHistoryByDate($history_rows);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Silver Rates</title>
</head>
<body>

<?php include '../includes/sidebar.php'; ?>
<div class="table-wrapper">

  <!-- ✅ Success message -->
  <?php if (isset($_GET['success'])): ?>
    <p class="success-msg">✅ Silver rate added successfully!</p>
  <?php endif; ?>

  <!-- ✅ Today’s Silver Prices -->
  <div class="table-container">
    <h2>📊 Today’s Silver Prices</h2>
    <table>
      <thead>
        <tr>
          <th>Date</th>
          <th>Weight</th>
          <?php foreach ($currencies as $symbol): ?>
            <th><?= htmlspecialchars($symbol) ?></th>
          <?php endforeach; ?>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($today_data)): ?>
          <?php foreach ($today_data as $info): ?>
            <tr>
              <td><?= htmlspecialchars($info['date']) ?></td>
              <td><?= htmlspecialchars($info['weight']) ?></td>
              <?php foreach ($currencies as $cid => $symbol): ?>
                <td><?= isset($info['prices'][$cid]) ? number_format($info['prices'][$cid], 2) : '-' ?></td>
              <?php endforeach; ?>
              <td>
                <a href="delete_silver.php?id=<?= $info['id'] ?>" 
                   title="Delete" 
                   onclick="return confirm('Are you sure you want to delete this record?');">🗑️</a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="<?= count($currencies) + 3 ?>" style="text-align:center;">❌ No records found for Today</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <!-- 📜 History Silver Prices -->
  <div class="table-container">
    <h2>📜 History Silver Prices (QAR)</h2>
    <table class="history-table">
      <thead>
        <tr>
          <th>Date</th>
          <th>1 Gram</th>
          <th>1 Tola</th>
          <th>1 Kg</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($history_data)): ?>
          <?php foreach ($history_data as $date => $weights): ?>
            <tr>
              <td><?= htmlspecialchars($date) ?></td>
              <td><?= isset($weights['1 Gram']) ? 'QAR ' . number_format($weights['1 Gram'], 2) : '-' ?></td>
              <td><?= isset($weights['1 Tola']) ? 'QAR ' . number_format($weights['1 Tola'], 2) : '-' ?></td>
              <td><?= isset($weights['1 Kg']) ? 'QAR ' . number_format($weights['1 Kg'], 2) : '-' ?></td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="4" style="text-align:center;">❌ No historical data found</td>
          </tr>
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
