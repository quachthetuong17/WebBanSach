
function onClickPagination(element) {
    var page = $(element).attr("page");
    $.get("/ajaxLoadProduct.php?page=" + page, (data, status) => {
        var result = '';
        if (data.data.length > 0) {
            // foreach(data->data as item)
            data.data.forEach(item => {
                var object = {
                    image: item.image,
                    name: item.name,
                    price: item.price,
                    id: item.id,
                };
                result += htmlProduct(object)
            });
            $("#ajax_product").html(result)
        }
    })

    // console.log(page);
}


function htmlProduct(object) {
    return `<div class="col-md-3 col-xs-6">
                <div class="product-item">
                    <div class="product-img">
                        <a href="#">
                            <img style="width: 100%; height: 400px" src="/assets/uploads/product/${object.image}" alt="">
                        </a>

                    </div>
                    <div class="product-details">
                        <h3>
                            <a class="product-title" href="/detail.php?product_id=${object.id}"><span style="font-weight:  bold !important;color: black;font-size: 19px">${object.name}</span></a>
                        </h3>
                        <span class="price">
                  
                  <ins>
                    <span class="ammount">${object.price}</span>
                  </ins>
                </span>
                    </div>
                </div>
            </div>`
}





//plus quantity in product detail
function updateCard() {
    if (localStorage.getItem("cart")) {
        var carts = JSON.parse(localStorage.getItem('cart'));
        var count_cart = 0;
        var count_total = 0;
        var result_item = '';

        carts.forEach(item => {
            count_cart += parseInt(item.quantity);
            result_item+=htmlCartItem(item);
            count_total+=parseInt(item.price)*parseInt(item.quantity);
        });

        $('#cart_count').html(count_cart);
        $('#cart_result').html(result_item);
        $('#cart_total').html(formatter.format(count_total));
    }
}

function htmlCartItem(object) {
    return `   <div class="nav-cart-item clearfix">
                                                <div class="nav-cart-img">
                                                    <a href="#">
                                                        <img style="width: 30px;height: 30px" src="/assets/uploads/product/${object.image}" alt="">
                                                    </a>
                                                </div>
                                                <div class="nav-cart-title">
                                                    <a href="#">
                                                        ${object.name}
                                                    </a>
                                                    <div class="nav-cart-price">
                                                        <span>${object.quantity} x</span>
                                                        <span>${formatter.format(object.price)}</span>
                                                    </div>
                                                </div>
                                                <div class="nav-cart-remove">
                                                    <a href="#"><i class="icon icon_close"></i></a>
                                                </div>
                                            </div>
`;
}



