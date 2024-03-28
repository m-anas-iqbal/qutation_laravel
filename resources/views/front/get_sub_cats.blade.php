@foreach($subs as $value)
    <option value="{{ $value->name }}">{{ $value->name }}</option>
    @endforeach