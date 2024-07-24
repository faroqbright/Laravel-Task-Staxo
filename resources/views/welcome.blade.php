<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


    <style>
        *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Poppins;
    color: white;
}

body{
    background: #131313;
    display: flex;
}

img{
    height: 100%;
    width: 100%;
    object-fit: cover;
    filter: grayscale(70%);
    border-radius: 7px;
}

h3{
    font-weight: 500;
}

p{
    font-style: italic;
    color: rgb(217, 217, 217);
}

button{
    display: inline-block;
    width: auto;
    padding: 0.6rem 1.5rem;
    border: 1px solid #606060;
    background: none;
    font-weight: 400;
    border-radius: 50px;
    cursor: pointer;
}

.container{
    margin: 0 auto 50px auto;
    width: 90%;
}

.input{
    display: flex;
    justify-content: center;
    margin-block: 20px 50px;
}

.product-list{
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
    gap: 20px;
}

.product-list:has(.product:hover) .product:not(:hover){
    filter: blur(5px);
    opacity: 0.7;
}

.product{
    border: 1px solid #606060;
    height: 300px;
    padding: 10px 10px 20px 10px;
    border-radius: 10px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    transition: filter 0.1s ease-in-out, opacity 0.1s ease-in-out;
}

.img{
    height: 60%;
    width: 100%;
}

.info{
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
}


/* nav */ nav ul { list-style-type: none; }
    nav ul li { display: inline; margin-right: 30px; }

    </style>
</head>
<body>



<div class="container">

    <nav>
        <ul>
            @guest
                <li><a href="/login">User Login</a></li>
                <li><a href="/register">User Register</a></li>

            @else
                @if(auth()->guard('admin')->check())
                    <!-- Admin navigation -->
                    {{-- <li><a href="/admin/dashboard">Admin Dashboard</a></li> --}}
                    <!-- Add more admin-specific links here -->
                    {{-- <li><span>Welcome, Admin {{ auth()->guard('admin')->user()->name }}</span></li> --}}
                @else
                    <!-- Regular user navigation -->
                    <li><span>Welcome, {{ auth()->user()->name }}</span></li>
                @endif
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </li>
            @endguest
        </ul>
    </nav>



<!-- <div class="input">
    <input type="range" min="50" max="1000" value="10" step="10" id="priceSlider" >
    <span id="sliderValue">$10</span>
</div> -->
<div class="product-list " style="margin-top:70px">
    @foreach ($products as $product)
  <div class="product" data-price="50">
  <a href="{{$product->link}}" >{{$product->link}}</a>
    <div class="img">
        <!-- <img src="https://images.pexels.com/photos/277319/pexels-photo-277319.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt=""> -->

        <img src="{{ asset('uploads/' . $product->image) }}" alt="{{ $product->name }}" >

    </div>

    <div class="info">


        <h3>{{$product->name}}</h3>
        <p>{{$product->price}}</p>

    </div>
    <a href="{{ route('product.show', ['id' => $product->id]) }}">
    <button>View Product</button>
</a>

  </div>
  @endforeach
  <!--<div class="product" data-price="150">
    <div class="img">
        <img src="https://images.pexels.com/photos/404181/pexels-photo-404181.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="">
    </div>
    <div class="info">
        <h3>Exquisit Atros</h3>
        <p>$150</p>
    </div>
    <button>Add to Cart</button>
  </div>
   <div class="product" data-price="250">
    <div class="img">
        <img src="https://images.pexels.com/photos/3766111/pexels-photo-3766111.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="">
    </div>
    <div class="info">
        <h3>Helux Spielberg</h3>
        <p>$250</p>
    </div>
    <button>Add to Cart</button>
  </div>
  <div class="product" data-price="350">
    <div class="img">
        <img src="https://images.pexels.com/photos/9897926/pexels-photo-9897926.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="">
    </div>
    <div class="info">
        <h3>Luminare Marine</h3>
        <p>$350</p>
    </div>
    <button>Add to Cart</button>
  </div>
  <div class="product" data-price="450">
    <div class="img">
        <img src="https://images.pexels.com/photos/9897857/pexels-photo-9897857.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="">
    </div>
    <div class="info">
        <h3>Regalli Claustroph</h3>
        <p>$450</p>
    </div>
    <button>Add to Cart</button>
  </div>
  <div class="product" data-price="550">
    <div class="img">
        <img src="https://images.pexels.com/photos/10436602/pexels-photo-10436602.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="">
    </div>
    <div class="info">
        <h3>Luminare Luxus</h3>
        <p>$550</p>
    </div>
    <button>Add to Cart</button>
  </div>
  <div class="product" data-price="650">
    <div class="img">
        <img src="https://images.pexels.com/photos/10478973/pexels-photo-10478973.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="">
    </div>
    <div class="info">
        <h3>Regalli Hetchers</h3>
        <p>$650</p>
    </div>
    <button>Add to Cart</button>
  </div>
  <div class="product" data-price="750">
    <div class="img">
        <img src="https://images.pexels.com/photos/10414981/pexels-photo-10414981.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="">
    </div>
    <div class="info">
        <h3>Helux MVII</h3>
        <p>$750</p>
    </div>
    <button>Add to Cart</button>
  </div>
  <div class="product" data-price="850">
    <div class="img">
        <img src="https://images.pexels.com/photos/10443775/pexels-photo-10443775.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="">
    </div>
    <div class="info">
        <h3>Exquisit Remos</h3>
        <p>$850</p>
    </div>
    <button>Add to Cart</button>
  </div>
  <div class="product" data-price="950">
    <div class="img">
        <img src="https://images.pexels.com/photos/9423283/pexels-photo-9423283.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="">
    </div>
    <div class="info">
        <h3>Helux Hostenhof</h3>
        <p>$950</p>
    </div>
    <button>Add to Cart</button>
  </div> -->
</div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
</body>
</html>
