

$('document').ready(function(){
    
  fetchProducts();
  searchProduct();

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
});

  
  
    

    //Fetch all Product
    function fetchProducts(){
      $("#table-products").html('');
      $.get("/product", {}, function(data, status){
        $("#table-products").html(data);
      });
    }

    //Search Product
    function searchProduct(query = ''){
      // console.log(query);
      $("#table-products").html('');
      $.post("/product/search", {query : query}, function(data, status){
        $("#table-products").html(data);
      });

      // $.ajax({
      //   url: '/product/search/' + query,
      //   data: {query : query},
      //   method: 'get',
      //   dataType: 'json',
      //   success: function(data, status){
      //     console.log(data);
      //     $("#table-products").html('');
      //     if(status == 200){
      //       $("#table-products").html(data);
      //       // $('#totalData').text(response.totalData);
      // //     } else {
      // //       $("#table-products").html(response.message);
      // //       $('#totalData').text(response.totalData);
      // //     }
      // //   }
      //   // error: function(xhr, status, error) {
      //   //   let err = JSON.parse(xhr.responseText);
      //   //   console.log(err.message);
      //     }
      //   }
      // });
    }

    $(document).on('keyup', '#search', function(){
      let query = $(this).val();
      searchProduct(query);
    });

    //Pagination on click
    $(document).on('click', '.pagination a', function(e){
      e.preventDefault();

      var url = $(this).attr('href');  
        getProducts(url);
        window.history.pushState("", "", url);

    });

    //Get the pagination request
    function getProducts(url) {
      $.ajax({
          url : url  
      }).done(function (data) {
          $("#table-products").html(data);  
      }).fail(function () {
          alert('Articles could not be loaded.');
      });
  }

    // Button Add Product on click
    $('.buttonAddProduct').on('click', function () {
        $('#modalLabel').html('Add New Product');
        $('.modal-footer button[type=submit]').html('Save Product');
        $('.modal-footer button[type=submit]').addClass('save-product');
        $('.modal-footer button[type=submit]').removeClass('update-product');
      });
      
      // Button Edit on click
      $(document).on('click', '.buttonEditProduct', function () {
        $('#modalLabel').html('Edit Product');
        $('.modal-footer button[type=submit]').html('Update changes');
        $('.modal-footer button[type=submit]').addClass('update-product');
        $('.modal-footer button[type=submit]').removeClass('save-product');
  
        const id = $(this).data('id');
  
        $.ajax({
          url: '/product/' + id + '/edit',
          // data: {id : id},
          method: 'get',
          dataType: 'json',
          success: function(response){
            // console.log(response);
            if(response.status == 404){
              $('.errors-message').html('');
              $('.success-message').html('');
              $('.success-message').addClass('d-none');
              $('.errors-message').addClass('alert alert-danger');
              $('.errors-message').removeClass('d-none');
              $('.errors-message').text(response.message);
            } else {
              $('#id').val(id);
              $('#name').val(response.product.name);
              $('#slug').val(response.product.slug);
              $('#detail').val(response.product.detail);
              $('#stock').val(response.product.stock);
              $('#price').val(response.product.price);
            }
          }
        });
      });
    
      // Button Save Product on click
      $(document).on('click', '.save-product', function(e){
        e.preventDefault();

        const data = {
          'name': $('#name').val(),
          'slug': $('#slug').val(),
          'detail': $('#detail').val(),
          'stock': $('#stock').val(),
          'price': $('#price').val()
        }
        // console.log(data);

                
        $.ajax({
          method: 'POST',
          url: '/product',
          data: data,
          dataType: 'json',
          success: function(response){
            // console.log(response);
            if(response.status == 400){
              $('.errors-message').html('');
              $('.success-message').html('');
              $('.success-message').addClass('d-none');
              $('.errors-message').addClass('alert alert-danger');
              $('.errors-message').removeClass('d-none');
              $.each(response.errors, function(key, err_values){
                // console.log(key);
                $('.errors-message').append('<li>' + err_values + '</li>');
              });
            } else {
              $('.errors-message').html('');
              $('.errors-message').addClass('d-none');
              $('.success-message').html('');
              $('.success-message').addClass('alert alert-success');
              $('.success-message').removeClass('d-none');
              $('.success-message').text(response.message);
              $('#exampleModal').find('input').val('');
              $('#exampleModal').find('textarea').val('');
              fetchProducts();
            }
          }
        });
      });
      
      
      // Button Update Product on click
      $(document).on('click', '.update-product', function(e){
        e.preventDefault();

        const data = {
          'id': $('#id').val(),
          'name': $('#name').val(),
          'slug': $('#slug').val(),
          'detail': $('#detail').val(),
          'stock': $('#stock').val(),
          'price': $('#price').val()
        }
        // console.log(data);

                
        $.ajax({
          method: 'PUT',
          url: '/product/' + data.id,
          data: data,
          dataType: 'json',
          success: function(response){
            // console.log(response);
            if(response.status == 400){
              $('.errors-message').html('');
              $('.success-message').html('');
              $('.success-message').addClass('d-none');
              $('.errors-message').addClass('alert alert-danger');
              $('.errors-message').removeClass('d-none');
              $.each(response.errors, function(key, err_values){
                // console.log(key);
                 $('.errors-message').append('<li>' + err_values + '</li>');
              });
            } else if(response.status == 404){
              $('.errors-message').html('');
              $('.success-message').html('');
              $('.success-message').addClass('d-none');
              $('.errors-message').addClass('alert alert-danger');
              $('.errors-message').removeClass('d-none');
              $('.errors-message').text(response.message);
            } else {
              $('.errors-message').html('');
              $('.errors-message').addClass('d-none');
              $('.success-message').html('');
              $('.success-message').addClass('alert alert-success');
              $('.success-message').removeClass('d-none');
              $('.success-message').text(response.message);
              $('#exampleModal').find('input').val('');
              $('#exampleModal').find('textarea').val('');
              $('#exampleModal').modal('hide');
              fetchProducts();
            }
          }
        });
      });

      //Button Delete on click
      $(document).on('click', '.buttonDeleteProduct', function(e){
        e.preventDefault();
          
        const id = $(this).data('id');
        $('#deleteModal').modal('show');

        $.ajax({
          url: '/product/' + id + '/edit',
          data: {id : id},
          method: 'get',
          dataType: 'json',
          success: function(response){
            // console.log(response);
            if(response.status == 404){
              $('.errors-message').html('');
              $('.success-message').html('');
              $('.success-message').addClass('d-none');
              $('.errors-message').addClass('alert alert-danger');
              $('.errors-message').removeClass('d-none');
              $('.errors-message').text(response.message);
            } else {
              $('#idDelete').val(id);
              $('#nameDelete').val(response.product.name);
            }
          }
        });
      });

      // Button Delete Product on click
      $(document).on('click', '.delete-product', function(e){
        e.preventDefault();

        const data = {
          'id': $('#idDelete').val(),
          'name': $('#nameDelete').val(),
        }

                
        $.ajax({
          method: 'DELETE',
          url: '/product/' + data.id,
          data: data,
          dataType: 'json',
          success: function(response){
            // console.log(response);
            $('.errors-message').html('');
            $('.errors-message').addClass('d-none');
            $('.success-message').html('');
            $('.success-message').addClass('alert alert-success');
            $('.success-message').removeClass('d-none');
            $('.success-message').text(response.message);
            $('#deleteModal').find('input').val('');
            $('#deleteModal').modal('hide');
            fetchProducts();
          }
        });
      });

      // Button Close on click
      $(document).on('click', '.buttonClose', function(e){
        e.preventDefault();
        $('#exampleModal').find('input').val('');
        $('#exampleModal').find('textarea').val('');
        $('.errors-message').html('');
        $('.success-message').html('');
        $('.errors-message').addClass('d-none');
        $('.success-message').addClass('d-none');

      });

  


