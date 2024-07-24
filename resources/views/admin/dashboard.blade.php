

@extends('admin.layouts.layout')

@section('admin.layouts.layout.content')

@section('content')

{{-- create modal --}}

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>


<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" onclick="closeModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete <span id="productName"></span>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                    <button type="button" class="btn btn-danger delete-confirm">Delete</button>
                </div>
            </div>
        </div>
    </div>






                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{ route('submit.form') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">


                                    <div class="form-floating mb-2">
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Enter Property name" value="">
                                        <label for="floatingInputGrid">Name</label>
                                    </div>
                                
                                    <div class="form-floating mt-2">
                                        <input type="text" class="form-control" placeholder="price" value=""
                                            name="price">
                                        <label for="floatingInputGrid">Price</label>
                                    </div>
                                    <div class="form-floating mt-2">
                                        <input type="text" class="form-control" placeholder="Link" value=""
                                            name="link">
                                        <label for="floatingInputGrid">Link</label>
                                    </div>
                                    <div class=" mt-2">
                                    <!-- <label for="floatingInputGrid">Link</label> -->
                                        <input type="file" class="form-control" placeholder="image" value=""
                                            name="image">
                                       
                                    </div>





                             
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- create modal end --}}
<div class="row g-4 mt-5 mb-5" style="margin-top:140px">
              
                
                    <div class="col-12">
                        
                        <div class="bg-light rounded h-100 p-4">
                              <!-- Button trigger modal -->
                        <div class="container mb-3 mt-1"> <button type="button" class="btn btn-primary float-end"
                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Add Product
                            </button></div>
                            <h6 class="mb-4">All product  


                            
                            </h6>
                            
                            <div class="table-responsive">
                                
                                <table class="table">

                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Link</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Action</th>
                                      
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                $id = 1;
                            @endphp
                            @foreach ($products as $product)
                                <tr>
                                    <th scope="row">{{ $id++ }}</th>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->link }}</td>
                                    <td><img src="{{ asset('uploads/' . $product->image) }}" alt="Product Image" width="60px" height="60"></td>
                              
                                    <td>



                                        
                                        
                                        
                                        
                                        <a href="{{ url('product_edit', $product->id) }}"><button
                                        class="btn btn-primary">edit</button></a>
                                        <!-- <form action="{{ route('product.destroy', $product->id) }}" method="POST">

                                           @csrf
                                           @method('DELETE')
                                           <button type="submit" class="btn btn-danger">Delete</button>
                                       </form> -->



<button type="button" class="btn btn-primary delete-btn" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal2" data-product-id="{{ $product->id }}">
                                            delete
                                        </button>


                                    </td>
                                </tr>
                            @endforeach
                                  
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
@endsection

