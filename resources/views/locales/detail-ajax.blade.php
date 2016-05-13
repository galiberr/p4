@foreach ($locale->ratings as $rating)
<div class="row">
        <div class="col-lg-4">
                <p>
                        On {{ $rating->updated_at }} <a href="/users/{{ $rating->rater->id }}">{{ $rating->rater->user_name }}</a> gave {{ $locale->gm_name }} a rating of {{ $rating->rating }} and commented:
                </p>
                
        </div>
        <div class="col-lg-8">
                <p>
                         @if ($rating->rater->image)
                        <img src="/assets/uploads/users/{{ $rating->rater->id }}/thumbnail" alt="Poster thumbnail">
                        @endif

                        {{ $rating->comment }}
                </p>
        </div>
</div>
@endforeach
