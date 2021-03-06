<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <title>Document</title>
</head>

<body class="bg-gray-200">
  <nav class="flex justify-between p-6 mb-3 bg-white">
    <ul class="flex items-center">
      <li class="p-3 font-semibold"><a href="/">Home</a></li>
      <li class="p-3 font-semibold"><a href="{{ route('dashboard') }}">Dashboard</a></li>
      <li class="p-3 font-semibold"><a href="{{ route('posts') }}">Posts</a></li>
    </ul>
    <ul class="flex items-center">
      @auth
      <li class="p-3 font-semibold"><a href="">{{ auth()->user()->name }}</a></li>
      <li class="p-3 font-semibold">
        <form action="{{ route('logout') }}" method="post">
          @csrf
          <button type="submit" class="font-semibold">Logout</button>
        </form>
      </li>
      @endauth
      @guest
      <li class="p-3 font-semibold"><a href="{{ route('login') }}">Login</a></li>
      <li class="p-3 font-semibold"><a href="{{ route('register') }}">Register</a></li>
      @endguest
    </ul>
  </nav>
  @yield('content')
</body>

</html>