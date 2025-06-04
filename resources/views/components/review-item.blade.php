@props([
    'message',
    'name'
])


<div class="review-item">
    <p class="para">“{{ $message }}”</p>
    <div class="rev-img-area">
        <div>
            <img src="{{ asset('assets/web/images/revimg.png') }}" alt="">
        </div>
        <div>
            <h5 class="rev-hd">{{ $name }}</h5>
            <p class="para">Customer</p>
        </div>
    </div>
</div>
