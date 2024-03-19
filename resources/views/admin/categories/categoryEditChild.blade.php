<option value="{{ $child_cate->id }}" {{ (old('parent_id') == $child_cate->id) || ($category->parent_id == $child_cate->id)  ? 'selected':'' }}>
    @php
        $prefix = str_repeat('--', $n);
    @endphp
    {{ $prefix }} {{ $child_cate->name }}
</option>
@if ($parentCategory->childrens)
    @foreach ($child_cate->childrens as $child)
        @include('admin.categories.categoryEditChild', ['child_cate' => $child,'n'=> ++$n])
    @endforeach
@endif
