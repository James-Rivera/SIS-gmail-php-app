## Flow Mail - Gmail Integration Hub

A modern web application for Gmail integration built with PHP, Bootstrap, and PHPMailer. This project provides a clean interface for composing and fetching emails through Gmail's SMTP and IMAP protocols.

## Features

Compose Email**: Send emails using PHPMailer with Gmail SMTP
Inbox Viewer**: Fetch and display latest emails via Gmail IMAP
Dark Theme**: Modern dark UI with gradient backgrounds
Responsive Design**: Bootstrap-powered responsive layout
ecure Authentication**: Gmail App Password integration


## Project Structure

```
Flow Mail/
├── assets/
│   └── svg/           # SVG icons and graphics
│       ├── compose.svg
│       ├── fetch.svg
│       ├── logo.svg
│       └── user.svg
├── vendor/            # Composer dependencies
├── index.php          # Main dashboard
├── sendemail.php      # Email composition page
├── fetchemail.php     # Inbox viewer page
├── composer.json      # Dependencies
└── README.md          # This file
```

##  Installation

### Prerequisites
- PHP 8.0 or higher
- Composer
- Gmail account with App Password enabled
- Web server (Apache/Nginx) or PHP built-in server

### Setup Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/James-Rivera/System-Integration-and-Architecture.git
   cd "02"
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Configure Gmail credentials**
   
   Edit the email configuration in `sendemail.php` and `fetchemail.php`:
   
   **For sendemail.php:**
   ```php
   $mail->Username = 'your-email@gmail.com';    // Your Gmail address
   $mail->Password = 'your-app-password';       // Gmail App Password
   ```
   
   **For fetchemail.php:**
   ```php
   $username = 'your-email@gmail.com';
   $password = 'your-app-password';
   ```

4. **Generate Gmail App Password**
   - Go to Google Account settings
   - Security → 2-Step Verification → App passwords
   - Generate a new app password for "Mail"
   - Use this password in your configuration

5. **Start the server**
   ```bash
   php -S localhost:8000
   ```

6. **Access the application**
   Open `http://localhost:8000` in your browser

## 🎯 Usage

### Dashboard
- Navigate between compose and inbox features
- Clean card-based interface with hover effects

### Compose Email
- Fill in recipient, subject, and message
- Real-time form validation
- Success/error feedback

### View Inbox
- Displays latest 10 emails
- Shows sender, subject, date, and preview
- Auto-refreshes email list


