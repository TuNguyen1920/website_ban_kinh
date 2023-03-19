var ViewedProducts = {
    init() {
        this.loadViewedProduct();
    },

    loadViewedProduct() {
        let listProduct = localStorage.getItem('productView');
        console.log()
        if (listProduct != null) {
            products = listProduct.split(',')
        } else {
            products = [];
        }

        if (typeof routeWiewedProducts !== "undefined") {
            if (products.length > 0 )
            {
                $.ajax({
                    url : routeWiewedProducts,
                    method : "POST",
                    data  : { ids : products},
                    success : function(results)
                    {
                        $('#list-viewed-products').html(results.html)
                    }
                });
            }
        }
    }
}

$(function () {
    "use strict";

    ViewedProducts.init();

    $('.load-more').click(function (event) {
        event.preventDefault();
        var url = $(this).attr('href');
        var numberPage = $(this).attr('numberPage');
        var __that = $(this);

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            async: true,
            data: { numberPage : numberPage}
        }).done(function (result) {
            __that.attr('numberPage', result.numberPage)
            $('.list-product-category').html(result.html);
            if (!result.loadMore) {
                __that.css('display', 'none');
            }
        }).fail(function (XMLHttpRequest, textStatus, thrownError) {
            swal('Thông báo', 'Không thể load thêm sản phẩm', "error");
        });
    })

    $('.product_view').click(function (event) {

        var id = $(this).attr('idproduct');
        var productView = [];

        if (localStorage.getItem('productView')) {
            var listProduct = localStorage.getItem('productView');
            productView = listProduct.split(',');
        }

        if (productView.indexOf(id) === -1) {
            productView.push(id)
        }

        localStorage.setItem('productView', productView.toString())
    })

    $('.search-product').click(function () {
        var url = window.location.href;
        if(url.indexOf('khuyen-mai') !== -1 || url.indexOf('san-pham-moi') !== -1 || url.indexOf('danh-muc') !== -1) {
            $('.form-search').attr('action', url);
        } else {
            $('.form-search').attr('action', urlSearch);
        }

    })
})

