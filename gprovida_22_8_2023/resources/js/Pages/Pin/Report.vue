<template>
    <div class="page-wrapper">
        <Head :title="`Pin request ${auth.user.username}`" />
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">E-Pin</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-user-circle"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">E-Pin Report</li>
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
                                <h5 class="mb-0 text-primary">My Report</h5>
                            </div>
                            <hr>
                            <div class="table-responsive">
                                <table id="table" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Package</th>
                                        <th>Quantity</th>
                                        <th>Amount Paid</th>
                                        <th>Account Number</th>
                                        <th>Bank</th>
                                        <th>Payment Mode</th>
                                        <th>Status</th>
                                        <th style="text-align: right">Date at</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(pinRequest, key) in  pinRequests" :key="pinRequest.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                                        <td class="align-middle">{{ key+1}}</td>
                                        <td class="align-middle">{{pinRequest.package.name}}</td>
                                        <td class="align-middle">{{pinRequest.quantity}}</td>
                                        <td class="align-middle">{{pinRequest.amount_paid}}</td>
                                        <td class="align-middle">{{pinRequest.account_number}}</td>

                                        <td class="align-middle">{{pinRequest.bank}}</td>
                                        <td class="align-middle">{{pinRequest.payment_mode}}</td>
                                        <td class="align-middle">{{pinRequest.status}}</td>

                                        <td style="text-align: right" class="align-middle">{{ pinRequest.created_date }}</td>
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
    name: "Pin Report",
    components: {
        Head,
        Link,
    },
    layout: DefaultLayout,
    props: {
        auth: Object,
        errors: Object,
        flash: Object,
        pinRequests: Object,
        packages: Object,
        user: Object,
    },

    remember: 'form',
    data() {
        return {
            form: this.$inertia.form({
                package_id: this.packages[0].id,
                currency_id: this.user.currency_id,
                quantity: '',
                amount_paid: '',
                payment_mode: '',
                account_number: '',
                bank: '',
                payment_details: '',
                transaction_teller: '',
            }),
        }
    },

    methods: {
        submitRequest() {
            this.form.post(`/pin/request`)
        },
    },

    mounted(){
        $(document).ready(function() {
            var table = $('#table').DataTable( {
                lengthMenu: [ 10, 25, 50, 100, 500 ],
                buttons: [ 'copy', 'excel', 'pdf', 'print']
            } );
            table.buttons().container()
                .appendTo( '#table_wrapper .col-md-6:eq(0)' );
        } );
    },
}

</script>

<style>

.dataTables_length{
    margin-bottom: 20px;
}

</style>
