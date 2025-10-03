<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Färger</title>
    <style>
        body {
            background-color: {{ $backcolor ?? 'inherit' }};

            color: {{ $textcolor ?? 'inherit' }};
        }
    </style>
</head>

<body>
    <h1>Välj färger</h1>
    <form method="POST">
        Välj textfärg: <input name="textColor" value = "{{ $textcolor }}"><br>
        Välj bakgrundsfärg: <input name="backColor" value = "{{ $backcolor }}"><br>
        <input type="submit" value="Skicka">
        <input type="reset" value="Ångra">
    </form>
</body>

</html>