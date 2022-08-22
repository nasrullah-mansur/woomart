<div class="col-lg-3 col-md-3">
    <div class="categories-list">
        <ul class="catagory">
            <li>
                <a href="#">All Categories <i class="fa fa-angle-down"></i></a>
                <ul class="catagory-items">

                    @if(isset($categories[0]))
                        @foreach($categories as $category)
                            <li><a href="{{route('category.product', [app()->getLocale(), $category->slug ])}}">{{$category->name}}</a></li>
                        @endforeach
                    @endif

                </ul>
            </li>
        </ul>
    </div>
    <a id="menu-bars" class="text-right d-block d-md-none" href="#"><i class="fa fa-bars"></i></a>
</div>
