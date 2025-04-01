<!DOCTYPE html>
<html lang="ar" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> All system teachers</title>
   <link href="{{ asset('css/subjects.css') }}" rel="stylesheet"></link>
   <link href="{{ asset('css/normalize.css') }}" rel="stylesheet"></link>
   <link href="{{ asset('all.min.css') }}" rel="stylesheet"></link>
   <script src="{{ asset('js/jquery.js') }}"></script> 
   <script src="{{ asset('js/subjects.js') }}"></script> 
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
    <form class="adding_grade_form" action="{{ route("add_subject") }}" method="post">
        @csrf
        <i class="fa-regular fa-circle-xmark exit" ></i>
        <div>
            <label for="name">Subject Name</label>
            <input type="text" name="name" id="name">
        </div>
        <input type="submit" value="create">
    </form>
    @component('components.header-component')@endcomponent
    @component('components.admin_links')@endcomponent

    <button class="add_grade_button"> Add Subject</button>
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
                    <th>Subject </th>
                </tr>
            </thead>
            <tbody>
                @foreach($subjects as $index => $subject)
                    <tr>
                        <td>{{$index +1}}</td>
                        <td>{{$subject->name}}</td>
                    </tr>
                @endforeach
            </tbody> 
    </table>


   
</body>
</html>