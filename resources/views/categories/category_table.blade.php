
@if ($categories)
    @php
        $level = ' / ----';
    @endphp
<table class="table">
    <thead>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Order</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
            @include('categories.child_category_table', ['category'=>$category, 'level'=>$level])
        @endforeach
    </tbody>
</table>
@endif


