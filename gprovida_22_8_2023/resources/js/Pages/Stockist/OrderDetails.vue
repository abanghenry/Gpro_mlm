<template>
    <div className="page-wrapper">
        <Head :title="`Order for  ${transaction.user.firstname} ${transaction.user.lastname}`"/>
        <div className="page-content">
            <!--breadcrumb-->
            <div className="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div className="breadcrumb-title pe-3">Transaction</div>
                <div className="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol className="breadcrumb mb-0 p-0">
                            <li className="breadcrumb-item"><a href="javascript:;"><i className="bx bx-user-circle"></i></a>
                            </li>
                            <li className="breadcrumb-item active" aria-current="page">{{ transaction.user.username }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div className="row">
                <div className="col-xl-12">
                    <div v-if="$page.props.flash.success" className="alert alert-success" role="alert">
                        {{ $page.props.flash.success }}
                    </div>
                    <div v-if="$page.props.flash.error" className="alert alert-danger" role="alert">
                        {{ $page.props.flash.error }}
                    </div>


                    <div className="card border-top border-0 border-4 border-primary">
                        <div className="card-body p-4">
                            <div className="card-title d-flex align-items-center">
                                <div>
                                    <i className="bx bx-lock me-1 font-22 text-primary"></i>
                                </div>
                                <h5 className="mb-0 text-primary">User Orders</h5>
                            </div>
                            <hr>

                                <div class="table-responsive">
                                    <br/>
                                    <table class="table table-bordered">
                                        <thead class="table-light">
                                            <tr>
                                                <th colspan="3">Order For {{transaction.owner.firstname}}  {{transaction.owner.lastname}} ( {{transaction.owner.username}} )</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><b>Ordered By</b></td>
                                                <td colspan="2">
                                                    {{transaction.user.firstname}}
                                                    {{transaction.user.lastname}}
                                                    ( {{transaction.user.username}} )
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"> &nbsp</td>
                                            </tr>
                                            <tr>
                                                <td><b>Order Ref</b></td><td><strong>No of Items</strong></td><td><b>Order Status</b></td>
                                            </tr>
                                            <tr>
                                                <td>{{transaction.orderRef}}</td>
                                                <td>{{transaction.number_of_items}}</td>
                                                <td>
                                                    <span v-if="transaction.status_order=='pending'" class="badge bg-gradient-blooker text-white shadow-sm w-100">
                                                        pending
                                                    </span>
                                                    <span v-else-if="transaction.status_order=='processing'" class="badge bg-gradient-deepblue text-white shadow-sm w-100">
                                                        processing
                                                    </span>
                                                        <span v-else-if="transaction.status_order=='shipped'" class="badge bg-gradient-quepal text-white shadow-sm w-100">
                                                        shipped
                                                    </span>
                                                    <span v-else-if="transaction.status_order=='cancelled'" class="badge bg-gradient-bloody text-white shadow-sm w-100">
                                                        cancelled
                                                    </span>
                                                    <span v-else-if="transaction.status_order=='fraud'" class="badge bg-gradient-ibiza text-white shadow-sm w-100">
                                                        fraud
                                                    </span>
                                                    <span v-else class="badge bg-gradient-moonlit text-white shadow-sm w-100">
                                                        {{ transaction.status_order }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Currency</b></td><td><strong>Amount</strong></td><td><b>Payment Status</b></td>
                                            </tr>
                                            <tr>
                                                <td>{{transaction.currency.code}}</td>
                                                <td>{{transaction.net_total}}</td>
                                                <td>
                                                    <span v-if="transaction.payment_status=='pending'" class="badge bg-warning">{{ transaction.payment_status  }}</span>
                                                    <span v-else-if="transaction.payment_status=='paid'" class="badge  bg-success">{{ transaction.payment_status  }}</span>
                                                    <span v-else-if="transaction.payment_status=='cancelled'" class="badge  bg-default">{{ transaction.payment_status  }}</span>
                                                    <span v-else-if="transaction.payment_status=='fraud'" class="badge bg-danger">{{ transaction.payment_status  }}</span>
                                                    <span v-else class="badge bg-warning">{{ transaction.payment_status  }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"> &nbsp</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"><b>Store</b> </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">{{transaction.store.name}} <br/> </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" >
                                                    {{transaction.store.address}}, <br/> {{transaction.store.address2}}  <br/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Country</b></td>
                                                <td><strong>State</strong></td>
                                                <td><b>City</b></td>
                                            </tr>
                                            <tr>
                                                <td>{{transaction.store.country}}</td>
                                                <td>{{transaction.store.state}}</td>
                                                <td>{{transaction.store.city}} </td>
                                            </tr>
                                            <tr><td><b>phone</b></td><td><strong>Email</strong></td><td><b>Website</b></td></tr>
                                            <tr>
                                                <td>{{transaction.store.phone}}</td>
                                                <td>{{transaction.store.email}} </td>
                                                <td>{{transaction.store.website}} </td>
                                            </tr>
                                            <tr><td colspan="3"> &nbsp</td></tr>
                                            <tr><td colspan="3"><b>Items</b></td></tr>
                                            <tr>
                                                <td><b>Product Name</b></td>
                                                <td><b>Qty*Amount</b></td>
                                                <td><b>Total</b></td>
                                            </tr>
                                            <tr v-for="items in transaction.items" :key="items.id">
                                                <td>{{items.name}}</td>
                                                <td>{{items.qty}} * {{items.amount}}</td>
                                                <td>{{items.total}}</td>
                                            </tr>
                                            <tr><td></td><td></td>
                                                <td>
                                                    <b>
                                                        {{ transaction.currency.prefix }}{{ transaction.net_total.toLocaleString() }}
                                                    </b>
                                                </td>
                                            </tr>
                                            <tr><td colspan="3">&nbsp</td></tr>
                                            <tr v-if="transaction.status_order == 'processing' ">
                                                <td colspan="3" >

                                                    <form class="row g-3" @submit.prevent="shipOrder" >
                                                        <input type="hidden" name="task"  id="task" value="">
                                                        <div class="btn-container">
                                                            <button type="submit" class="btn btn-primary px-5">Mark as Shipped</button>
                                                        </div>

                                                    </form>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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
import {Head, Link} from '@inertiajs/inertia-vue3'

export default {
    name: "OrderDetails",
    components: {
        Head,
        Link,
    },
    layout: DefaultLayout,
    props: {
        auth: Object,
        errors: Object,
        flash: Object,
        transaction: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                id:this.transaction.encrypted_id,
                status: '1',
                task: 'shipped',
                store_id: this.transaction.store_id,
            }),
        }
    },

    methods: {
        shipOrder() {
            this.form.post(`/stockisttx/shipped`)
        },

    },




}

</script>

<style>
.dataTables_length{
    margin-bottom: 20px;
}

</style>



