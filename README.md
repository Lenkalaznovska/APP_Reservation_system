# Reservation System

Welcome to the Reservation System repository! This project is a web application designed for efficient reservation management. It allows users to easily create, update, and confirm reservations, while automatically sending confirmation emails. You can view the live version of the site [here(http://rezervacni-system.wz.cz:8080)

## Contents

- [Description](#description)
- [Technologies Used](#technologies-used)
- [Project Structure](#project-structure)
- [API](#api)
- [PHPMailer Library](#phpmailer-library)

## Description

The Reservation System is a web application that provides the following features:

- **Reservation Form:** Users can enter reservation details (name, phone number, email, number of people, date, and time).
- **Create Reservation:** New reservations are automatically saved to the database.
- **Update Reservation:** Users can update existing reservations based on phone number and date.
- **Reservation Confirmation:** After a reservation is successfully created or updated, a confirmation email is automatically sent.
- **Live Chat:** Real-time communication with users through the Tawk.to API.

## Technologies Used

### Frontend

- **HTML5:** Structure of the website.
- **CSS3:** Styling of the website.

### Backend

- **PHP:** Data processing and interaction with the database.
- **MySQL:** Database for storing reservation information.
- **PHPMailer:** Library for sending emails from PHP applications.

### Development Tools

- **XAMPP:** Local web server containing Apache, MySQL, and PHP.
- **Apache Server:** Web server for running PHP applications.

## Project Structure

- `index.php`: Main page with reservation form, form processing, and sending confirmation emails.
- `conn.php`: Connection to the MySQL database.
- `css/style.css`: Styling of the page.
- `PHPMailer-master`: PHPMailer library for sending emails.

## API

The project includes the following API:

- **Tawk.to chat:** API for integrating Tawk.to live chat, enabling real-time communication with users.

## PHPMailer Library

PHPMailer is used for sending confirmation emails in this project. Specifically, it serves to:

- **Send Reservation Confirmation Emails:** After a reservation is successfully created or updated, an email with reservation details is automatically sent. PHPMailer ensures that users receive immediate confirmation and are informed of all important details.
