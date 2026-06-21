<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>StockFlow</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: #e5e7eb;
            font-family: 'Inter', Arial, sans-serif;
        }

        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
        }

        .auth-card-new {
            width: 100%;
            max-width: 1050px;
            min-height: 650px;
            background: white;
            display: grid;
            grid-template-columns: 1.05fr .95fr;
            box-shadow: 0 25px 70px rgba(15, 23, 42, .25);
            overflow: hidden;
        }

        .auth-left {
            padding: 38px 48px;
            background: #f8fafc;
        }

        .auth-right {
            background: linear-gradient(135deg, #0f172a, #2563eb);
            color: white;
            padding: 60px 45px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .brand-auth {
            color: #2563eb;
            font-weight: 900;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 32px;
            font-size: 22px;
        }

        .auth-left h2 {
            font-weight: 900;
            color: #0f172a;
            letter-spacing: -1px;
        }

        label {
            font-size: 13px;
            font-weight: 700;
            color: #334155;
            margin-bottom: 5px;
        }

        .form-control,
        .form-select {
            height: 44px;
            border-radius: 10px;
            border: 1px solid #d1d5db;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 .2rem rgba(37, 99, 235, .15);
        }

        .btn {
            border-radius: 10px;
            font-weight: 700;
        }

        .floating-card {
            background: rgba(255,255,255,.96);
            color: #0f172a;
            border-radius: 18px;
            padding: 24px;
            margin-bottom: 45px;
            box-shadow: 0 20px 45px rgba(0,0,0,.25);
        }

        .preview-mini {
            background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.18);
            border-radius: 18px;
            padding: 18px;
            margin-top: 25px;
        }

        .auth-right h3 {
            font-weight: 900;
            letter-spacing: -1px;
        }

        .auth-right p {
            color: rgba(255,255,255,.78);
            line-height: 1.7;
        }

        @media(max-width: 900px) {
            .auth-card-new {
                grid-template-columns: 1fr;
            }

            .auth-right {
                display: none;
            }
        }
    </style>

    @livewireStyles
</head>

<body>
    <div class="auth-wrapper">
        {{ $slot }}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    @livewireScripts
</body>
</html>