<!DOCTYPE html>
<html lang="ar" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Dashboard</title>
   <link href="{{ asset('css/create_teacher_account.css') }}" rel="stylesheet"></link>
   <link href="{{ asset('css/normalize.css') }}" rel="stylesheet"></link>
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
@if(session('importErrors'))
    <div style="background-color: #fdd; padding: 10px; margin-bottom: 15px;">
        <h4>Import Errors:</h4>
        <ul>
            @foreach(session('importErrors') as $failure)
                <li>
                    <strong>Row {{ $failure->row() }}:</strong>
                    Field <code>{{ $failure->attribute() }}</code>
                    - {{ implode(', ', $failure->errors()) }}
                </li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('message'))
    <div class="success-message">
        <p class="success-text">{{ session('message') }}</p>
    </div>
@endif
    <form  id="file_form" action="{{ route('import_teachers') }}" enctype="multipart/form-data" method="post">
        @csrf
        <h3>Import teachers form excel sheet</h3>
        <input type="file" name="file" id="file">
        <input type="submit" value="Import Teachers" id="submit_file">
    </form>
    <div class="form-container">
        <h2>Add Teacher</h2>

        <form id="teacherForm" action="{{ route('create_teacher_account_back') }}" method="POST">
            @csrf
            <div class="form-group mid">
                <label for="name">Full Name</label>
                <input name="name" type="text" id="name" placeholder="Enter full name" required>
            </div>
        
            <div class="form-group mid">
                <label for="email">Email</label>
                <input name="email" type="email" id="email" placeholder="Enter email" required>
            </div>
        
            <div class="form-group mid">
                <label for="password">Password</label>
                <input name="password" type="password" id="password" placeholder="Enter password" required>
            </div>
        
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
        
            <button type="submit">Add Teacher</button>
        </form>
        
    </div>

</body>
</html>