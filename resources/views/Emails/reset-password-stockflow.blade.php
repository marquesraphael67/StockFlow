<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Redefinir senha - StockFlow</title>
</head>
<body style="margin:0; padding:0; background:#f4f7fb; font-family:Arial, sans-serif; color:#0f172a;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f7fb; padding:40px 0;">
    <tr>
        <td align="center">
            <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:18px; overflow:hidden; box-shadow:0 12px 35px rgba(15,23,42,.12);">

                <tr>
                    <td style="background:linear-gradient(135deg,#0f172a,#2563eb); padding:32px; color:#ffffff;">
                        <h1 style="margin:0; font-size:26px;">StockFlow</h1>
                        <p style="margin:8px 0 0; color:#dbeafe;">
                            Controle de estoque simples e profissional
                        </p>
                    </td>
                </tr>

                <tr>
                    <td style="padding:36px;">
                        <h2 style="margin:0 0 12px; font-size:24px; color:#0f172a;">
                            Redefinição de senha
                        </h2>

                        <p style="font-size:15px; line-height:1.7; color:#475569;">
                            Olá, <strong>{{ $user->name }}</strong>.
                        </p>

                        <p style="font-size:15px; line-height:1.7; color:#475569;">
                            Recebemos uma solicitação para redefinir a senha da sua conta no <strong>StockFlow</strong>.
                            Clique no botão abaixo para criar uma nova senha.
                        </p>

                        <div style="text-align:center; margin:32px 0;">
                            <a href="{{ $url }}"
                               style="background:#2563eb; color:#ffffff; padding:14px 28px; border-radius:12px; text-decoration:none; font-weight:bold; display:inline-block;">
                                Redefinir minha senha
                            </a>
                        </div>

                        <p style="font-size:14px; line-height:1.7; color:#64748b;">
                            Este link expira em 60 minutos por segurança.
                        </p>

                        <p style="font-size:14px; line-height:1.7; color:#64748b;">
                            Se você não solicitou essa alteração, ignore este e-mail.
                        </p>

                        <hr style="border:none; border-top:1px solid #e5e7eb; margin:28px 0;">

                        <p style="font-size:12px; color:#94a3b8; word-break:break-all;">
                            Se o botão não funcionar, copie e cole este link no navegador:<br>
                            {{ $url }}
                        </p>
                    </td>
                </tr>

                <tr>
                    <td style="background:#f8fafc; padding:20px 36px; text-align:center; color:#64748b; font-size:13px;">
                        © {{ date('Y') }} StockFlow — Sistema SaaS de gestão de estoque.
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>

</body>
</html>