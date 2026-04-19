# 🎓 Career AI - AI Powered Career Counseling System

A smart career counseling web application built with PHP, MySQL, and Claude AI.

---

## 🚀 Features

- 🔐 Admin Login System
- 📝 Student Details Form
- 🤖 AI Career Analysis (Powered by Claude AI)
- 📊 Performance Analysis
- 🏆 Top 3 Career Suggestions
- 🗺️ Career Road Map
- 📚 Study Tips
- 💰 Salary Range Information
- 💪 Motivational Messages
- 📋 History of All Analyses

---

## 🛠️ Tech Stack

- **Frontend:** HTML, CSS
- **Backend:** PHP
- **Database:** MySQL (phpMyAdmin)
- **AI:** Claude AI (Anthropic API)
- **Server:** XAMPP (Apache)

---

## ⚙️ Installation

1. **Clone the repository**

git clone https://github.com/mahen215/Career_AI.git

2. **Move to XAMPP htdocs folder**
C:\xampp\htdocs\career-ai

3. **Database setup** — phpMyAdmin mein ye SQL run karo:
```sql
   CREATE DATABASE IF NOT EXISTS career_ai;
   USE career_ai;

   CREATE TABLE students (
     id INT AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR(100) NOT NULL,
     age INT NOT NULL,
     marks_10th INT NOT NULL,
     marks_12th INT NOT NULL,
     interests VARCHAR(100) NOT NULL,
     fav_subject VARCHAR(100) NOT NULL,
     course VARCHAR(100) NOT NULL
   );

   CREATE TABLE admin (
     id INT AUTO_INCREMENT PRIMARY KEY,
     username VARCHAR(50) NOT NULL,
     password VARCHAR(50) NOT NULL
   );

   INSERT INTO admin (username, password) VALUES ('admin', 'admin123');
```

4. **API Key setup** — `ai_career.php` mein apni Anthropic API key daalo:
```php
   $api_key = "YOUR_API_KEY_HERE";
```

5. **Run the project**

http://localhost/career-ai/index.php

---

## 🔐 Login Credentials

| Username | Password |
|----------|----------|
| admin    | admin123 |

---

## 👨‍💻 Developer

Made with ❤️ by **Mahen**

---

## 📄 License

This project is open source and available under the MIT License.
