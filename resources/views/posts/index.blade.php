@extends('layouts.app')

@section('content')
<div class="flex justify-center">
  <div class="w-8/12 p-6 mb-4 bg-white rounded-lg">
    <form action="{{ route('posts') }}" method="post" class="mb-4">
      @csrf
      <div class="mb-4">
        <label for="body" class="sr-only">Body</label>
        <textarea name="body" id="body" cols="30" rows="4"
          class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror"
          placeholder="Post something!"></textarea>
        @error('body')
        <div class="mt-2 text-sm text-red-500">{{ $message }}</div>
        @enderror
      </div>
      <div>
        <button type="submit" class="px-4 py-2 font-medium text-white bg-blue-500 rounded">Post</button>
      </div>
    </form>
    @if($posts->count() > 0)
    @foreach ($posts as $post)
    <div class="mb-4">
      <a href="" class="mr-2 font-bold">{{ $post->user->name }}</a>
      <span class="text-gray-600">{{$post->created_at->diffForHumans() }}</span>
      <p>{{ $post['body'] }}</p>
      <div class="flex items-center">
        <form action="{{ route('posts.likes', $post->id) }}" method="post" class="mr-1">
          @csrf
          <button type="submit" class="text-sm text-blue-500">Like</button>
        </form>
        <form action="" method="post" class="mr-1">
          @csrf
          <button type="submit" class="text-sm text-blue-500">Dislike</button>
        </form>

        <span class="text-sm text-gray-600">{{ $post->likes()->count() }} {{ Str::plural('like', $post->likes()->count()
          ) }}</span>
      </div>
    </div>
    @endforeach
    {{ $posts->links() }}
    @else
    <p>No post</p>
    @endif
  </div>
</div>
@endsection