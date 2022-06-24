<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="{{ url('/css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

          <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

@extends('../../layouts.app')
@section('content')
<div>
     
<!-- background color: linear-gradient(#fff,whitesmoke); -->
    <div style=" background: #FFEEF8;">
        {{-- header start --}}
        <div class="header">
            <div class="container">

                <div class="navbar">
                    <div class="logo mt-3">
                        <a href="{{ url('/') }}"><img src= "{{ asset('images/store.png') }}" alt="logo" width="80px"></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <h2 class="mt-0">Shopping Here!</h2>
                       <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Explicabo quibusdam molestiae aut porro delectus nulla quia nisi suscipit odio excepturi!</p>
                        <a href={{ route('products') }} class="button btn btn-info">Explore Now</a>
                    </div>
                    <!-- Carousel Item Start -->
                    <div class="col-6">

                        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ asset('images/images.jpg') }}" class="d-block w-100 rounded-3" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>First slide label</h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="{{ asset('images/images2.jpg') }}" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Second slide label</h5>
        <p>Some representative placeholder content for the second slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="{{ asset('images/images3.jpg') }}" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Third slide label</h5>
        <p>Some representative placeholder content for the third slide.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

                    </div>

                </div>
            </div>
        </div>
        {{-- header end --}}
        <div class="container">
            <h3 class="title">All Products</h3>
            <div class="row">
                @foreach ($allProducts as $product)
                <div class="col-3">
                    <div class="card-group ">
                        <div class="card mb-4">
                            <img class="card-img-top" height="140px" width="260px"
                                src="{{ asset('uploads/products/'.$product->image) }}" alt="Card image cap">
                            <div class="card-body">
                                <div class="d-flex">
                                    <h5 class="card-title text-primary">{{ $product->category }}</h5>
                                    <h6 class="card-title ms-auto mt-1">{{ $product->name }}</h6>
                                </div>
                                <span></span>
                                <div class="d-flex">
                                    <p class="card-text"><small class="text-danger fw-bold">Price:
                                            {{ $product->price }}</small></p>
                                    <p class="card-text  ms-auto"><small class="text-muted">Available:
                                            {{ $product->quantity }}</small></p>

                                </div>
                                <div class="d-flex">
                                    <p>Author: {{ $product->sellerName }}</p>

                                    <div class="ms-auto">
                                        <a class="btn btn-primary btn-sm ms-auto"  href={{ "products/" .$product->id }}>Buy
                                            Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="">
                {{  $allProducts->links('vendor.pagination.bootstrap-4')  }}
            </div>


            <div class="small-container">
                <h3 class="title">Featured Products</h3>
                <div class="row">
                    @foreach($featuredProducts as $product)
                    <div class="col-4">
                        <img class="" height="300" width="200"
                        src="{{ asset('uploads/products/'.$product->image) }}">
                        <div class="card-body">
                            <div class="d-flex">
                                <h5 class="card-title text-primary">{{ $product->category }}</h5>
                                <h6 class="card-title ms-auto mt-1">{{ $product->name }}</h6>
                            </div>
                            <span></span>
                            <div class="d-flex">
                                <p class="card-text"><small class="text-danger fw-bold">Price:
                                        {{ $product->price }}</small></p>
                                <p class="card-text  ms-auto"><small class="text-muted">Available:
                                        {{ $product->quantity }}</small></p>

                            </div>
                            <div class="d-flex">
                                <p>Author: {{ $product->sellerName }}</p>

                                <div class="ms-auto">
                                    <a class="btn btn-primary btn-sm ms-auto"  href={{ "products/" .$product->id }}>Buy
                                        Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
                <h3 class="title">Latest Products</h3>
                <div class="row">
                    @foreach($latestProducts as $product)
                        <div class="col-4">
                            <img class="" height="300" width="200"
                            src="{{ asset('uploads/products/'.$product->image) }}">
                            <div class="card-body">
                                <div class="d-flex">
                                    <h5 class="card-title text-primary">{{ $product->category }}</h5>
                                    <h6 class="card-title ms-auto mt-1">{{ $product->name }}</h6>
                                </div>
                                <span></span>
                                <div class="d-flex">
                                    <p class="card-text"><small class="text-danger fw-bold">Price:
                                            {{ $product->price }}</small></p>
                                    <p class="card-text  ms-auto"><small class="text-muted">Available:
                                            {{ $product->quantity }}</small></p>

                                </div>
                                <div class="d-flex">
                                    <p>Author: {{ $product->sellerName }}</p>

                                    <div class="ms-auto">
                                        <a class="btn btn-primary btn-sm ms-auto"  href={{ "products/" .$product->id }}>Buy
                                            Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

</html>