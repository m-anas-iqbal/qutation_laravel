@extends('layouts.front')
@section('title', 'Position Details')
@section('style')

<style>
    table{
font-size:12px;
}
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection
@section('content')


    <section class="py-8 py-md-11 bg-hn1" style="margin-top: 91px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <h2 class="text-center">User Contacts</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('front.includes.user_menu')


    <section class="py-8 py-md-10" style="padding-top: unset !important;">
        <div class="container-fluid">
            <div class="row justify-content-center">

                <div class="content-column col-lg-12 col-md-12 col-sm-12 trader_section">
                    <table class="table table-bordered" id="myTable">
                        <thead>
                        <tr>
                            <th colspan="5">User Information</th>
                            <th colspan="2">Job Information</th>
                            <th colspan="2" >Posted </th>
                        </tr>
                        <tr>
                            <th scope="col">#</th>
                            <!-- <th scope="col">Business Name</th> -->
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Postcode</th>
                            <th scope="col">Status</th>
                            <th scope="col">Description</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        // echo "<pre>";
                        //     print_r($user_contacts);
                        //     die;
 ?>

                        @foreach($user_contacts as $key => $contact)
                            <?php
                            // print_r()
                            $business = \App\User::where('id', $contact->user_business_id)->first();
                            $user = \App\User::where('id', $contact->user_id)->first();
                            ?>
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <!-- <td>{{ $business->name }}</td> -->
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->phone }}</td>
                                <td>{{ $contact->postcode }}</td>
                                <td>{{ $contact->job_status }}</td>
                                <td>{{ $contact->description }}</td>
                                <td>{{ $contact->created_at }}</td>
                                <td><button class="btn-sm btn-danger"   onclick="delete_req({{ $contact->id }})"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
</svg></button></td>

<!-- <a href="" class="btn-sm btn-primary">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
  <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
  <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
</svg></a> |  -->
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </section>

@endsection

@section('script')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
//  swal("Deleted!", "Your imaginary file has been deleted.", "success");
let table = new DataTable('#myTable');

function delete_req(id) {
    swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this Record!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    let _token = "{{ csrf_token() }}";
                $.ajax({
                    type: 'POST',
                    url: "{{ url('delete_record_qoute') }}",
                    data: {
                        _token: _token,
                        id: id,
                    },
                    dataType:'json',
                    success: function(data) {
    location.reload();
                    },
                    error:function(data){
                        console.log('error');
                        console.log(data.responseText);
                    }
                });


  }
});



}
</script>
@endsection
