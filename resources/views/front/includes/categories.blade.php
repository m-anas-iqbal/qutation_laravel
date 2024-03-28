<?php
$sidebar_cats = \App\BusinessCategory::all();
?>

<style>
    a{
        color: black;
    }
.cat_menu{
    font-size: 18px;
    font-weight: 500;
}
.main_cat{
    font-size: 22px;
    font-weight: 600;
}
</style>
<div class="card" style="padding-bottom: 92px;">
    <div class="card-body">
<ul class="nav nav-light" style="display: contents;">




    {{--city--}}

    @if(isset($city) && isset($name))

        @foreach($sidebar_cats as $cat)
            <?php
            $sidebar_sub_cats = \App\BusinessSubCategory::where('category_id', $cat->id)->get();
            ?>
            <li class="nav-item cat_menu main_cat mb-1"><a href="{{ url('category/'.$cat->name.'/'.$country.'/'.$state.'/'.$county.'/'.$city.'/'.$name) }}">{{ $cat->name }}</a></li>
            @foreach($sidebar_sub_cats as $sub_cat)
                <li class="nav-item cat_menu mb-1"><a href="{{ url('subcategory/'.$sub_cat->name.'/'.$country.'/'.$state.'/'.$county.'/'.$city.'/'.$name) }}">{{ $sub_cat->name }}</a></li>
            @endforeach
        @endforeach

    {{--city--}}

    @elseif(isset($city))

        @foreach($sidebar_cats as $cat)
            <?php
            $sidebar_sub_cats = \App\BusinessSubCategory::where('category_id', $cat->id)->get();
            ?>
            <li class="nav-item cat_menu main_cat mb-1"><a href="{{ url('category/'.$cat->name.'/'.$country.'/'.$state.'/'.$county.'/'.$city.'/'.$name) }}">{{ $cat->name }}</a></li>
            @foreach($sidebar_sub_cats as $sub_cat)
                <li class="nav-item cat_menu mb-1"><a href="{{ url('subcategory/'.$sub_cat->name.'/'.$country.'/'.$state.'/'.$county.'/'.$city.'/'.$name) }}">{{ $sub_cat->name }}</a></li>
            @endforeach
        @endforeach




    {{--county--}}

    @elseif(isset($county))

        @foreach($sidebar_cats as $cat)
            <?php
            $sidebar_sub_cats = \App\BusinessSubCategory::where('category_id', $cat->id)->get();
            ?>
            <li class="nav-item cat_menu main_cat mb-1"><a href="{{ url('category/'.$cat->name.'/'.$country.'/'.$state.'/'.$county.'/'.$name) }}">{{ $cat->name }}</a></li>
            @foreach($sidebar_sub_cats as $sub_cat)
                <li class="nav-item cat_menu mb-1"><a href="{{ url('subcategory/'.$sub_cat->name.'/'.$country.'/'.$state.'/'.$county.'/'.$name) }}">{{ $sub_cat->name }}</a></li>
            @endforeach
        @endforeach




    {{--state--}}

    @elseif(isset($state))

        @foreach($sidebar_cats as $cat)
            <?php
            $sidebar_sub_cats = \App\BusinessSubCategory::where('category_id', $cat->id)->get();
            ?>
            <li class="nav-item cat_menu main_cat mb-1"><a href="{{ url('category/'.$cat->name.'/'.$country.'/'.$state.'/'.$name) }}">{{ $cat->name }}</a></li>
            @foreach($sidebar_sub_cats as $sub_cat)
                <li class="nav-item cat_menu mb-1"><a href="{{ url('subcategory/'.$sub_cat->name.'/'.$country.'/'.$state.'/'.$name) }}">{{ $sub_cat->name }}</a></li>
            @endforeach
        @endforeach


        {{--country--}}

    @elseif(isset($country))

        @foreach($sidebar_cats as $cat)
            <?php
            $sidebar_sub_cats = \App\BusinessSubCategory::where('category_id', $cat->id)->get();
            ?>
                <li class="nav-item cat_menu main_cat mb-1"><a href="{{ url('category/'.$cat->name.'/'.$country.'/'.$name) }}">{{ $cat->name }}</a></li>
                @foreach($sidebar_sub_cats as $sub_cat)
                    <li class="nav-item cat_menu mb-1"><a href="{{ url('subcategory/'.$sub_cat->name.'/'.$country.'/'.$name) }}">{{ $sub_cat->name }}</a></li>
                @endforeach
        @endforeach




        @elseif(isset($search_area_name))
    @foreach($sidebar_cats as $cat)
        <?php
        $sidebar_sub_cats = \App\BusinessSubCategory::where('category_id', $cat->id)->get();
        ?>
    <li class="nav-item cat_menu main_cat mb-1"><a href="{{ url('category/'.$cat->name.'/'.$search_area_name) }}">{{ $cat->name }}</a></li>
@foreach($sidebar_sub_cats as $sub_cat)
    <li class="nav-item cat_menu mb-1"><a href="{{ url('subcategory/'.$sub_cat->name.'/'.$search_area_name) }}">{{ $sub_cat->name }}</a></li>
            @endforeach
    @endforeach


        @else
    @foreach($sidebar_cats as $cat)
        <?php
        $sidebar_sub_cats = \App\BusinessSubCategory::where('category_id', $cat->id)->get();
        ?>
    @if(isset($name))
    <li class="nav-item cat_menu main_cat mb-1"><a href="{{ url('category/'.$cat->name.'/'.$name) }}">{{ $cat->name }}</a></li>
@foreach($sidebar_sub_cats as $sub_cat)
    <li class="nav-item cat_menu mb-1"><a href="{{ url('subcategory/'.$sub_cat->name.'/'.$name) }}">{{ $sub_cat->name }}</a></li>
            @endforeach
            @endif
    @endforeach

        @endif
</ul>

    </div>
</div>