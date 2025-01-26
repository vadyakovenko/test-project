<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
    <title>@yield('title', 'Test project')</title>
    @yield('meta')
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .dashboard {
            display: flex;
            height: 100vh;
        }
        .sidebar {
            width: 20%;
            background-color: #d0e7ff; /* light blue */
            padding: 1rem;
        }
        .content {
            flex-grow: 1;
            background-color: #e0f7df; /* light green */
            padding: 1rem;
        }
    </style>
</head>
<body>
<div class="dashboard">
    <div class="sidebar">
        <h2>Sidebar</h2>
        <ul>
            <li><a href="{{route('screen.one.index')}}">Screen 1</a></li>
            <li><a href="{{route('screen.two.index')}}">Screen 2</a></li>
            <li><a href="{{route('screen.three.index')}}">Screen 3</a></li>
        </ul>
    </div>
    <div class="content">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"  crossorigin="anonymous"></script>
</div>
</body>
</html>
