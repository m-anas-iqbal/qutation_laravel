@extends('layouts.admin')
@section('title', 'Countries')
@section('css')

    @include('admin.includes.datatables-css')

@endsection
@section('content')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.2/select2.css">
    <style>
        .select2-choice {
            border: unset !important;
        }

        .select2-choice {
            background-image: unset !important;
        }
        .select2-container .select2-choice div{
            display: none !important;
        }
        .select2-dropdown-open .select2-choice{
            background: white;
        }
    </style>
    <div class="d-flex flex-column flex-md-row align-items-center jobTitlePadding">
        <h2 class="my-0 mr-md-auto">Export Excel Url Data</h2>
    </div>


    <div class="row">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <div class="card-body">
                    <div class="widget-content widget-content-area br-6">
                        <form action="{{ route('category.export.excel') }}"
                              method="POST"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Your Service Area</label>
                                    <span class="text-danger"> *</span>

                                    <select class="select2 form-control" id="service_area" name="service_area"
                                            required>
                                        <optgroup label="Country">
                                            <option value=""></option>
                                            @if(count($countries) > 0)
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->name }}">{{ $country->name }}</option>
                                                @endforeach
                                            @endif
                                        </optgroup>
                                        <optgroup label="States">
                                            @if(count($states) > 0)
                                                @foreach($states as $state)
                                                    <option value="{{ $state->name }}">{{ $state->name }}</option>
                                                @endforeach
                                            @endif
                                        </optgroup>
                                        <optgroup label="Counties">
                                            @if(count($counties) > 0)
                                                @foreach($counties as $county)
                                                    <option value="{{ $county->name }}">{{ $county->name }}</option>
                                                @endforeach
                                            @endif
                                        </optgroup>
                                        <optgroup label="Cities">
                                            @if(count($cities) > 0)
                                                @foreach($cities as $city)
                                                    <option value="{{ $city->name }}">{{ $city->name }}</option>
                                                @endforeach
                                            @endif
                                        </optgroup>
                                        <optgroup label="Towns">
                                            @if(count($towns) > 0)
                                                @foreach($towns as $town)
                                                    <option value="{{ $town->name }}">{{ $town->name }}</option>
                                                @endforeach
                                            @endif
                                        </optgroup>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    Export
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.2/select2.min.js"></script>
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
            },
            matcher: function (term, text, opt) {
                return text.toUpperCase().indexOf(term.toUpperCase()) >= 0 || opt.parent("optgroup").attr("label").toUpperCase().indexOf(term.toUpperCase()) >= 0
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
        $(document).ready(function() {
            $(':input[type="submit"]').prop('disabled', true);
            $('input[type="text"]').keyup(function() {
                if($(this).val() != '') {
                    $(':input[type="submit"]').prop('disabled', false);
                }
            });
        });
    </script>
@endsection
