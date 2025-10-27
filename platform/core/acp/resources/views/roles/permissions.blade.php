@foreach ($permissionTrees['root'] as $keyRoot => $itemRoot)
    <div class="card">
        <div class="card-header bg-transparent border-bottom p-2">
            <div class="form-check form-check-success">
                <input class="form-check-input me-1" type="checkbox" id="root_{{ $keyRoot }}" name="flags[]"
                    value="{{ $flags[$itemRoot]['flag'] }}"
                    {{ in_array($flags[$itemRoot]['flag'], $active) ? 'checked' : '' }}>
                <label class="form-check-label" for="root_{{ $keyRoot }}">
                    {{ $flags[$itemRoot]['name'] }}
                </label>
            </div>
        </div>
        @if (isset($permissionTrees[$itemRoot]))
            <div class="card-body">
                <ul class="list-unstyled">
                    @foreach ($permissionTrees[$itemRoot] as $keyLv1 => $itemLv1)
                        @php
                            $collapseLv1 = 'collapse_lv1_' . $keyLv1;
                        @endphp
                        <li>
                            <div class="form-check form-check-success ms-0 ps-0 mb-3">
                                @if (isset($permissionTrees[$itemLv1]))
                                    <span class="toggle-icon text-secondary collapsed float-start" role="button"
                                        data-bs-toggle="collapse" data-bs-target="#{{ $collapseLv1 }}"
                                        aria-expanded="false" aria-controls="{{ $collapseLv1 }}">
                                        <i class="bx bx-plus"></i>
                                    </span>
                                @else
                                    <span class="me-2" style="width: 1rem;"></span>
                                @endif
                                <input class="form-check-input ms-1 me-1" type="checkbox"
                                    id="childrenLv1_{{ $keyRoot }}_{{ $keyLv1 }}" name="flags[]"
                                    value="{{ $flags[$itemLv1]['flag'] }}"
                                    {{ in_array($flags[$itemLv1]['flag'], $active) ? 'checked' : '' }}>
                                <label class="form-check-label"
                                    for="childrenLv1_{{ $keyRoot }}_{{ $keyLv1 }}">
                                    {{ $flags[$itemLv1]['name'] }}
                                </label>
                            </div>
                            @if (isset($permissionTrees[$itemLv1]))
                                <ul class="list-unstyled collapse ps-4" id="{{ $collapseLv1 }}">
                                    @foreach ($permissionTrees[$itemLv1] as $keyLv2 => $itemLv2)
                                        @php
                                            $collapseLv2 = 'collapse_lv2_' . $keyLv2;
                                        @endphp
                                        <li>
                                            <div class="form-check form-check-success ms-0 ps-0 mb-3">
                                                @if (isset($permissionTrees[$itemLv2]))
                                                    <span class="toggle-icon text-secondary collapsed float-start"
                                                        role="button" data-bs-toggle="collapse"
                                                        data-bs-target="#{{ $collapseLv2 }}" aria-expanded="false"
                                                        aria-controls="{{ $collapseLv2 }}">
                                                        <i class="bx bx-plus"></i>
                                                    </span>
                                                @else
                                                    <span class="me-2" style="width: 1rem;"></span>
                                                @endif
                                                <input class="form-check-input ms-1 me-1" type="checkbox"
                                                    id="childrenLv2_{{ $keyLv1 }}_{{ $keyLv2 }}"
                                                    name="flags[]" value="{{ $flags[$itemLv2]['flag'] }}"
                                                    {{ in_array($flags[$itemLv2]['flag'], $active) ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="childrenLv2_{{ $keyLv1 }}_{{ $keyLv2 }}">
                                                    {{ $flags[$itemLv2]['name'] }}
                                                </label>
                                            </div>
                                            @if (isset($permissionTrees[$itemLv2]))
                                                <ul class="list-unstyled collapse ps-4" id="{{ $collapseLv2 }}">
                                                    @foreach ($permissionTrees[$itemLv2] as $keyLv3 => $itemLv3)
                                                        <li>
                                                            <div class="form-check form-check-success ms-0 ps-0 mb-3">
                                                                <span class="me-2" style="width: 1rem;"></span>
                                                                <input class="form-check-input ms-1 me-1"
                                                                    type="checkbox"
                                                                    id="childrenLv3_{{ $keyLv2 }}_{{ $keyLv3 }}"
                                                                    name="flags[]"
                                                                    value="{{ $flags[$itemLv3]['flag'] }}"
                                                                    {{ in_array($flags[$itemLv3]['flag'], $active) ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="childrenLv3_{{ $keyLv2 }}_{{ $keyLv3 }}">
                                                                    {{ $flags[$itemLv3]['name'] }}
                                                                </label>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endforeach
