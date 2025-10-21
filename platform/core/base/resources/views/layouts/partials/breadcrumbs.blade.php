<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <div class="page-title-left">
                <ol class="breadcrumb m-0">
                    @foreach ($items as $item)
                        @if ($item['url'] && !$loop->last)
                            <li class="breadcrumb-item">
                                <a href="{{ $item['url'] }}">{!! $item['label'] !!}</a>
                            </li>
                        @else
                            <li class="breadcrumb-item active">{!! Str::limit($item['label'], 60) !!}</li>
                        @endif
                    @endforeach
                </ol>
            </div>

        </div>
    </div>
</div>
