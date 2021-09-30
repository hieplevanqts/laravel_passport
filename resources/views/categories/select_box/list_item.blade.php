@php
    $level = ' / ----';
@endphp
<li class="dd-item" data-id="{{ $item->id }}">
    <div class="dd-handle">{{ $item->name }} / {{ $item->id }}</div>
</li>

@if (count($item->children) > 0)
    @foreach ($item->children as $val)
        <ol class="dd-list">
            @include('categories.select_box.list_item', ['item'=>$val])
        </ol>
    @endforeach

@endif
