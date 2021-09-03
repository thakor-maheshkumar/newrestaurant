@if(session()->has('message'))
<div class="alert alert-success">
    {{session()->get('message')}}
</div>
@endif

<section class="section" id="menu">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="section-heading">
                        <h6>Our Menu</h6>
                        <h2>Our selection of cakes with quality taste</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-item-carousel">
            <div class="col-lg-12">
                <div class="owl-menu-item owl-carousel">
                    @foreach($data as $key=>$value)
                    <form method="post" action="{{url('addcart')}}">
                        @csrf
                    <div class="item">
                        <div class='card' style="background-image: url('foodimage/{{$value->image}}');">
                            <div class="price"><h6>{{$value->price}}</h6></div>
                            <div class='info'>
                              <h1 class='title'>{{$value->title}}</h1>
                              <p class='description'>{{$value->description}}</p>
                              <div class="main-text-button">
                                  <div class="scroll-to-section"><a href="#reservation">Make Reservation <i class="fa fa-angle-down"></i></a></div>
                              </div>
                            </div>
                        </div>
                        <input type="hidden" name="food_id" value="{{$value->id}}">
                        <input type="number" name="quantity"  value="1" min="1" style="width: 80px;">
                       <button type="submit" class="btn btn-success btn-sm">Add To cart</button>
                    </div>
                </form>
                @endforeach
                   
                </div>
            </div>
        </div>
    </section>