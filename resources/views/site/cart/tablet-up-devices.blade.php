<div class="card">
    @if(count($carts)>0)
        <table id="table" class="">
            <thead>
            <tr class="no-bor-top">
                <th scope="col">@langucw('image')</th>
                <th scope="col">@langucw('product')</th>
                <th scope="col">@langucw('price')</th>
                <th scope="col">@langucw('quantity')</th>
                <th scope="col">@langucw('total')</th>
                <th scope="col">@langucw('special image')</th>
                <th scope="col">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @foreach($carts??[] as $index=>$cart)
                @if($cart->item)
                    <tr>
                       
                        <td>
                            <div class=""><img
                                        alt="Cake-one" class="full-image"
                                        src="{{asset($cart->item->getFirstMediaUrl('products', 'small'))}}"></div>
                        </td>
                        <td>
                            <h3>{{$cart->item->getTitle()}} ({{$cart->item->price()}})
                                @if($cart->optionDetil())
                                    @foreach($cart->optionDetil()->get()??[] as $option)
                                        <br>
                                        <span>{{$option->subOption->getTitle()}} ({{$option->AdditionalValue}})</span>
                                    @endforeach
                                @endif
                            </h3>
                        </td>
                        @php
                            $price=    ($cart->optionDetil()?$cart->optionDetil()->sum('AdditionalValue'):0) ;

                        @endphp
                        <td>
                            <h3><div class="price-product price-{{$cart->id}}">{{$price}}</div></h3>
                        </td>
                        <td style="    text-align: -webkit-center;">
                            @include('components.btn-number',['id'=>$cart->id,'quantity'=>$cart->quantity])
                        </td>
                        <td>
                            <span
                                class="total total_{{$cart->id}}">{{ ($price*$cart->quantity)}}</span> {{$genralSetting->getCurrency()}}
                        </td>
                        <td>
                            @if($cart->getFirstMediaUrl('images','large'))
                                <a class="img-product" target="_blank"
                                   href="{{asset($cart->getFirstMediaUrl('images','large'))??''}}?v={{now()}}"><img
                                        width="100px" height="100px" class="full-image"
                                        src="{{asset($cart->getFirstMediaUrl('images','small'))??''}}?v={{now()}}"></a>
                            @endif
                        </td>
                        <td>
                            <span style="cursor:pointer" onclick="deleteItem('{{route('cart.delete',$cart)}}')"><img src="{{ asset('assets/images/ic_close.svg') }}" class="cursor-pointer"></span>
                        </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    @endif
</div>

