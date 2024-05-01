@extends('admin/layouts.backend')
@section('title', 'Add Topics')
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
            <h1>Add Topics</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Add Topics</li>
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
                <h3 class="card-title"> Add Topics</h3>
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
				<form role="form" action="{{route('admin.add_topics_action')}}" method="POST" enctype='multipart/form-data'>
					@CSRF
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1">Topic Name <span style="color:red;">*</span></label>
							<input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="exampleInputEmail1" placeholder="title" value="{{ old('title') }}" >
			
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Description<span style="color:red;">*</span></label>
              <textarea id="summernote" name="description"></textarea>
							 
						</div>
            <!-- /.results -->

            <div class="form-group">
							<label for="exampleInputEmail1">result 1 <span style="color:red;">*</span></label>
              <textarea id="result1" name="result1"></textarea>			
						</div>
            <div class="form-group">
							<label for="exampleInputEmail1">result 2 <span style="color:red;">*</span></label>
              <textarea id="result2" name="result2"></textarea>			
						</div>
            <div class="form-group">
							<label for="exampleInputEmail1">result 3 <span style="color:red;">*</span></label>
              <textarea id="result3" name="result3"></textarea>			
						</div>
            <div class="form-group">
							<label for="exampleInputEmail1">result 4 <span style="color:red;">*</span></label>
              <textarea id="result4" name="result4"></textarea>			
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
   
 
@endsection
