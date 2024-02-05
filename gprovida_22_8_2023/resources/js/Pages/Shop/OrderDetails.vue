<template>
    <div class="page-wrapper">
        <Head :title="`Order ${auth.user.username}`" />
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Products</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-user-circle"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Orders</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->


            <div v-if="$page.props.flash.success" class="alert alert-success" role="alert">
                {{ $page.props.flash.success }}
            </div>
            <div v-if="$page.props.flash.error" class="alert alert-danger" role="alert">
                {{ $page.props.flash.error }}
            </div>
            <div class="row">
                <div class="col-xl-5">
                    <div class="card border-primary border-bottom border-3 border-0">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Order</h5>
                            <hr/>

                            <dl class="row">
                                <dt class="col-sm-4 mb-3">orderRef:</dt>
                                <dd class="col-sm-8 mb-3">{{order.orderRef}} </dd>
                                <dt class="col-sm-4 mb-3">Status</dt>
                                <dd class="col-sm-8 mb-3">{{order.status_order}}</dd>

                                <dt class="col-sm-4 mb-3">Payment Method</dt>
                                <dd class="col-sm-8 mb-3"> {{order.payment_method }}</dd>
                                <dt class="col-sm-4 mb-3">Payment Status</dt>
                                <dd class="col-sm-8 mb-3">{{order.payment_status}} </dd>
                                <dt class="col-sm-4 mb-3">Total Sales:</dt>
                                <dd class="col-sm-8 mb-3">{{order.total_sales}} </dd>
                                <dt class="col-sm-4 mb-3">Shipping Cost:</dt>
                                <dd class="col-sm-8 mb-3">{{order.total_shipping}} </dd>
                                <dt class="col-sm-4 mb-3">Total:</dt>
                                <dd class="col-sm-8 mb-3">{{order.net_total}} </dd>
                            </dl>

                        </div>
                    </div>
                </div>
                <div class="col-xl-7">
                    <div class="card border-primary border-bottom border-3 border-0">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Items</h5>
                            <hr/>
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Name</th>
                                            <th>Item Price</th>
                                            <th>Quantity</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <tr v-for="item in order.items">
                                        <td width="40%">{{item.name}}</td>
                                        <td>{{order.currency.prefix}}{{item.amount.toLocaleString()}}</td>
                                        <td>{{item.qty}}</td>
                                        <td>{{order.currency.prefix}}{{item.total.toLocaleString()}}</td>
                                    </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-5">
                    <div class="card border-primary border-bottom border-3 border-0">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Store</h5>
                            <hr/>
                            <dl class="row">
                                <dt class="col-sm-3 mb-3"> <h6 class="card-title text-primary">{{order.store.name}}</h6></dt>
                                <dd class="col-sm-9 mb-3"></dd>

                                <dt class="col-sm-3 mb-3">Description:</dt>
                                <dd class="col-sm-9 mb-3">{{order.store.description}} </dd>

                                <dt class="col-sm-3 mb-3">Address</dt>
                                <dd class="col-sm-9 mb-3">
                                    {{order.store.address}}  {{order.store.address2 }}
                                </dd>
                                <dd class="col-sm-3 mb-3"></dd>
                                <dd class="col-sm-9 mb-3">
                                    {{order.store.city}}  {{order.store.state }},
                                </dd>
                                <dd class="col-sm-3 mb-3"></dd>
                                <dd class="col-sm-9 mb-3">
                                   {{order.store.country}}
                                </dd>

                                <dt class="col-sm-3 mb-3">Phone:</dt>
                                <dd class="col-sm-9 mb-3">{{order.store.phone}} </dd>
                                <dt class="col-sm-3 mb-3">Email:</dt>
                                <dd class="col-sm-9 mb-3">{{order.store.email}} </dd>
                                <dt class="col-sm-3 mb-3">Website:</dt>
                                <dd class="col-sm-9 mb-3">{{order.store.website}} </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7">
                    <div class="card border-primary border-bottom border-3 border-0">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Order By</h5>
                            <hr/>
                            <dl class="row">
                                <dd class="col-sm-3 mb-3">
                                    <h6 class="card-title text-primary">
                                        {{order.owner.firstname}}{{order.owner.lastname}}
                                    </h6>
                                </dd>
                                <dd class="col-sm-9 mb-3"></dd>
                                <dt class="col-sm-2 mb-3">Username:</dt>
                                <dd class="col-sm-9 mb-3">{{order.owner.username}} </dd>
                                <dt class="col-sm-2 mb-3">Address</dt>
                                <dd class="col-sm-9 mb-3">
                                    {{order.owner.address}}  {{order.owner.address2 }}
                                </dd>
                                <dd class="col-sm-2 mb-3"></dd>
                                <dd class="col-sm-9 mb-3">
                                    {{order.owner.city}}  {{order.owner.state }},
                                </dd>
                                <dd class="col-sm-2 mb-3"></dd>
                                <dd class="col-sm-9 mb-3">
                                    {{order.owner.country}}
                                </dd>
                                <dt class="col-sm-2 mb-3">Phone:</dt>
                                <dd class="col-sm-9 mb-3">{{order.owner.phone}} </dd>
                                <dt class="col-sm-2 mb-3">Email:</dt>
                                <dd class="col-sm-9 mb-3">{{order.owner.email}} </dd>
                                <dt class="col-sm-2 mb-3">gender:</dt>
                                <dd class="col-sm-9 mb-3">{{order.owner.gender}} </dd>
                            </dl>

                        </div>
                    </div>
                </div>
            </div>




        </div>
    </div>
</template>


<script>
import DefaultLayout from '@/Layouts/DefaultLayout.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'
export default {
    name: "Order Detail",
    components: {
        Head,
        Link,
    },
    layout: DefaultLayout,
    props: {
        auth: Object,
        errors: Object,
        flash: Object,
        order: Object,
    },
    remember: 'form',
    data() {
        return {

        }
    },

    methods: {

    },



}

</script>



<style scoped>

</style>
