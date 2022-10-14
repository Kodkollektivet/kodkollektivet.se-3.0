@if (isset($DOMData))

{!! $DOMData !!}

@else

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Canvas</title>
    <style>
        body {
            margin: 0;
        }
        body img {
            max-width: 100%;
        }
    </style>
</head>
<body>
    <img src="/public/images/mock_iframes/{{ $mock }}.jpg">
</body>
</html>

@endif