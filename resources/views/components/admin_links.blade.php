<ul class="links">
    <li><a href="{{ route('add_week') }}">Add week</a></li>
    <li><a href="{{ route('admin_all_tables') }}">See all weeks</a></li>
    <li><a href="{{ route('grades') }}"> Grades</a></li>
    <li><a href="{{ route('subjects') }}"> Subjects</a></li>
    <li><a href="{{ route('create_teacher_account') }}">Add teacher</a></li>
    <li><a href="{{ route('all_teachers') }}">See all teachers</a></li>
    <li><a href="{{ route('home') }}"> Home</a></li>
</ul>

<style>

.links{
    margin-top:0;
    background-color: #c6dcee;
    display:flex;
    align-items:center;
    justify-content: space-evenly;
    padding:5px;
    flex-wrap:wrap;
}
.links li a{
    text-decoration:none;
    color:#00213a;
    font-size:20px;
}
.links li {
    list-style:none;
    padding:20px;
    transition-duration: 0.5S;
}
.links li:hover {
    transform:translateY(10px);
}
</style>