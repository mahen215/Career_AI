# 🎓 Career AI - AI Powered Career Counseling System

A smart career counseling web application built with PHP, MySQL, and Claude AI.

---

## 🚀 Features

- 🔐 Admin Login System (3D Flip Card)
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
- **Server:** XAMPP / Docker

---

## 🐳 Docker Setup (Recommended)

### Requirements
- Docker Desktop installed
- Git installed

### Steps

**1. Clone the repository**

git clone https://github.com/mahen215/Career_AI.git

cd Career_AI

**2. Start Docker containers**



docker-compose up --build



**3. Open phpMyAdmin**
- Username: `root`
- Password: `root`

**4. Create tables — SQL tab mein ye run karo:**
```sql
CREATE TABLE IF NOT EXISTS students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  age INT NOT NULL,
  marks_10th INT NOT NULL,
  marks_12th INT NOT NULL,
  interests VARCHAR(100) NOT NULL,
  fav_subject VARCHAR(100) NOT NULL,
  course VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS admin (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(50) NOT NULL
);

INSERT INTO admin (username, password) VALUES ('admin', 'admin123');
```

**5. Open Project**
localhost:8080

**6. API Key Setup — `ai_career.php` mein apni key daalo:**
```php
$api_key = "YOUR_ANTHROPIC_API_KEY";
```

---

## 💻 XAMPP Setup

**1. Clone the repository**

git clone https://github.com/mahen215/Career_AI.git

**2. Move to htdocs folder**

C:\xampp\htdocs\career-ai

**3. Database setup — phpMyAdmin mein ye SQL run karo:**
```sql
CREATE DATABASE IF NOT EXISTS career_ai;
USE career_ai;
-- (same tables as above)
```

**4. Run the project**
localhost/career-ai/index.php
---

## 🐳 Docker Commands

```bash
# Project start karo
docker-compose up

# Background mein run karo
docker-compose up -d

# Project band karo
docker-compose down

# Logs dekho
docker-compose logs

# Containers check karo
docker ps
```

---

## 🔐 Login Credentials

| Username | Password |
|----------|----------|
| admin    | admin123 |

---

## 📁 Project Structure
career-ai/
├── db.php             
├── index.php           
├── dashboard.php       
├── student_form.php    
├── ai_career.php       
├── history.php         
├── delete_history.php  
├── logout.php         
├── style.css           
├── Dockerfile          
├── docker-compose.yml  
└─ README.md           
---

## 👨‍💻 Developer

Made with ❤️ by **Mahendra Prajapat**

---

## 📄 License

This project is open source and available under the MIT License.
