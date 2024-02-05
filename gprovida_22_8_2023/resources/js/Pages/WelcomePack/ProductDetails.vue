<template>
    <div class="page-wrapper">
        <div class="page-content">

            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Shop Online</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Products Details</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">

                </div>
            </div>
            <!--end breadcrumb-->


            <div class="row">
                <div class="col-xl-12">
                    <div v-if="errors.length>0" class="alert alert-danger" role="alert">
                        <p v-for="error in errors">
                            {{ error }}
                        </p>
                    </div>

                    <div v-if="$page.props.flash.success" class="alert alert-success" role="alert">
                        {{ $page.props.flash.success }}
                    </div>
                    <div v-if="$page.props.flash.error" class="alert alert-danger" role="alert">
                        {{ $page.props.flash.error }}
                    </div>


                </div>
            </div>


            <div class="card">
                <div class="row g-0">

                    <div class="col-md-4 border-end">
                        <img :src="this.imageFeatured" class="img-fluid product-image"
                             :alt="product.name"  @load="setheight" :style="{ height: imageHeight + 'px' }" >
                        <div class="row mb-3 row-cols-auto g-2 justify-content-center mt-3">
                            <div class="col">
                                <img :src="product.image_url" width="70" height="70" @click="loadImage(product.image_url)"
                                     class="border rounded cursor-pointer" alt="">
                            </div>

                            <div class="col" v-for="image in product.images">
                                <img :src="image.url" width="70" height="70" @click="loadImage(image.url)"
                                     class="border rounded cursor-pointer" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h4 class="card-title">{{product.name}}</h4>
                            <div class="d-flex gap-3 py-3">
                                <div class="cursor-pointer">
                                    <i class='bx bxs-star text-warning'></i>
                                    <i class='bx bxs-star text-warning'></i>
                                    <i class='bx bxs-star text-warning'></i>
                                    <i class='bx bxs-star text-warning'></i>
                                    <i class='bx bxs-star text-secondary'></i>
                                </div>
                                <div>20 reviews</div>
                            </div>
                            <div class="mb-3">
                                <template v-for="priceItem in product.price">
                                    <span v-if="priceItem.currency_id == this.user.currency_id" class="price h4">
                                        {{priceItem.currency.prefix}}{{priceItem.price.toLocaleString()}}
                                    </span>
                                </template>
                            </div>
                            <p class="card-text fs-6">{{product.desc}}</p>
                            <dl class="row">
                                <dt class="col-sm-3">Model#</dt>
                                <dd class="col-sm-9">{{product.sku}}</dd>

                                <dt class="col-sm-3">PV#</dt>
                                <dd class="col-sm-9">{{product.pv}}</dd>

                                <dt class="col-sm-3">Category</dt>
                                <dd class="col-sm-9">{{product.category.name}}</dd>
                            </dl>
                            <hr>
                            <div class="row row-cols-auto row-cols-1 row-cols-md-3 align-items-center">
                                <div class="col">
                                    <label class="form-label">Quantity</label>
                                    <div class="input-group input-spinner">
                                        <button class="btn btn-white" type="button" id="button-plus" @click="incrementQty"> + </button>
                                        <input type="text" class="form-control" v-model="form.qty">
                                        <button class="btn btn-white" type="button" id="button-minus" @click="decrementQty"> − </button>
                                    </div>
                                </div>

                            </div>
                            <div class="d-flex gap-3 mt-3">
                                <a href="#" class="btn btn-primary" @click="buyNow()">
                                    <span class="text">Buy Now</span>
                                    <i class='bx bxs-cart-alt'></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="card-body">
                    <ul class="nav nav-tabs nav-primary mb-0" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#primaryDesc" role="tab" aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-comment-detail font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title"> Product Description </div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#primaryTags" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-bookmark-alt font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">Tags</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#primaryReview" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-star font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">Reviews</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content pt-3">
                        <div class="tab-pane fade show active" id="primaryDesc" role="tabpanel">
                             {{ product.desc }}
                        </div>
                        <div class="tab-pane fade" id="primaryTags" role="tabpanel">
                            <p></p>
                        </div>
                        <div class="tab-pane fade" id="primaryReview" role="tabpanel">
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>


            <h6 class="text-uppercase mb-0">Related Product</h6>
            <hr/>
            <div class="row row-cols-1 row-cols-lg-3">
                <div class="col" v-for="similarProduct in similarProducts">
                    <div class="card"  @click="addToCart(similarProduct.id, similarProduct.name, similarProduct.category_id)">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img :src="similarProduct.image_url" class="similar-product-image"
                                     :alt="similarProduct.name" width="150" height="150" >
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h6 class="card-title">{{similarProduct.name}}</h6>
                                    <div class="cursor-pointer my-2">
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-secondary"></i>
                                    </div>
                                    <div class="clearfix">
                                        <p class="mb-0 float-start fw-bold">
                                            <template v-for="priceItem in similarProduct.price">
                                                <span v-if="priceItem.currency_id == this.user.currency_id">
                                                    {{priceItem.currency.prefix}}{{priceItem.price.toLocaleString()}}
                                                </span>
                                            </template>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</template>

<script>
import DefaultLayout from '@/Layouts/DefaultLayout.vue'
export default {
    name: "OrderProductDetails",
    layout: DefaultLayout,
    props: {
        auth: Object,
        errors: Object,
        categories: Object,
        pageTitle: String,
        product:Object,
        similarProducts:Object,
        userPriceCurrency:Object,
        user:Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                qty: 1,
                productId: this.product.id,
                price: this.userPriceCurrency[0].price,
                priceCurrencyId: this.userPriceCurrency[0].currency_id,
            }),
            imageHeight: null,
            imageFeatured:this.product.image_url,
        }
    },

    methods: {
        filterCategory(id){
            console.log(id)
        },

        addToCart(id, name,  categoryId) {
            this.$inertia.visit('/welcomepack/product', {
                method: 'post',
                data: {
                    id: id,
                    name: name,
                    categoryId: categoryId,
                },
            })
        },


        incrementQty(){
            this.form.qty++
        },
        decrementQty(){
            if(this.form.qty>1){
                this.form.qty--
            }
        },

        buyNow(){
            this.form.post(this.route('welcomepack.save'))
        },


        setheight(event){
            let image = event.target;
            this.imageHeight = image.clientWidth;
        },
        loadImage(url){
            this.imageFeatured = url
        }
    },

}

</script>

<style scoped>
.product-image{
    width: 98%;
    overflow: hidden;
    padding: 40px;
}

.similar-product-image{
    width: 98%;
    overflow: hidden;
}
</style>
