<div>
@foreach ($event->posts as $post)
<p>
        On {{ $post->updated_at }} <a href="/users/{{ $post->poster->id }}">{{ $post->poster->user_name }}</a> posted: {{ $post->post }}
</p>
@endforeach
</div>