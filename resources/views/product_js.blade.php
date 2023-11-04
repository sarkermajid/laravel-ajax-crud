<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function() {

        // add product and error validation view

        $(document).on('click', '.add_product', function(e){
            e.preventDefault();
            let name    = $('#name').val();
            let price   = $('#price').val();
            console.log(name, price);

            $.ajax({
                url: "{{ route('add.product') }}",
                method: 'post',
                data: { name: name, price: price},
                success:function(res){
                    if(res.status == 'success'){
                        $('#addModal').modal('hide');
                        $('#addProductForm')[0].reset();
                        $('.table').load(location.href+' .table');
                        Command: toastr["success"]("Product Added successfully")
                            toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                            }
                    }
                },
                error:function(err){
                    let error = err.responseJSON;
                    $.each(error.errors,function(key,val){
                        $('.errMsg').append('<span class="text-danger">'+val+'</span>'+'</br>')})
                }
            })
        })

        // show update product value

        $(document).on('click','.update_product_form',function(e){
            let id = $(this).data('id');
            let name = $(this).data('name');
            let price = $(this).data('price');

            $('#update_id').val(id);
            $('#update_name').val(name);
            $('#update_price').val(price);
        })

        // update product form

        $(document).on('click', '.update_product', function(e){
            e.preventDefault();
            let update_id      = $('#update_id').val();
            let update_name    = $('#update_name').val();
            let update_price   = $('#update_price').val();

            $.ajax({
                url: "{{ route('update.product') }}",
                method: 'post',
                data: { update_id:update_id, update_name: update_name, update_price: update_price},
                success:function(res){
                    if(res.status == 'success'){
                        $('#updateModal').modal('hide');
                        $('#updateProductForm')[0].reset();
                        $('.table').load(location.href+' .table');
                        Command: toastr["success"]("Product Updated successfully")
                            toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                            }
                    }
                },
                error:function(err){
                    let error = err.responseJSON;
                    $.each(error.errors,function(key,val){
                        $('.errMsg').append('<span class="text-danger">'+val+'</span>'+'</br>')})
                }
            })
        })

        // Delete product

        $(document).on('click', '.delete-product', function(e){
            e.preventDefault();
            let product_id      = $(this).data('id');
            if(confirm('Are you sure you want to delete this product ?')){
                $.ajax({
                    url: "{{ route('delete.product') }}",
                    method: 'post',
                    data: { product_id:product_id},
                    success:function(res){
                        if(res.status == 'success'){
                            $('.table').load(location.href+' .table');
                            Command: toastr["error"]("Product Deleted successfully")
                            toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                            }
                        }
                    },
                })
            }
        })

        // ajax Pagination

        $(document).on('click','.pagination a', function (e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            product(page);
        })

        function product(page){
            $.ajax({
                url: '/pagination/paginate-data?page='+page,
                success:function(res){
                    $('.table-data').html(res);
                }
            })
        }

        // product search with ajax

        $(document).on('keyup',function(e){
            e.preventDefault();
            let search = $('#search').val();
            console.log(search);
            $.ajax({
                'url': '{{ route('search.product') }}',
                'method': 'GET',
                'data': {search:search},
                success:function(res){
                    $('.table-data').html(res);
                    if(res.status == 'nothing_found'){
                        $('.table-data').html('<span class="text-danger">'+ 'Nothing Found' + '</span>')
                    }
                }
            })
        })
})
</script>
