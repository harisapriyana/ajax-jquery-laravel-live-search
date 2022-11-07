<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Production</title>
    {{-- css bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    {{-- css bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-md-11">
                <h2 class="my-4 text-center">Product Menu</h2>
                {{-- Input Search --}}
                <input type="text" name="search" id="search" class="form-control mb-3" placeholder="Search Product">
                <p id="totalData"></p>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mb-3 buttonAddProduct" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add Product
                </button>
                {{-- Start Table --}}
                <div class="table-data" id="table-products">
                    {{-- here the table data show --}}
                    @include('product.fetchproducts')
                </div>
            </div>
        </div>
    </div>
    
    @include('product.modal')








    {{-- javascript bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    {{-- JQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="script.js"></script>
  </body>
</html>