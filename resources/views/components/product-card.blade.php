@props([
    'name',
    'price',
    'image',
    'id'
])

  <div class="col-lg-3 col-md-6 col-12">
      <a href="{{ route('shop.details',$id) }}">
          <div class="pro-area">
              <div class="text-center mb-3">
                  <img class="img-fluid bit-img" src="{{ asset('images/products/featured/'.$image) }}" alt="">
              </div>
              <h4 class="inner-financial-hd">{{ $name }}</h4>
              <div class="raiting-area">
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
              </div>
              <p class="shipping-para pr"><strong>${{ $price }}</strong></p>
              <div class="cart-btn-area">
                  <button class="cart-btn"><i class="fa-solid fa-cart-shopping"></i> Add To Cart</button>
                  <button class="cart-btn"><i class="fa-solid fa-code-compare"></i> Compare</button>
              </div>
          </div>
      </a>
  </div>
