@props([
    'heading'    => 'Ready to Book Your Appointment?',
    'subheading' => 'Call us or come in. Walk-ins are always welcome.',
    'primaryText'    => 'Get Started',
    'primaryRoute'   => 'contact-us',
    'secondaryText'  => 'Call (718) 261-8655',
    'secondaryHref'  => 'tel:+17182618655',
])

<section class="cta-section" aria-labelledby="cta-heading">
    <div class="container">
        <h2 id="cta-heading">{{ $heading }}</h2>
        <p>{{ $subheading }}</p>
        <div class="cta-section__actions">
            <a href="{{ route($primaryRoute) }}" class="btn btn--outline-white btn--lg">{{ $primaryText }}</a>
            <a href="{{ $secondaryHref }}" class="btn btn--gold btn--lg">{{ $secondaryText }}</a>
        </div>
    </div>
</section>
