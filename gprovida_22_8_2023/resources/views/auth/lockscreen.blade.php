@extends('layout.empty', ['bodyClass' => 'bg-lock-screen'])

@section('title', 'Lockscreen')


@section('styles')
    <style type="text/css">
        .bg-lock-screen {
            background-image: url(../assets/img/login-images/bg-lock-screen.jpg);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .bg-transparent{
            border:none;
        }
        .wrapper {
        width: 100%;
        position: relative;
        }

        .authentication-lock-screen {
            height: 100vh;
            padding: 0 1rem;
        }
    
    </style>
@endsection

@section('content')
   <!-- wrapper -->
    <div class="wrapper">
        <div class="authentication-lock-screen d-flex align-items-center justify-content-center">
            <div class="card shadow-none bg-transparent">
                <div class="card-body p-md-5 text-center">
                    <h2 class="text-white" id="myTime"></h2>
                    <h5 class="text-white" id="MyDate"></h5>
                    <div class="">
                        <img src="/assets/img/icon/user.png" class="mt-5" width="120" alt="" />
                    </div>
                    <p class="mt-2 text-white">Administrator</p>
                    <div class="mb-3 mt-3">
                        <input type="password" class="form-control" placeholder="Password" />
                    </div>
                    <div class="d-grid">
                        <button type="button" class="btn btn-white">Login</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- end wrapper -->
@endsection


@section('scripts')
<script>
    $(document).ready(function() {
        startTime();  
        startDate();    
    } );

    function startTime() {
        const today = new Date();
        let h = today.getHours(); // 0 - 23
        let m = today.getMinutes();// 0 - 59
        let s = today.getSeconds();// 0 - 59
        var session = "AM";
        if(h == 0){ h = 12; }    
        if(h > 12){
            h = h - 12;
            session = "PM";
        }
        h = (h < 10) ? "0" + h : h;

        m = checkTime(m);
        s = checkTime(s);
        document.getElementById('myTime').innerHTML =  h + ":" + m + ":" + s + " " + session;
        setTimeout(startTime, 1000);
    }

    function checkTime(i) {
        if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
        return i;
    }

    function startDate(){        
        const today = new Date();
        var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('MyDate').innerHTML = today.toLocaleDateString("en-US", options);
    }


</script>
@endsection
