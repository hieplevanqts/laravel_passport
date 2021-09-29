<li>{{ $category->name }}</li>
@if ($category->categories)
    <ul>
        @foreach ($category->categories as $childCategory)
            @include('categories.child_category', ['category'=>$childCategory])
        @endforeach
    </ul>
@endif
