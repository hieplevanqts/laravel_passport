@php
    $level = ' / ----';
@endphp
<li class="dd-item" data-id="{{ $item->id }}">
    <div class="dd-handle">{{ $item->name }} / {{ $item->id }}</div>
    @if (count($item->children) > 0)
    <ol class="dd-list">
        @foreach ($item->children as $val)
                @include('categories.select_box.list_item', ['item'=>$val])
        @endforeach
    </ol>
</li>
@endif
