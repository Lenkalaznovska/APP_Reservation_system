# 📅 Reservation System

A simple and effective web application for managing reservations. The system features a straightforward form for creating and updating reservations, with automated email confirmations sent to clients using the PHPMailer library.

The live version is available here: [rezervacni-system.wz.cz](http://rezervacni-system.wz.cz:8080)

<img width="516" height="813" alt="Reservation form on a mobile device" src="https://github.com/user-attachments/assets/b6c772ed-00c9-4ce7-b1b7-541bf53f9682" />

---

## ✨ Key Features

-   **Create & Update Reservations:** A simple interface for users to submit new reservations or update existing ones.
-   **Automated Email Confirmations:** Utilizes PHPMailer to instantly send detailed confirmation emails to clients upon successful submission.
-   **Input Validation:** Includes backend validation to ensure data integrity, such as a required pattern for phone numbers.
-   **Secure Database Operations:** Uses `mysqli` with prepared statements to prevent SQL injection vulnerabilities.
-   **Third-Party Chat Integration:** Integrated with Tawk.to for live user support.
-   **Responsive Design:** A clean and simple layout that works on both desktop and mobile devices.

---

## 🛠️ Technology Stack

This project uses a classic web stack without any complex frameworks, making it lightweight and easy to understand.

-   **Frontend:**
    -   **HTML5**
    -   **Vanilla CSS3**
-   **Backend:**
    -   **PHP** (utilizing the procedural `mysqli` extension for database communication)
    -   **MySQL / MariaDB**
    -   XAMPP: Local web server containing Apache, MySQL, and PHP.
-   **Dependencies:**
    -   **PHPMailer:** A popular PHP library for sending emails, included manually in the project.

---

## 🗃️ Database Schema

Here is the SQL command to create the necessary `reservations` table.

<details>
  <summary>Click to view SQL Schema</summary>
  
  ```sql
  CREATE TABLE `reservations` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `Name` VARCHAR(255) NOT NULL,
    `Phone` VARCHAR(20) NOT NULL,
    `Email` VARCHAR(255) NOT NULL,
    `NumberOfPersons` INT NOT NULL,
    `ReservationDate` DATE NOT NULL,
    `ReservationTime` TIME NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY `unique_reservation` (`Phone`, `ReservationDate`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
