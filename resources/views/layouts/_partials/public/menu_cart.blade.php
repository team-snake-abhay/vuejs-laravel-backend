
  <a class="mdl-button mobileversion mdl-js-button mdl-js-ripple-effect hdr-basket" href="{{route('pub.shop.cart')}}"
    data-upgraded=",MaterialButton,MaterialRipple">
    <i class="fa fa-cart-plus"></i><span class="cart-count">{{Session::has('cart')? Session::get('cart')->totalQty : 0}}</span>
    <span class="mdl-button__ripple-container"><span class="mdl-ripple is-animating"
        style="width: 148.219px; height: 148.219px; transform: translate(-50%, -50%) translate(19px, 13px);"></span></span></a>
  <ul class="menu-megamenu menu-cart">
    @php $cartItems = Session::has('cart')? session()->get('cart')->items : [];@endphp
    @forelse($cartItems as $item)     
    <li class="cart-overview">
      <a href="#" class="row">
        <div class="col-4 pr-0 cart-img">
          <img src="{{url('storage/images/products',$item['item']->img_1)}}" alt="{{$item['item']->name}}">
        </div>
        <div class="col-8 cart-details">
          <span class="title">{{$item['item']->name}}</span>
          <span class="price">Price: {{$item['item']->price}}</span>
          <span class="qty">Quantity: {{$item['qty']}}</span>
          <div class="cart-remove cart-item-remove" pid="{{$item['item']->id}}"><i class="icon-close"></i></div>
        </div>
      </a>
    </li>
    @empty

    @endforelse
    <li class="row align-items-center">
      <div class="col-6">
        <a href="{{route('pub.shop.checkout')}}" class="btn btn-dark text-white text-center">Checkout</a>
      </div>
      <div class="col-6 text-right">
        <p class="font-dosis font-20 m-0">Total : {{Session::has('cart')? Session::get('cart')->totalPrice : ''}}</p>
      </div>
    </li>
  </ul>
