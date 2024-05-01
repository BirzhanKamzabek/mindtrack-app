@extends('admin/layouts.backend')
@section('title', 'Adsense')
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
            <h1>Adsense</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Adsense</li>
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
                    <th>title</th>
                    <th>Banner</th>              
                    <th>Status</th>     
				          	<th>Action</th>
				  </tr>
                  </thead>
                  <tbody>
                    <?php $i=1; ?>
					  @if(isset($adsense))
						@foreach($adsense as $plan)
							<tr>
                <td>{{$i}}</td>
								<td >{{ $plan->title }}</td>
								<td><img src="{{ asset('admin/images/adsense') }}/{{ $plan->banner }}" alt="" srcset="" width="200px"</td>
								 <td>
                 
                 <form action="{{url('admin/adsense/status/update')}}" method="post" id="statusForm">
                  @csrf
                  <input type="hidden" name="id" value="{{$plan->id}}">
                  <div class="custom-control custom-switch">
                  <input type="checkbox"   id="customSwitch" name="status" {{($plan->status==1)? "checked": ""}}   data-off-color="danger" data-on-color="success">
                  </div>
                  
                 </form>
                 </td>
								<td><a href="{{ url('admin/adsense/edit') }}/{{ $plan->id }}"><button type="button" class="btn btn-success">Edit</button></a> 
                <a href="{{ url('/admin/adsense/delete') }}/{{ $plan->id }}" onclick="return validateDelete(this);"><button type="button" class="btn btn-danger">Delete</button></a>
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
  document.addEventListener('DOMContentLoaded', function () {
        var statusCheckbox = document.querySelector('input[name="status"]');
        var statusForm = document.getElementById('statusForm');
        // Bind change event to the checkbox
        statusCheckbox.addEventListener('change', function () {
            console.log('ll');
            statusForm.submit();
        });
    });
</script>
@endsection
