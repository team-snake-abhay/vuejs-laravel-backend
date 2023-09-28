@forelse($products as $item)
<div class="col-md-6 col-lg-4">
  <div class="product-card p-2 border border-light">
    <div class="product-img">
      <div class="owl-carousel owl-theme theme-owlslider dots-overlay text-center">
        <div class="theme-owlslider-container">
          <a href="{{route('pub.shop.product-details',[$item->id])}}">
            <img class="img-responsive" src="{{url('storage/images/products',$item->img_1)}}" alt="" />
          </a>
        </div>        
      </div>
    </div>
    <div class="product-details">
      <h5 class="title"><a href="{{route('pub.shop.product-details',[$item->id])}}">{{$item->name}}</a></h5>
      <div class="price">
        <!--del>$79.99</del-->Price: ৳ {{$item->price}}
        <span class="text-info float-right">Stock: {{$item->available_quantity}}</span>
      </div>



      <div class="rating">
        @for ($i = 1; $i <= $item->rating; $i++)
          <i class="fa fa-star"></i>
        @endfor
          <!-- <i class="fa fa-star-o"></i> -->
      </div>
      @if($item->available_quantity > 0)
      <p class="text-justify">{{Str::limit($item->description,200)}}</p>
      <div class="row">
        <div class="col-sm-3">
          <span pId="{{$item->id}}" class="btn btn-primary btn-outline-1x btn-sm m-1 add-to-cart">
            Add to Cart</span>
          <!-- <a href="#" class="btn btn-outline btn-dark btn-outline-1x btn-sm m-1">Buy
          Now</a> -->
        </div>
        <div class="col-sm-3">
          <span pId="{{$item->id}}" class="btn btn-info btn-outline-1x btn-sm m-1 buy-now">
            Buy Now</span>
          <!-- <a href="#" class="btn btn-outline btn-dark btn-outline-1x btn-sm m-1">Buy
          Now</a> -->
        </div>
      </div>
      @else
      <span class="text-danger">Out of Stock</span>        
      @endif

    </div>
  </div>
</div>
@empty

No product found

@endforelse