<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Laravel Ajax CRUD </title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
        body {
            color: #566787;
            background: #f5f5f5;
            font-family: 'Varela Round', sans-serif;
            font-size: 13px;
        }

        .table-responsive {
            margin: 30px 0;
        }

        .table-wrapper {
            background: #fff;
            padding: 20px 25px;
            border-radius: 3px;
            min-width: 1000px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }

        .table-title {
            padding-bottom: 15px;
          /*  background: #435d7d;
            color: #fff;*/
            padding: 16px 30px;
            min-width: 100%;
            margin: -20px -25px 10px;
            border-radius: 3px 3px 0 0;
        }

        .table-title h2 {
            margin: 5px 0 0;
            font-size: 24px;
        }

        .table-title .btn-group {
            float: right;
        }

        .table-title .btn {
            color: #fff;
            float: right;
            font-size: 13px;
            border: none;
            min-width: 50px;
            border-radius: 2px;
            border: none;
            outline: none !important;
            margin-left: 10px;
        }

        .table-title .btn i {
            float: left;
            font-size: 21px;
            margin-right: 5px;
        }

        .table-title .btn span {
            float: left;
            margin-top: 2px;
        }

        table.table tr th,
        table.table tr td {
            border-color: #e9e9e9;
            padding: 12px 15px;
            vertical-align: middle;
        }

        table.table tr th:first-child {
            width: 60px;
        }

        table.table tr th:last-child {
            width: 100px;
        }

        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }

        table.table-striped.table-hover tbody tr:hover {
            background: #f5f5f5;
        }

        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }

        table.table td:last-child i {
            opacity: 0.9;
            font-size: 22px;
            margin: 0 5px;
        }

        table.table td a {
            font-weight: bold;
            color: #566787;
            display: inline-block;
            text-decoration: none;
            outline: none !important;
        }

        table.table td a:hover {
            color: #2196F3;
        }

        table.table td a.edit {
            color: #FFC107;
        }

        table.table td a.delete {
            color: #F44336;
        }

        table.table td i {
            font-size: 19px;
        }

        table.table .avatar {
            border-radius: 50%;
            vertical-align: middle;
            margin-right: 10px;
        }

        /* Modal styles */
        .modal .modal-dialog {
            max-width: 400px;
        }

        .modal .modal-header,
        .modal .modal-body,
        .modal .modal-footer {
            padding: 20px 30px;
        }

        .modal .modal-content {
            border-radius: 3px;
            font-size: 14px;
        }

        .modal .modal-footer {
            background: #ecf0f1;
            border-radius: 0 0 3px 3px;
        }

        .modal .modal-title {
            display: inline-block;
        }

        .modal .form-control {
            border-radius: 2px;
            box-shadow: none;
            border-color: #dddddd;
        }

        .modal textarea.form-control {
            resize: vertical;
        }
       #msg .alert-success{
            background-color: #28a745 !important;
                border-color: #28a745;
                color: #fff;
                width: 100%;
                padding: 10px;
        }

        .modal .btn {
            border-radius: 2px;
            min-width: 100px;
        }

        .modal form label {
            font-weight: normal;
        }

        .loading {
            color: black;
            font: 300 2em/100% Impact;
            text-align: center;
        }

        /* loading dots */

        .loading:after {
            content: ' .';
            animation: dots 1s steps(5, end) infinite;
        }

        @keyframes dots {

            0%,
            20% {
                color: rgba(0, 0, 0, 0);
                text-shadow:
                    .25em 0 0 rgba(0, 0, 0, 0),
                    .5em 0 0 rgba(0, 0, 0, 0);
            }

            40% {
                color: black;
                text-shadow:
                    .25em 0 0 rgba(0, 0, 0, 0),
                    .5em 0 0 rgba(0, 0, 0, 0);
            }

            60% {
                text-shadow:
                    .25em 0 0 black,
                    .5em 0 0 rgba(0, 0, 0, 0);
            }

            80%,
            100% {
                text-shadow:
                    .25em 0 0 black,
                    .5em 0 0 black;
            }
        }
    </style>
