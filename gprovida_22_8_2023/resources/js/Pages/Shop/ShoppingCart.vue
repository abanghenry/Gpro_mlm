<template>
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Shopping Cart</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">

                </div>
            </div>
            <!--end breadcrumb-->

            <div class="row">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body border-primary border-bottom border-3 border-0">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="table-light">
                                    <tr>
                                        <th>Items Details</th>
                                        <th>Quantity</th>
                                        <th>Item Price</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>


                                    <tr v-for="item in cart">
                                        <td width="40%">{{item.productName}}</td>
                                        <td>{{item.productqty}}</td>
                                        <td>
                                            <strong>{{currency.prefix}}{{item.productAmount.toLocaleString()}}</strong>
                                            <p>{{currency.prefix}}{{item.productPrice.toLocaleString()}} * {{item.productqty}}</p>
                                        </td>
                                        <td style="text-align: right">
                                            <div class="d-flex order-actions" @click="deleteFromCart(item.productId)">
                                                <a href="javascript:;" class="ms-3"><i class='bx bxs-trash'></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body border-primary border-bottom border-3 border-0">
                            <div class="d-flex align-items-center gap-2">
                                <a href="javascript:;" class="btn btn-primary" @click="continueShopping">
                                    Continue To Shopping
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card border-primary border-bottom border-3 border-0">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Order Summary</h5>
                            <hr/>
                            <dl class="row">
                                <dd class="col-sm-6 mb-3">No. Of Items</dd>
                                <dd class="col-sm-6 mb-3">{{itemCount.toLocaleString()}}</dd>

                                <dd class="col-sm-6 mb-3">Delivery Charges:</dd>
                                <dd class="col-sm-6 mb-3"> </dd>

                                <dd class="col-sm-6 mb-3">Sub Total</dd>
                                <dd class="col-sm-6 mb-3">
                                    <strong>{{currency.prefix}} {{ totalAmount.toLocaleString() }}</strong>
                                </dd>

                                <dt class="col-sm-6 mb-3">Total</dt>
                                <dd class="col-sm-6 mb-3">
                                    <strong>{{currency.prefix}} {{ totalAmount.toLocaleString() }}</strong>
                                </dd>
                            </dl>

                            <div class="d-flex align-items-center gap-2 mb-3 mt-2">
                                <select class="form-select" v-model="form.selectedStore" required @change="showStoreDetails">
                                    <option value="">Select Store </option>
                                    <option v-for="store in stores" :value="store.id">{{ store.name }}</option>
                                </select>
                            </div>
                            <h6 class="card-title text-primary">{{selectedStoreName}}</h6>
                            <p class="card-text">{{selectedStoreAddress}}  {{selectedStoreCityState}}  {{selectedStoreCountry}} </p>
                            <p>{{selectedStorePhone}} <br/> {{selectedStoreEmail}} </p>
                            <hr>
                            <div class="d-flex align-items-center gap-2">
                                <select class="form-select" v-model="form.paymentMethod" required>
                                    <option value="">Select Payment Method</option>
                                    <option value="bank">Bank Transfer</option>
                                </select>
                            </div>
                            <hr>
                            <div class="d-flex align-items-center gap-2">
                                <a href="javascript:;" class="btn btn-primary" style="width: 100%" @click="store">
                                    Checkout
                                </a>
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
    name: "ShoppingCart",
    layout: DefaultLayout,
    props: {
        auth: Object,
        errors: Object,
        categories: Object,
        pageTitle: String,
        cart:Object,
        currency:Object,
        user:Object,
        stores:Object,
        totalAmount:String,
        itemCount:String,
    },

    data() {
        return {
            form: this.$inertia.form({
                cartItems: this.cart.lenght,
                selectedStore:'',
                paymentMethod:''
            }),
            imageHeight: null,
            selectedStoreName:'',
            selectedStoreDesc:'',
            selectedStoreAddress:'',
            selectedStoreCityState:'',
            selectedStoreCountry:'',
            selectedStorePhone:'',
            selectedStoreEmail:'',
        }
    },

    methods: {
        filterCategory(id){
            console.log(id)
        },
        incrementQty(){
            this.form.qty++
        },
        decrementQty(){
            if(this.form.qty>1){
                this.form.qty--
            }
        },

        showStoreDetails(event){
            let index = this.stores.findIndex(x => x.id==event.target.value);
            if(index>-1){
                this.selectedStoreName      = this.stores[index].name;
                this.selectedStoreDesc      = this.stores[index].description;
                this.selectedStoreAddress   = this.stores[index].address+" "+this.stores[index].address2;
                this.selectedStoreCityState = this.stores[index].city+", "+this.stores[index].state;
                this.selectedStoreCountry   = this.stores[index].country;
                this.selectedStorePhone     = this.stores[index].phone;
                this.selectedStoreEmail     = this.stores[index].email;
            }else{
                this.selectedStoreName='';
                this.selectedStoreDesc='';
                this.selectedStoreAddress='';
                this.selectedStoreCityState='';
                this.selectedStoreCountry='';
                this.selectedStorePhone='';
                this.selectedStoreEmail='';
            }

            if(index === -1){
                this.selectedItem.discountedAmount =this.discountAmount
                this.selectedItem.discountType =this.discountSelect
                this.cart.push({...this.selectedItem})
                console.log(this.cart)
            }



        },
        continueShopping(){
            this.$inertia.visit('/order', {
                method: 'get',
                data: {
                },
            })
        },
        deleteFromCart(id){
            this.$inertia.visit('/order/delete', {
                method: 'delete',
                data: {
                    id: id,
                },
            })
        },
        store() {
            if(this.form.selectedStore==''){
                alert('Select Pickup Store')
                return false
            }
            if(this.form.paymentMethod==''){
                alert('Select Payment method')
                return false
            }
            this.form.postCart = JSON.stringify(this.cart)
            this.form.post(this.route('order.store'))
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

<style>

</style>
