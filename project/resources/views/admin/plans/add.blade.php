@extends('admin/layouts.backend')
@section('title', 'Add Plan')
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
            <h1>Add Plan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Add Plan</li>
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
                <h3 class="card-title"> Add Plan</h3>
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
				<form role="form" action="{{route('admin.add_subscription_plans_action')}}" method="POST" enctype='multipart/form-data'>
					@CSRF
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1">Name <span style="color:red;">*</span></label>
							<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1" placeholder="Name" value="{{ old('name') }}" >
			
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Price<span style="color:red;">*</span></label>
							<input type="number" name="price" class="form-control @error('price') is-invalid @enderror" id="exampleInputEmail1" placeholder="Price" value="{{ old('price') }}" step="any">
							 
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Days<span style="color:red;">*</span></label>
							<input type="number" name="days" class="form-control @error('days') is-invalid @enderror" id="exampleInputEmail1" placeholder="days" value="{{ old('days') }}" >
							 
						</div>
					  
            <div class="form-group">
							<label for="exampleInputEmail1">Description<span style="color:red;">*</span></label>
							<textarea type="file" class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{old('description')}}</textarea>
							 
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
  var country = document.getElementById("country");
  var countrycode = document.getElementById("country_code");
  var isd_code = document.getElementById("isd_code");

  country.addEventListener("change", function() {
    var name = country.value;
    var isdCode = country.options[country.selectedIndex].dataset.isdCode;
    var countryCode = country.options[country.selectedIndex].dataset.countryCode;

    console.log(name, isdCode, countryCode);

    countrycode.value = countryCode;
    isd_code.value = isdCode;
    country.readOnly = true;
  });
</script>
<script>
    function previewImage() {
        // Get the selected file input
        var input = document.getElementById('image');

        // Check if a file is selected
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            // Set up the image preview once the file is loaded
            reader.onload = function (e) {
                var preview = document.getElementById('image-preview');
                preview.innerHTML = '<img src="' + e.target.result + '" alt="Image Preview">';
            };

            // Read the file as a data URL
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
