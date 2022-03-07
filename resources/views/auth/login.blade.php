@extends('layouts.app')

@section('content')
<div class="flex justify-center">

  <div class="w-4/12 p-6 bg-white rounded-lg">

    @if(session('status'))
    <div class="bg-red-500 p-4 rounded-lg mb-5 text-white text-center">
      {{ session('status') }}
    </div>
    @endif
    <form action="{{ route('login') }}" method="post">
      @csrf
      <div class="mb-4">
        <label for="email" class="sr-only">Email</label>
        <input type="text" name="email" id="email" placeholder="Your Email"
          class="w-full p-4 bg-gray-100 border-2 rounded-lg @error('email') border-red-400 @enderror"
          value="{{ old('email') }}">
        @error('email')
        <div class="text-sm text-red-500">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-4">
        <label for="password" class="sr-only">Password</label>
        <input type="password" name="password" id="password" placeholder="Choose a password"
          class="w-full p-4 bg-gray-100 border-2 rounded-lg @error('password') border-red-400 @enderror" value="">
        @error('password')
        <div class="text-sm text-red-500">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-4">
        <div class="flex items-center">
          <input type="checkbox" name="remember" id="remember" class="mr-2">
          <label for="remember">Remember me</label>
        </div>
      </div>

      <div class="">
        <button type="submit" class="w-full px-4 py-3 font-medium text-white bg-blue-500 rounded">Login</button>
      </div>
    </form>
  </div>
</div>
@endsection