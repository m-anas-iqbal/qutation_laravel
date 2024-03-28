<select name="category_id" id="category_id" onchange="getSubCatFunc()">
    @foreach($cats as $cat)
        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
    @endforeach
</select>