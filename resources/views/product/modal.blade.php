<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <form action="" method="post">
    @csrf
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalLabel">Add New Product</h1>
            <button type="button" class="btn-close buttonClose" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="errors-message d-none"></ul>
                <div class="success-message d-none"></div>
                <input type="hidden" name="id" id="id">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Product Name">
                    <label for="name">Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Product Slug Name">
                    <label for="slug">Slug Name</label>
                </div>
                <div class="form-floating  mb-3">
                    <textarea class="form-control" placeholder="Leave the product's detail here" id="detail" name="detail"></textarea>
                    <label for="detail">Detail</label>
                </div>
                <div class="form-floating  mb-3">
                    <input type="text" class="form-control" id="stock" name="stock" placeholder="Product Stock">
                    <label for="stock">Stock</label>
                </div>
                <div class="form-floating  mb-3">
                    <input type="text" class="form-control" id="price" name="price" placeholder="Product Price">
                    <label for="price">Price</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary buttonClose" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Product</button>
            </div>
        </div>
        </div>
    </form>
  </div>

  <!-- Modal Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <form action="" method="post">
    @csrf
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalLabel">Delete Product</h1>
            <button type="button" class="btn-close buttonClose" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="errors-message d-none"></ul>
                <div class="success-message d-none"></div>
                <input type="hidden" name="idDelete" id="idDelete">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nameDelete" name="nameDelete" readonly>
                    <label for="name">Product Name</label>
                </div>
                <div class="form-floating mb-3">
                    <h5>Are you sure want to <strong>DELETE</strong> this product?</h5>                
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary buttonClose" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary delete-product">Yes Delete</button>
            </div>
        </div>
        </div>
    </form>
  </div>
