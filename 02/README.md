# 📧 Flow Mail - Gmail Integration Hub

A modern web application for Gmail integration built with PHP, Bootstrap, and PHPMailer. This project provides a clean interface for composing and fetching emails through Gmail's SMTP and IMAP protocols.

## 🌟 Features

- **📝 Compose Email**: Send emails using PHPMailer with Gmail SMTP
- **📬 Inbox Viewer**: Fetch and display latest emails via Gmail IMAP
- **🎨 Dark Theme**: Modern dark UI with gradient backgrounds
- **📱 Responsive Design**: Bootstrap-powered responsive layout
- **🔐 Secure Authentication**: Gmail App Password integration

## 🛠️ Tech Stack

- **Backend**: PHP 8+
- **Frontend**: HTML5, CSS3, Bootstrap 5.3.3
- **Email Library**: PHPMailer
- **Fonts**: Satoshi (via CDN)
- **Icons**: Custom SVG assets
- **Dependency Management**: Composer

## 📁 Project Structure

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

## 🚀 Installation

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

## 🔧 Configuration

### Email Settings
The application uses Gmail's servers:
- **SMTP Server**: smtp.gmail.com:587 (TLS)
- **IMAP Server**: imap.gmail.com:993 (SSL)

### Security Notes
- Never commit real credentials to version control
- Use environment variables for production
- Enable 2FA on Gmail account
- Use App Passwords instead of account password

## 🎨 Customization

### Theme Colors
Customize the color scheme in CSS variables:
```css
:root {
    --ff-satoshi: 'Satoshi', sans-serif;
    --card-bg: #0b0b0b;      /* Dark card background */
    --accent: #dfdfdf;        /* Button/accent color */
}
```

### Layout
- Cards: Adjust `gap` in `.cards-row` for spacing
- Container: Modify `max-width` in `.app-container`
- Typography: Change font sizes in component classes

## 📋 Requirements

- **PHP Extensions**:
  - `openssl`
  - `imap`
  - `mbstring`
  
- **Composer Packages**:
  - `phpmailer/phpmailer`

## 🐛 Troubleshooting

### Common Issues

**SMTP Connection Failed**
- Verify Gmail credentials
- Check App Password is correct
- Ensure 2FA is enabled on Gmail

**IMAP Connection Error**
- Enable "Less secure app access" (not recommended)
- Use App Password instead
- Check IMAP is enabled in Gmail settings

**Icons Not Loading**
- Verify SVG files are in `assets/svg/`
- Check file permissions
- Ensure web server serves static files

## 👥 Contributors

- **James Carlo Rivera** - *Initial Development*
- **Group 4** - *System Integration & Architecture*

## 📄 License

This project is created for educational purposes as part of System Integration and Architecture coursework.

## 🔗 Links

- [PHPMailer Documentation](https://github.com/PHPMailer/PHPMailer)
- [Bootstrap Documentation](https://getbootstrap.com/docs/5.3/)
- [Gmail App Password Setup](https://support.google.com/accounts/answer/185833)

---

**Built with ❤️ by Group 4 - BSIT 3rd Year**