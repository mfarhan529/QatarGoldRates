<?php
session_start();

// ✅ Check if admin is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: ../"); 
    exit();
}

include '../includes/db.php';

// ✅ Insert data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Weight = $_POST['Weight'] ?? null;
    $QAR    = $_POST['QAR'] ?? null;
    $USD    = $_POST['USD'] ?? null;
    $INR    = $_POST['INR'] ?? null;

    if ($Weight && $QAR && $USD && $INR) {
        // Prepare SQL
        $sql = "INSERT INTO `21k_gold` (Weight, Currencies, Prices, created_at) VALUES (?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssd", $Weight, $currency, $price);

        // Insert QAR
        $currency = "QAR";
        $price = $QAR;
        $stmt->execute();

        // Insert USD
        $currency = "USD";
        $price = $USD;
        $stmt->execute();

        // Insert INR
        $currency = "INR";
        $price = $INR;
        $stmt->execute();

        // Redirect after success
        header("Location: view_21k_gold.php?success=1");
        exit();
    } else {
        echo "<p style='color:red; text-align:center;'>❌ Please fill in all fields.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add 21K Gold Rate</title>
</head>
<body>

<?php include '../includes/sidebar.php'; ?>

<div class="form-wrapper">
  <div class="form-container">
    <h2>➕ Add 21K Gold Rate</h2>
    <form method="POST" action="">
      
      <div class="form-group">
        <label>Weight</label>
        <select name="Weight" required>
          <option value="">-- Select Weight --</option>
          <option value="1 Tola">1 Tola</option>
          <option value="1 Gram">1 Gram</option>
          <option value="10 Grams">10 Grams</option>
          <option value="1 Ounce">1 Ounce</option>
        </select>
      </div>

      <div class="form-group">
        <label>Price in QAR</label>
        <input type="number" step="0.01" name="QAR" placeholder="Enter QAR price..." min="1" required>
      </div>

      <div class="form-group">
        <label>Price in USD</label>
        <input type="number" step="0.01" name="USD" placeholder="Enter USD price..." min="1" required>
      </div>

      <div class="form-group">
        <label>Price in INR</label>
        <input type="number" step="0.01" name="INR" placeholder="Enter INR price..." min="1" required>
      </div>

      <button type="submit">💰 Save 21K Gold Rate</button>
    </form>
  </div>
</div>

<style>
  body {
    font-family: 'Segoe UI', Arial, sans-serif;
    background: #f0f2f5;
    margin: 0;
    padding: 0;
  }

  .form-wrapper {
    margin-left: 400px; /* Sidebar offset */
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
  }

  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
  }

  h2 {
    text-align: center;
    margin-bottom: 30px;
    color: #1e3a8a;
    font-size: 26px;
    font-weight: 700;
    letter-spacing: 0.5px;
  }

  .form-group {
    margin-bottom: 20px;
  }

  label {
    font-weight: 600;
    display: block;
    margin-bottom: 8px;
    color: #222;
    font-size: 15px;
  }

  input, select {
    width: 100%;
    padding: 12px 14px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 15px;
    transition: all 0.25s ease;
    background: #fafafa;
  }

  input:focus, select:focus {
    border-color: #1e3a8a;
    background: #fff;
    box-shadow: 0 0 8px rgba(30,58,138,0.15);
    outline: none;
  }

  button {
    margin-top: 25px;
    padding: 14px;
    background: linear-gradient(135deg, #1e3a8a, #152c65);
    color: #fff;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    width: 100%;
    font-size: 17px;
    font-weight: 600;
    transition: all 0.3s ease;
  }

  button:hover {
    background: linear-gradient(135deg, #152c65, #0d1a3a);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
  }
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
