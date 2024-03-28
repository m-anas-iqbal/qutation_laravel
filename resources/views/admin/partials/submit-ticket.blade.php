@extends('layouts.admin')
@section('title','Submit Ticket')
@section('css')
    <link href="{{ my_asset('plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ my_asset('plugins/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ my_asset('assets/css/pages/contact_us.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ my_asset('assets/css/forms/theme-checkbox-radio.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ my_asset('plugins/file-upload/file-upload-with-preview.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        h2{font-weight:700;color:#005beb;}
        .n-chk {display: inline-block;}
        em{display:block;font-style: normal;color: red;}
        label{display:block;}
        .form-group label, label {
            font-size: 1rem!important;
            color: #333;
            letter-spacing: 0.03em;
            font-weight:700;
        }
        .custom-file-container label {
            color: #333;
        }
        .new-control.new-radio .new-control-indicator {
            background-color: #EEEEEE;
        }
        .custom-file-container__image-multi-preview {
            position: relative;
            box-sizing: border-box;
            transition: all 0.2s ease;
            border-radius: 6px;
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            float: left;
            margin: 1.858736%;
            width: 10%;
            height: 90px;
            box-shadow: 0 4px 10px 0 rgba(51, 51, 51, 0.25);
        }
        .red-required{color:#d32f2f}
        .custom-file-container__image-multi-preview__single-image-clear__icon {
            color: #1b55e2;
            display: block;
            margin-top: -8px;
            font-size: 1.5rem;
            }
         .new-control.new-radio .new-control-indicator {
            background-color: #EEEEEE;
        }
        .clear-image {color: red;}
    </style>
@endsection
@section('content')

	<!-- Contents -->
	<div class="row layout-top-spacing">
		<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        	<div class="statbox widget box box-shadow">
        		
        		<div class="widget-content widget-content-area">
                    <div class="row mb-5">
        				<div class="col-xl-12 col-md-12 col-sm-12 col-12">
        					<h2>Submit A Ticket</h2>
        				</div>
        			</div>
                    <div class="row mb-5">
                    	<div class="col-md-12">
                    		<form action="{{ url('/user-submit-ticket') }}" method="POST" id="marketing-form" onsubmit="return loginLoadingBtn(this)" class="" enctype="multipart/form-data">
                    			@csrf
		                        <div class="row mb-2">
		                            <div class="col-sm-12 col-md-12 col-xl-12">
		                                <label>Priority <span class="text-danger"><sup id="priority-error">*</sup></span></label></label>
		                                <div class="n-chk">
                                            <label class="new-control new-radio radio-classic-primary">
                                              <input type="radio" class="new-control-input priority" name="priority" id="priority" value="Routine">
                                              <span class="new-control-indicator"></span>Routine
                                            </label>
                                        </div>
                                        <div class="n-chk">
                                            <label class="new-control new-radio radio-classic-primary">
                                              <input type="radio" class="new-control-input priority " name="priority" id="priority" value="Urgent">
                                              <span class="new-control-indicator"></span>Urgent
                                            </label>
                                        </div>
		                                @error('priority')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
		                            </div>
		                        </div>
		                        <div class="row mb-2">
		                            <div class="col-xl-4 col-md-4 col-sm-4">
		                                <div class="form-group">
		                                    <label for="Requested By" id="form-label">Requested By <span class="text-danger"><sup id="requestedby-error">*</sup></span></label>
		                                    <select class="form-control" readonly>
		                                        <option value="">
		                                        	{{ Auth::user()->name }}
		                                        </option>
		                                    </select>
		                                </div>
		                            </div>
		                            <div class="col-xl-4 col-md-4 col-sm-4">
		                                <div class="form-group">
		                                    <label for="duedate" id="form-label">Due Date <span class="text-danger"><sup id="duedate-error">*</sup></span></label>
		                                    <input type="text" class="form-control{{ $errors->has('duedate') ? ' is-invalid' : '' }}" name="duedate" id="duedate" autocomplete="off" required>
		                                </div>
		                                @error('duedate')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
		                            </div>
		                            <div class="col-xl-4 col-md-4 col-sm-4">
		                                <div class="form-group">
		                                    <label for="time" id="form-label">Time Needed By</label>
		                                    <input type="text" name="time" id="time" value="{{ old('time') }}" autocomplete="off" class="form-control" >
		                                </div>
		                            </div>
		                        </div>
		                        <div class="row mb-2">
		                            <div class="col-xl-12 col-md-12 col-sm-12">
		                            	@php
		                            	$arr = explode(",",Auth::user()->company_id);
                                		$companies = \DB::table('companies')
                                			->select('id','name')
                                			->WhereIn('id',$arr)
                                			->orderBy('name','asc')
                                			->get();
                                		$count = count($arr);
		                            	@endphp
		                                
		                                <label>Select Company <span class="text-danger"><sup id="company-error">*</sup></span></label>
		                                @foreach($companies as $company)
		                                <div class="n-chk">
                                            <label class="new-control new-radio radio-classic-primary">
                                              <input type="radio" class="new-control-input" name="company" value="{{ $company->id }}" @if($count == 1) {{ (in_array($company->id,$arr)) ? 'checked' : '' }} @endif>
                                              <span class="new-control-indicator"></span>{{ $company->name }}
                                            </label>
                                        </div>
		                                 @endforeach
		                                @error('company')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
		                            </div>
		                        </div>
		                        <div class="row mb-2">
		                            <div class="col-xl-12 col-md-12 col-sm-12">
		                                <div class="form-group">
		                                    <label for="newprojecttitle" id="form-label">Project Title <span class="text-danger"><sup id="title-error">*</sup></span></label>
		                                    <input type="text" value="{{ old('newprojecttitle') }}" class="form-control{{ $errors->has('newprojecttitle') ? ' is-invalid' : '' }}" id="newprojecttitle" name="newprojecttitle" autocomplete="off" required placeholder="Project Title">
		                                </div>
		                                @error('newprojecttitle')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
		                            </div>
		                        </div>
		                        <div class="row mb-2">
		                            <div class="col-xl-12 col-md-12 col-sm-12">
		                                <div class="form-group">
		                                    <label for="instructions" id="form-label">Instructions <span class="text-danger"><sup id="instruction-error">*</sup></span></label>
		                                    <textarea class="form-control{{ $errors->has('instructions') ? ' is-invalid' : '' }}" rows="4" id="instructions" name="instructions" placeholder="Describe the project .. if the description is too long, copy it to Word and attach it" required>{{ old('instructions') }}</textarea>
		                                </div>
		                                @error('instructions')
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
		                                @enderror
		                            </div>
		                        </div>

				                <input type="hidden" id="counter" name="counter" value="1">
				                <div class="row mb-2">
				                    <div class="col-xl-12 col-md-12 col-sm-12">
				                        <div class="form-group">
				                            <label>Attachment <a href="javascript:void(0)"
				                                                 class="custom-file-container__image-clear clear-image"
				                                                 onclick="removeImage('1')" title="Clear Image">x</a></label>
				                            <input type="file" class="form-control" name="image_1" id="image_1">
				                        </div>
				                    </div>
				                </div>
				                <div id="add-more"></div>
				                <div class="row mb-4">
				                    <div class="col-xl-12 col-md-12 col-sm-12">
				                        <div class="form-group">
				                            <a class="btn btn-sm btn-neutral" id="add-more-btn"
				                                    style="float: right; border: 1px solid #bfc9d4; width: 15%; padding: 10px;">
				                                Add More
				                            </a>
				                        </div>
				                    </div>
				                </div>
		                        <div class="row mb-2">
		                            <div class="col-xl-12 col-md-12 col-sm-12">
		                                @php
	                                	$categories = \App\Category::select('id','name')->where('status',1)->orderBy('name','asc')->get();
	                                	@endphp
                                        <label for="category" id="form-label">Category (create a new request for each category) <span class="text-danger"><sup id="category-error">*</sup></span></label>
                                        @foreach($categories as $category)
                                        <div class="n-chk">
                                            <label class="new-control new-radio radio-classic-primary">
                                              <input type="radio" class="new-control-input" name="category" id="category" value="{{ $category->id }}">
                                              <span class="new-control-indicator"></span> {{ $category->name }}
                                            </label>
                                        </div>
                                        @endforeach
		                            </div>
		                            @error('category')
		                                <span class="invalid-feedback" role="alert">
		                                    <strong>{{ $message }}</strong>
		                                </span>
		                            @enderror
		                        </div>
		                        <br>
		                        <div class="form-group" id="loading-btn">
		                            <button type="submit" class="btn btn-lg mr-3 btn-primary" id="submit-btn" style="width: unset;">SUBMIT
		                            </button>
		                        </div>
		                        <div class="alert alert-danger" style="display: none;" id="error-class">
		                            Required fields must not be empty.
		                        </div>
                    		</form>
                    	</div>
                    </div>
        		</div>
        	</div>
        </div>
    </div>

@endsection
@section('js')

	<script src="{{ my_asset('assets/js/validation.js') }}"></script>
    <script src="{{ my_asset('plugins/file-upload/file-upload-with-preview.min.js') }}"></script>
    <script>
        var secondUpload = new FileUploadWithPreview('mySecondImage');
    </script>
	<script src="{{ my_asset('plugins/flatpickr/flatpickr.js') }}"></script>
	<script src="{{ my_asset('plugins/flatpickr/custom-flatpickr.js') }}"></script>
	<script>
	    var f1 = flatpickr(document.getElementById('duedate'), {
	        dateFormat: "m-d-Y",
	    });
	    function removeImage(id) {
	        $('#image_'+id).val('');
	    }

	    $('#add-more-btn').click(function() {
	        var count = parseInt($("#counter").val()) + 1;
	        $('#add-more').append('<div class="row mb-2"><div class="col-xl-12 col-md-12 col-sm-12"><div class="form-group"><label>Attachment <a href="javascript:void(0)" class="custom-file-container__image-clear clear-image" onclick="removeImage('+ count +')" title="Clear Image">x</a></label><input type="file" class="form-control" name="image_'+ count +'" id="image_'+ count +'"></div></div></div>');
	        $("#counter").val(count);
	    });
	</script>
	<?php
	    $out = \DB::table('holidays')->first();
	    if ($out) {
	        $from = strtotime(\Carbon\Carbon::createFromFormat('m-d-Y', $out->from_date)->format('Y-m-d'));
	        $to = strtotime(\Carbon\Carbon::createFromFormat('m-d-Y', $out->to_date)->format('Y-m-d'));
	        $current = strtotime(date('Y-m-d'));
	    }
	    if ($out && $current == $from && $out->status == 1) {
	        ?>
	        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: block; padding-right: 15px;" aria-modal="true">
	            <div class="modal-dialog modal-dialog-centered" role="document">
	                <div class="modal-content">
	                    <div class="modal-header">
	                        <h5 class="modal-title" id="exampleModalCenterTitle">Out Of Office</h5>
	                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                          <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
	                        </button>
	                    </div>
	                    <div class="modal-body">
	                            <p class="modal-text">{!! $out->text !!}</p>
	                    </div>
	                    <div class="modal-footer">
	                        <button class="btn" data-dismiss="modal" style="background-color: #343a40; color: #fff;">
	                            <i class="flaticon-cancel-12"></i> Close
	                        </button>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <script>
	            $('#exampleModalCenter').modal('show');
	        </script>
	        <?php
	    } elseif($out && $current <= $to && $out->status == 1) {
	        ?>
	        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: block; padding-right: 15px;" aria-modal="true">
	            <div class="modal-dialog modal-dialog-centered" role="document">
	                <div class="modal-content">
	                    <div class="modal-header">
	                        <h5 class="modal-title" id="exampleModalCenterTitle">Out Of Office</h5>
	                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                          <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
	                        </button>
	                    </div>
	                    <div class="modal-body">
	                            <p class="modal-text">{!! $out->text !!}</p>
	                    </div>
	                    <div class="modal-footer">
	                        <button class="btn" data-dismiss="modal" style="background-color: #343a40; color: #fff;">
	                            <i class="flaticon-cancel-12"></i> Close
	                        </button>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <script>
	            $('#exampleModalCenter').modal('show');
	        </script>
	        <?php
	    }
	?>

@endsection