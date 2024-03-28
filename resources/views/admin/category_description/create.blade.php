@extends('layouts.admin')
@section('title', 'Countries')
@section('css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.2/select2.css">
    <style>
        .select2-choices {
            border: unset !important;
        }

        .select2-container-multi .select2-choices {
            background-image: unset !important;
        }
        #add-prescription{
            cursor: pointer;
        }
        #remove-prescription{
            cursor: pointer;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css">
@endsection
@section('content')



    <div class="row">
        <div class="col-md-12 col-sm-12 col-12">
            <h2 class="jobTitlePadding">Add Service Area Description </h2>
        </div>

        <div class="col-md-12 col-sm-12 col-12 layout-spacing">

                <div class="card p-5">

                    <form action="{{ route('category-description.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Your Service Area</label>
                            <span class="text-danger"> *</span>

                            <select class="select2 form-control" id="service_area" name="short_service_area[]"
                                    multiple required onchange="serviceAreaFunc()">
                                <optgroup label="Country">
                                    @if(count($filter_arr_countries) > 0)
                                        @foreach($filter_arr_countries as $country)
                                            <option value="{{ $country }}">{{ $country }}</option>
                                        @endforeach
                                    @endif
                                </optgroup>
                                <optgroup label="States">
                                    @if(count($filter_arr_states) > 0)
                                        @foreach($filter_arr_states as $state)
                                            <option value="{{ $state }}">{{ $state }}</option>
                                        @endforeach
                                    @endif
                                </optgroup>
                                <optgroup label="Counties">
                                    @if(count($filter_arr_counties) > 0)
                                        @foreach($filter_arr_counties as $county)
                                            <option value="{{ $county }}">{{ $county }}</option>
                                        @endforeach
                                    @endif
                                </optgroup>
                                <optgroup label="Cities">
                                    @if(count($filter_arr_cities) > 0)
                                        @foreach($filter_arr_cities as $city)
                                            <option value="{{ $city }}">{{ $city }}</option>
                                        @endforeach
                                    @endif
                                </optgroup>
                                <optgroup label="Towns">
                                    @if(count($filter_arr_towns) > 0)
                                        @foreach($filter_arr_towns as $town)
                                            <option value="{{ $town }}">{{ $town }}</option>
                                        @endforeach
                                    @endif
                                </optgroup>
                            </select>
                        </div>

                        <input type="hidden" value="" name="service_area[]" id="service_values" class="form-control">

                        <div class="form-group">
                            <label for="">Description</label>
                            <span class="text-danger"> *</span><small style="color: #0a53be">use {tag_area} in your contents for service area.</small>
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control">{tag_area}</textarea>
                        </div>

                        {{--///--}}


                                    <div id="prescription-area" class="mb-3">
                                            <div class="form-group">
                                                <label for="Question">Question
                                                    <span class="text-color-red">*</span>
                                                </label>
                                                <input type="text" name="question[]" id="question" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="answer">Answer
                                                    <span class="text-danger"> *</span><small style="color: #0a53be">use {tag_area} in your contents for service area.</small>
                                                </label>

                                                <textarea id="summernote" name="answer[]"></textarea>
                                            </div>
                                        </div>

                                    <h5 id="add-prescription" class="btn btn-primary"><span class="text-color-red">+ </span>Add Another</h5>
                                    <h5 id="remove-prescription" class="btn btn-danger"><span class="text-color-red">- </span>Subtract</h5>


                        {{--////--}}



                        <div id="group-area" class="mb-3">
                        <div class="form-group">
                            <label for="Group">Group Name
                                <span class="text-color-red">*</span>
                            </label>
                            <input type="text" name="group1" id="group" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Tag Description</label>
                            <span class="text-danger"> *</span><small style="color: #0a53be">use {tag_area} in your contents for service area.</small>
                            <div id="desc-area" class="mb-3">
                            <textarea id="tag_summernote" name="tag_description1[]">{tag_area}</textarea>
                            </div>
                        </div>

                            <h5 id="add-desc" class="btn btn-primary"><span class="text-color-red">+ </span>Add Description</h5>
                            <h5 id="remove-desc" class="btn btn-danger"><span class="text-color-red">- </span>Subtract Description</h5>
                        </div>
                        <div class="form-group">
                        {{--<h5 id="add-desc" class="btn btn-primary"><span class="text-color-red">+ </span>Add Description</h5>--}}
                        {{--<h5 id="remove-desc" class="btn btn-danger"><span class="text-color-red">- </span>Subtract Description</h5>--}}
                        <h5 id="add-group" class="btn btn-primary"><span class="text-color-red">+ </span>Add Group</h5>
                        {{--<h5 id="remove-group" class="btn btn-danger"><span class="text-color-red">- </span>Subtract Group</h5>--}}
                        </div>
                        <div class="form-group">
                        <button type="submit" class="theme-btn btn btn-primary" disabled>
                            Submit
                            <div class="spinner-border d-none" role="status"></div>
                        </button>
                        </div>
                    </form>
                </div>

        </div>
    </div>

@endsection


@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>
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
            $('#add-prescription').click(function(){
                var intId = $("#prescription-area .w-row").length + 1 || 1;
                var presFields = $('<div class="w-row"><div class="empty-col-left w-col w-col-4"><label for="Question' + intId + '">Question <span class="text-color-red">*</span></label>' +
                    ' <input type="text" name="question[]" id="question' + intId + '" data-name="Question' + intId + '" class="form-control">' +
                    '</div><div class="empty-col-right w-col w-col-4"><label for="answer' + intId + '">answer <span class="text-color-red">*</span></label></div><textarea  id="summernote' + intId + '" name="answer[]" data-name="answer' + intId +'"></textarea>');

                $('#prescription-area').append(presFields);

                var $editor = $('#summernote' + intId + '');
                $editor.summernote({
                    height: 200,
                    toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'hr']],
                    ['view', ['fullscreen', 'codeview']],
                    ['help', ['help']]
                ]
                    // callbacks: {
                    //     onPaste: function(e) {
                    //         console.log('Called event paste', e);
                    //     },
                    //     onImageUpload: function(files) {
                    //         console.log(files);
                    //         // upload image to server and create imgNode...
                    //         $summernote.summernote('insertNode', imgNode);
                    //     }
                    // },
                    // toolbar: [
                    //     // [groume, [list of button]]
                    //     ['style', ['bold', 'italic', 'underline']],
                    //     ['fontsize', ['fontsize']],
                    //     ['color', ['color']],
                    //     ['height', ['height']],
                    //     ['operation', ['undo', 'redo']],
                    //     ['font', ['strikethrough', 'superscript', 'subscript', 'clear']],
                    //     ['para', ['ul', 'ol', 'paragraph']],
                    //     ['object', ['link', 'table', 'picture', 'video']],
                    //     ['misc', [ 'help', 'fullscreen', 'codeview']]
                    // ]
                });

            });

            $('#remove-prescription').click(function(){
                $("#prescription-area .w-row:last").remove();
            });

            $('#prescription-area').on('change','select[id^="Question"]',function() {
                var val = $(this).val();
                var dose = $(this).parent().next(".w-col").find('select[id^="answer"]');

                if (val == "Sildenafil") {
                    $(dose).html("<option value='20mg'>20mg</option>");
                } else if (val == "Sildenafil RDT") {
                    $(dose).html("<option value='50mg'>50mg</option><option value='100mg'>100mg</option>");
                } else if (val == "Sildenafil Viagra") {
                    $(dose).html("<option value='25mg'>25mg</option><option value='50mg'>50mg</option><option value='100mg'>100mg</option>");
                } else if (val == "Tadalafil") {
                    $(dose).html("<option value='10mg'>10mg</option><option value='20mg'>20mg</option>");
                } else if (val == "Tadalafil RDT") {
                    $(dose).html("<option value='2.5mg'>2.5mg</option><option value='5.0mg'>5.0mg</option>");
                } else if (val == "Vardenafil RDT") {
                    $(dose).html("<option value='2.5mg'>2.5mg</option><option value='5.0mg'>5.0mg</option><option value='10mg'>10mg</option><option value='20mg'>20mg</option>");
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var $editor = $('#summernote');
            $editor.summernote({
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'hr']],
                    ['view', ['fullscreen', 'codeview']],
                    ['help', ['help']]
                ]
                // callbacks: {
                //     onPaste: function(e) {
                //         console.log('Called event paste', e);
                //     },
                //     onImageUpload: function(files) {
                //         console.log(files);
                //         // upload image to server and create imgNode...
                //         $summernote.summernote('insertNode', imgNode);
                //     }
                // },
                // toolbar: [
                //     // [groume, [list of button]]
                //     ['style', ['bold', 'italic', 'underline']],
                //     ['fontsize', ['fontsize']],
                //     ['color', ['color']],
                //     ['height', ['height']],
                //     ['operation', ['undo', 'redo']],
                //     ['font', ['strikethrough', 'superscript', 'subscript', 'clear']],
                //     ['para', ['ul', 'ol', 'paragraph']],
                //     ['object', ['link', 'table', 'picture', 'video']],
                //     ['misc', [ 'help', 'fullscreen', 'codeview']]
                // ]
            });

        });

        $(document).ready(function() {
            var $editor = $('#tag_summernote');
            $editor.summernote({
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'hr']],
                    ['view', ['fullscreen', 'codeview']],
                    ['help', ['help']]
                ]
            });

        });
        $(document).ready(function() {
            var $editor = $('#description');
            $editor.summernote({
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'hr']],
                    ['view', ['fullscreen', 'codeview']],
                    ['help', ['help']]
                ]
            });

        });
    </script>


    <script>
        function serviceAreaFunc(){
            var service_area = $('#service_area').val();

            $.ajax({
                url : "{{ url('get-service-areas') }}",
                type: 'get',
                data: {
                    service_area : service_area
                },
                success: function(res)
                {
                    $('#service_values').val(res);
                },
                error: function()
                {
                    // alert('failed...');

                }
            });
        }
    </script>



    <script>
        $(document).ready(function() {
            $('#add-group').click(function(){
                var intId = $("#group-area .w-row").length + 1 || 1;


                 intId = intId +1;

                $('#group' + intId).each(function(i, obj) {
                    intId = intId +1;
                    $('#group' + intId).each(function(i, obj) {
                        intId = intId +1;
                    });
                });
                var presFields = $('<div class="w-row groupdiv' + intId + '"><div class="empty-col-left w-col w-col-4"><label for="Group' + intId + '">Group Name<span class="text-color-red">*</span></label>' +
                    '<input type="text" name="group'+intId+'" id="group' + intId + '" data-name="Group' + intId + '" class="form-control">\n' +
                    '<div id="desc-area' + intId + '" class="mb-3"></div>' +
                    '<h5 id="add-desc' + intId + '" class="btn btn-primary" onclick="addDesc('+intId+')"><span class="text-color-red">+ </span>Add Description</h5>\n' +
                    '<h5 id="remove-desc' + intId +  '" class="btn btn-danger" onclick="removeDesc('+intId+')"><span class="text-color-red">- </span>Subtract Description</h5></div>'+'<h5 id="remove-group" class="btn btn-danger" onclick="removeGroup('+intId+')"><span class="text-color-red"> - </span>Subtract Group</h5>');

                $('#group-area').append(presFields);

                var $editor = $('#summernote' + intId + '');
                $editor.summernote({
                    height: 200,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                        ['fontname', ['fontname']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'hr']],
                        ['view', ['fullscreen', 'codeview']],
                        ['help', ['help']]
                    ]
                });

            });

            $('#remove-group').click(function(){
                $("#group-area .w-row:last").remove();
            });

        });
    </script>

    <script>
        $(document).ready(function() {
            $('#add-desc').click(function(){
                // var intId = $("#desc-area .w-row").length + 1 || 1;
                var rand = Math.floor(Math.random()*100000)+1;
                var presFields = $('<div class="w-row0"><div class="empty-col-left w-col w-col-4"><label for="tag_description' + rand + '">Tag Description<span class="text-color-red">*</span></label></div><textarea  id="summernote' + rand + '" name="tag_description1[]" data-name="tag_description' + rand +'"></textarea>');

                // $('#desc-area').append(presFields);
                // if(intId == 1){
                //     $('#desc-area').append(presFields);
                // }
                // else{
                    $('#desc-area').append(presFields);
                // }

                var $editor = $('#summernote' + rand + '');
                $editor.summernote({
                    height: 200,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                        ['fontname', ['fontname']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'hr']],
                        ['view', ['fullscreen', 'codeview']],
                        ['help', ['help']]
                    ]
                });

            });

            $('#remove-desc').click(function(){
                $("#desc-area .w-row0:last").remove();
            });

            // $('#desc-area').on('change','select[id^="Group"]',function() {
            //     var val = $(this).val();
            //     var dose = $(this).parent().next(".w-col").find('select[id^="answer"]');
            //
            //     if (val == "Sildenafil") {
            //         $(dose).html("<option value='20mg'>20mg</option>");
            //     } else if (val == "Sildenafil RDT") {
            //         $(dose).html("<option value='50mg'>50mg</option><option value='100mg'>100mg</option>");
            //     } else if (val == "Sildenafil Viagra") {
            //         $(dose).html("<option value='25mg'>25mg</option><option value='50mg'>50mg</option><option value='100mg'>100mg</option>");
            //     } else if (val == "Tadalafil") {
            //         $(dose).html("<option value='10mg'>10mg</option><option value='20mg'>20mg</option>");
            //     } else if (val == "Tadalafil RDT") {
            //         $(dose).html("<option value='2.5mg'>2.5mg</option><option value='5.0mg'>5.0mg</option>");
            //     } else if (val == "Vardenafil RDT") {
            //         $(dose).html("<option value='2.5mg'>2.5mg</option><option value='5.0mg'>5.0mg</option><option value='10mg'>10mg</option><option value='20mg'>20mg</option>");
            //     }
            // });
        });
    </script>

    <script>
        function addDesc(intId){
            var rand = Math.floor(Math.random()*1000)+1;
            var presFields = $('<div class="w-row0"><div class="empty-col-left w-col w-col-4"><label for="tag_description' + intId + '">Tag Description<span class="text-color-red">*</span></label></div><textarea  id="summernote' + rand + '" name="tag_description'+intId+'[]" data-name="tag_description' + intId +'"></textarea>');

                $('#desc-area'+intId).append(presFields);
// alert('#desc-area'+intId);
            var $editor = $('#summernote' + rand + '');
            $editor.summernote({
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'hr']],
                    ['view', ['fullscreen', 'codeview']],
                    ['help', ['help']]
                ]
            });
        }
        function removeDesc(intId){
            // alert("#desc-area"+intId+ ' .w-row:last');
            $("#desc-area"+intId+ ' .w-row0:last').remove();
        }
        function removeGroup(intId){
            $(".groupdiv"+intId).remove();
        }
    </script>

@endsection
