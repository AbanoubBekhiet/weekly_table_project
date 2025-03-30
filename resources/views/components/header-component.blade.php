
<p> Weekely Content Management System </p>
<div class="header">
    <img src="{{ asset('images/LOGO-ROYAL-AMERICAN-SCHOOL.png') }}" alt="logo">
    @if (!Auth::guard('admins')->check()&&!Auth::user())
        <div class="buttons">
            <a href="{{ route('admin_login_back') }}"><span>Admin login</span></a>
            <a href="{{ route('teacher_login_back') }}"><span>Teacher login</span></a>
        </div>
    @elseif (Auth::guard('admins')->check())
    <div class="buttons">
        <form action="{{ route('admin_logout') }}" method="post">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
    @elseif (Auth::user())
    <div class="buttons">
        <form action="{{ route('teacher_logout') }}" method="post">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
    @endif
     {{-- Auth::check(): {{ Auth::check() ? 'true' : 'false' }}<br>
    Auth::guard('admins')->check(): {{ Auth::guard('admins')->check() ? 'true' : 'false' }}<br>
    Current guard: {{ Auth::getDefaultDriver() }}<br>
    Session ID: {{ session()->getId() }}<br>
    {{ Auth::user() ??"false"}}<br>
    {{ Auth::guard('admins')->check()??"false" }} --}}
</div>


<style>
p{
    background-color:#ffb606;
    padding:20px;
    margin:0px;
    text-align: center;
    font-size:25px;
    color:#001e35;
}

.header{
    background-color:#ffffff;
    /* width:100%; */
    height:80px;
    padding:20px;
    display:flex;
    align-items: center;
    justify-content: space-around;
    /* margin-top:10px; */
    border-bottom:1px solid #ffb606;
    padding-top:10px;

}
.header img{
    width:25%;
}
.header span ,.buttons button{
    padding:10px 20px;
    font-size:20px;
    background-color:#c6dcee;
    border-radius: 10px;
    color:#001e35;
    border:0px;
}   
.header span:hover,.buttons button:hover{
    color:#c6dcee;
    background-color:#001e35 ;
}

</style>