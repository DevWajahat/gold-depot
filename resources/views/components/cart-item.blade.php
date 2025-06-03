@props(['category', 'name', 'price', 'image', 'quantity', 'total','dataid'])

<tr class="tr-hover">
    <td class="pr-title d-flex mt-2">
        <span>
            <img class="img-fluid" src="{{ asset('images/products/featured/' . $image) }}" alt="">
        </span>
        <span>{{ $category }} <br><strong>{{ $name }}</strong></span>
    </td>
    <td class="pr-title"><span><strong>${{ $price }}</strong></span></td>
    <td class="pr-title counter d-flex">
        <button class="count-btn decrement" data-id="{{ $dataid }}">-</button>
        <input class="count" name="quantity" value="{{ $quantity }}" />
        <button class="count-btn increment" data-id="{{ $dataid }}" >+</button>

    </td>
    <td class="pr-title"><span><strong id="item-total-{{ $dataid }}">$ {{ $total }}</strong></span></td>

    {{-- <x-cart-item-total :total="$total" /> --}}
    <td class="pr-title"><button class="delete-btn" type="button"><a href="{{ route('cart.destroy',$dataid) }}" class="nav-link"><i class="fa-solid fa-xmark"></a></i></button></td>
</tr>
