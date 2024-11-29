@include("eccom.layout.navbar")

<div class="breadcrumbs">
<div class="container">
<div class="row align-items-center">
<div class="col-lg-6 col-md-6 col-12">
<div class="breadcrumbs-content">
<h1 class="page-title">Cart</h1>
</div>
</div>
<div class="col-lg-6 col-md-6 col-12">
<ul class="breadcrumb-nav">
<li><a href="index-2.html"><i class="lni lni-home"></i> Home</a></li>
<li><a href="index-2.html">Shop</a></li>
<li>Cart</li>
</ul>
</div>
</div>
</div>
</div>


<div class="shopping-cart section">
<div class="container">
<div class="cart-list-head">

<div class="cart-list-title">
<div class="row">
<div class="col-lg-1 col-md-1 col-12">
</div>
<div class="col-lg-4 col-md-3 col-12">
<p>Product Name</p>
</div>
<div class="col-lg-2 col-md-2 col-12">
<p>Quantity</p>
</div>



<div class="col-lg-2 col-md-2 col-12">
    <p>Subtotal</p>
    </div>
    <div class="col-lg-2 col-md-2 col-12">
        <p>Discount</p>
        </div>

<div class="col-lg-1 col-md-2 col-12">
<p>Remove</p>
</div>
</div>
</div>

@php
$sum_price=0;
$sum=0;
$number_sale=0;
@endphp
@foreach ($Cart as $cart)
@foreach ($Product as $product)
@php
$images=explode('+',$product->img);
$sale_price = $product->price * (1 - $product->sale / 100);
$sum_one_item = $cart->count *  $sale_price;
$final_price = $product->price * $cart->count;


@endphp



@if ($cart->product_id==$product->id)
<div class="cart-single-list">
<div class="row align-items-center">
<div class="col-lg-1 col-md-1 col-12">
<a href="{{ route('eccom.show', ['productId' => $product->id, 'categoryId' =>  $product->category["id"] ]) }}"><img src="{{ asset("storage/images/". $images[0]) }}" alt="#"></a>
</div>
<div class="col-lg-4 col-md-3 col-12">
<h5 class="product-name"><a href="{{ route('eccom.show', ['productId' => $product->id, 'categoryId' =>  $product->category["id"] ]) }}">
{{ $product->name }}</a></h5>
<p class="product-des">
<span><em>Type:</em> {{  $product->category["name"] }}</span>
<span><em>Color:</em> Black</span>
</p>
</div>
<div class="col-lg-2 col-md-2 col-12">
    <p>{{ $cart->count }}x</p>
</div>

<div class="col-lg-2 col-md-2 col-12">
    <p>${{ $final_price }}</p>
    </div>

<div class="col-lg-2 col-md-2 col-12">
<p>{{ $product->sale }}%</p>
</div>

<div class="col-lg-1 col-md-2 col-12">
    <form action="{{ route("cart.destroy",$product->id) }}"  method="post" >
        @csrf
        @method("DELETE")
        <button type="submit"  class="remove-item" href="javascript:void(0)"><i class="lni lni-close"></i></button>
    </form>

</div>
</div>
</div>


@php
     $sum+=  $sum_one_item;
     $sum_price+= $final_price;


@endphp
@endif
@endforeach
@endforeach
@php
    $number_sale= $sum_price - $sum;
@endphp

</div>

<div class="row">
<div class="col-12">

<div class="total-amount">
<div class="row">
<div class="col-lg-8 col-md-6 col-12">
<div class="left">
<div class="coupon">
 <form action="#" target="_blank">
<input name="Coupon" placeholder="Enter Your Coupon">
<div class="button">
<button class="btn">Apply Coupon</button>
</div>
</form>
</div>
</div>
</div>
<div class="col-lg-4 col-md-6 col-12">
<div class="right">
<ul>
<li>Cart Subtotal<span>${{ $sum_price }}</span></li>
<li>Shipping<span>Free</span></li>
<li>You Save<span>${{ $number_sale }}</span></li>
<li class="last">You Pay<span>${{ $sum }}</span></li>
</ul>
<div class="button">
<a href="checkout.html" class="btn">Checkout</a>
<a href="product-grids.html" class="btn btn-alt">Continue shopping</a>
</div>
</div>
</div>
</div>
</div>

</div>
</div>
</div>
</div>
@include("eccom.layout.footer")
