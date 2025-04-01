<!DOCTYPE html>
<html lang="ar" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> All system teachers</title>
   <link href="{{ asset('css/grades.css') }}" rel="stylesheet"></link>
   <link href="{{ asset('css/normalize.css') }}" rel="stylesheet"></link>
   <link href="{{ asset('all.min.css') }}" rel="stylesheet"></link>
   <script src="{{ asset('js/jquery.js') }}"></script> 
   <script src="{{ asset('js/grades.js') }}"></script> 
</head>
<body>
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
    <form class="adding_grade_form" action="{{ route("add_grade") }}" method="post">
        @csrf
        <i class="fa-regular fa-circle-xmark exit" ></i>
        <div>
            <div>
                <label for="name">Grade Name</label>
                <input type="text" name="name" id="name">
            </div>
            <div>
                <h3>Choose grade Subjects</h3>
                <div class="subjects_container">
                    @foreach ($subjects as $subject)  
                    <div class="form-group">
                        <label for="subject_{{$subject->id}}">{{$subject->name}}</label>
                        <input name="subjects[]" type="checkbox" id="subject_{{$subject->id}}" value="{{$subject->id}}">
                    </div>
                @endforeach
                </div>
        </div>
    </div>
        
        <input type="submit" value="create">
    </form>
    @component('components.header-component')@endcomponent
    @component('components.admin_links')@endcomponent

    <button class="add_grade_button"> Add grade</button>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        
    <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>grade </th>
                    <th>subjects </th>
                </tr>
            </thead>
            <tbody>
            @foreach($grades as $index => $grade)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $grade['grade_name'] }}</td>
                    <td>
                        @foreach($grade['subjects'] as $subject)
                            <span style="background-color:#ffb606; padding:3px;">{{ $subject }}</span>
                        @endforeach
                    </td>
                </tr>
            @endforeach
            </tbody> 
    </table>


   
</body>
</html>