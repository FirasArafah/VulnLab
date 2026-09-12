<?php

$db = new SQLite3('vuln_lab.db');

$db->exec("CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL,
    password TEXT NOT NULL,
    role TEXT NOT NULL
)");

$stmt = $db->prepare("INSERT OR IGNORE INTO users (username, password, role) VALUES (:username, :password, :role)");
$stmt->bindValue(':username', 'admin', SQLITE3_TEXT);
$stmt->bindValue(':password', 'admin123', SQLITE3_TEXT);
$stmt->bindValue(':role', 'admin', SQLITE3_TEXT);
$stmt->execute();

if (!file_exists('uploads')) {
    mkdir('uploads', 0755, true);
}

echo "Database and uploads directory initialized successfully.";
?>