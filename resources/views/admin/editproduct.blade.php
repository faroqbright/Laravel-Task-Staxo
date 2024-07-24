

@extends('admin.layouts.layout')

@section('admin.layouts.layout.content')

@section('content')


<div class="row g-4 mt-5 mb-5" style="margin-top:140px">
<h4>Edit Product</h4>
@foreach ($products as $product)


<div class="container">
                <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')


                <div class="form-floating mb-2">
                    <input type="text" class="form-control" name="name" placeholder="Enter product name"
                        value="{{ $product->name }}">
                    <label for="floatingInputGrid">Product Name</label>
                </div>
                <div class="form-floating ">
                    <input type="text" class="form-control" placeholder="Owner" name="price"
                        value="{{ $product->price }}" id="name">
                    <label for="floatingInputGrid">Price</label>
                </div>
                <div class="form-floating mt-2">
                    <input type="text" class="form-control" placeholder="Location" value="{{ $product->link }}" name="link">
                    <label for="floatingInputGrid">Link</label>
                </div>
                <div class=" mt-2">
                    <input type="file" class="form-control" placeholder="Price" value="{{ $product->image }}"
                        name="image">
                    <!-- <label for="floatingInputGrid"></label> -->
                </div>


                <img src="{{ asset('uploads/' . $product->image) }}" alt="{{ $product->name }}" width="120px" class="mt-2">



            
                <div class="modal-footer mt-3 d-flex ">
                    {{-- <a href="{{ url('/home') }}" class="align-self-center"><button class="btn btn-primary">Home</button></a> --}}
                    <button type="submit" class="btn btn-primary">Save changes</button>
                
            <a href="{{url('/admin/dashboard')}}" class="align-self-center btn btn-success">Back</a> 
                </div>
            </form>
            @endforeach

                
            </div>
        




    </div>

@endsection