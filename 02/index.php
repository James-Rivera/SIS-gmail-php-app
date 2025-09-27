<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Flow Mail - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        @import url('https://fonts.cdnfonts.com/css/satoshi');

        :root {
            --ff-satoshi: 'Satoshi', system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
            --band-bg: #e6e6e6;
            --card-bg: #0b0b0b;
            --accent: #dfdfdf; 
        }

        html,body {
            height: 100%;
            margin: 0;
        }

        body {
            font-family: var(--ff-satoshi);
            width: 100%;
            min-width: 1440px;
            max-height: 1024px;
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

        .cards-row {
            display: flex;
            justify-content: center;
            gap: 129px; 
            align-items: stretch;
            flex-wrap: nowrap;
        }

        .card-wrap {
            max-width: 540px;
            width: 100%;
            display: flex;
            flex-direction: column;
        }

        /* card visual */
        .card-custom {
            background: var(--card-bg);
            color: #fff;
            border-radius: 18px;
            padding: 36px 28px;
            height: 260px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 6px 18px rgba(0,0,0,0.35);
        }

        .card-icon {
            width: 56px;
            height: 56px;
            display: grid;
            place-items: center;
            border-radius: 10px;
            margin-bottom: 8px;
            margin-left: 72px;
        }

        .card-icon svg{
            display:block;
            width:32px;
            height: 32px;
        }

        .card-title { font-weight: 700; font-size: 14px; text-align:center; }
        .card-desc { font-size: 12px; color: rgba(255,255,255,0.65); text-align:center; margin-top: 6px; }

        .pill-btn {
            background: var(--accent);
            color: #111111ff;
            border: none;
            border-radius: 10px;
            padding: 12px 18px;
            width: 85%; 
            max-width: 420px;
            margin: 0 auto;
        }

        .pill-btn:hover {
            background: #002D68;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        .pill-btn:active {
            transform: translateY(0);
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }

        .app-container{
            margin-top: 164px;
        }



        .lh-tight { line-height: 1; }
    </style>
</head>
<body>
    <header class="bg-header text-white py-20 mb-4">
        <div class="container header-inner d-flex align-items-center">
            <img src="assets/svg/logo.svg" alt="Wave Logo" class="me-3" style="height: 51px; width:51px;">
            <div class="d-flex flex-column brand-stack">
                <span class="brand-main lh-tight">FLOW</span>
                <small class="brand-sub lh-tight">Mail Hub</small>
            </div>

            <div class="header-center d-none d-md-block">
                <small style="font-weight:300; opacity:.85;">GROUP - 4</small><br>
                <strong class="font-satoshi">GMAIL INTEGRATION</strong>
            </div>

            <div class="ms-auto">
                <img src="assets/svg/user.svg" alt="User" class="rounded-circle" style="height:32px; width:32px;">
            </div>
        </div>
    </header>

    <main class="container app-container">
            <div class="cards-row">
                <div class="card-wrap">
                    <div class="card-custom">
                        <div class="text-center">
                            <div class="card-icon">
                                <img src="assets/svg/compose.svg" alt="compose">
                            </div>
                            <div class="card-title">Compose Email</div>
                            <div class="card-desc">Send a new message using PHPMailer.</div>
                        </div>

                        <a href="sendemail.php" class="btn pill-btn">Write New Email</a>
                    </div>
                </div>

                <div class="card-wrap">
                    <div class="card-custom">
                        <div class="text-center">
                            <div class="card-icon">
                                <img src="assets/svg/fetch.svg" alt="fetch">
                            </div>
                            <div class="card-title">View Inbox</div>
                            <div class="card-desc">Fetch and view the latest emails via IMAP</div>
                        </div>

                        <a href="fetchemail.php" class="btn pill-btn">Go to Inbox</a>
                    </div>
                </div>
            </div>
    </main>
</body>
</html>

