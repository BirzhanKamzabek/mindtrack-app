@extends('admin/layouts.backend')
@section('title', 'Edit Meditation')
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
            <h1>Edit Meditation</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Edit Meditation</li>
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
                <h3 class="card-title"> Edit Meditation</h3>
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
				<form role="form" action="{{route('admin.edit_meditation_action')}}" method="POST" enctype='multipart/form-data'>
					@CSRF
          <input type="hidden" name="meditation_id" value="{{$meditation->id }}">
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1">Title <span style="color:red;">*</span></label>
							<input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="exampleInputEmail1" placeholder="title" value="{{$meditation->title }}" >
			
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Description<span style="color:red;">*</span></label>
              <textarea id="" name="description" rows="10" class="form-control"> {{$meditation->description }}</textarea>
							 
						</div>
            <div class="form-group">
							<label for="exampleInputEmail1">Image<span style="color:red;">*</span></label>
               <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror"> 
						</div>
            <div id="preview">
              @if($meditation->image)
              <img src="{{asset('admin/meditation/images')}}/{{$meditation->image}}" alt="{{$meditation->image}}">
              @endif
            </div>
						<div class="form-group">
							<label for="exampleInputEmail1">Video<span style="color:red;">*</span></label>
               <input type="file" name="video" id="video" class="form-control @error('video') is-invalid @enderror"> 
               @if($meditation->video)
               <video src="{{asset('admin/meditation/videos')}}/{{$meditation->video}}" width="200px"></video>
               @endif
						</div>

					 <div class="card">
           <div class="card-header">
                <h3 class="card-title"> Add Meditation Steps</h3>
              </div>
            <div class="card-body">
              <div id="dynamic_field">
              @foreach($meditation->steps as $key => $step)
              <div class="row">
                <div class="col-11">
                <div class="form-group">
							<label for="exampleInputEmail1">Step Title <span style="color:red;">*</span></label>
							<input type="text" name="step_title[]" class="form-control @error('step_title') is-invalid @enderror" id="exampleInputEmail1"   value="{{ $step->title }}" >
              <input type="hidden" name="step_id[]" value="{{$step->id}}">
						</div>
                </div>
                 
                <div class="col-1 mt-4">
                <a href="{{url('admin/meditation/step/delete/')}}/{{$step->id}}" onclick="return validateDelete(this);"><button type="button" name="remove" class="btn btn-danger btn_remove">x</button></a>  
                </div>
                 
              </div>
              @endforeach

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
  function validateDelete(){
	var confirms = confirm('Do you want to delete ?.');
	if(confirms==false){
		return false;
	}
  }
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
