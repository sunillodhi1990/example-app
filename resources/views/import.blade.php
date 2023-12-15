@extends('master')

@section('content')

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
 
    <form action="{{ route('import.excel') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="file">Choose Excel File</label>
            <input type="file" name="file" id="file" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Import</button>
    </form>
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
@endsection