@props([
  'title' => 'Workers',
  'main_page' => 'Workers',
  'main_link' => 'workers.index'
])
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<a href="{{ route($main_link) }}"><h1>{{ $main_page }}</h1></a>
{{ $slot }}
</body>
</html>
