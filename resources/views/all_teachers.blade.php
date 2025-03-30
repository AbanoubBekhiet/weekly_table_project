<!DOCTYPE html>
<html lang="ar" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> All system teachers</title>
   <link href="{{ asset('css/all_teachers.css') }}" rel="stylesheet"></link>
   <link href="{{ asset('css/normalize.css') }}" rel="stylesheet"></link>
</head>
<body>
    @component('components.header-component')@endcomponent
    @component('components.admin_links')@endcomponent
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
                    <th>Teacher Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>grades</th>
                    <th>subjects</th>
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

                    </tr>
                @endforeach
            </tbody> 
    </table>

</body>
</html>