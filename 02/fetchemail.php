<?php
// Connect to Gmail IMAP server
$hostname = '{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX';
$username = 'jamescarlorivera52@gmail.com';
$password = 'jiimqbowhcyjwgrz';

// Try to connect
$inbox = imap_open($hostname, $username, $password) or die('Cannot connect: ' . imap_last_error());

// Get emails (latest 10)
$emails = imap_search($inbox, 'ALL');

if ($emails) {
    rsort($emails); // Newest first
    foreach (array_slice($emails, 0, 10) as $email_number) {
        $overview = imap_fetch_overview($inbox, $email_number, 0);
        $message  = imap_fetchbody($inbox, $email_number, 1);

        echo "Subject: " . (isset($overview[0]->subject) ? $overview[0]->subject : 'No Subject') . "\n";
        echo "From: "    . (isset($overview[0]->from) ? $overview[0]->from : 'Unknown Sender') . "\n";
        echo "Date: "    . (isset($overview[0]->date) ? $overview[0]->date : 'Unknown Date') . "\n";
        echo "Message: " . substr($message, 0, 100) . "...\n\n";
    }
} else {
    echo "No emails found.\n";
}

// Close connection
imap_close($inbox);
?>