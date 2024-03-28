<select name="subcategory_id" id="subcategory_id" onchange="PostecodeFunc()">
    @foreach($subcats as $subcat)
        <option value="{{ $subcat->id }}">{{ $subcat->name }}</option>
    @endforeach
</select>