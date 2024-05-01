@extends('admin/layouts.backend')
@section('title', 'Users')
@section('content')
<!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper admin-dashboard-content">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
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
                <h3 class="card-title">All Users  </h3>
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date</th>
				          	<th>Action</th>
				  </tr>
                  </thead>
                  <tbody>
                    <?php $i=1; ?>
					  @if(isset($data))
						@foreach($data as $data)
							<tr>
                <td>{{$i}}</td>
								<td>{{ $data->name }}</td>
								<td>{{ $data->email }}</td>
							    <td>{{ $data->created_at }}</td>

							
                <?php
                /*
                {{ url('/admin/'edit_user) }}/{{ $data->id }} 
                {{ url('/admin/delete_category/') }}/{{ $category->id }}
                */
                ?>
								<td><a href="{{ url('/admin/edit-users') }}/{{ $data->id }}"><button type="button" class="btn btn-warning"><b>Edit & View </b></button></a> 
                <a href="{{ url('/admin/delete-user') }}/{{ $data->id }}" onclick="return validateDelete(this);"><button type="button" class="btn btn-danger">Delete</button></a>
              </td>
							</tr>
              <?php $i++; ?>
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
