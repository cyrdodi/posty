@props(['post' => $post])
<div class="mb-4">
  <a href="{{ route('users.posts', $post->user) }}" class="mr-2 font-bold">{{ $post->user->name }}</a>
  <span class="text-gray-600">{{$post->created_at->diffForHumans() }}</span>
  <p>{{ $post['body'] }}</p>

  {{-- delete --}}
  @can('delete', $post)
  <form action="{{ route('posts.destroy', $post->id) }}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit" class="text-sm text-red-700">Delete</button>
  </form>
  @endcan

  <div class="flex items-center">
    {{-- not shown if not login --}}
    @auth
    {{-- show like btn if not liked b4 --}}
    @if(!$post->likedBy(auth()->user()))
    <form action="{{ route('posts.likes', $post->id) }}" method="post" class="mr-1">
      @csrf
      <button type="submit" class="text-sm text-blue-500">Like</button>
    </form>
    @else
    <form action="{{ route('posts.likes', $post->id) }}" method="post" class="mr-1">
      @csrf
      @method('DELETE')
      <button type="submit" class="text-sm text-blue-500">Dislike</button>
    </form>
    @endif
    @endauth
    <span class="text-sm text-gray-600">{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()
      ) }}</span>
  </div>

</div>