{{-- auto generated from : php artisan make:mail PostLiked --markdown=emails.posts.post_liked --}}
@component('mail::message')
# Hey someone is liking your post.

{{ $liker->name }} is liked your post

@component('mail::button', ['url' => route('posts.show', $post)])
See here!
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent