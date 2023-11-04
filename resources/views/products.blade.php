<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel & Ajax Crud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="display-4 text-center my-3">
                    <p>Laravel & Ajax Crud</p>
                </div>
                <a href="" class="btn btn-success my-3" data-bs-toggle="modal" data-bs-target="#addModal">Add Product</a>
                <input type="text" class="form-control mb-3" name="search" id="search" placeholder="Search here...">
                <div class="table-data">
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key =>  $product )
                            <tr>
                              <th>{{ $key+1 }}</th>
                              <td>{{ $product->name }}</td>
                              <td>{{ $product->price}}</td>
                              <td>
                                  <a class="btn btn-primary btn-sm update_product_form"
                                  data-bs-toggle="modal"
                                  data-bs-target="#updateModal"
                                  data-id="{{ $product->id }}"
                                  data-name="{{ $product->name }}"
                                  data-price="{{ $product->price }}">
                                  <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                  <a class="btn btn-danger btn-sm delete-product"
                                   href=""
                                   data-id="{{ $product->id }}"><i class="fa-solid fa-trash"></i></a>
                              </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                      {!! $products->links() !!}
                </div>
            </div>
        </div>
    </div>
    @include('add_product_modal')
    @include('update_product_modal')
    @include('product_js')
            {!! Toastr::message() !!}
  </body>
</html>
