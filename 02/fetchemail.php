<?php
// Connect to Gmail IMAP server
$hostname = '{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX';
$username = 'jamescarlorivera52@gmail.com';
$password = 'jiimqbowhcyjwgrz';

$emails_data = [];
$error_message = '';

// Try to connect
try {
    $inbox = imap_open($hostname, $username, $password);
    
    if ($inbox) {
        // Get emails (latest 10)
        $emails = imap_search($inbox, 'ALL');
        
        if ($emails) {
            rsort($emails); // Newest first
            foreach (array_slice($emails, 0, 10) as $email_number) {
                $overview = imap_fetch_overview($inbox, $email_number, 0);
                $message = imap_fetchbody($inbox, $email_number, 1);
                
                $emails_data[] = [
                    'subject' => isset($overview[0]->subject) ? $overview[0]->subject : 'No Subject',
                    'from' => isset($overview[0]->from) ? $overview[0]->from : 'Unknown Sender', 
                    'date' => isset($overview[0]->date) ? date('M j, Y', strtotime($overview[0]->date)) : 'Unknown Date',
                    'message' => substr(strip_tags($message), 0, 100) . '...'
                ];
            }
        }
        
        // Close connection
        imap_close($inbox);
    } else {
        $error_message = 'Cannot connect: ' . imap_last_error();
    }
} catch (Exception $e) {
    $error_message = 'Error: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Flow Mail - Inbox</title>
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

        /* Card layout for inbox */
        .inbox-card {
            background: var(--card-bg);
            color: #fff;
            border-radius: 18px;
            padding: 32px;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 8px 24px rgba(0,0,0,0.35);
        }

        .inbox-header {
            display: flex;
            align-items: center;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid #444;
        }

        .inbox-title {
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

        .email-item {
            padding: 16px;
            border: 1px solid #444;
            border-radius: 8px;
            margin-bottom: 12px;
            background: #1a1a1a;
            transition: box-shadow 0.2s ease;
        }

        .email-item:hover {
            box-shadow: 0 2px 8px rgba(255,255,255,0.1);
        }

        .email-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .email-sender {
            font-weight: 600;
            color: #fff;
            font-size: 14px;
        }

        .email-date {
            font-size: 12px;
            color: rgba(255,255,255,0.7);
        }

        .email-subject {
            font-weight: 500;
            color: #111;
            font-size: 14px;
            margin-bottom: 8px;
            background: #d4edda;
            padding: 8px 12px;
            border-radius: 6px;
        }

        .email-preview {
            font-size: 13px;
            color: rgba(255,255,255,0.7);
            line-height: 1.4;
        }

        .no-emails {
            text-align: center;
            padding: 40px;
            color: rgba(255,255,255,0.7);
        }

        .app-container {
            margin-top: 48px;
            padding: 0 24px;
        }

        .inbox-footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 16px;
            border-top: 1px solid #444;
            color: rgba(255,255,255,0.7);
            font-size: 14px;
        }
    </style>
</head>
<body>
    <header class="bg-header text-white py-20 mb-4">
        <div class="container header-inner d-flex align-items-center">
            <img src="logo.svg" alt="Flow Logo" class="me-3" style="height: 51px; width:51px;">
            <div class="d-flex flex-column brand-stack">
                <span class="brand-main lh-tight">FLOW</span>
                <small class="brand-sub lh-tight">Mail Hub</small>
            </div>

            <div class="header-center d-none d-md-block">
                <small style="font-weight:300; opacity:.85;">GROUP - 4</small><br>
                <strong>GMAIL INTEGRATION</strong>
            </div>

            <div class="ms-auto">
                <img src="user.svg" alt="User" class="rounded-circle" style="height:32px; width:32px;">
            </div>
        </div>
    </header>

    <main class="container app-container">
        <div class="inbox-card">
            <!-- Header with logo and title -->
            <div class="inbox-header">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 6.5L12 13.5L21 6.5" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M3 6.5h18v11a1 1 0 01-1 1H4a1 1 0 01-1-1v-11z" stroke="#fff" stroke-width="1.5"/>
                </svg>
                <h1 class="inbox-title">Flow Mail</h1>
            </div>

            <h2 class="h4 fw-bold mb-3" style="color: #fff;">Inbox</h2>

            <!-- Back to Dashboard Link -->
            <a href="index.php" class="back-link">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 12H5M12 19L5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Back to Dashboard
            </a>

            <?php if($error_message): ?>
                <div class="alert alert-danger"><?= $error_message ?></div>
            <?php endif; ?>

            <!-- Email List -->
            <div class="emails-container">
                <?php if(empty($emails_data)): ?>
                    <div class="no-emails">
                        <p>No emails found or unable to connect to the server.</p>
                    </div>
                <?php else: ?>
                    <?php foreach($emails_data as $email): ?>
                        <div class="email-item">
                            <div class="email-header">
                                <div class="email-sender"><?= htmlspecialchars($email['from']) ?></div>
                                <div class="email-date"><?= htmlspecialchars($email['date']) ?></div>
                            </div>
                            
                            <div class="email-subject">
                                <?= htmlspecialchars($email['subject']) ?>
                            </div>
                            
                            <div class="email-preview">
                                <?= htmlspecialchars($email['message']) ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    
                    <div class="inbox-footer">
                        Showing latest <?= count($emails_data) ?> messages.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>
</body>
</html>