<?php
// 1. REQUIRE PHPMailer & AUTOLOAD
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require __DIR__ . '/vendor/autoload.php';

// Initialize status variable
$status_message = '';
$status_class = ''; // For Bootstrap alert color

// 2. CHECK IF FORM WAS SUBMITTED
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 3. CAPTURE FORM DATA
    $recipient = $_POST['recipient'] ?? '';
    $subject   = $_POST['subject'] ?? 'No Subject';
    $message   = $_POST['message'] ?? 'Empty Message';
    
    $mail = new PHPMailer(true);

    try {
        // --- PHPMailer Settings ---
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'avera.visuals@gmail.com';     // Your Gmail address
        $mail->Password   = 'qcmdrapfxecmmtnp';           // Your generated App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        
        // --- Recipients and Content (USING FORM DATA) ---
        $mail->setFrom('avera.visuals@gmail.com', 'Avera Visuals (Flow Mail)');
        
        // Add the dynamic recipient from the form
        $mail->addAddress($recipient); 
        
        // Set dynamic content
        $mail->isHTML(true); 
        $mail->Subject = $subject;
        $mail->Body    = nl2br(htmlspecialchars($message)); // nl2br converts newlines to <br>
        $mail->AltBody = htmlspecialchars($message); // Plain text fallback
        
        $mail->send();
        $status_message = 'Email sent successfully!';
        $status_class = 'success';
        
    } catch (Exception $e) {
        $status_message = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        $status_class = 'danger';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Flow Mail - Compose Email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        @import url('https://fonts.cdnfonts.com/css/satoshi');

        :root {
            --ff-satoshi: 'Satoshi', system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
            --card-bg: #0b0b0b;
            --accent: #dfdfdf;
        }

        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            font-family: var(--ff-satoshi);
            width: 100%;
            min-width: 1440px;
            min-height: 1024px;
            background: linear-gradient(134deg, #9BB7DB -15.56%, #6E757E 43.57%, #002D68 102.7%);
        }

        .bg-header {
            background: rgba(0,0,0,0.94);
        }
        .py-20 { padding-top: 20px !important; padding-bottom: 20px !important; }

        .header-inner { position: relative; }
        .brand-stack { line-height: 1; }
        .brand-stack .brand-main { font-size: 20px; font-weight: 700; }
        .brand-stack .brand-sub { font-size: 12px; letter-spacing: 4.6px; opacity: .85; text-transform: uppercase; }
        .header-center { position: absolute; left: 50%; transform: translateX(-50%); top: 50%; translate: 0 -50%; text-align: center; }
        .lh-tight { line-height: 1; }

        /* Card layout for compose form */
        .compose-card {
            background: var(--card-bg);
            color: #fff;
            border-radius: 18px;
            padding: 32px;
            max-width: 480px;
            margin: 0 auto;
            box-shadow: 0 8px 24px rgba(0,0,0,0.35);
        }

        .compose-header {
            display: flex;
            align-items: center;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid #444;
        }

        .compose-title {
            font-size: 24px;
            font-weight: 700;
            color: #fff;
            margin: 0 0 0 12px;
        }

        .back-link {
            display: flex;
            align-items: center;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-size: 14px;
            margin-bottom: 20px;
            transition: color 0.2s ease;
        }

        .back-link:hover {
            color: var(--accent);
        }

        .back-link svg {
            margin-right: 8px;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #444;
            background: #1a1a1a;
            color: #fff;
            padding: 12px 16px;
            font-size: 14px;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-control:focus {
            border-color: var(--accent);
            background: #222;
            color: #fff;
            box-shadow: 0 0 0 0.2rem rgba(223, 223, 223, 0.25);
        }

        .form-control::placeholder {
            color: rgba(255,255,255,0.5);
        }

        .form-label {
            font-weight: 600;
            color: #fff;
            margin-bottom: 8px;
        }

        .send-btn {
            background: var(--accent);
            color: #111;
            border: none;
            border-radius: 8px;
            padding: 12px 24px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            transition: all 0.2s ease;
        }

        .send-btn:hover {
            background: #c5c5c5;
            color: #111;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(223, 223, 223, 0.3);
        }

        .send-btn svg {
            margin-left: 8px;
        }

        .success-alert {
            background: #155724;
            border: 1px solid #28a745;
            color: #d4edda;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .danger-alert {
            background: #721c24;
            border: 1px solid #dc3545;
            color: #f8d7da;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .app-container {
            margin-top: 48px;
            padding: 0 24px;
        }
    </style>
</head>
<body>
    <header class="bg-header text-white py-20 mb-4">
        <div class="container header-inner d-flex align-items-center">
            <img src="assets/svg/logo.svg" alt="Flow Logo" class="me-3" style="height: 51px; width:51px;">
            <div class="d-flex flex-column brand-stack">
                <span class="brand-main lh-tight">FLOW</span>
                <small class="brand-sub lh-tight">Mail Hub</small>
            </div>

            <div class="header-center d-none d-md-block">
                <small style="font-weight:300; opacity:.85;">GROUP - 4</small><br>
                <strong>GMAIL INTEGRATION</strong>
            </div>

            <div class="ms-auto">
                <img src="assets/svg/user.svg" alt="User" class="rounded-circle" style="height:32px; width:32px;">
            </div>
        </div>
    </header>

    <main class="container app-container">
        <div class="compose-card">
            <!-- Header with logo and title -->
            <div class="compose-header">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 6.5L12 13.5L21 6.5" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M3 6.5h18v11a1 1 0 01-1 1H4a1 1 0 01-1-1v-11z" stroke="#fff" stroke-width="1.5"/>
                </svg>
                <h1 class="compose-title">Flow Mail</h1>
            </div>

            <h2 class="h4 fw-bold mb-3" style="color: #fff;">Compose Email</h2>

            <!-- Back to Dashboard Link -->
            <a href="index.php" class="back-link">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 12H5M12 19L5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Back to Dashboard
            </a>

            <!-- Success/Error message -->
            <?php if($status_message): ?>
            <div class="<?= $status_class ?>-alert">
                <?= $status_message ?>
            </div>
            <?php endif; ?>

            <!-- Email Form -->
            <form method="POST" action="sendemail.php">
                <div class="mb-3">
                    <label for="recipient" class="form-label">Recipient</label>
                    <input type="email" class="form-control" id="recipient" name="recipient" placeholder="Enter email address" required>
                </div>

                <div class="mb-3">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter email subject" required>
                </div>

                <div class="mb-4">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="6" placeholder="Type your message here..." required></textarea>
                </div>

                <button type="submit" class="btn send-btn">
                    Send Email
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22 2L11 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M22 2L15 22L11 13L2 9L22 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </form>
        </div>
    </main>
</body>
</html>