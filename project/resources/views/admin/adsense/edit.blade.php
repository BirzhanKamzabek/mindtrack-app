@extends('admin/layouts.backend')
@section('title', 'Update Plan')
@section('content')
<style>
        #image-preview {
    max-width: 300px;
}
        #image-preview img{
			max-width: 100%;
}
    </style>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper admin-dashboard-content">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Plan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Update Plan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

 <!-- Main content -->
  <section class="content">
     <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> Update Plan</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                @if(session()->has('success'))
					<div class="alert alert-success">
					  <strong>Success!</strong> {{ session()->get('success') }}
					</div>
				@endif
				@if(session()->has('error'))
					<div class="alert alert-danger">
						<strong>Warning!</strong> {{ session()->get('error') }}
					</div>
				@endif
				<form role="form" action="{{route('admin.edit_adsense_action')}}" method="POST" enctype='multipart/form-data'>
					@CSRF
          <input type="hidden" name="id" value="{{ $adsense->id }}">
					<div class="box-body">
						 
            <div class="form-group">
							<label for="exampleInputEmail1">Title <span style="color:red;">*</span></label>
							<input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="exampleInputEmail1" placeholder="title" value="{{ $adsense->title }}" >
			
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Banner <span style="color:red;">*</span></label>
							<input type="file" name="banner" class="form-control @error('banner') is-invalid @enderror" id="banner" placeholder="banner" value="{{ old('banner') }}" onchange="previewImage()">

              <img src="{{ asset('admin/images/adsense') }}/{{ $adsense->banner }}" alt="" id="banner-preview" width="400px">
						</div>
		
                    </div>
					<!-- /.box-body -->
					<div class="box-footer">
						<button type="submit" name="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
 
  <script>
    function previewImage() {
       // Get the selected file input
       var input = document.getElementById('banner');

       // Check if a file is selected
       if (input.files && input.files[0]) {
           var reader = new FileReader();

           // Set up the banner preview once the file is loaded
           reader.onload = function (e) {
               var preview = document.getElementById('banner-preview');
               preview.src = e.target.result; // Set the src attribute of the img tag
           };

           // Read the file as a data URL
           reader.readAsDataURL(input.files[0]);
         }}
</script>
@endsection
