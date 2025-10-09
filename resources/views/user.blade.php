<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        label {
            display: block;
            margin-bottom: 10px;
        }
    </style>

</head>
<body>
    <h1>Användare</h1>
    <form method="POST">
        <label> Namn:
            <input name = "namn" required placeholder = "Ange namn" value = "{{$user -> namn ?? ''}}">
        </label>
        <label>Epost:
            <input type = "email" name = "epost" required placeholder = "Ange epost" value = "{{$user -> epost ?? ''}}">
        </label>
        <input type = "submit" value = "Spara">
        <input type = "reset" value = "Ångra">
    </form>
</body>
</html>