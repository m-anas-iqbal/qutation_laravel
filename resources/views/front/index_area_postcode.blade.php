<style>
    .list{
        width: 326px !important;
        height: 217px;
    }
</style>

<div class="row">
<div class="row mb-2">
    <center><b style="font-size: 21px; color: red">On Field is Required Area/Postcode *</b></center>
</div>
    <div class="col-6">
        <div class="form-group">
            <label for="" class="mb-2">Type Postcode</label>
            <select class="select1 form-control" id="postcode" name="postcode">
                <option value="">--Select--</option>
                @foreach($arr_postcodes as $postcode)
                    <option value="{{ $postcode }}">{{ $postcode }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="" class="mb-2">Type Area</label>
            <select class="select2 form-control" id="area" name="area">
                <option value="">--Select--</option>
                @foreach($countries as $data)
                <option value="{{ $data->name }}">{{ $data->name }}</option>
                @endforeach
                @foreach($states as $data)
                <option value="{{ $data->name }}">{{ $data->name }}</option>
                @endforeach
                @foreach($counties as $data)
                <option value="{{ $data->name }}">{{ $data->name }}</option>
                @endforeach
                @foreach($cities as $data)
                <option value="{{ $data->name }}">{{ $data->name }}</option>
                @endforeach
                @foreach($towns as $data)
                <option value="{{ $data->name }}">{{ $data->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    {{--<div class="col-6">--}}
        {{--<div class="form-group">--}}
            {{--<label for="" class="mb-2">Type Area</label>--}}
            {{--<select name="postcode" id="postcode" style="display: block !important;" class="form-control" disabled="disabled">--}}
                {{--<option value="">--Select--</option>--}}
                {{--@foreach($countries as $data)--}}
                    {{--<option value="{{ $data->name }}">{{ $data->name }}</option>--}}
                {{--@endforeach--}}
                {{--@foreach($states as $data)--}}
                    {{--<option value="{{ $data->name }}">{{ $data->name }}</option>--}}
                {{--@endforeach--}}
                {{--@foreach($counties as $data)--}}
                    {{--<option value="{{ $data->name }}">{{ $data->name }}</option>--}}
                {{--@endforeach--}}
                {{--@foreach($cities as $data)--}}
                    {{--<option value="{{ $data->name }}">{{ $data->name }}</option>--}}
                {{--@endforeach--}}
                {{--@foreach($towns as $data)--}}
                    {{--<option value="{{ $data->name }}">{{ $data->name }}</option>--}}
                {{--@endforeach--}}
            {{--</select>--}}
        {{--</div>--}}
    </div>
</div>
<div class="row">

    <div class="col-12">

        <div class="form-group">
        <button class="theme-btn sc-6bac5830-0 crZSbT sc-6bac5830-1 fxqnjv" style="position: absolute;
        right: 5px;
        min-height: 42px;
        max-width: 166px;" disabled>Continue</button>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.2/select2.min.js"></script>

<script>
    // var select = $('select');
    var select = $('.select1');

    function formatSelection(state) {
        return state.text;
    }

    function formatResult(state) {
        console.log(state)
        if (!state.id) return state.text; // optgroup
        var id = 'state' + state.id.toLowerCase();
        var label = $('<label></label>', {for: id})
            .text(state.text);
        var checkbox = $('<input type="checkbox" style="display: none">', {id: id});

        return checkbox.add(label);
    }

    select.select2({
        closeOnSelect: false,
        formatResult: formatResult,
        formatSelection: formatSelection,
        minimumInputLength: 2,
        escapeMarkup: function (m) {
            return m;
        }
    }).on("change", function (e) {
        // alert($(this).val());
        if ($(this).val() == '') {
            $('.theme-btn').prop('disabled', true);
        }
        else {
            $('.theme-btn').prop('disabled', false);
        }
    });

    // select.select2({
    // }).on("change", function (e) {
    //     if($(this).val() == '') {
    //         $('.theme-btn').prop('disabled', true);
    //     }
    //     else {
    //         $('.theme-btn').prop('disabled', false);
    //     }
    // });
</script>

<script>
    // var select = $('select');
    var select = $('.select2');

    function formatSelection(state) {
        return state.text;
    }

    function formatResult(state) {
        console.log(state)
        if (!state.id) return state.text; // optgroup
        var id = 'state' + state.id.toLowerCase();
        var label = $('<label></label>', {for: id})
            .text(state.text);
        var checkbox = $('<input type="checkbox" style="display: none">', {id: id});

        return checkbox.add(label);
    }

    select.select2({
        closeOnSelect: false,
        formatResult: formatResult,
        formatSelection: formatSelection,
        minimumInputLength: 2,
        escapeMarkup: function (m) {
            return m;
        }
    }).on("change", function (e) {
        // alert($(this).val());
        if ($(this).val() == '') {
            $('.theme-btn').prop('disabled', true);
        }
        else {
            $('.theme-btn').prop('disabled', false);
        }
    });

    // select.select2({
    // }).on("change", function (e) {
    //     if($(this).val() == '') {
    //         $('.theme-btn').prop('disabled', true);
    //     }
    //     else {
    //         $('.theme-btn').prop('disabled', false);
    //     }
    // });
</script>

