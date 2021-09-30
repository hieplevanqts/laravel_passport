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
        {{-- @include('categories.child_category_table', ['category'=>$childCategory]) --}}
        <tr>
            <td>{{ $childCategory->id }}</td>
            <td>{{ $level . ' ' . $childCategory->name }}</td>
            <td>@include('categories.order', ['id'=>$childCategory->id])</td>
        </tr>
    @endforeach
@endif


