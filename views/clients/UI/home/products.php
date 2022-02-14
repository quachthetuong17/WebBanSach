<!-- New Arrivals -->
<section class="section-wrap new-arrivals pb-40">
    <div class="container">

        <div class="row heading-row">
            <div class="col-md-12 text-center">
                <h2 class="heading uppercase"><small>New Arrivals</small></h2>
            </div>
        </div>

        <div class="row row-10">

        <div id="ajax_product">

            <?php foreach ($dataSendView['product'] as $item): ?>
                <div class="col-md-3 col-xs-6" id="product_<?= $item->id ?>">
                    <input type="hidden" id="product_id_home" value="<?= $item->id ?>" />
                    <input type="hidden" id="product_name_home" value="<?= $item->name ?>" />
                    <input type="hidden" id="product_price_home" value="<?= $item->price ?>" />
                    <input type="hidden" id="product_image_home" value="<?= $item->image ?>" />
                    <div class="product-item">
                        <div class="product-img">
                            <a href="/detail.php?product_id=<?php echo $item->id ?>">
                                <img style="width: 100%; height: 400px" src="/assets/uploads/product/<?php echo $item->image ?>" alt="">
                            </a>

                        </div>
                        <div class="product-details">
                            <h3>
                                <a class="product-title"  href="/detail.php?product_id=<?php echo $item->id ?>"><span style="font-weight:  bold !important;color: black;font-size: 19px" ><?php echo $item->name ?></span></a>
                            </h3>
                            <span class="price">

                  <ins>
                    <span class="ammount"><?php echo number_format($item->price) ?></span>
                  </ins>
                </span>

                        </div>
                        <a product_id="<?= $item->id ?>" style="width: 100%;" onclick="addToCard(<?= $item->id ?>)" class="btn btn-color btn-lg add-to-cart left"><span>Add to Cart</span></a>
                        <div class="quantity buttons_added">
                            <input id="product_decrement_home" type="button" value="-" class="minus"><input id="product_quantity_home" type="number" step="1" min="0" value="1" title="Qty" class="input-text qty text"><input id="product_increment_home" type="button" value="+" class="plus">
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
<script>
    $(document).ready(function(){
        $('#product_decrement_home').click(e=>{
            var current_quantity = $('#product_quantity_home').val();

            if(current_quantity > 1){
                current_quantity--;
                $('#product_quantity_home').attr('value',current_quantity)
            }
        });
        $('#product_increment_home').click(e=>{
            var current_quantity = $('#product_quantity_home').val();
            if(current_quantity >= 1){
                current_quantity++;
                $('#product_quantity_home').attr('value',current_quantity)
            }
        });
        $('#add_to_card').click(e=>{


        });
    })
    function addToCard(id) {

        // var id_btn = $('#add_to_card').attr('product_id');
        var product_name =$(`#product_${id}>#product_name_home`).val();
        var product_id =$(`#product_${id}>#product_id_home`).val();
        var product_price =$(`#product_${id}>#product_price_home`).val();
        var product_quantity =$(`#product_${id}   [id^=product_quantity_home]`).val();
        var product_image =$(`#product_${id}>#product_image_home`).val();

        var cart = [];
        //khoi dau localStorage
        var cart_object = {
            id:product_id,
            name:product_name,
            price:parseInt(product_price),
            quantity:parseInt(product_quantity),
            image:product_image
        };

        console.log(cart_object)
        cart.push(cart_object);
        if(localStorage.getItem("cart")){
            var carts = JSON.parse(localStorage.getItem('cart'));
            var item = carts.find(x=>x.id == cart_object.id);
            if(item){
                var cart_quantity = item.quantity + cart_object.quantity;
                item.quantity=  cart_quantity ;
            }else{
                carts.push(cart_object)
            }

            localStorage.setItem("cart",JSON.stringify(carts));
        }else{
            localStorage.setItem("cart",JSON.stringify(cart));
        }

        updateCard();
    }
</script>




        </div> <!-- end row -->
        <?php for ($i=1;$i<=$dataSendView['total_page'];$i++) { ?>
            <button
                    onclick="onClickPagination(this)"
               id="btn_pagination"
               page="<?= $i ?>"
               type="button"
               style="color:white"
               class="btn btn-primary">
                <?php echo $i; ?>
            </button>
        <?php }?>
    </div>

</section> <!-- end new arrivals -->



<script>



</script>