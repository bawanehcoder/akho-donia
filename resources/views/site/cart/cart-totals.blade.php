<div class="col-lg-4 col-12 mb-30">
    <div class="cart-totals card" style=" border-radius: 10px;">
        <div class="cart-totals-inner p-3">
            <h4 class="title">@langucw('cart totals')</h4>
            <table class=" bg-transparent">
                <tbody>
                @php
                    $total=app()->make(\App\Repositories\CartRepository::class)->getTotalPrice($carts??[]);
                @endphp
                <tr class="subtotal">
                    <th class="sub-title">@langucw('subtotal')</th>
                    <td class="amount"><span class="subtotal subtotal_amount">{{(float)$total}}</span></td>
                    <td>{{$genralSetting->getCurrency()}}</td>
                </tr>

                </tbody>
            </table>
        </div>

        @if(auth()->user())
            <button type="button" onclick="nextRoute('{{Route('shipping_info.index')}}')"    class="dropdown-item checkout-button p-2">@langucw('proceed to checkout')</button>
        @else
            <a href="{{Route('login')}}"    class="dropdown-item checkout-button p-2">@langucw('login')</a>
        @endif
    </div>
</div>
