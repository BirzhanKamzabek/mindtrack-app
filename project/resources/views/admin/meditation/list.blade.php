@extends('admin/layouts.backend')
@section('title', 'Topics')
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
            <h1>Topics</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Topics</li>
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
                    <th>Image</th>
                    <th>Name</th>
                    <th>Steps</th>
                    <th>Description</th>    
				          	<th>Action</th>
				  </tr>
                  </thead>
                  <tbody>
                   
					  @if(isset($lists))
            @foreach($lists as $key => $list)
							<tr>
                <td>{{$key + 1}}</td>
								<td><img src="{{asset('admin/meditation/images')}}/{{$list->image}}" alt="{{$list->image}}" width="100px"></td>
								<td>{{ $list->title }}</td>
								<td><a target="_blank" href="{{ url('/admin/meditation/step/list') }}/{{ $list->id }}"><button type="button" class="btn btn-warning">View<sup>({{ $list->steps->count() }})</sup></button></a> </td>
								<td>{!! $list->description !!}</td>
								<td><a href="{{ url('/admin/meditation/edit') }}/{{ $list->id }}"><button type="button" class="btn btn-success">Edit</button></a> 
                 <a href="{{ url('/admin/meditation/delete') }}/{{ $list->id }}" onclick="return validateDelete(this);"><button type="button" class="btn btn-danger">Delete</button></a> 
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
