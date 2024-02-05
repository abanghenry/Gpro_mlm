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

            <div class="row">
                <div class="col-xl-12">
                    <div v-if="$page.props.flash.success" class="alert alert-success" role="alert">
                        {{ $page.props.flash.success }}
                    </div>
                    <div v-if="$page.props.flash.error" class="alert alert-danger" role="alert">
                        {{ $page.props.flash.error }}
                    </div>


                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-4">
                            <div class="card-title d-flex align-items-center">
                                <div>
                                    <i class="bx bx-lock me-1 font-22 text-primary"></i>
                                </div>
                                <h5 class="mb-0 text-primary">Orders History</h5>
                            </div>
                            <hr>


                            <div class="table-responsive">
                                <table id="table" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Order #</th>
                                        <th>Date</th>
                                        <th>Client Name (Owner)</th>
                                        <th>Payment Method</th>
                                        <th>Item count</th>
                                        <th>Total</th>
                                        <th>Payment Status</th>
                                        <th>Status</th>
                                        <th>view</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="order in orders" :key="order.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                                        <td class="align-middle">{{ order.id }}</td>
                                        <td class="align-middle">{{ order.orderRef }}</td>
                                        <td class="align-middle">{{ order.order_date }}</td>
                                        <td class="align-middle">{{ order.owner.firstname }} {{ order.owner.lastname }}</td>
                                        <td class="align-middle">{{ order.payment_method }}</td>
                                        <td class="align-middle">{{ order.items.length }}</td>
                                        <td class="align-middle">
                                            {{ order.currency.prefix }}{{ order.net_total.toLocaleString() }}</td>
                                        <td class="align-middle">{{ order.payment_status }}</td>
                                        <td class="align-middle">
                                            <div v-if="order.status_order=='pending'"
                                                 class="badge rounded-pill text-warning bg-light-warning  p-2 text-uppercase px-3">
                                                <i class="bx bxs-circle me-1"></i>pending
                                            </div>
                                            <div v-else-if="order.status_order=='processing'"
                                                class="badge rounded-pill text-info bg-light-info p-2 text-uppercase px-3">
                                                <i class="bx bxs-circle align-middle me-1"></i>processing
                                            </div>

                                            <div v-else-if="order.status_order=='shipped'"
                                                 class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">
                                                <i class="bx bxs-circle align-middle me-1"></i>shipped
                                            </div>

                                            <div v-else-if="order.status_order=='cancelled'"
                                                 class="badge rounded-pill text-light bg-secondary p-2 text-uppercase px-3">
                                                <i class="bx bxs-circle align-middle me-1"></i>cancelled
                                            </div>
                                            <div v-else-if="order.status_order=='fraud'"
                                                 class="badge rounded-pill text-danger bg-danger-info p-2 text-uppercase px-3">
                                                <i class="bx bxs-circle align-middle me-1"></i>fraud
                                            </div>
                                            <div v-else
                                                 class="badge rounded-pill text-light bg-dark p-2 text-uppercase px-3">
                                                <i class="bx bxs-circle align-middle me-1"></i>{{ order.status_order }}
                                            </div>

                                        </td>
                                        <td>
                                            <inertia-link :href="`/order/history/${order.id}`">
                                                <i class='bx bxs-show'></i>
                                            </inertia-link>
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
import { Head, Link } from '@inertiajs/inertia-vue3'
export default {
    name: "History",
    components: {
        Head,
        Link,
    },
    layout: DefaultLayout,
    props: {
        auth: Object,
        errors: Object,
        flash: Object,
        orders: Object,
    },
    remember: 'form',
    data() {
        return {
            form: this.$inertia.form({
                username: '',
            }),
        }
    },

    methods: {
        update() {
            this.form.post(`/profile-genealogy`)
        },
    },

    mounted(){
        $(document).ready(function() {
            var table = $('#table').DataTable( {
                lengthMenu: [ 10, 25, 50, 100, 500 ],
                buttons: [ ]
            } );

            table.buttons().container()
                .appendTo( '#table_wrapper .col-md-6:eq(0)' );
        } );
    },



}

</script>

<style scoped>


</style>



<!--<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/genealogy.css') }}" />-->
<!--<script src="{{ URL::asset('tooltipster/js/tooltipster.bundle.min.js') }}"></script>-->
<!--<link rel="stylesheet" type="text/css" href="{{ URL::asset('tooltipster/css/tooltipster.bundle.min.css') }}" />-->

