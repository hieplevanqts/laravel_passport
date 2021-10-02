
{{-- @if ($categories)
    @php
        $level = ' / ----';
    @endphp --}}
<table class="table" id="empTable">
    <thead>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Order</td>
        </tr>
    </thead>
    {{-- <tbody>
        @foreach ($categories as $category)
            @include('categories.child_category_table', ['category'=>$category, 'level'=>$level])
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ str_repeat( $level , $category->depth ) }}{{  $category->name }}</td>
                <td>@include('categories.order', ['id'=>$category->id])</td>
            </tr>
        @endforeach
    </tbody> --}}
</table>
{{-- @endif --}}


