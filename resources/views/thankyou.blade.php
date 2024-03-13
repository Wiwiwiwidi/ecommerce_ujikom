@extends('beranda.beranda')
@section('content')
<div class="bg-light py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Contact</strong></div>
      </div>
    </div>
</div>  

<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <span class="icon-check_circle display-3 text-success"></span>
                <h2 class="display-3 text-black">Thank you!</h2>
                <p class="lead mb-5">Your order was successfully completed, want to see your order detail?</p>
                <div class="btn-group">
                    <a href="/my-produk" class="btn btn-sm btn-primary mr-2">Back to product</a> <!-- Tambahkan class "mr-2" untuk memberikan spasi -->
                    <a href="/my-history" class="btn btn-sm btn-primary">Order details</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection