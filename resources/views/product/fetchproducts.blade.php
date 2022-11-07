<table class="table table-bordered">
  <thead class=" table-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Detail</th>
      <th scope="col">Stock</th>
      <th scope="col">Price</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($products as $product) 
      <tr>
        <th scope="row">{{ $loop->iteration }}</th>
        <td>{{ $product->name }}</td>
        <td>{!! $product->detail !!}</td>
        <td>{{ $product->stock }}</td>
        <td>{{ $product->price }}</td>
        <td>
            <a href="" class="btn btn-warning buttonEditProduct" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="{{ $product->id }}"><i class="bi bi-pencil-square"></i></a>
            <a href="" class="btn btn-danger buttonDeleteProduct" data-id="{{ $product->id }}"><i class="bi bi-trash"></i></a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
{{-- pagination --}}
<div class="d-flex justify-content-end">{{ $products->links() }}</div>

