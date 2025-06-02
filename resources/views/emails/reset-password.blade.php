<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: sans-serif;
            background: white;
            padding: 20px;
            margin: 10px;
        }

        .button {
            background-color: #446163;
            color: white;
            padding: 10px 15px;
            text-align: center;
            display: inline-block;
            border-radius: 5px;
            text-decoration: none;
        }
    </style>
</head>
<body>
<h2>Hey there! 👋🏻</h2>
<p>Forgot your password? No worries — we got you! 🔒</p>
<p>Click the button below to reset your password and get back to Roomify. 👇</p>

<a href="{{ $url }}" class="button">Reset Password</a>


<p>If you didn’t request a password reset, you can safely ignore this message. 🙈</p>
<p>Take care, your Roomify Team 🤎</p>
</body>
</html>
