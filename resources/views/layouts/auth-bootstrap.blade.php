<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>StockFlow</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0d6efd, #052c65);
            font-family: Arial, sans-serif;
        }

        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
        }

        .auth-card {
            width: 100%;
            max-width: 520px;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 20px 45px rgba(0,0,0,.25);
            overflow: hidden;
        }

        .auth-header {
            background: #f8fafc;
            padding: 28px;
            text-align: center;
            border-bottom: 1px solid #e5e7eb;
        }

        .auth-header i {
            font-size: 42px;
            color: #0d6efd;
        }

        .auth-body {
            padding: 30px;
        }

        .form-control,
        .form-select {
            height: 46px;
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