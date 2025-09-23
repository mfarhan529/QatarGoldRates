<?php include 'includes/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CRM Dashboard</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" />
  <script src="https://unpkg.com/lucide@latest"></script>
  <style>
    :root {
      --bg: #f9fafb;
      --text: #1f2937;
      --sidebar-bg: #111827;
      --sidebar-text: #9ca3af;
      --sidebar-active: #2563eb;
      --card-bg: rgba(255, 255, 255, 0.9);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      display: flex;
      background-color: var(--bg);
      color: var(--text);
    }

    .sidebar {
      width: 260px;
      background: var(--sidebar-bg);
      color: var(--sidebar-text);
      height: 100vh;
      position: fixed;
      padding: 2rem 1rem;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      transition: 0.3s;
    }

    .sidebar .top {
      display: flex;
      flex-direction: column;
      gap: 2rem;
    }

    .logo {
      font-size: 22px;
      color: #fff;
      font-weight: 600;
      text-align: center;
    }

    .sidebar ul {
      list-style: none;
    }

    .sidebar ul li {
      margin: 1rem 0;
    }

    .sidebar ul li a {
      text-decoration: none;
      display: flex;
      align-items: center;
      color: var(--sidebar-text);
      padding: 0.6rem 1rem;
      border-radius: 8px;
      transition: 0.3s ease;
    }

    .sidebar ul li a:hover,
    .sidebar ul li a.active {
      background-color: #1f2937;
      color: white;
    }

    .sidebar ul li a svg {
      margin-right: 10px;
      stroke-width: 1.8;
    }

    .profile {
      text-align: center;
      margin-top: 2rem;
    }

    .profile img {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 0.5rem;
    }

    .profile p {
      color: #d1d5db;
      font-size: 14px;
    }

    .main {
      margin-left: 260px;
      padding: 2rem;
      width: 100%;
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 2rem;
    }

    header h1 {
      font-size: 28px;
    }

    .theme-toggle {
      cursor: pointer;
      padding: 0.5rem;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    .content {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 1.5rem;
    }

    .card {
      padding: 1.5rem;
      background: var(--card-bg);
      border-radius: 14px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
      backdrop-filter: blur(8px);
      transition: 0.4s;
      text-align: center;
    }

    .card h3 {
      font-size: 18px;
      margin-bottom: 0.4rem;
    }

    .card p {
      font-size: 32px;
      font-weight: bold;
      color: #2563eb;
      transition: 0.3s ease-in-out;
    }

    .card p::after {
      content: '+';
      opacity: 0.3;
      margin-left: 4px;
    }

    /* Dark mode styles */
    body.dark {
      --bg: #0f172a;
      --text: #f1f5f9;
      --sidebar-bg: #0f172a;
      --sidebar-text: #94a3b8;
      --card-bg: rgba(30, 41, 59, 0.9);
    }

    .dark .card p {
      color: #60a5fa;
    }

    @media (max-width: 768px) {
      .sidebar {
        display: none;
      }
      .main {
        margin-left: 0;
      }
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <aside class="sidebar">
    <div class="top">
      <div class="logo">🏗️ Renovation CRM</div>
      <ul>
        <li><a href="dashboard.php" class="active"><i data-lucide="layout-dashboard"></i>Dashboard</a></li>
        <li><a href="leads.php"><i data-lucide="users"></i>Leads</a></li>
        <li><a href="clients.php"><i data-lucide="user-check"></i>Clients</a></li>
        <li><a href="projects.php"><i data-lucide="briefcase"></i>Projects</a></li>
        <li><a href="invoices.php"><i data-lucide="file-text"></i>Invoices</a></li>
        <li><a href="accounting.php"><i data-lucide="credit-card"></i>Accounting</a></li>
        <li><a href="suppliers.php"><i data-lucide="truck"></i>Suppliers</a></li>
        <li><a href="analytics.php"><i data-lucide="bar-chart-2"></i>Analytics</a></li>
      </ul>
    </div>
    <div class="profile">
      <img src="https://i.pravatar.cc/100?img=15" alt="User Avatar">
      <p>Admin</p>
    </div>
  </aside>

  <!-- Main Content -->
  <div class="main">
    <header>
      <h1>Dashboard</h1>
      <div class="theme-toggle" onclick="toggleTheme()">
        <i data-lucide="moon"></i>
      </div>
    </header>

    <section class="content">
      <div class="card">
        <h3>Total Clients</h3>
        <p id="countClients">0</p>
      </div>
      <div class="card">
        <h3>Total Leads</h3>
        <p id="countLeads">0</p>
      </div>
      <div class="card">
        <h3>Total Projects</h3>
        <p id="countProjects">0</p>
      </div>
      <div class="card">
        <h3>Total Invoices</h3>
        <p id="countInvoices">0</p>
      </div>
    </section>
  </div>

  <!-- Scripts -->
  <script>
    lucide.createIcons();

    const values = {
      countClients: <?= $conn->query("SELECT COUNT(*) AS total FROM clients")->fetch_assoc()['total'] ?>,
      countLeads: <?= $conn->query("SELECT COUNT(*) AS total FROM leads")->fetch_assoc()['total'] ?>,
      countProjects: <?= $conn->query("SELECT COUNT(*) AS total FROM projects")->fetch_assoc()['total'] ?>,
      countInvoices: <?= $conn->query("SELECT COUNT(*) AS total FROM invoices")->fetch_assoc()['total'] ?>
    };

    function animateValue(id, end) {
      let start = 0;
      const duration = 800;
      const increment = Math.ceil(end / (duration / 10));
      const el = document.getElementById(id);
      const timer = setInterval(() => {
        start += increment;
        if (start >= end) {
          start = end;
          clearInterval(timer);
        }
        el.textContent = start;
      }, 20);
    }

    window.onload = () => {
      for (const id in values) {
        animateValue(id, values[id]);
      }
    };

    function toggleTheme() {
      document.body.classList.toggle('dark');
    }
  </script>
</body>
</html>
