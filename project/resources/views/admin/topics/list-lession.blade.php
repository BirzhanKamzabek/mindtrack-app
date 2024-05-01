@extends('admin/layouts.backend')
@section('title', 'Lession')
@section('content')
<!-- Content Wrapper. Contains page content -->
<style>
  .normal {
    background: yellow;
}
.weak{
  background: #ff5d5d;
}
.strong{
  background: #0eaf0e;
  color:#fff;
}
</style>
  <div class="content-wrapper admin-dashboard-content">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $topic->name }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Lession</li>
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
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
				  <tr>     
                    <th>S.no</th>
                    <th>Topic</th>
                    <th>Chapter</th>
                    <th>Title</th>
                    <th>About</th>
                    <th>Video</th>
                    <th>Image</th>
                    <th>Description</th>    
				          	<th>Action</th>
				  </tr>
                  </thead>
                  <tbody>
                   
					  @if(isset($lessions))
            @foreach($lessions as $key => $lession)
							<tr>
                <td>{{$key + 1}}</td>
								<td>{{ $lession->topic->name }}</td>
								<td>{{ $lession->name }}</td>
								<td>{{ $lession->title }}</td>
								<td>{{ $lession->about }}</td>
                 @if($lession->video)
								<td><video src="{{ asset('admin/lession/video') }}/{{$lession->video}}"  width="100px"></video></td>
                 @else
                 <td>No Video</td>
                 @endif
                 @if($lession->image)
								<td><img src="{{ asset('admin/lession/images') }}/{{$lession->image}}" width="100px"></td>
                @else
                <td>No Image</td>
                @endif
								<td>{!! $lession->description !!}</td>
								<td><a href="{{ url('/admin/lession/edit') }}/{{ $lession->id }}"><button type="button" class="btn btn-success">Edit</button></a> 
                 <a href="{{ url('/admin/lession/delete') }}/{{ $lession->id }}" onclick="return validateDelete(this);"><button type="button" class="btn btn-danger">Delete</button></a> 
              </td>
							</tr>
            
					     	@endforeach
					    @endif
                  </tbody>
               
                </table>
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
  function validateDelete(){
	var confirms = confirm('Do you want to delete ?.');
	if(confirms==false){
		return false;
	}
  }
</script>
@endsection
