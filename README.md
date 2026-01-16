# PHP CRUD System (XAMPP + MySQL + Tailwind CSS)

A simple and stable **PHP CRUD (Create, Read, Update, Delete)** system built with **Core PHP**, **MySQL**, and **Tailwind CSS**.  
This project includes **admin login authentication** and a clean UI, designed for learning and small academic or demo projects.

---

## 🚀 Features

- Admin Login & Logout
- Create student records
- View all students
- Update student information
- Delete students
- Flash messages (success & error)
- Clean UI using Tailwind CSS
- Secure database access using PDO

---

## 🛠️ Technologies Used

- PHP (Core PHP)
- MySQL (phpMyAdmin)
- Tailwind CSS (CDN)
- XAMPP (Apache + MySQL)

---

## 📂 Project Structure

php-crud-pro/
│
├── assets/
│ └── helpers.php
│
├── auth.php
├── config.php
├── create.php
├── delete.php
├── edit.php
├── index.php
├── login.php
├── logout.php
├── README.md

yaml
Copy code

---

## 🗄️ Database Setup

### 1️⃣ Create Database
Open **phpMyAdmin** → SQL tab → run:

```sql
CREATE DATABASE php_crud_tailwind;
USE php_crud_tailwind;
2️⃣ Create Tables
sql
Copy code
CREATE TABLE admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(120) NOT NULL,
  phone VARCHAR(40) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
3️⃣ Insert Default Admin
sql
Copy code
INSERT INTO admins (username, password_hash)
VALUES (
  'admin',
  '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
);
🔐 Default Login:

pgsql
Copy code
Username: admin
Password: password
⚙️ Configuration
Open config.php and confirm database name:

php
Copy code
$dbname = "php_crud_tailwind";
▶️ How to Run the Project
Start Apache and MySQL in XAMPP

Place the project inside:

makefile
Copy code
C:\xampp\htdocs\phpcode\php-crud-pro
Open browser:

ruby
Copy code
http://localhost/phpcode/php-crud-pro/login.php
Login using admin credentials

Start managing students 🎉

📌 Notes
This project intentionally does NOT include image upload

Designed to be simple, stable, and beginner-friendly

Uses PDO prepared statements for security

Suitable for:

University projects

Practice & learning

Small internal systems

📈 Future Improvements (Optional)
Search & pagination

Export to Excel / PDF

Email uniqueness validation

User roles (Admin / Staff)

REST API version

👤 Author
Abdi kani Mohamed
Student & Developer

📄 License
This project is free to use for learning and educational purposes.
