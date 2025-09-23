<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: ../");
    exit();
}

include '../includes/db.php';

// ✅ Fetch the latest price for each Gold Type today
$gold_types = ["24K Gold", "22K Gold", "21K Gold", "18K Gold", "14K Gold", "10K Gold"];
$today_prices = [];

foreach ($gold_types as $type) {
    $stmt = $conn->prepare("SELECT Price FROM gold_prices 
                            WHERE Quantity = ? 
                              AND created_at >= NOW() - INTERVAL 1 DAY 
                            ORDER BY created_at DESC LIMIT 1");
    $stmt->bind_param("s", $type);
    $stmt->execute();
    $stmt->bind_result($price);
    if ($stmt->fetch()) {
        $today_prices[$type] = $price;
    }
    $stmt->close();
}

$result_msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $gold_type = $_POST['gold_type'];
    $weight = floatval($_POST['weight']);

    if (isset($today_prices[$gold_type])) {
        $price_per_tola = $today_prices[$gold_type];
        $total_price = $price_per_tola * $weight;

        $result_msg = "<p style='color:black; font-weight:700; font-size:18px; margin-top:20px;'>
                        The price for {$weight} tola of {$gold_type} is:<br>
                        <span style='color:green; font-weight:bold;'>QAR: " . number_format($total_price, 2) . "</span>
                       </p>";
    } else {
        $result_msg = "<p style='color:red; font-weight:bold;'>❌ Latest price not available in today's table for {$gold_type}.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Calculate Gold Rate</title>
</head>
<body>

<?php include '../includes/sidebar.php'; ?>
<div class="form-wrapper">
  <div class="form-container">
    <h2>💰 Calculate Gold Rate</h2>

    <form method="POST" action="">
      <div class="form-group">
        <label class="center-label">Select Gold Type:</label>
        <select name="gold_type" required>
          <option value="24K Gold">24K Gold</option>
          <option value="22K Gold">22K Gold</option>
          <option value="21K Gold">21K Gold</option>
          <option value="18K Gold">18K Gold</option>
          <option value="14K Gold">14K Gold</option>
          <option value="10K Gold">10K Gold</option>
        </select>
      </div>

      <div class="form-group">
        <label class="center-label">Weight Unit: </label>
                 
        <input type="text" value="Tola" readonly>
      </div>

      <div class="form-group">
        <label class="center-label">Enter Weight</label>
        <input type="number" step="0.01" name="weight" placeholder="Enter weight..." required>
      </div>

      <button type="submit">Calculate</button>
    </form>

    <!-- ✅ Result shown here -->
    <?php if ($result_msg) echo $result_msg; ?>

  </div>
</div>

<style>
  select, input {
    text-align: center;
    text-align-last: center;
  }
  input::placeholder {
    text-align: center;
  }
  body {
    font-family: 'Segoe UI', Arial, sans-serif;
    background: #f0f2f5;
    margin: 0;
    padding: 0;
  }
  .form-wrapper {
    margin-left: 400px;
    padding: 40px 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 800px;
  }
  .form-container {
    width: 100%;
    background: #fff;
    padding: 35px 40px;
    border-radius: 14px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    animation: fadeIn 0.5s ease-in-out;
    text-align: center;
  }
  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
  }
  h2 {
    text-align: center;
    margin-bottom: 30px;
    color: #000;
    font-size: 26px;
    font-weight: 700;
  }
  .form-group {
    margin-bottom: 20px;
    text-align: center;
  }
  .center-label {
    font-weight: bold;
    display: block;
    margin-bottom: 8px;
    color: #000;
    font-size: 16px;
  }
  input, select {
    width: 60%;
    padding: 12px 14px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 15px;
    transition: all 0.25s ease;
    background: #fafafa;
    margin: 0 auto;
    display: block;
  }
  input:focus, select:focus {
    border-color: #8b0000;
    background: #fff;
    box-shadow: 0 0 8px rgba(139,0,0,0.2);
    outline: none;
  }
  button {
    margin-top: 25px;
    padding: 14px;
    background: darkred;
    color: #fff;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    width: 60%;
    font-size: 17px;
    font-weight: 600;
    transition: all 0.3s ease;
  }
  button:hover {
    background: #a40000;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
  }
</style>

</body>
</html>
