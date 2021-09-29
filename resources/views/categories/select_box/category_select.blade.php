
@if ($categories)
    @php
        $level = ' / ----';
    @endphp
    <select class="form-control">
        @foreach ($categories as $category)
            @include('categories.select_box.child_category_select', ['category'=>$category, 'level'=>$level])
        @endforeach
    </select>
@endif


