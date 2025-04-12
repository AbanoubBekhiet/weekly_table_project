<!DOCTYPE html>
<html lang="ar" >
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> All system teachers</title>
   <link href="{{ asset('css/all_teachers.css') }}" rel="stylesheet"></link>
   <link href="{{ asset('css/normalize.css') }}" rel="stylesheet"></link>
   <link href="{{ asset('all.min.css') }}" rel="stylesheet"></link>
   <script src="{{ asset('js/jquery.js') }}"></script> 
   <script src="{{ asset('js/all_teachers.js') }}"></script> 
</head>
<body>
    @component('components.header-component')@endcomponent
    @component('components.admin_links')@endcomponent
    @if ($errors->any())
    <div class="error-message">
        <ul class="error-list">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('message'))
    <div class="success-message">
        <p class="success-text">{{ session('message') }}</p>
    </div>
@endif     
<div id="seacrh_div">
    <label for="search">Search  a teacher</label>
    <input type="text" name="search"  id="search">
</div>
    <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Teacher Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>grades</th>
                    <th>subjects</th>
                    <th>operations</th>
                </tr>
            </thead>
            <tbody>
                @foreach($teachers as $index => $teacher)
                    <tr>
                        <td>{{$index +1}}</td>
                        <td>{{$teacher->name}}</td>
                        <td>{{$teacher->email}}</td>
                        <td>{{$teacher->password_not_hashed}}</td>
                        <td>
                            @foreach($teacher->grades as $grade)
                            <span style="background-color:#ffb606;padding:3px">{{ $grade }}</span>
                            @endforeach
                        </td>
                        <td>
                            @foreach($teacher->subjects as $subject)
                            <span style="background-color:#ffb606;padding:3px">{{ $subject }}</span>
                            @endforeach
                        </td>
                        <td id="td_of_forms">
                            <form  action="{{ route('delete_teacher',$teacher->id) }}" method="post" id="delete_form">
                                @csrf
                                <input id="delete_teacher_button" type="submit" value="Delete" data-id="{{ $teacher->id }}">
                            </form>
                            <form action="{{ route('update_teacher',$teacher->id) }}" method="post">
                                @csrf
                                <input id="update_teacher_button" type="submit" value="Update" data-id="{{ $teacher->id }}">
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody> 
    </table>


    <div class="overlay">
        <form action method="post" id="update_teacher_form">
            @csrf
            <i class="fa-regular fa-circle-xmark exit" ></i>

            <h3>Choose Subjects</h3>
            <div class="subjects_container">
                @foreach ($subjects as $subject)  
                    <div class="form-group">
                        <label for="subject_{{$subject->id}}">{{$subject->name}}</label>
                        <input name="subjects[]" type="checkbox" id="subject_{{$subject->id}}" value="{{$subject->id}}">
                    </div>
                @endforeach
            </div>
        
            <h3>Choose Grades</h3>
            <div class="subjects_container">
                @foreach ($grades as $grade)  
                    <div class="form-group">
                        <label for="grade_{{$grade->id}}">{{$grade->name}}</label>
                        <input name="grades[]" type="checkbox" id="grade_{{$grade->id}}" value="{{$grade->id}}">
                    </div>
                @endforeach
            </div>
            <input type="submit" value="Update teacher">
        </form>
    </div>

<div class="warning"> 
    <p>Are you sure you want to delete this teacher permanently</p>
    <div class="buttons">
        <button class="Cancel">Cancel</button>
        <button class="Delete">Delete</button>
    </div>
</div>


<script>
    const teachers = @json($teachers);
</script>

</body>
</html>