<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: ../"); // Redirect to login if not logged in
    exit();
}

include '../includes/db.php';// Insert data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Gemstone = $_POST['Gemstone'] ?? null;
    $Weight = $_POST['Weight'] ?? null;
    $Currency = $_POST['Currency'] ?? null;
    $Price    = $_POST['Price'] ?? null;

    $sql = "INSERT INTO sapphire_prices (Gemstone, Weight, Currency, Price) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssd", $Gemstone, $Weight, $Currency, $Price);

    if ($stmt->execute()) {
        // ✅ Redirect to view page after successful insert
        header("Location: view_sapphire.php?success=1");
        exit();
    } else {
        echo "<p style='color:red; text-align:center;'>❌ Error: " . $stmt->error . "</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Sapphire Rate</title>
</head>
<body>

<?php include '../includes/sidebar.php'; ?>
<div class="form-wrapper">
  <div class="form-container">
    <h2>➕ Add Sapphire Rate</h2>
    <form method="POST" action="">
      
      <div class="form-group">
        <label>Gemstone</label>
        <select name="Gemstone" required>
          <option value="">-- Select Gemstone --</option>
          <option value="Black Sapphire">Black Sapphire</option>
          <option value="Blue Sapphire">Blue Sapphire</option>
          <option value="Green Sapphire">Green Sapphire</option>
          <option value="Pink Sapphire">Pink Sapphire</option>
          <option value="White Sapphire">White Sapphire</option>
          <option value="Orange Sapphire">Orange Sapphire</option>
          <option value="Yellow Sapphire">Yellow Sapphire</option>
          <option value="Padparadscha Sapphire">Padparadscha Sapphire</option>
        </select>
      </div>

       <div class="form-group">
        <label>Weight</label>
        <select name="Weight" required>
          <option value="">-- Select Weight --</option>
          <option value="1 carat">1 carat</option>
        </select>
      </div>

      <div class="form-group">
        <label>Currency</label>
        <select name="Currency" required>
          <option value="">-- Select Currency --</option>
          <option value="QAR">QAR</option>
          <option value="INR">INR</option>
          <option value="USD">USD</option>
        </select>
      </div>

      <div class="form-group">
        <label>Price</label>
        <input type="number" step="0.01" name="Price" placeholder="Enter price..." required>
      </div>

      <button type="submit">💰 Save Sapphire Rate</button>
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
