<?php
include '../includes/db.php';

// ✅ Must have type
if (!isset($_GET['type'])) {
    header("Location: view_gold.php");
    exit();
}

$type = $_GET['type']; 
$table = "";
$redirect = "";

// ✅ Normal tables delete by ID
if ($type === 'gold') {
    $table = "gold_prices";
    $redirect = "view_gold.php";
} elseif ($type === 'silver') {
    $table = "silver_prices";
    $redirect = "view_silver.php";
} elseif ($type === 'diamond') {
    $table = "diamond_prices";
    $redirect = "view_diamond.php";
} elseif ($type === 'platinum') {
    $table = "platinum_prices";
    $redirect = "view_platinum.php";
} elseif ($type === 'emerald') {
    $table = "emerald_prices";
    $redirect = "view_emerald.php";
} elseif ($type === 'ruby') {
    $table = "ruby_prices";
    $redirect = "view_ruby.php";
} elseif ($type === 'sapphire') {
    $table = "sapphire_prices";
    $redirect = "view_sapphire.php";
} elseif ($type === 'pearl') {
    $table = "pearl_prices";
    $redirect = "view_pearl.php";
}

// ✅ Special Case 1: 24 Carat Gold (delete by Weight for today’s table)
elseif ($type === '24_carat_gold') {
    $table = "24_carat_gold";
    $redirect = "view_24_carat_gold.php";

    if (isset($_GET['weight']) && !empty($_GET['weight'])) {
        $weight = $conn->real_escape_string($_GET['weight']);
        $sql = "DELETE FROM `$table` WHERE Weight = '$weight'";
        if ($conn->query($sql)) {
            header("Location: {$redirect}?deleted=1");
            exit();
        } else {
            die("Error deleting record: " . $conn->error);
        }
    }
}

// ✅ Special Case 2: 24 Carat Gold History (delete all rows of given DATE)
elseif ($type === '24_carat_gold_history') {
    $table = "24_carat_gold";
    $redirect = "view_24_carat_gold.php";

    if (isset($_GET['date'])) {
        $date = $conn->real_escape_string($_GET['date']);
        $sql = "DELETE FROM `$table` WHERE DATE(created_at) = '$date'";
        if ($conn->query($sql)) {
            header("Location: {$redirect}?deleted=1");
            exit();
        } else {
            die("Error deleting records: " . $conn->error);
        }
    } else {
        header("Location: {$redirect}?error=missing_date");
        exit();
    }
}

// ✅ Special Case 1: 22 Carat Gold (delete by Weight for today’s table)
elseif ($type === '22k_gold') {
    $table = "22k_gold";
    $redirect = "view_22k_gold.php";

    if (isset($_GET['weight']) && !empty($_GET['weight'])) {
        $weight = $conn->real_escape_string($_GET['weight']);
        $sql = "DELETE FROM `$table` WHERE Weight = '$weight'";
        if ($conn->query($sql)) {
            header("Location: {$redirect}?deleted=1");
            exit();
        } else {
            die("Error deleting record: " . $conn->error);
        }
    }
}

// ✅ Special Case 2: 22 Carat Gold History (delete all rows of given DATE)
elseif ($type === '22k_gold_history') {
    $table = "22k_gold";
    $redirect = "view_22k_gold.php";

    if (isset($_GET['date'])) {
        $date = $conn->real_escape_string($_GET['date']);
        $sql = "DELETE FROM `$table` WHERE DATE(created_at) = '$date'";
        if ($conn->query($sql)) {
            header("Location: {$redirect}?deleted=1");
            exit();
        } else {
            die("Error deleting records: " . $conn->error);
        }
    } else {
        header("Location: {$redirect}?error=missing_date");
        exit();
    }
}



