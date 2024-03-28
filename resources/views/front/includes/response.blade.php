@if ($errors->any())
    <div class="row layout-top-spacing mb-4">
        <div class="col-md-12 container">
            <ul style="color: #fff; background: #dc3545; padding: 15px; border-radius: 5px; padding-left: 30px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
@if (session('success'))
    <div class="alert alert-success mb-4" role="alert">
        <strong>Success!</strong> {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger mb-4" role="alert">
        <strong>Oops!</strong> {{ session('error') }}
    </div>
@endif
