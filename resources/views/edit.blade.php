@extends('master')

@section('content')

<div class="card">
	<div class="card-header">Edit Student</div>
	<div class="card-body">
		<form method="post" action="{{ route('students.update', $student->id) }}" enctype="multipart/form-data">
			@csrf
			@method('PUT')
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Student Name</label>
				<div class="col-sm-10">
					<input type="text" name="student_name" class="form-control" value="{{ $student->student_name }}" />
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Student Email</label>
				<div class="col-sm-10">
					<input type="text" name="student_email" class="form-control" value="{{ $student->student_email }}" />
				</div>
			</div>
			<div class="row mb-4">
				<label class="col-sm-2 col-label-form">Student Gender</label>
				<div class="col-sm-10">
					<select name="student_gender" class="form-control">
						<option value="Male" {{ ( 'Male' == $student->student_gender) ? 'selected' : '' }}>Male</option>
						<option value="Female" {{ ( 'Female' == $student->student_gender) ? 'selected' : '' }}>Female</option>
					</select>
				</div>
			</div>
			<div class="row mb-4">
                <label class="col-sm-2 col-label-form">Collage Name</label>
                <div class="col-sm-10">
                    <select name="collage_name" class="form-control">
                        <option value="">Select Collage</option>
                         @if(!empty($collage))                  
                        @foreach ($collage as $c)
                        <option value="{{$c->id}}"  {{ ( $c->id == $student->collage_id) ? 'selected' : '' }}>{{$c->collage_name}}</option>
                        @endforeach
                       @endif
                    </select>
                </div>
            </div>
            <div class="row mb-4">
                <label class="col-sm-2 col-label-form">Course Name</label>
                <div class="col-sm-10">
                    <select name="course_name" class="form-control">
                        <option value="">Select Course</option>
                        @if (!empty($course))                  
                        @foreach ($course as $c)
                        <option value="{{$c->id}}" {{ ( $c->id == $student->course_id) ? 'selected' : '' }}>{{$c->course_name}}</option>
                        @endforeach
                      @endif
                    </select>
                </div>
            </div>
			<div class="row mb-4">
				<label class="col-sm-2 col-label-form">Student Image</label>
				<div class="col-sm-10">
					<input type="file" name="student_image" />
					<br />
					<img src="{{ asset('images/' . $student->student_image) }}" width="100" class="img-thumbnail" />
					<input type="hidden" name="hidden_student_image" value="{{ $student->student_image }}" />
				</div>
			</div>
			<div class="text-center">
				<input type="hidden" name="hidden_id" value="{{ $student->id }}" />
				<input type="submit" class="btn btn-primary" value="Edit" />
			</div>	
		</form>
	</div>
</div>
<script>
document.getElementsByName('student_gender')[0].value = "{{ $student->student_gender }}";
</script>

@endsection('content')