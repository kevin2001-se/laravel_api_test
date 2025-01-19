<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff !important;
            color: #000000 !important;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            border-radius: 8px;
            background-color: #ffffff !important;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Box shadow para resaltar */
        }
        .header {
            text-align: center;
            padding: 15px 0;
            background-color: #FFE100 !important;
            border-radius: 8px 8px 0 0;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #000000 !important;
        }
        .content {
            text-align: center;
            padding: 20px;
        }
        .content p {
            font-size: 16px;
            margin: 10px 0;
        }
        .password-box {
            display: inline-block;
            margin: 20px 0;
            padding: 10px 20px;
            font-size: 20px;
            font-weight: bold;
            background-color: #FFE100 !important;
            color: #000000 !important;
            border-radius: 4px;
        }
        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            font-size: 16px;
            font-weight: bold;
            color: #ffffff !important;
            background-color: #000000 !important;
            text-decoration: none;
            border-radius: 5px;
        }
        .footer {
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #000000 !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Nueva Contraseña Generada</h1>
        </div>
        <div class="content">
            <p>Hola, {{ $user->name }}</p>
            <p>Se ha generado una nueva contraseña para tu cuenta. Por favor, utiliza la contraseña a continuación para acceder:</p>
            <div class="password-box">{{ $password }}</div>
            <p>Te recomendamos cambiarla después de iniciar sesión para mayor seguridad.</p>
            <a href="{{ env('FRONTEND_URL') }}/login" class="btn">Ir al inicio de sesión</a>
        </div>
        <div class="footer">
            <p>Este es un mensaje automático. Por favor, no respondas a este correo.</p>
        </div>
    </div>
</body>
</html>
