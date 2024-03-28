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
            <h2 class="jobTitlePadding">Update </h2>
        </div>
        <div class="col-md-12 col-sm-12 col-12 layout-spacing">
            <div>
                <div class="card p-5">

                    <div class="row">
                        <div class="col-12">
                    <!-- Large modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg" style="float: right;">Groups</button>

                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">All Groups</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($groups as $key=>$group)
                                        <tr>
                                            <th scope="row">{{ $key+1 }}</th>
                                            <td>{{ $group->name }}</td>
                                            <td>
                                                    <a href="{{ url('activate-group/'.$category_description->id.'/'.$group->id) }}" class="btn btn-{{ $group->status == 0 ? 'info' : 'success'}}">{{ $group->status == 0 ? 'Deactivated' : 'Activated'}}</a>
                                            </td>
                                            <td>
                                                <a href="{{ url('delete-group', $group->id) }}"><svg class="mb-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" height="18" width="18"><g><polyline points="11.5 5.5 10.5 13.5 3.5 13.5 2.5 5.5" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></polyline><line x1="1" y1="3.5" x2="13" y2="3.5" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></line><path d="M4.46,3.21l0-1.73a1,1,0,0,1,1-1h3a1,1,0,0,1,1,1v2" fill="none" stroke="#1b55e2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>
                        </div>
                    </div>



                    {{--<form action="{{ url('save-group') }}" method="POST">--}}
                        {{--@csrf--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-10">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="Group">Groups--}}
                                        {{--<span class="text-color-red">*</span>--}}
                                    {{--</label>--}}
                                    {{--<select class="form-control" id="group_id" name="group_id"--}}
                                            {{--required>--}}
                                        {{--<option value="">--Select--</option>--}}
                                        {{--@foreach($groups as $group)--}}
                                            {{--<option value="{{ $group->id }}" {{ $group->status == 1 ? 'selected' : '' }}>{{ $group->name }}</option>--}}
                                        {{--@endforeach--}}

                                    {{--</select>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-2">--}}
                                {{--<div class="form-group">--}}
                                    {{--<button type="submit" class="btn btn-primary" style="margin-top: 33px;">--}}
                                        {{--Save Group--}}
                                    {{--</button>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                    <hr>

                    <form action="{{ route('category-description.update' , $category_description->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Your Service Area</label>
                            <span class="text-danger"> *</span>

                            <select class="select2 form-control" id="service_area" name="short_service_area[]"
              _area"                multiple required onchange="serviceAreaFunc()">
                            <optgroup label="Selected">
                                @foreach($arr_service_areas as $area)
                                    <option value="{{ $area }}" selected>{{ $area }}</option>
                                @endforeach
                            </optgroup>
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

                        <?php
                        $description = str_replace($category_description->service_area_values, '{tag_area}', $category_description->description);
                        $tag_description = str_replace($category_description->service_area_values, '{tag_area}', $category_description->tag_description);
                        ?>

                        <input type="hidden" value="{{ $category_description->service_area }}" name="service_area[]" id="service_values" class="form-control">

                        <div class="form-group">
                            <label for="">Description</label>
                            <span class="text-danger"> *</span>
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ $description }}</textarea>
                        </div>

                        {{--///--}}


                        <div id="prescription-area">
                            @foreach($faqs as $key=>$faq)
                                <?php
                                $question = str_replace($category_description->service_area_values, '{tag_area}', $faq->question);
                                $ans = str_replace($category_description->service_area_values, '{tag_area}', $faq->answer);
                                ?>
                            <div class="form-group">
                                <label for="Question">Question
                                    <span class="text-color-red">*</span>
                                </label>
                                <input type="text" name="question[]" id="question" class="form-control" value="{{ $question }}" required>
                            </div>
                            <div class="form-group">
                                <label for="answer">Answer
                                    <span class="text-color-red">*</span>
                                </label>

                                <textarea id="summernote{{$key}}" name="answer[]">{!! $ans !!}</textarea>
                            </div>
                                @endforeach
                        </div>
@if(count($faqs)<=0)
                        <h5 id="add-prescription" class="btn btn-primary"><span class="text-color-red">+ </span>Add Another</h5>
                        <h5 id="remove-prescription" class="btn btn-danger"><span class="text-color-red">- </span>Subtract</h5>
@endif

                        {{--////--}}







                        <div id="group-area" class="mb-3">


                            @foreach($groups as $key=>$group)
                                <?php
                                $tags = \App\GroupTagDescription::where('group_id', $group->id)->get();
                                ?>
                                <div class="form-group">
                                    <label for="Question">Group Name
                                        <span class="text-color-red">*</span>
                                    </label>
                                    <input type="text" name="group{{ $key }}" id="group" class="form-control"
                                           value="{{ $group->name }}" required>
                                </div>
                                @if(count($tags) > 0)
                                        @foreach($tags as $tag)
                                    <div class="form-group">
                                        <label for="">Tag Description
                                            <span class="text-color-red">*</span>
                                        </label>
                                            <textarea id="tag_summernote{{$tag->id}}"
                                                      name="tag_description{{$key}}[]">{!! $tag->description !!}</textarea>
                                    </div>
                                        @endforeach
                                @endif
                                    <div id="desc-area{{ $group->id }}" class="mb-3">
                                    </div>
                                    <h5 id="add-desc{{ $group->id }}" class="btn btn-primary"><span class="text-color-red">+ </span>Add Description</h5>
                                    {{--<h5 id="remove-desc{{ $group->id }}" class="btn btn-danger"><span class="text-color-red">- </span>Subtract Description</h5>--}}



                            @endforeach

                        </div>
                        <div class="form-group">
                            {{--<h5 id="add-desc" class="btn btn-primary"><span class="text-color-red">+ </span>Add Description</h5>--}}
                            {{--<h5 id="remove-desc" class="btn btn-danger"><span class="text-color-red">- </span>Subtract Description</h5>--}}
                            <h5 id="add-group" class="btn btn-primary"><span class="text-color-red">+ </span>Add Group</h5>
                            {{--<h5 id="remove-group" class="btn btn-danger"><span class="text-color-red">- </span>Subtract Group</h5>--}}
                        </div>

                        <button type="submit" class="theme-btn btn btn-primary">
                            Update
                            <div class="spinner-border d-none" role="status"></div>
                        </button>
                    </form>

            </div>
        </div>
    </div>
    </div>


@endsection


@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.2/select2.min.js"></script>

    @foreach($groups as $key=>$group)
        <?php
        $tags = \App\GroupTagDescription::where('group_id', $group->id)->get();
        ?>

        <script>
            $(document).ready(function() {
                $('#add-desc{{ $group->id }}').click(function(){
                    // var intId = $("#desc-area .w-row").length + 1 || 1;
                    var rand = Math.floor(Math.random()*100000)+1;
                    var presFields = $('<div class="w-row0"><div class="empty-col-left w-col w-col-4"><label for="tag_description' + rand + '">Tag Description<span class="text-color-red">*</span></label></div><textarea  id="summernote' + rand + '" name="tag_description{{$key}}[]" data-name="tag_description' + rand +'"></textarea>');

                    // $('#desc-area').append(presFields);
                    // if(intId == 1){
                    //     $('#desc-area').append(presFields);
                    // }
                    // else{
                    $('#desc-area{{ $group->id }}').append(presFields);
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

        @foreach($tags as $tag)
    <script>
        $(document).ready(function() {
            var $editor = $('#tag_summernote{{$tag->id}}');
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
    @endforeach
    @endforeach


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

    @foreach($faqs as $key=>$faq)
    <script>
        $(document).ready(function() {
            var $editor = $('#summernote{{ $key }}');
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
    @endforeach

    <script>
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
// alert(service_area);
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

var count_values = {{ count($groups) }}
                intId = intId+count_values+1;

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
