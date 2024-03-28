<option value="">--Select--</option>
@foreach($towns as $town)
    <option value="{{ $town->name }}">{{ $town->name }}</option>
@endforeach