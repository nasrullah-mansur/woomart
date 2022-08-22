
<div class="product-modal-box modal " id="second_section_product-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog  modal-dialog-centered " role="document">
        <div class="modal-content container">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="flaticon-multiplication" ></span></button>
            </div>
            <div class="modal-body ">
                <div class="row ">
                    <div class="col-lg-6 ">
                        <div class="quick-view-image">
                            <div class="signle-image-product">
                                <a href="{{route('single.product', $f_product->slug)}}" data-fancybox="gallery">
                                    <img class="example-image" src="{{isset($f_product) ? $f_product->primary_image : ''}}" alt="image-1">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 ">
                        <div class="product-details-content ">
                            <h3 class="product-title">{{$f_product->name}}</h3>
                            <div class="quickview-peragraph ">
                                <p>{!! $f_product->about_product !!}</p>
                            </div>
                            <div class="price-box">
                                <span class="price">£ {{$f_product->discount_price }}</span> @if($f_product->discount_price > 0) <span class="old-price"><s>$ {{$f_product->price }}</s></span> @endif
                            </div>
                            <div class="single-variable color-variable">
                                <h4>Color</h4>
                                <ul>
                                    <li><span class="color oragne"></span></li>
                                    <li><span class="color black"></span></li>
                                    <li><span class="color white"></span></li>
                                    <li><span class="color blue"></span></li>
                                    <li><span class="color violet"></span></li>
                                    <li><span class="color red"></span></li>
                                </ul>
                            </div>

                            <div class="single-variable size-variable">
                                <h4>Sizes</h4>
                                <ul>
                                    @foreach($f_product->productSize as $productSize)
                                        <li><span class="size">{{$productSize->size}}</span></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="quickview-cart-box">
                                <h4>Quantity</h4>
                                <div class="quickview-cart-wrap d-flex align-items-center ">
                                    <div class="quickview-quality">
                                        <div class="cart-plus-minus">
                                            <div class="dec qtybutton btn">-</div>
                                            <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1">
                                            <div class="inc qtybutton btn">+</div>
                                        </div>
                                    </div>
                                    <div class="stock in-stock ">
                                        <p>Available: <span>In stock</span></p>
                                    </div>
                                </div>
                            </div>
                            <a class="add-cart" href="#"> <i class="flaticon-shopping-cart-empty-side-view"></i> Add to Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
