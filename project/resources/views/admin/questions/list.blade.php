@extends('admin/layouts.backend')
@section('title', 'Question')
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
            <h1>Leads</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Questions</li>
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
                    <th>Question</th>
                    <th>option1</th>        
                    <th>option2</th>        
                    <th>option3</th>        
                    <th>option4</th>                
				           <th>Action</th>  
				  </tr>
                  </thead>
                  <tbody>
                  <?php $i=1; ?>
@if(isset($questions) && count($questions) > 0)
    @foreach($questions as $question)
        <tr>
            <td>{{ $i }}</td>
            <td>{{ $question->topic->title }}</td>
            <td>{{ $question->question }}</td>
            <td class="{{ $question->answer == 'option1' ? 'bg-success' : '' }}">{{ $question->option1 }}</td>
            <td class="{{ $question->answer == 'option2' ? 'bg-success' : '' }}">{{ $question->option2 }}</td>
            <td class="{{ $question->answer == 'option3' ? 'bg-success' : '' }}">{{ $question->option3 }}</td>
            <td class="{{ $question->answer == 'option4' ? 'bg-success' : '' }}">{{ $question->option4 }}</td>
            <td><a href="{{ url('admin/questions/edit') }}/{{ $question->id }}"><button type="button" class="btn btn-success">Edit</button></a> 
              <a href="{{ url('/admin/questions/delete') }}/{{ $question->id }}" onclick="return validateDelete(this);"><button type="button" class="btn btn-danger">Delete</button></a>
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
