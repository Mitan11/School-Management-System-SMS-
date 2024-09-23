
# 📚 School Management System 📅

This project is a **School Management System** that allows you to manage and track various school activities, including student attendance. The system includes a calendar view to display attendance status for each day.

## ✨ Features

- 📋 Display attendance records for a specific student.
- 📆 Calendar view with attendance status (✅ Present, ❌ Absent, 🏖️ Leave, ⏰ Late).
- 🔄 Navigation through months and years.
- 🔒 Secure database queries using prepared statements.
- 📋 Students can view their timetable.
- 📆 Admin or teachers can manage the timetable.
- 💳 Parents can pay fees.

## 🛠️ Technologies Used

- 🐘 PHP
- 🐬 MySQL
- 🌐 HTML
- 🎨 CSS
- 💻 JavaScript

## 🚀 Setup Instructions

### 📋 Prerequisites

- 🐘 PHP 7.0 or higher
- 🐬 MySQL 5.6 or higher
- 🌐 Web server (e.g., Apache, Nginx)

### 📥 Installation

1. 📂 Clone the repository to your local machine:
    ```sh
    git clone https://github.com/Mitan11/School-Management-System-SMS-.git
    ```

2. 📁 Navigate to the project directory:
    ```sh
    Rename the directory `School-Management-System-SMS-` to `School-Management-System - Copy`.
    ```

3. 🗄️ Import the database schema:
    - Create a new database in MySQL named `SchoolManagementSystem`.
    - Import the `SchoolManagementSystem.sql` file into your database.

4. 🛠️ Update the database connection details (host, username, password, database name) if required. By default, in XAMPP, the host is `localhost`, the username is `root`, the password is `''`, and the database name will be `SchoolManagementSystem`.

    ```php
    <?php
    $db_connection = mysqli_connect('localhost', 'username', 'password', 'database_name');

    if (!$db_connection) {
        die("Connection failed: " . mysqli_connect_error());
    }
    ?>
    ```

5. 🌐 Start your web server and navigate to the project directory in your browser.

## 📖 Usage

1. 🌐 Open the application in your web browser.
2. 📊 Navigate to the attendance management section.
3. 👨‍🎓 View and manage attendance records for students.
4. 📅 Use the calendar to view attendance status for each day.
5. ➕ Add new students and teachers to the system.
6. 📅 Create and manage timetables.
7. 👨‍🎓 Students can view their timetables.
8. 💰 Manage and process fee payments.
9. 📈 Generate attendance reports for a specific period.

## 🗂️ File Structure

- `📁 includes/`: Contains configuration files.
- `📁 Student/`: Contains the main application files.
  - `📄 attendance.php`: Main file for managing attendance.
  - `📄 Calendar.php`: Class file for rendering the calendar.
- `📄 header.php`: Header file included in the main layout.
- `📄 sidebar.php`: Sidebar file included in the main layout.
- `📄 footer.php`: Footer file included in the main layout.

## 🙏 Acknowledgements

- Thanks to all the contributors and open-source projects that made this project possible.
