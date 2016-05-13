@foreach ($locale->ratings as $rating)
<p>
        On {{ $rating->updated_at }} <a href="/users/{{ $rating->rater->id }}">{{ $rating->rater->user_name }}</a> gave {{ $locale->gm_name }} a rating of {{ $rating->rating }} and commented: {{ $rating->comment }}
</p>
@endforeach
