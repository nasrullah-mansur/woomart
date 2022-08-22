
<div class="col-lg-3 col-md-3">
    <div class="categories-list-v2 ">
        <h3 class="catagory-name"><i class="fas fa-bars"></i> All Categories </h3>
        <ul class="catagory-items">

            @if(isset($categories[0]))
                @foreach($categories as $category)
                    <li><a href="{{route('category.product', [app()->getLocale(), $category->slug] )}}"><img src="{{$category->icon}}" alt="icon" /> {{$category->name}}</a></li>
                @endforeach
            @endif

        </ul>
    </div>
    <a id="menu-bars" class="text-right d-block d-md-none" href="#"><i class="fa fa-bars"></i></a>
</div>
