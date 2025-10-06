<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo-lista</title>
</head>
<body>
    <h1>Todo-lista</h1>
    <form method = "POST">
        Uppgift: <input name = "uppgift" placeholder = "Skriv in en uppgift" required><br>
        <input type = "submit" value = "Lägg till">
        <input type="hidden" name = "lista" value = "{{json_encode($lista)}}">
    </form>
    @if (empty($lista))
        <p>Det finns inga uppgifter att göra :C </p>
    @else
        <h2>Uppgifter</h2>
        <ul>
            @foreach ($lista as $uppgift)
                <li>
                    <form method = "POST">
                        <input type="hidden" name = "lista" value = "{{json_encode($lista)}}">
                        {{ $uppgift }}
                        <input type = "hidden" name = "uppgift" value = "{{ $uppgift }}">
                        <input type = "hidden" name = "_method" value = "DELETE">
                        <input type = "submit" value = "Ta bort">
                    </form>
                    
                </li>
            @endforeach    
        </ul>
    @endif    
</body>
</html>