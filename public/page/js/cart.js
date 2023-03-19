$(function () {
    "use strict";

    /*[ Load page ]
    ===========================================================*/
    $('.js-add-to-cart').click(function () {

        let idProduct = $(this).attr('id_produt');
        let size = $('.size_product').val();
        let color = $('.color_product').val();
        let numberProdcut = $('.num-product').val();
        let url = $(this).attr('url');
        let type =  $(this).attr('type');
        let priceProduct = $('.price_product').val();
        let clothesProduct = $('.clothes_product').val();
        let nameClothes = $('.name_clothes').val();

        if (size == '' && size !== undefined) {
            swal('Thông báo', 'Vui lòng chọn size của sản phẩm', "error");
            return false;
        }

        if (color == '' && color !== undefined) {
            swal('Thông báo', 'Vui lòng chọn màu của sản phẩm', "error");
            return false;
        }
        if (clothesProduct == '' && clothesProduct !== undefined) {
            swal('Thông báo', 'Vui lòng chọn thông tin áo hoặc bộ', "error");
            return false;
        }
        if (numberProdcut <= 0) {
            swal('Thông báo', 'Số lượng sản phẩm phải lớn hơn >= 1', "error");
            return false;
        }

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            async: true,
            data: {
                id: idProduct,
                size: size,
                color: color,
                numberProdcut: numberProdcut,
                type: type,
                priceProduct: priceProduct,
                clothesProduct: clothesProduct,
                nameClothes: nameClothes
            }
        }).done(function (result) {
            if (result.status_code == 200) {
                $('.js-show-cart').attr('data-notify', result.qty);
                if (result.routeRedirect.length > 0) {
                    window.location.href = result.routeRedirect;
                } else {
                    swal(result.product_name, result.message, "success");
                }
            } else {
                swal('Thông báo', result.message, "error");
            }
        }).fail(function (XMLHttpRequest, textStatus, thrownError) {
            swal('Thông báo', 'Đã sảy ra lỗi không thể thêm sản phẩm vào giỏ hàng', "error");
        });

    })

    $('.address').on('change', function() {
        let $this = $(this);
        let $type = $this.attr('data-type');
        let $id   = $this.val();
        let $url = $('.form_payment').attr('data-url');
        if ($type && $id)
        {
            $.ajax({
                url : $url,
                type : 'post',
                dataType: 'json',
                async: true,
                data: { id : $id,type : $type}
            }).done(function (responsive) {

                if (responsive.locations)
                {
                    // if($name_form === 'update') {
                    //
                    // }

                    let html = '';
                    if($type === 'district') {
                        html = "<option value=''> Quận / Huyện </option>";
                    } else if($type === 'street') {
                        html = "<option value=''> Xã / Phường </option>";
                    }

                    $.each(responsive.locations, function(index,value){
                        html += "<option value='"+value.id+"'>"+value.loc_name+"</option>"
                    });

                    $('.'+$type).html(html);
                }
            });
        };
    });

    $('.delete-product-cart').click(function (event) {
        event.preventDefault();
        let url = $(this).attr('href');
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            async: true,
            data: {}
        }).done(function (result) {
            if (result.status_code == 200) {
                $('.js-show-cart').attr('data-notify', result.numberCart);
                $('.total_cart').text(result.totalCart)
                $('.delete_product_' + result.productCart).remove();
                swal(result.productName, result.message, "success");
            } else {
                swal(result.productName, result.message, "error");
            }
        }).fail(function (XMLHttpRequest, textStatus, thrownError) {
            swal('Thông báo', 'Đã sảy ra lỗi không thể thêm sản phẩm vào giỏ hàng', "error");
        });

    })
    $('.btn-cancel-order').click(function (event) {
        event.preventDefault();
        let url = $(this).attr('href');
        var __that = $(this);
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            async: true,
            data: {}
        }).done(function (result) {

            if (result.status_code == 200) {
                __that.parent().find('.btn-status-order').css('display', 'none');
                __that.text('Đã hủy');
                swal('Thông báo', result.message, "success");
            } else {
                swal('Thông báo', result.message, "error");
            }
        }).fail(function (XMLHttpRequest, textStatus, thrownError) {
            swal('Thông báo', 'Đã sảy ra lỗi không thể hủy đơn hang', "error");
        });
    })
    
    $('.clothes_product').change(function () {
        var idClothes = $(this).val();
        var url = $(this).attr('url');

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            async: true,
            data: { idClothes : idClothes}
        }).done(function (result) {
            if (result.code == 200) {
                $('.current-price-sale').css('display', 'none');
                $('.current-price').text(result.price_format);
                $('.price_product').val(result.price)
                $('.name_clothes').val(result.name_clothes)
            }
        }).fail(function (XMLHttpRequest, textStatus, thrownError) {
            console.log(thrownError)
        });

    })
})
