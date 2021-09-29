<tr>
    <td>{{ $category->id }}</td>
    <td>{{ $level . ' ' . $category->name }}</td>
    <td>@include('categories.order', ['id'=>$category->id])</td>
</tr>

@if ($category->categories)
    @php
        $level .= $level;
    @endphp
    @foreach ($category->categories as $childCategory)
        @include('categories.child_category_table', ['category'=>$childCategory])
    @endforeach
@endif


