@extends('master')

@section('content')

@if($message = Session::get('success'))

<div class="alert alert-success">
    {{ $message }}
</div>

@endif
<div class="table-title">
                    <div class="bg-light p-2 m-2">
                        <h5 class="text-dark text-center">Only Laravel  CRUD operation</h5>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <h2>Manage <b>Student</b></h2>
                        </div>
                        <div class="col-sm-3">
                            <a href="{{url('/')}}" class="btn btn-success" ><i class="material-icons">&#xE147;</i> <span>Add New student Ajax</span></a>
                        </div>
                        <div class="col-sm-3">
                            <a href="{{url('import-excel')}}" class="btn btn-success" ><i class="material-icons">&#xE147;</i> <span>Uploads Exel Larave</span></a>
                        </div>
                        <div class="col-sm-3">
                            <a href="{{url('students')}}" class="btn btn-success" ><i class="material-icons">&#xE147;</i> <span>Add New student Laravel</span></a>
                        </div>
                    </div>
                </div>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col col-md-6"><b>Student Data</b></div>
            <div class="col col-md-6">
                <a href="{{ route('students.create') }}" class="btn btn-success btn-sm float-end">Add</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Collage</th>
                <th>Course</th>
                <th>Action</th>
            </tr>
            @if(count($data) > 0)

                @foreach($data as $row)

                    <tr>
                        @if(!empty($row->student_image))
                        <td><img src="{{ asset('images/' . $row->student_image) }}" width="45" /></td>
                        @else
                         <td><img src="http://127.0.0.1:8000/images/1702488740.png" width="45" /></td>
                        @endif
                        <td>{{ $row->student_name }}</td>
                        <td>{{ $row->student_email }}</td>
                        <td>{{ $row->student_gender }}</td>
                        <td>{{ $row->collage->collage_name }}</td>
                        <td>{{ $row->course->course_name }}</td>

                        <td>
                            <form method="post" action="{{ route('students.destroy', $row->id) }}">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('students.show', $row->id) }}" class="btn btn-primary btn-sm">View</a>
                                <a href="{{ route('students.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <input type="submit" class="btn btn-danger btn-sm" value="Delete" />
                            </form>
                            
                        </td>
                    </tr>

                @endforeach

            @else
                <tr>
                    <td colspan="5" class="text-center">No Data Found</td>
                </tr>
            @endif
        </table>
        {!! $data->links() !!}
    </div>
</div>



@endsection