// ✅ Special Case 1: 21 Carat Gold (delete by Weight for today’s table)
elseif ($type === '21k_gold') {
    $table = "21k_gold";
    $redirect = "view_21k_gold.php";

    if (isset($_GET['weight']) && !empty($_GET['weight'])) {
        $weight = $conn->real_escape_string($_GET['weight']);
        $sql = "DELETE FROM `$table` WHERE Weight = '$weight'";
        if ($conn->query($sql)) {
            header("Location: {$redirect}?deleted=1");
            exit();
        } else {
            die("Error deleting record: " . $conn->error);
        }
    }
}

// ✅ Special Case 2: 21 Carat Gold History (delete all rows of given DATE)
elseif ($type === '21k_gold_history') {
    $table = "21k_gold";
    $redirect = "view_21k_gold.php";

    if (isset($_GET['date'])) {
        $date = $conn->real_escape_string($_GET['date']);
        $sql = "DELETE FROM `$table` WHERE DATE(created_at) = '$date'";
        if ($conn->query($sql)) {
            header("Location: {$redirect}?deleted=1");
            exit();
        } else {
            die("Error deleting records: " . $conn->error);
        }
    } else {
        header("Location: {$redirect}?error=missing_date");
        exit();
    }
}


// ✅ Special Case 1: 18 Carat Gold (delete by Weight for today’s table)
elseif ($type === '18k_gold') {
    $table = "18k_gold";
    $redirect = "view_18k_gold.php";

    if (isset($_GET['weight']) && !empty($_GET['weight'])) {
        $weight = $conn->real_escape_string($_GET['weight']);
        $sql = "DELETE FROM `$table` WHERE Weight = '$weight'";
        if ($conn->query($sql)) {
            header("Location: {$redirect}?deleted=1");
            exit();
        } else {
            die("Error deleting record: " . $conn->error);
        }
    }
}

// ✅ Special Case 2: 18 Carat Gold History (delete all rows of given DATE)
elseif ($type === '18k_gold_history') {
    $table = "18k_gold";
    $redirect = "view_18k_gold.php";

    if (isset($_GET['date'])) {
        $date = $conn->real_escape_string($_GET['date']);
        $sql = "DELETE FROM `$table` WHERE DATE(created_at) = '$date'";
        if ($conn->query($sql)) {
            header("Location: {$redirect}?deleted=1");
            exit();
        } else {
            die("Error deleting records: " . $conn->error);
        }
    } else {
        header("Location: {$redirect}?error=missing_date");
        exit();
    }
}


// ✅ Special Case 1: 14 Carat Gold (delete by Weight for today’s table)
elseif ($type === '14k_gold') {
    $table = "14k_gold";
    $redirect = "view_14k_gold.php";

    if (isset($_GET['weight']) && !empty($_GET['weight'])) {
        $weight = $conn->real_escape_string($_GET['weight']);
        $sql = "DELETE FROM `$table` WHERE Weight = '$weight'";
        if ($conn->query($sql)) {
            header("Location: {$redirect}?deleted=1");
            exit();
        } else {
            die("Error deleting record: " . $conn->error);
        }
    }
}

// ✅ Special Case 2: 14 Carat Gold History (delete all rows of given DATE)
elseif ($type === '14k_gold_history') {
    $table = "14k_gold";
    $redirect = "view_14k_gold.php";

    if (isset($_GET['date'])) {
        $date = $conn->real_escape_string($_GET['date']);
        $sql = "DELETE FROM `$table` WHERE DATE(created_at) = '$date'";
        if ($conn->query($sql)) {
            header("Location: {$redirect}?deleted=1");
            exit();
        } else {
            die("Error deleting records: " . $conn->error);
        }
    } else {
        header("Location: {$redirect}?error=missing_date");
        exit();
    }
}



// ✅ Default case → delete by ID
if (!empty($table) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM `$table` WHERE id = $id";
    if ($conn->query($sql)) {
        header("Location: {$redirect}?deleted=1");
        exit();
    } else {
        die("Error deleting record: " . $conn->error);
    }
}
?>
