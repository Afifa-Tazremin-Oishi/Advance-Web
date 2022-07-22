<!-- <nav class="navbar navbar-expand-lg navbar-light bg-dark" style="background-color: #789;">
<h5 class="fw-bold text-white">BACHELOR<span style="color:orange;"> HOUSING</span> MANAGEMENT  <span style="color:green;"> WEBSITE</span></h5>
<div class="container py-1 px-5">
        
        <div class="navbar-nav ms-auto">
     
       <a class="fw-bold nav-link mx-2 text-white"  href="{{ route('home') }}">Home</a>
        @if(Session::has('admin'))
      
        @endif
        @if(Session::has('manager'))
       <a class="fw-bold nav-link mx-2 text-white"  href="{{ route('dashboardManager') }}">Dashboard</a>
        @endif
        @if(Session::has('manager'))
       <a class="fw-bold nav-link mx-2 text-white"  href="{{ route('advertisementList') }}">Advertisement List</a>
        @endif
        @if(Session::has('manager'))
       <a class="fw-bold nav-link mx-2 text-white"  href="{{ route('paymentList') }}">Payment List</a>
        @endif
        
       
    
        @if(Session::has('admin') || Session::has('manager'))
        @if(Session::has('admin'))
    <a class="fw-bold nav-link mx-2 text-white"  href="#">Welcome {{Session()->get('admin')}}</a>
        @endif
        @if(Session::has('manager'))
      <a class="fw-bold nav-link mx-2 text-white"  href="#">Welcome {{Session()->get('manager')}}</a>
        @endif
      <a class="fw-bold nav-link mx-2 text-white"  href="{{route('logout')}}" class="btn btn-danger"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
        @else
        <a class="fw-bold nav-link mx-2 text-white"  href="{{route('signup')}}"><span class="glyphicon glyphicon-user"></span> Sign Up</a>
      <a class="fw-bold nav-link mx-2 text-white"  href="{{route('login')}}"><span class="glyphicon glyphicon-log-in"></span> Login</a>
        @endif
     
    </div>
        </div>
    </div>
</nav> -->