</head>

<body>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="bg-light p-2 m-2">
                        <h5 class="text-dark text-center">Laravel with Ajax CRUD operation</h5>
                    </div>
                    <div class="row">
                        <div id="msg" style="width: 100%;padding: 10px;margin: 15px 0;"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <h2>Manage <b>Student</b></h2>
                        </div>
                        <div class="col-sm-3">
                            <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New student Ajax</span></a>
                        </div>
                        <div class="col-sm-3">
                            <a href="{{url('import-excel')}}" class="btn btn-success" ><i class="material-icons">&#xE147;</i> <span>Uploads Exel Larave</span></a>
                        </div>
                        <div class="col-sm-3">
                            <a href="{{url('students')}}" class="btn btn-success" ><i class="material-icons">&#xE147;</i> <span>Add New student Laravel</span></a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Collage Name</th>
                            <th>Course Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="employee_data">
                    </tbody>
                </table>
                <p class="loading">Loading Data</p>
            </div>
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <div id="addEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Student</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body add_epmployee">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" id="name_input" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="email_input" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select class="form-control" id="gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>

                        </select>
                       
                    </div>
                    <div class="form-group">
                         <label>Collage</label>
                         <select class="form-control" id="collage">
                            @if(!empty($collage))
                            @foreach($collage as $c)
                            <option value="{{$c->id}}">{{$c->collage_name}}</option>
                            @endforeach
                            @endif
                           

                        </select>
                    </div>

                     <div class="form-group">
                         <label>Course Name</label>
                         <select class="form-control" id="course">
                            @if(!empty($course))
                            @foreach($course as $c)
                            <option value="{{$c->id}}">{{$c->course_name}}</option>
                            @endforeach
                            @endif

                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-success" value="Add" onclick="addEmployee()">
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <div id="editEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Student</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body edit_employee">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" id="name_input" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="email_input" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <input type="text" id="gender" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Collage Name</label>
                        <input type="text" id="collage" class="form-control" readonly>
                        <input type="hidden" id="collage1" class="form-control" required>
                       
                    </div>
                    <div class="form-group">
                        <label>Course Name</label>
                        <input type="text" id="course" class="form-control" readonly>
                        <input type="hidden" id="course1" class="form-control" required>
                        <input type="hidden" id="employee_id" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-info" onclick="editEmployee()" value="Save">
                </div>
            </div>
        </div>
    </div>

    <!-- View Modal HTML -->
    <div id="viewEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">View Student</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body view_employee">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" id="name_input" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="email_input" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                       <input type="text" id="gender" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>collage Name</label>
                        <input type="text" id="collage" class="form-control" readonly>
                    </div>
                     <div class="form-group">
                        <label>course Name</label>
                        <input type="text" id="course" class="form-control" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Close">
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal HTML -->
    <div id="deleteEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete student</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete these Records?</p>
                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                </div>
                <input type="hidden" id="delete_id">
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-danger" onclick="deleteEmployee()" value="Delete">
                </div>
            </div>
        </div>
    </div>

    <script>

    </script>
    <script>
        $(document).ready(function() {
            employeeList();

        });

        function employeeList() {
            $.ajax({
                type: 'get',
                url: "{{ url('student-list') }}",
                success: function(response) {
                    console.log(response);
                    var tr = '';
                    for (var i = 0; i < response.length; i++) {
                        var id = response[i].id;
                        var name = response[i].student_name;
                        var email = response[i].student_email;
                        var gender = response[i].student_gender;
                        var collage = response[i].collage.collage_name;
                        var course = response[i].course.course_name;
                        tr += '<tr>';
                        tr += '<td>' + id + '</td>';
                        tr += '<td>' + name + '</td>';
                        tr += '<td>' + email + '</td>';
                        tr += '<td>' + gender + '</td>';
                        tr += '<td>' + collage + '</td>';
                        tr += '<td>' + course + '</td>';
                        tr += '<td><div class="d-flex">';
                        tr +=
                            '<a href="#viewEmployeeModal" class="m-1 view" data-toggle="modal" onclick=viewEmployee("' +
                            id + '")><i class="fa" data-toggle="tooltip" title="view">&#xf06e;</i></a>';
                        tr +=
                            '<a href="#editEmployeeModal" class="m-1 edit" data-toggle="modal" onclick=viewEmployee("' +
                            id +
                            '")><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>';
                        tr +=
                            '<a href="#deleteEmployeeModal" class="m-1 delete" data-toggle="modal" onclick=$("#delete_id").val("' +
                            id +
                            '")><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>';
                        tr += '</div></td>';
                        tr += '</tr>';
                    }
                    $('.loading').hide();
                    $('#employee_data').html(tr);
                }
            });
        }

        function addEmployee() {
            var name = $('.add_epmployee #name_input').val();
            var email = $('.add_epmployee #email_input').val();
            var gender = $('.add_epmployee #gender').val();
            var collage = $('.add_epmployee #collage').val();
            var course = $('.add_epmployee #course').val();             

            $.ajax({
                type: 'post',
                data: {
                    name: name,
                    email: email,
                    gender: gender,
                    collage: collage,
                    course: course,
                    _token: "{{ csrf_token() }}"
                },
                url: "{{ url('student-add') }}",
                success: function(response) {
                    $('#addEmployeeModal').modal('hide');
                    employeeList();
                    $("#msg").html('<div class"alert alert-success">'+response.message+'</div>');
                   
                }

            })
        }

        function editEmployee() {
            var name = $('.edit_employee #name_input').val();
            var email = $('.edit_employee #email_input').val();
            var collage = $('.edit_employee #collage1').val();
            var gender = $('.edit_employee #gender').val();
            var course = $('.edit_employee #course1').val();
            var employee_id = $('.edit_employee #employee_id').val();

            $.ajax({
                type: 'post',
                data: {
                    name: name,
                    email: email,
                    collage: collage,
                    gender: gender,
                    course: course,
                    employee_id: employee_id,
                    _token: "{{ csrf_token() }}"
                },
                url: "{{ url('student-edit') }}",
                success: function(response) {
                    $('#editEmployeeModal').modal('hide');
                    employeeList();
                    $("#msg").html('<div class"alert alert-success">'+response.message+'</div>');
                }

            })
        }

        function viewEmployee(id = 2) {


            $.ajax({
                type: 'get',
                data: {
                    id: id,
                },
                url: "{{ url('student-view') }}",
                success: function(response) {
                    console.log(response);
                    $('.edit_employee #name_input').val(response.student_name);
                    $('.edit_employee #email_input').val(response.student_email);            
                   
                    $('.edit_employee #employee_id').val(response.id);
                     $('.edit_employee #gender').val(response.student_gender);
                     $('.edit_employee #course').val(response.course.course_name);
                    $('.edit_employee #collage').val(response.collage.collage_name);
                    
                     $('.edit_employee #course1').val(response.course_id);
                    $('.edit_employee #collage1').val(response.collage_id);

                    $('.view_employee #name_input').val(response.student_name);
                    $('.view_employee #email_input').val(response.student_email);
                    $('.view_employee #gender').val(response.student_gender);
                    $('.view_employee #course').val(response.course.course_name);
                    $('.view_employee #collage').val(response.collage.collage_name);
                }
            })
        }

        function deleteEmployee() {
            var id = $('#delete_id').val();
            $('#deleteEmployeeModal').modal('hide');
            $.ajax({
                type: 'get',
                data: {
                    id: id,
                },
                url: "{{ url('student-delete') }}",
                success: function(response) {
                    employeeList();
                    $("#msg").html('<div class"alert alert-success">'+response.message+'</div>');
                }
            })
        }
    </script>

</body>

</html>