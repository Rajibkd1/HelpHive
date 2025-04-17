<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        HelpHive
    </title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA1MCA1MCIgZmlsbD0ibm9uZSI+CiAgICA8cGF0aCBkPSJNMjUgMkMxMi44NSAyIDMgMTEuODUgMyAyNEMzIDM2LjE1IDEyLjg1IDQ2IDI1IDQ2QzM3LjE1IDQ2IDQ3IDM2LjE1IDQ3IDI0QzQ3IDExLjg1IDM3LjE1IDIgMjUgMloiIGZpbGw9IiMwRjE3MkEiIHN0cm9rZT0iIzEwQjk4MSIgc3Ryb2tlLXdpZHRoPSIyIi8+CiAgICA8cGF0aCBkPSJNMzQgMTZMMjUgMjNMMTYgMTZMMTMgMjRMMjUgMzJMMzcgMjRMMzQgMTZaIiBmaWxsPSIjMTBCOTgxIi8+CiAgICA8cGF0aCBkPSJNMjUgMzJWNDAiIHN0cm9rZT0iIzEwQjk4MSIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiLz4KICAgIDxwYXRoIGQ9Ik0yMCAzNUwyNSA0MEwzMCAzNSIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjMTBCOTgxIiBzdHJva2Utd2lkdGg9IjIiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCIvPgogICAgPGNpcmNsZSBjeD0iMjUiIGN5PSIxNSIgcj0iMyIgZmlsbD0iI0Y1OUUwQiIvPgo8L3N2Zz4=">
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.0/cdn.min.js" defer></script>
</head>

<body class="h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full">
        @yield('content')
    </div>
</body>

</html>
