@extends('layouts.app')

@section('content')
<div class="flex justify-center">
  <div class="w-8/12">
    <div class="p-6">
      <h1 class="text-2xl">{{ $user->name }}</h1>
      <p>Posted
        {{ $posts->count() }}
        {{ Str::plural('post', $posts->count()) }}
        and {{ $user->receivedLikes->count() }} received {{ Str::plural('like', $user->receivedLikes->count()) }}
      </p>

    </div>
    <div class="p-6 bg-white rounded-lg">
      @if($posts->count() > 0)
      @foreach ($posts as $post)
      <x-post :post="$post" />
      @endforeach
      {{ $posts->links() }}
      @else
      <p>{{ $user->name }} does not have any post</p>
      @endif
    </div>
  </div>
</div>
@endsection