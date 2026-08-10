@props(['member' => []])

<article class="team-card">
    <div class="team-card__photo">
        <img src="{{ asset($member['photo']) }}"
             alt="{{ $member['name'] }}"
             loading="lazy">
    </div>
    <div class="team-card__body">
        <h3 class="team-card__name">{{ $member['name'] }}</h3>
        <p class="team-card__role">{{ $member['role'] }}</p>
        @if(isset($member['quote']))
        <blockquote class="team-card__quote">
            &ldquo;{{ $member['quote'] }}&rdquo;
        </blockquote>
        @endif
        @foreach($member['bio'] as $paragraph)
        <p class="team-card__bio">{{ $paragraph }}</p>
        @endforeach
    </div>
</article>
