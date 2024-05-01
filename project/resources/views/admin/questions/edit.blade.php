@extends('admin/layouts.backend')
@section('title', 'Edit Questions')
@section('content')
<style>
        #image-preview {
    max-width: 300px;
}
        #image-preview img{
			max-width: 100%;
}
    .input-with-checkbox {
        display: flex;
        align-items: center;
    }

    .input-with-checkbox input[type="text"] {
        flex: 1;
        margin-right: 10px;
    }

    </style>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper admin-dashboard-content">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Questions</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Edit Questions</li>
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
                <h3 class="card-title"> Edit Questions</h3>
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
				<form role="form" action="{{route('admin.edit_questions_action')}}" method="POST" enctype='multipart/form-data'>
					@CSRF
          <input type="hidden" name="question_id" value="{{ $question->id }}">
					<div class="box-body">
          <div class="col-md-12">
    <div class="form-group">
        <label for="exampleInputEmail1">Topic <span style="color:red;">*</span></label>
         <select name="topic_id" id="" class="form-control">
         @foreach($topics as $topic)
          <option value="{{ $topic->id }}" {{ ($question->topic_id == $topic->id ) ? 'selected' : "" }}>{{ $topic->title}}</option>
          @endforeach
         </select>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Question <span style="color:red;">*</span></label>
        <input type="text" name="question" class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1" placeholder="Name" value="{{ $question->question }}" >
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1">Option 1<span style="color:red;">*</span></label>
            <div class="input-with-checkbox">
                <input type="text" name="option1" class="form-control @error('option1') is-invalid @enderror" id="exampleInputEmail1" placeholder="Option 1" value="{{ $question->option1 }}" step="any">
                <input type="checkbox" name="answer" value="option1" {{ ( $question->answer == 'option1' ) ? 'checked' : "" }}>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1">Option 2<span style="color:red;">*</span></label>
            <div class="input-with-checkbox">
                <input type="text" name="option2" class="form-control @error('option2') is-invalid @enderror" id="exampleInputEmail1" placeholder="Option 2" value="{{ $question->option2 }}">
                <input type="checkbox" name="answer" value="option2" {{ ( $question->answer == 'option2' ) ? 'checked' : "" }}>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1">Option 3<span style="color:red;">*</span></label>
            <div class="input-with-checkbox">
                <input type="text" name="option3" class="form-control @error('option3') is-invalid @enderror" id="exampleInputEmail1" placeholder="Option 3" value="{{ $question->option3 }}" step="any">
                <input type="checkbox" name="answer" value="option3" {{ ( $question->answer == 'option3' ) ? 'checked' : "" }}>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1">Option 4<span style="color:red;">*</span></label>
            <div class="input-with-checkbox">
                <input type="text" name="option4" class="form-control @error('option4') is-invalid @enderror" id="exampleInputEmail1" placeholder="Option 4" value="{{ $question->option4 }}">
                <input type="checkbox" name="answer" value="option4" {{ ( $question->answer == 'option4' ) ? 'checked' : "" }}>
            </div>
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

<script>
    const checkboxes = document.querySelectorAll('input[name="answer"]');
    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener('change', function() {
            checkboxes.forEach((otherCheckbox) => {
                if (otherCheckbox !== this) {
                    otherCheckbox.checked = false;
                }
            });
        });
    });
</script>

@endsection
