                @foreach ($event->posts as $post)
<div class="row">
                <div class="col-lg-4">
                        <p>On {{ $post->updated_at }} <a href="/users/{{ $post->poster->id }}">{{ $post->poster->user_name }}</a> posted:</p>
                </div>
                <div class="col-lg-8">
                <p>
                        @if ($post->poster->image)
                        <img src="/assets/uploads/users/{{ $post->poster->id }}/thumbnail" alt="Poster thumbnail">
                        @endif
                        {{ $post->post }}
                </p>
                </div>
        </div>
                
                @endforeach
