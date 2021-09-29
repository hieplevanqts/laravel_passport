@if ($categories)
<ul>
    @foreach ($categories as $category)
       @include('categories.child_category', ['category'=>$category]);
    @endforeach
</ul>
@endif
