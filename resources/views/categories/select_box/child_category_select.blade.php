<option value="{{ $category->id }}">{{ $level . ' ' . $category->name }}</option>
@if ($category->categories)
    @php
        $level .= $level;
    @endphp
    @foreach ($category->categories as $childCategory)
        @include('categories.select_box.child_category_select', ['category'=>$childCategory])
    @endforeach
@endif


