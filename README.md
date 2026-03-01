# 🎨 Canvas | Artist Discovery Platform

Canvas is a responsive web application built with PHP and MySQL that allows users to explore digital artists. It features a secure authentication system and a modern, minimalist user interface.

---

## ✨ Key Features

* **Secure Authentication**: Full Login and Registration flow using `password_hash` and `password_verify`.
* **Data Protection**: 
    * **SQL Injection Prevention**: All queries use MySQLi Prepared Statements.
    * **XSS Protection**: User-generated content is sanitized via `htmlspecialchars()`.
* **Responsive UI**: A sleek, sliding profile navigation bar and flexible grid for artist displays.
* **Session Management**: Persistent user sessions for a seamless browsing experience.

---

## 🛠️ Technical Stack

* **Backend**: PHP 8.x
* **Database**: MySQL
* **Frontend**: HTML5, CSS3, JavaScript (ES6)

---

## 🚀 Installation & Setup

Follow these steps to get a local copy up and running:

### 1. Prerequisites
Ensure you have a local server environment installed (e.g., **XAMPP**, **WAMP**, or **Laragon**).

### 2. Database Configuration
1. Open **phpMyAdmin**.
2. Create a new database named `user_canvas`.
3. Click the **Import** tab and select: `db/user_canvas.sql`.
4. Click **Go** to generate the tables.

### 3. Environment Setup
1. Navigate to the `/config` directory.
2. Rename `config.php.example` to `config.php`.
3. Open `config.php` and enter your local database credentials:
   ```php
   $host = "localhost";
   $user = "root";      // Default for XAMPP
   $password = "";      // Default for XAMPP
   $database = "user_canvas";