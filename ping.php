<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}

$output = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ip'])) {
    $ip = $_POST['ip'];

    $output = shell_exec("ping -c 4 " . $ip);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ping - VulnLab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <span class="navbar-brand">VulnLab</span>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="search.php">Search</a>
                <a class="nav-link" href="upload.php">Upload</a>
                <a class="nav-link" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Ping an IP Address</h5>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="ip" placeholder="e.g. 8.8.8.8" required>
                        <button class="btn btn-primary" type="submit">Ping</button>
                    </div>
                </form>
                <?php if ($output !== ''): ?>
                    <h6>Result:</h6>
                    <pre class="bg-dark text-light p-3 rounded"><?php echo $output; ?></pre>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>