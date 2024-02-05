<template>
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div v-if="cartSessionLength>0" class="col-lg-3 col-xl-2">
                                    <a href="#" class="btn btn-primary mb-3 mb-lg-0" @click="checkout">
                                        <i class='bx bxs-plus-square'></i>Checkout
                                    </a>
                                </div>
                                <div class="col-lg-9 col-xl-10">
                                    <form class="float-lg-end">
                                        <div class="row row-cols-lg-auto g-2">
                                            <div class="col-12">
                                                <div class="position-relative">
                                                    <input type="text" class="form-control ps-5" placeholder="Search Product...">
                                                    <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                                    <button type="button" class="btn btn-white">Sort By</button>
                                                    <div class="btn-group" role="group">
                                                        <button id="btnGroupDrop1" type="button" class="btn btn-white dropdown-toggle dropdown-toggle-nocaret px-1" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class='bx bx-chevron-down'></i>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                            <li><a class="dropdown-item" href="#" @click="sortProductBy(price)">Price</a></li>
                                                            <li><a class="dropdown-item" href="#" @click="sortProductBy(rating)">Rating</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                                    <button type="button" class="btn btn-white">Product Category</button>
                                                    <div class="btn-group" role="group">
                                                        <button id="btnGroupDrop1b" type="button" class="btn btn-white dropdown-toggle dropdown-toggle-nocaret px-1" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class='bx bxs-category'></i>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                            <li v-for="category in categories">
                                                                <a class="dropdown-item" href="#" @click="filterCategory(category.id)">
                                                                    {{category.name}}
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5 product-grid">
                <div class="col" v-for="product in products">
                    <div class="card" @click="addToCart(product.id, product.name, product.category.id,  product.price)">
                        <img :src="product.image_url" class="card-img-top img-rounded product-image"
                             :alt="product.name"  @load="setheight" :style="{ height: imageHeight + 'px' }">
                        <div class="card-body">
                            <h6 class="card-title cursor-pointer">{{ product.name}}</h6>
                            <div class="clearfix">
                                <p class="mb-0 float-start fw-bold">
                                    <span>
                                        <template v-for="priceItem in product.price">
                                            <template v-if="priceItem.currency_id == this.user.currency_id">
                                                {{priceItem.currency.prefix}}{{priceItem.price.toLocaleString()}}
                                            </template>
                                        </template>
                                    </span>
                                </p>
                            </div>
                            <div class="d-flex align-items-center mt-3 fs-6">
                                <div class="cursor-pointer">
                                    <i class='bx bxs-star text-warning'></i>
                                    <i class='bx bxs-star text-warning'></i>
                                    <i class='bx bxs-star text-warning'></i>
                                    <i class='bx bxs-star text-warning'></i>
                                    <i class='bx bxs-star text-secondary'></i>
                                </div>
                                <p class="mb-0 ms-auto">4.2(182)</p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <!--end row-->
        </div>

    </div>
</template>

<script>
import DefaultLayout from '@/Layouts/DefaultLayout.vue'
export default {
    name: "Order",
    metaInfo: { title: 'Shop' },
    layout: DefaultLayout,
    props: {
        auth: Object,
        errors: Object,
        categories: Object,
        products:Object,
        user:Object,
        cartSession:Object,
        cartSessionLength:String,
    },
    data() {
        return {
            selectedItem: {
                id: null,
                name: null,
                category:null,
                price: null,
                qty: null,
                discountedAmount:null,
                discountType:null
            },
            cart:this.cartSession,
            imageHeight: null
        }
    },
    methods: {
        filterCategory(id){
            console.log(id)
        },

        getPriceInUserCurrency(priceItem){
            return priceItem.currency_id == this.user.currency_id;
        },
        addToCart(id, name,  categoryId, priceArray){
            this.$inertia.visit('/order/product', {
                method: 'post',
                data: {
                    id: id,
                    name: name,
                    categoryId: categoryId,
                },
            })

            this.selectedItem.id=id
            this.selectedItem.name=name
            this.selectedItem.category = categoryId,
            this.selectedItem.qty = 1,
            this.selectedItem.price=priceArray.filter(this.getPriceInUserCurrency).price
            this.selectedItem.discountedAmount=0
            this.selectedItem.discountType=''

            if(this.selectedItem.id != null){
                let index = this.cart.findIndex(x => x.name==this.selectedItem.name);
                if(index === -1){
                    this.cart.push({...this.selectedItem})
                }else{
                   this.cart[index].qty++
                }
                this.clearBasket()
            }
        },
        clearBasket(){
            this.selectedItem.type=null,
            this.selectedItem.id=null,
            this.selectedItem.category=null,
            this.selectedItem.qty=null,
            this.selectedItem.name=null,
            this.selectedItem.price=null,
            this.selectedItem.discountedAmount=null,
            this.selectedItem.discountType=null
        },

        store() {
            this.form.postCart = JSON.stringify(this.cart)
            this.form.post(this.route('order.store'))
        },
        checkout(){
            this.$inertia.visit('/order/cart', {
                method: 'get',
                data: {
                },
            })
        },

        setheight(event){
            let image = event.target;
            this.imageHeight = image.clientWidth;
        }
    },

}

</script>

<style scoped>
    .product-image{
        width: 100% !important;
        overflow: hidden;
        padding: 0px !important;
    }

</style>
