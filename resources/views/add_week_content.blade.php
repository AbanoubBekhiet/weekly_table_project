<!DOCTYPE html>
<html lang="ar" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
   <link href="{{ asset('css/add_week_content.css') }}" rel="stylesheet"></link>
   <link href="{{ asset('css/normalize.css') }}" rel="stylesheet"></link>
   <script src="{{ asset('js/jquery.js') }}"></script> 
   <script src="{{ asset('js/add_week_content.js') }}"></script> 
</head>
<body>
    @component('components.header-component')@endcomponent
    @component('components.teacher_links')@endcomponent


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

    <div class="container">
        <form id="form_of_data" method="post" action="{{route("create_week_grade_subject_part")}}">
            <h2>Weekly Lesson Plan</h2>
                <div class="form-group">
                    <label for="year">Year</label>
                    <select id="year" name="year">
                        <option>select year</option>
                        @foreach ($years as $year)
                            <option>{{ $year->year }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group hide">
                    <label for="week">Week Name</label>
                    <select name="week" id="week">

                    </select>
                </div>

                <div class="form-group hide">
                    <label for="grade">Grade</label>
                    <select name="grade" id="grade">

                    </select>
                </div>

                <div class="form-group hide">
                    <label for="subject">Subject</label>
                    <select name="subject"  id="subject">

                    </select>
                </div>

                <div class="form-group hide">
                    <label for="assignment">Add Assessment</label>
                    <input type="text" name="assignment" id="assignment">
                    <label for="day">Select the day</label>
                    <select name="day"  id="day" syle="margin-top:20px;">
                        <option value="mon">Monday</option>
                        <option value="tue">Tuesday</option>
                        <option value="wen">Wednesday</option>
                        <option value="thr">Thursday</option>
                        <option value="fri">Friday</option>                        
                    </select>
                </div>

                @csrf
                <table id="table_of_content" class="hide">
                    <thead>
                        <tr>
                            <th>Day</th>
                            <th>Lesson Topic</th>
                            <th>Books & Pages</th>
                            <th>Homework</th>
                            <th>Due Date</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Monday</td>
                            <td class="monday_lesson"><textarea name="monday_lesson"></textarea></td>
                            <td class="monday_books_pages"><textarea name="monday_books_pages"></textarea></td>
                            <td class="monday_homework"><textarea name="monday_homework"></textarea></td>
                            <td class="monday_hw_due_date"><input type="date" name="monday_hw_due_date"></td>
                            <td class="monday_notes"><textarea name="monday_notes"></textarea></td>
                        </tr>
                        <tr>
                            <td>Tuesday</td>
                            <td class="tuesday_lesson"><textarea name="tuesday_lesson"></textarea></td>
                            <td class="tuesday_books_pages"><textarea name="tuesday_books_pages"></textarea></td>
                            <td class="tuesday_homework"><textarea name="tuesday_homework"></textarea></td>
                            <td class="tuesday_hw_due_date"><input type="date" name="tuesday_hw_due_date"></td>
                            <td class="tuesday_notes"><textarea name="tuesday_notes"></textarea></td>
                        </tr>
                        <tr>
                            <td>Wednesday</td>
                            <td class="wednesday_lesson"><textarea name="wednesday_lesson"></textarea></td>
                            <td class="wednesday_books_pages"><textarea name="wednesday_books_pages"></textarea></td>
                            <td class="wednesday_homework"><textarea name="wednesday_homework"></textarea></td>
                            <td class="wednesday_hw_due_date"><input type="date" name="wednesday_hw_due_date"></td>
                            <td class="wednesday_notes"><textarea name="wednesday_notes"></textarea></td>
                        </tr>
                        <tr>
                            <td>Thursday</td>
                            <td class="thursday_lesson"><textarea name="thursday_lesson"></textarea></td>
                            <td class="thursday_books_pages"><textarea name="thursday_books_pages"></textarea></td>
                            <td class="thursday_homework"><textarea name="thursday_homework"></textarea></td>
                            <td class="thursday_hw_due_date"><input type="date" name="thursday_hw_due_date"></td>
                            <td class="thursday_notes"><textarea name="thursday_notes"></textarea></td>
                        </tr>
                        <tr>
                            <td>Friday</td>
                            <td class="friday_lesson"><textarea name="friday_lesson"></textarea></td>
                            <td class="friday_books_pages"><textarea name="friday_books_pages"></textarea></td>
                            <td class="friday_homework"><textarea name="friday_homework"></textarea></td>
                            <td class="friday_hw_due_date"><input type="date" name="friday_hw_due_date"></td>
                            <td class="friday_notes"><textarea name="friday_notes"></textarea></td>
                        </tr>
                    </tbody>
                </table>

                <button type="submit" class="hide submit_button">Save</button>
        </form>
    </div>

</body>
</html>