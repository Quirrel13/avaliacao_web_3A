<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bem-vindo ao IFBank</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2>Olá, {{ $user->name }}!</h2>
    <p>Sua conta no <strong>IFBank</strong> foi criada com sucesso.</p>
    <p>Abaixo estão suas credenciais provisórias para realizar o primeiro acesso:</p>
    
    <div style="background-color: #f4f4f4; padding: 15px; border-radius: 5px; margin: 20px 0;">
        <p style="margin: 5px 0;"><strong>E-mail:</strong> {{ $user->email }}</p>
        <p style="margin: 5px 0;"><strong>Senha Provisória:</strong> {{ $senhaProvisoria }}</p>
    </div>

    <p>Recomendamos que você altere sua senha no primeiro acesso ao sistema.</p>
    <br>
    <p>Atenciosamente,<br>Equipe <strong>IFBank</strong></p>
</body>
</html>