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
