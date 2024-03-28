<option value="">--Select--</option>
@foreach($cities as $city)
    <option value="{{ $city->name }}">{{ $city->name }}</option>
@endforeach