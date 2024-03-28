<option value="">--Select--</option>
@foreach($counties as $county)
    <option value="{{ $county->name }}">{{ $county->name }}</option>
@endforeach