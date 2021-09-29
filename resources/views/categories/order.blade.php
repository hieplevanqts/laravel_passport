

@php
    use App\Models\Category;
    $node = Category::find($id);
@endphp

<span style="width: 45px" class="d-inline-block">
    @if ($node->getPrevSibling())
        <a href="{{ route('category.move', ['id'=>$id, 'type'=>'up']) }}" class="btn btn-primary">Up</a>
    @endif
</span>

<span style="width: 65px" class="d-inline-block">
    @if ($result = $node->getNextSibling())
        <a href="{{ route('category.move', ['id'=>$id, 'type'=>'down']) }}" class="btn btn-danger">Down</a>
    @endif
</span>


