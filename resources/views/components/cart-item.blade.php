@props(['category', 'name', 'price', 'image', 'quantity', 'total', 'dataid', 'productid', 'item'])
@php
    use App\Models\Product;
@endphp
<tr class="tr-hover ">
        <td class="pr-title d-flex mt-2">
            <span>
                <img class="img-fluid" src="{{ asset('images/products/featured/' . $image) }}" alt="">
            </span>
            <span>{{ $category }} <br><strong>{{ $name }}</strong></span>
        </td>
        @if (isset($item['variants']))
        <td class="pr-title"><span><strong id="sumPrice">${{ $item['sumprice']}}</strong></span></td>
        @else
        <td class="pr-title"><span><strong>${{ $item["price"] }}</strong></span></td>
        @endif
        <td class="pr-title counter d-flex">
            <button class="count-btn decrement" data-id="{{ $dataid }}">-</button>
            <input class="count" name="quantity" value="{{ $quantity }}" />
            <button class="count-btn increment" data-id="{{ $dataid }}">+</button>
        </td>
    {{-- @dd(session('cart')['items']) --}}

    <td>
        @php
            $product = Product::find($productid);
        @endphp
        @if (isset($item['variants']) && is_array($item['variants']))
            @forelse ($item["variants"] as $attr => $variant)
            {{-- @dd($attr, $variant) --}}
                <div class="par">
                    {{-- @dump() --}}
                    <div class="fw-bolder attr-name">{{ $attr }}</div>
                    <input class="attr-name" type="hidden" value="{{ $attr }}">
                    <select name="variants[]" class="form-control variant" id="{{ $dataid }}">
                        @forelse ($product->variants as $var)
                            @if ($attr == $var->attribute->name)
                                <option value="{{ $var->name }}" {{ $var->name == $variant[0] ? 'selected' : '' }}>
                                    {{ $var->name }}</option>
                            @endif
                        @empty
                        @endforelse
                    </select>
                </div>
            @empty
            @endforelse
        @endif
    </td>

    <td class="pr-title"><span><strong class="productTotal" id="item-total-{{ $dataid }}">$ {{ $total }}</strong></span></td>

    {{-- <x-cart-item-total :total="$total" /> --}}
    <td class="pr-title"><button class="delete-btn" type="button"><a href="{{ route('cart.destroy', $dataid) }}"
                class="nav-link"><i class="fa-solid fa-xmark"></a></i></button></td>
</tr>
