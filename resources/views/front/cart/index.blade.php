@extends('front.layouts.master')
@section('title', 'cart')
@section('content')
    <?php
    $items = cartItems();
    ?>
    <div class="cart-page pb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="section-wrap">
                        <h3 class="sectin-wrap-title">Shopping Cart</h3>
                        <div class="table-responsive m-y-20">
                            <div class="primary-table">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                        <th>Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @if(!empty($items))
                                        @foreach($items as $item)
                                            <tr>
                                                <td>
                                                    <div class="producd-info d-flex align-items-center">
                                                        <a href="#" class="product-img mr-3">
                                                            <img src="{{$item->image}}" alt="product">
                                                        </a>
                                                        <a class="product-name" href="#">{{$item->name}}</a>
                                                    </div>
                                                </td>
                                                <td>{{allSettings('currency').' '.number_format($item->price,2)}}</td>
                                                <td>
                                                    <input class="qnty qty" data-id="{{$item->quantity}}" min="1"
                                                           type="number" value="{{$item->quantity}}">
                                                </td>
                                                <td>{{allSettings('currency').' '.getSubTotal($item->price,$item->quantity )}}</td>
                                                <td>
                                                    <a class="trash-btn"
                                                       href="{{route('cart.remove',[ app()->getLocale(), $item->id])}}"
                                                       onclick="return deleteConfirmation()"><i
                                                            class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="cart-bottom mt-5">
                            <ul class="d-flex align-items-center justify-content-between">
                                <li><a class="btn-style-two back-btn" href="#"> <i class="fas fa-angle-left"></i> Back
                                        to shopping</a></li>
                                <li><a class="btn-style-two" href="#">Update Cart</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart-page-right">
                        <div class="card-right-wrap coupon-code-info ">
                            <h3 class="sectin-wrap-title">Discount Coupon</h3>
                            <form>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="coupon" name="coupon"
                                           placeholder="Coupon Code">
                                </div>
                                <button type="submit" class="apply-btn">Apply</button>
                            </form>
                        </div>
                        <div class="card-right-wrap proceed-checkout-info">
                            <ul>
                                <li>Product Cost <span>$1080.20</span></li>
                                <li>TAX (5%) <span>$50</span></li>
                                <li>Shipping Cost <span>$36</span></li>
                                <li class="total">Total <span>$1100.00</span></li>
                            </ul>
                            <a class="checkout-btn" href="#">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('post_script')
    <script>
        function deleteConfirmation() {
            var r = confirm("Are you sure to remove it !");

            if (r == true) {
                return true;

            } else {

                return false;
            }
        }



        let data = document.querySelectorAll('.qty');
        console.log(data);


        for (let quantity of data) {
            quantity.addEventListener('change', function (e){
                let item = e.target.getAttribute('value');
                console.log();
            })
        }

    </script>


@endsection
