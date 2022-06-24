@extends('layouts.app')
@section('content')

<h1 style="text-align: center;"> Grab Grocery</h1>
<p style="text-align: center;"> Welcome to Grocery Shop</p>
<p style="text-align: center;"> +880 1712345678</p>
<form action="{{route('contactUs')}}" class="form-group" method="post">
{{csrf_field()}}

        <label for="">Email</label>
        <input type="email" name="email" id="" value="{{old('email')}}" class="form-control">
        @error('email')
            <span class="text-danger">{{$message}}</span>
        @enderror
        <br>

        <label for="">Message</label>
        <input type="text" name="message" id="" value="{{old('message')}}" class="form-control">
        @error('message')
            <span class="text-danger">{{$message}}</span>
        @enderror
        <br>

        <input type="submit">

</form>
<img align="center" style="width: 60%; height:40%" src="https://www.linkpicture.com/q/contactUs.jpg" alt="">
<h5>&copy; <?php echo("Afifa"); ?></h5>
@endsection