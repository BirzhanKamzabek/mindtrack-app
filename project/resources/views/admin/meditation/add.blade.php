@extends('admin/layouts.backend')
@section('title', 'Add Meditation')
@section('content')
<style>
        #image-preview {
    max-width: 300px;
}
        #image-preview img{
			max-width: 100%;
}
#preview img{
    width: 200px;
  }
    </style>
   
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper admin-dashboard-content">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Meditation</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Add Meditation</li>
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
                <h3 class="card-title"> Add Meditation</h3>
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
				<form role="form" action="{{route('admin.add_meditation_action')}}" method="POST" enctype='multipart/form-data'>
					@CSRF
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1">Title <span style="color:red;">*</span></label>
							<input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="exampleInputEmail1" placeholder="title" value="{{ old('title') }}" >
			
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Description<span style="color:red;">*</span></label>
              <textarea id="" name="description" rows="10" class="form-control">{{old('description')}}</textarea>
							 
						</div>
					 
						<div class="form-group">
							<label for="exampleInputEmail1">Image<span style="color:red;">*</span></label>
               <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror"> 
						</div>
            <div id="preview"></div>
						<div class="form-group">
							<label for="exampleInputEmail1">Video<span style="color:red;">*</span></label>
               <input type="file" name="video" id="video" class="form-control @error('video') is-invalid @enderror"> 
						</div>
					 <div class="card">
           <div class="card-header">
                <h3 class="card-title"> Add Meditation Steps</h3>
              </div>
            <div class="card-body">
              <div id="dynamic_field">
              <div class="row">
                <div class="col-11">
                <div class="form-group">
							<label for="exampleInputEmail1">Step Title <span style="color:red;">*</span></label>
							<input type="text" name="step_title[]" class="form-control @error('step_title') is-invalid @enderror" id="exampleInputEmail1"   value="{{ old('step_title[0]') }}" >
			
						</div>
                </div>
                <!-- <div class="col-1">
                 <button type="button" name="remove" class="btn btn-danger btn_remove">x</button> 
                </div> -->
              </div>
              </div>
              <div class="row">
                           <div class="col-md-11">&nbsp;</div>
                           <div class="col-md-1"><button type="button" name="add" id="add" class="btn btn-success pull-right" style="margin-left: 48px;margin-top: 10px;">+</button></div>
                        </div>

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
var i = 1;

$('#add').click(function(){  
    i++;  
    $('#dynamic_field').append('<div class="row" id="row'+i+'"><div class="col-11"><div class="form-group"><label for="exampleInputEmail1">Step Title <span style="color:red;">*</span></label><input type="text" name="step_title[]" class="form-control step-title" id="exampleInputEmail1" ></div></div><div class="col-1 mt-4"><button type="button" id="'+i+'" name="remove" class="btn btn-danger btn_remove">x</button></div></div>');  
});

$(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      }); 
    </script>
 <script>
document.getElementById('image').addEventListener('change', function() {
  const file = this.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function(event) {
      const img = document.createElement('img');
      img.setAttribute('src', event.target.result);
      img.setAttribute('id', 'previewImage');
      document.getElementById('preview').innerHTML = '';
      document.getElementById('preview').appendChild(img);
    };
    reader.readAsDataURL(file);
  } else {
    document.getElementById('preview').innerHTML = '';
  }
});
</script>
@endsection
