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
<p>Thanks for joining <strong>Roomify</strong> ✨</p>
<p>To start, please confirm your email by clicking the button below. 👇</p>
@component('mail::button', ['url' => $url])
    Verify my email
@endcomponent
<p>If you didn’t sign up, just ignore this message. 🙈</p>
<p>Cheers, your Roomify Team 🤎</p>
</body>
</html>
