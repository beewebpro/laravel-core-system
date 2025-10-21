<div class="col-md-4">
    <div class="faq-box d-flex mb-4">
        <div class="flex-shrink-0 me-3 faq-icon">
            <i class="{{ $icon ?: 'bx bx-help-circle' }} font-size-20 text-success"></i>
        </div>
        <div class="flex-grow-1">
            <h5 class="font-size-15"><a href="{{ $url }}">{{ $title }}</a></h5>
            @if ($description)
                <p class="text-muted">{{ $description }}</p>
            @endif
        </div>
    </div>
</div>
