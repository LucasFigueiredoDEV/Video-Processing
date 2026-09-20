<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Recuperação de senha</title>
</head>

<body style="margin: 0; padding: 0; background-color: #f5f7fa; font-family: Arial, Helvetica, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" border="0"
        style="background-color: #f5f7fa; padding: 40px 15px;">

        <tr>
            <td align="center">

                <table width="100%" cellpadding="0" cellspacing="0" border="0"
                    style="max-width: 600px; background-color: #ffffff; border-radius: 10px; overflow: hidden;">

                    <!-- Header -->
                    <tr>
                        <td style="padding: 30px; text-align: center; background-color: #111827;">

                            <h1 style="margin: 0; color: #ffffff; font-size: 24px;">
                                {{ config('app.name') }}
                            </h1>

                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px 35px;">

                            <h2 style="margin-top: 0; color: #111827; font-size: 22px;">
                                Recuperação de senha
                            </h2>

                            <p style="color: #4b5563; font-size: 16px; line-height: 1.6;">
                                Olá, {{ $user->name }}!
                            </p>

                            <p style="color: #4b5563; font-size: 16px; line-height: 1.6;">
                                Recebemos uma solicitação para redefinir a senha
                                da sua conta.
                            </p>

                            <p style="color: #4b5563; font-size: 16px; line-height: 1.6;">
                                Clique no botão abaixo para criar uma nova senha:
                            </p>

                            <!-- Button -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0"
                                style="margin: 30px 0;">

                                <tr>
                                    <td align="center">

                                        <a href="{{ $resetUrl }}"
                                            style="
                                                display: inline-block;
                                                padding: 14px 28px;
                                                background-color: #2563eb;
                                                color: #ffffff;
                                                text-decoration: none;
                                                border-radius: 6px;
                                                font-size: 16px;
                                                font-weight: bold;
                                            ">
                                            Redefinir minha senha
                                        </a>

                                    </td>
                                </tr>

                            </table>

                            <p style="color: #6b7280; font-size: 14px; line-height: 1.6;">
                                Se você não solicitou a recuperação da sua senha,
                                pode ignorar este e-mail.
                            </p>

                            <p style="color: #6b7280; font-size: 14px; line-height: 1.6;">
                                Por segurança, este link possui um prazo de validade.
                            </p>

                            <hr style="border: 0; border-top: 1px solid #e5e7eb; margin: 30px 0;">

                            <p style="color: #9ca3af; font-size: 12px; line-height: 1.5;">
                                Caso o botão não funcione, copie e cole o endereço
                                abaixo no seu navegador:
                            </p>

                            <p style="word-break: break-all; color: #2563eb; font-size: 12px;">
                                {{ $resetUrl }}
                            </p>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding: 20px 35px; background-color: #f9fafb; text-align: center;">

                            <p style="margin: 0; color: #9ca3af; font-size: 12px;">
                                Este é um e-mail automático. Por favor, não responda.
                            </p>

                            <p style="margin: 8px 0 0; color: #9ca3af; font-size: 12px;">
                                &copy; {{ date('Y') }} {{ config('app.name') }}.
                                Todos os direitos reservados.
                            </p>

                        </td>
                    </tr>

                </table>

            </td>
        </tr>

    </table>

</body>

</html>
