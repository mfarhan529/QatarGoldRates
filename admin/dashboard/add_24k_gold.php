<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../"); 
    exit();
}

include '../includes/db.php';

// ✅ Fetch all currencies for dropdown
$currency_sql = "SELECT id, Symbol FROM currencies ORDER BY id ASC";
$currency_result = $conn->query($currency_sql);

// ✅ Insert data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currency_id = $_POST['Currency'] ?? null;
    $purity      = $_POST['Purity'] ?? null;
    $weight      = $_POST['Weight'] ?? null;
    $price       = $_POST['Price'] ?? null;

    if ($currency_id && $purity && $weight && $price > 0) {
        $sql = "INSERT INTO `24k_gold` (currency_id, Purity, Weight, Prices, created_at, updated_at) 
                VALUES (?, ?, ?, ?, NOW(), NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issd", $currency_id, $purity, $weight, $price);

        if ($stmt->execute()) {
            header("Location: view_24K_gold.php?success=1");
            exit();
        } else {
            echo "<p style='color:red; text-align:center;'>❌ Error: " . $stmt->error . "</p>";
        }
    } else {
        echo "<p style='color:red; text-align:center;'>❌ Invalid input. All fields are required and price must be greater than 0.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add 24K Gold Rate</title>
</head>
<body>

<?php include '../includes/sidebar.php'; ?>
<div class="form-wrapper">
  <div class="form-container">
    <h2>➕ Add 24K Gold Rate</h2>
    <form method="POST" action="">
      
      <!-- Currency -->
      <div class="form-group">
        <label>Currency</label>
        <select name="Currency" required>
          <option value="">-- Select Currency --</option>
          <?php while ($row = $currency_result->fetch_assoc()) { ?>
            <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['Symbol']) ?></option>
          <?php } ?>
        </select>
      </div>

      <!-- Purity -->
      <div class="form-group">
        <label>Purity</label>
        <select name="Purity" required>
          <option value="">-- Select Purity --</option>
          <option value="24K Gold">24K Gold</option>
          <option value="22K Gold">22K Gold</option>
          <option value="21K Gold">21K Gold</option>
          <option value="18K Gold">18K Gold</option>
          <option value="14K Gold">14K Gold</option>
        </select>
      </div>

      <!-- Weight -->
      <div class="form-group">
        <label>Weight</label>
        <select name="Weight" required>
          <option value="">-- Select Weight --</option>
          <option value="1 Gram">1 Gram</option>
          <option value="1 Tola">1 Tola</option>
          <option value="10 Grams">10 Grams</option>
          <option value="1 Ounce">1 Ounce</option>
        </select>
      </div>

      <!-- Price -->
      <div class="form-group">
        <label>Price</label>
        <input type="number" step="0.01" name="Price" placeholder="Enter price..." required>
      </div>

      <button type="submit">💰 Save 24K Gold Rate</button>
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
