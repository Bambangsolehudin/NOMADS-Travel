@extends('layouts.app')
@section('title')
    NOMADS
@stop

@section('content')
<!-- Header -->
<header class="text-center">
    <h1>Explore The Beautiful World
        <br>
        As Easy One Click</h1>
        <p class="mt-3">You Will See Beautiful <br>
            Moment You Never See Before</p>
    <!-- <a href="#popular" class="btn btn-get-started px-4 mt4">
        Get Started
    </a> -->
</header>

<main>




<section class="section-popular" id="popular">
    <div class="container">
      <div class="row">
        <div class="col text-center section-popular-heading" >
          <h2>Daftar Paket Travel</h2>
          <p>
            <!-- Something that you never try
            <br />
            before in this world -->
          </p>
        </div>
      </div>
    </div>
  </section>

  
  <section class="section-popular-content" id="popularContent">
    <div class="container">
      <div class="section-popular-travel row justify-content-center">
        @foreach($items as $item)
            <div class="col-sm-6 col-md-4 col-lg-3">
              <div
                class="card-travel text-center d-flex flex-column"
                style="background-image: url('{{ $item->galleries->count() ? Storage::url($item->galleries->first()->image) : '' }}');"
              >
                <div class="travel-country">{{ $item->location }}</div>
                <div class="travel-location">{{ $item->title }}</div>
                <div class="travel-button mt-auto">
                  <a href="{{ route('detail', $item->slug) }}" class="btn btn-travel-details px-4">
                    View Details
                  </a>
                </div>
              </div>
            </div>
        @endforeach
      </div>
    </div>
  </section>



</main>
@endsection