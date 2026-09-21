# VulnLab - Vulnerable Web Application Lab

A deliberately vulnerable PHP web application built for **Red Team / Blue Team** security training. It demonstrates the full attack lifecycle in a controlled lab environment: deployment, exploitation, detection, and remediation.

---

## ⚠️ WARNING

This application is **intentionally insecure**. It contains four known vulnerabilities that can lead to **Remote Code Execution (RCE)** and full system compromise.

> **DO NOT** deploy this application on a public server, production environment, or any system connected to the internet. It is designed strictly for educational and laboratory use.

---

## Overview

VulnLab was developed as part of a cybersecurity course project simulating a real-world attack and defense scenario. The application is a simple user-management web tool with four intentional vulnerabilities. It is designed to be paired with a SIEM solution for log ingestion, detection, and incident response practice.

---

## Vulnerabilities Implemented

| # | Vulnerability | File |
|---|---------------|------|
| 1 | SQL Injection (SQLi) | `index.php` |
| 2 | Cross-Site Scripting (XSS) | `search.php` |
| 3 | OS Command Injection | `ping.php` |
| 4 | Unrestricted File Upload | `upload.php` |

---

## Tech Stack

- **PHP** 7.4 or higher
- **SQLite 3**
- **Bootstrap 5**
- **Apache** or PHP built-in server

---

## Project Structure

    VulnLab/
    ├── index.php        Login page
    ├── search.php       User search page
    ├── ping.php         Network ping utility
    ├── upload.php       File upload page
    ├── logout.php       Session destroy
    ├── setup.php        Initializes database and uploads folder
    ├── vuln_lab.db      SQLite database (created by setup.php)
    └── uploads/         Directory for uploaded files

---

## Setup

1. **Clone the repository**

   ```bash
   git clone https://github.com/FirasArafah/VulnLab.git
   cd VulnLab
   ```

2. **Initialize the database**

   ```bash
   php setup.php
   ```

3. **Start a local server**

   ```bash
   php -S localhost:8000
   ```

4. **Open the browser**

       http://localhost:8000

5. **Default credentials**

   | Field | Value |
   |-------|-------|
   | Username | `admin` |
   | Password | `admin123` |

---

## Branches

| Branch | Description |
|--------|-------------|
| `main` | Patched version |
| `vulnerable` | Original vulnerable version |

## Tags

| Tag | Description |
|-----|-------------|
| `v1.0-vulnerable` | Initial vulnerable release |
| `v1.1-patched` | Fully patched release |

---

## Ethical Use

This project is published for **educational and portfolio purposes only**.

- Do not use any technique demonstrated in this repository against systems you do not own or have explicit written permission to test.
- Unauthorized access to computer systems is illegal.

By using this project, you agree to use it only in legal, controlled, and authorized environments.

---