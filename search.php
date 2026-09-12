<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}

$q = isset($_GET['q']) ? $_GET['q'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Search - VulnLab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <span class="navbar-brand">VulnLab</span>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="upload.php">Upload</a>
                <a class="nav-link" href="ping.php">Ping</a>
                <a class="nav-link" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">User Search</h5>
            </div>
            <div class="card-body">
                <form method="get" class="mb-4">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" placeholder="Search by name..." value="<?php echo $q; ?>">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                    </div>
                </form>

                <?php if ($q !== ''): ?>
                    <h5>Search results for:
                        <!-- VULNERABILITY: Cross‑Site Scripting (XSS) -->
                        <!-- User input echoed without htmlspecialchars() -->
                        <span class="text-danger"><?php echo $q; ?></span>
                    </h5>
                    <hr>
                    <!-- Database query remains vulnerable to SQL injection (secondary) -->
                    <?php
                    $db = new SQLite3('vuln_lab.db');
                    $result = $db->query("SELECT username FROM users WHERE username LIKE '%$q%'");
                    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                        echo '<div class="list-group-item">' . htmlspecialchars($row['username']) . '</div>';
                    }
                    ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>