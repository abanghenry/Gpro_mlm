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
                        <li class="breadcrumb-item active" aria-current="page">Request E-Pin</li>
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
                    <div class="card-body p-5">
                        <div class="card-title d-flex align-items-center">
                            <div>
                                <i class="bx bx-lock me-1 font-22 text-primary"></i>
                            </div>
                            <h5 class="mb-0 text-primary">Request E-Pin</h5>
                        </div>
                        <hr>



                        <form class="row g-3" @submit.prevent="submitRequest" >
                            <!-- Package-->
                            <div class="row mb-3 mt-4">
                                <label class="col-sm-4 col-form-label">Choose Joining Package</label>
                                <div class="col-sm-7">
                                    <select  class="form-select" v-model="form.package_id" required>
                                        <option v-for="our_package in packages" :key="our_package.id"  :value="our_package.id">
                                            {{our_package.name}}
                                            <template v-for="priceItem in our_package.price">
                                                <template v-if="priceItem.currency_id == this.user.currency_id">
                                                    ({{priceItem.currency_code}} {{priceItem.price.toLocaleString()}})
                                                </template>

                                            </template>
                                        </option>
                                    </select>
                                    <div v-if="form.errors.package_id" class="form-error">{{ form.errors.package_id }}</div>
                                </div>
                            </div>
                            <!-- Quantity-->
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">E-pin Quantity</label>
                                <div class="col-sm-7">
                                    <input type="number" class="form-control" v-model="form.quantity" />
                                </div>
                            </div>
                            <!-- amount paid-->
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">Amount Paid</label>
                                <div class="col-sm-7">
                                    <input type="number" class="form-control" v-model="form.amount_paid">
                                </div>
                            </div>
                            <!-- A/C Number -->
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">Account Number</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" v-model="form.account_number"  required />
                                </div>
                            </div>
                            <!-- Bank -->
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">Bank</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" v-model="form.bank"  required />
                                </div>
                            </div>
                            <!-- payment_details -->
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">Transaction ID</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" v-model="form.payment_details"  />
                                </div>
                            </div>
                            <!-- payment_mode -->
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">Payment Mode</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" v-model="form.payment_mode"  required />
                                </div>
                            </div>
                            <!-- Upload Transaction Proof -->
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">Upload Transaction Proof:</label>
                                <div class="col-sm-7">
                                    <input type="file" @input="form.transaction_teller = $event.target.files[0]" accept="image/*, application/pdf" />
                                    <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                        {{ form.progress.percentage }}%
                                    </progress>

                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-4 col-form-label"></label>
                                <div class="col-sm-7">
                                    <button type="submit" class="btn btn-primary px-5">Submit</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

                <div class="card border-top border-0 border-4 border-primary">
                    <div class="card-body p-4">
                        <div class="card-title d-flex align-items-center">
                            <div>
                                <i class="bx bx-lock me-1 font-22 text-primary"></i>
                            </div>
                            <h5 class="mb-0 text-primary">My Request</h5>
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
    name: "Pin Request",
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
