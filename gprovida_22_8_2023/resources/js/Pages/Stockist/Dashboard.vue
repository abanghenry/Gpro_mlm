<template>
    <div class="page-wrapper">
        <div class="page-content">

            <div class="row">
                <div v-if="$page.props.flash.success" className="alert alert-success" role="alert">
                    {{ $page.props.flash.success }}
                </div>
                <div v-if="$page.props.flash.error" className="alert alert-danger" role="alert">
                    {{ $page.props.flash.error }}
                </div>


                <div class="col-md-12 col-xl-10">
                    <div class="card radius-10 bg-primary bg-gradient">
                        <div class="card-body">
                            <h5 class="card-title text-white">Earnings Reports</h5>
                            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-5">
                                <div class="col">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-white">Total Earnings</p>
                                            <h4 class="my-1 text-white">{{user.currency.prefix}}{{ totalEarning.toLocaleString() }}</h4>
                                            <p class="mb-0 text-white">Total store earning</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-white">Months Earning</p>
                                            <h4 class="my-1 text-white">{{ user.currency.prefix}}{{ earningMonth.toLocaleString() }}</h4>
                                            <p class="mb-0 text-white">Earnings this month</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-white">Weeks Earning</p>
                                            <h4 class="my-1 text-white">{{ user.currency.prefix}}{{ earningWeek.toLocaleString() }}</h4>
                                            <p class="mb-0 text-white">Earning this week</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-white">Todays Earning</p>
                                            <h4 class="my-1 text-white">{{ user.currency.prefix}}{{ earningToday.toLocaleString() }}</h4>
                                            <p class="mb-0 text-white">Current Earning</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-white">Total Earning</p>
                                            <h4 class="my-1 text-white">
                                                {{ user.currency.prefix}}{{ totalEarning.toLocaleString()  }}</h4>
                                            <p class="mb-0 text-white">Total Paid Earning</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xl-2">
                    <div class="card radius-10 bg-primary bg-gradient">
                        <div class="card-body">
                            <h5 class="card-title text-white">Balance</h5>
                            <div class="d-flex align-items-center">
                                <div>
                                    <h4 class="my-1 text-white">{{user.currency.prefix}}{{ balanceEarning.toLocaleString() }}</h4>
                                    <p class="mb-0 text-white">Last payment {{user.currency.prefix}}{{ balanceEarning.toLocaleString() }}</p>
                                    <p class="mb-0 text-white">Wallet: {{user.currency.prefix}}{{ user.wallet.toLocaleString() }}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--second row-->
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3">
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-warning">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Total Order</p>
                                    <h4 class="my-1 text-warning">{{ totalTransactions.toLocaleString() }}</h4>
                                    <inertia-link href="#" >
                                        <div class="mb-0 font-13 text-black-50">view</div>
                                    </inertia-link>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto">
                                    <i class='bx bxs-wallet'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-info">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Shipped Order</p>
                                    <h4 class="my-1 text-info">{{ totalTransactionsShipped.toLocaleString() }}</h4>
                                    <inertia-link href="#" >
                                        <div class="mb-0 font-13 text-black-50">view</div>
                                    </inertia-link>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto">
                                    <i class='bx bxs-wallet'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-danger">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Pending Order</p>
                                    <h4 class="my-1 text-danger">{{ totalTransactionsProcessing.toLocaleString() }}</h4>
                                    <inertia-link href="#" >
                                        <div class="mb-0 font-13 text-black-50">view</div>
                                    </inertia-link>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto">
                                    <i class='bx bxs-wallet'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- recent order -->
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Orders</h6>
                        </div>
                        <div class="dropdown ms-auto">
                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-bordered">
                            <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Ref</th>
                                <th>Customer</th>
                                <th># of Item</th>
                                <th>Total</th>
                                <th>Order Status</th>
                                <th>Date</th>
                                <th>view</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(transaction, index) in transactions" :key="transaction.id">
                                <td class="align-middle">{{ ++index}}</td>
                                <td>{{ transaction.orderRef }}</td>
                                <td>{{ transaction.owner.firstname }}  {{ transaction.owner.lastname }}
                                    ( {{ transaction.owner.username }} )
                                </td>
                                <td>{{ transaction.number_of_items }}</td>
                                <td>
                                    {{ transaction.currency.prefix }}{{ transaction.net_total.toLocaleString() }}
                                </td>

                                <td>
                                    <span v-if="transaction.status_order=='pending'"
                                          class="badge bg-gradient-blooker text-white shadow-sm w-100">
                                        pending
                                    </span>
                                    <span v-else-if="transaction.status_order=='processing'"
                                          class="badge bg-gradient-deepblue text-white shadow-sm w-100">
                                        processing
                                    </span>
                                    <span v-else-if="transaction.status_order=='shipped'"
                                          class="badge bg-gradient-quepal text-white shadow-sm w-100">
                                        shipped
                                    </span>
                                    <span v-else-if="transaction.status_order=='cancelled'"
                                          class="badge bg-gradient-bloody text-white shadow-sm w-100">
                                        cancelled
                                    </span>
                                    <span v-else-if="transaction.status_order=='fraud'"
                                          class="badge bg-gradient-ibiza text-white shadow-sm w-100">
                                        fraud
                                    </span>
                                    <span v-else
                                          class="badge bg-gradient-moonlit text-white shadow-sm w-100">
                                        {{ transaction.status_order }}
                                    </span>
                                </td>

                                <td>{{ transaction.order_date }} </td>
                                <td>
                                    <inertia-link :href="`/stockisttx/${transaction.encrypted_id}`">
                                        View
                                    </inertia-link>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Last 10 Referral & Direct Bonus -->
            <div class="row row-cols-1 row-cols-lg-1">
                <div class="col d-flex">
                    <div class="card radius-10 w-100">
                        <div class="card-header bg-transparent">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0">Last 10 Stockist Paid Bonus</h6>
                                </div>
                                <div class="dropdown ms-auto">
                                    <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                                        <i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="height: 300px; font-size: 12px">
                            <div class="table-wrapper">
                                <table class="table table-striped table-sm mb-0 ">
                                    <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">PV</th>
                                        <th scope="col">Date Earned</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Details</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(directBonus, index) in latestDirectBonus" :key="directBonus.id">
                                        <th scope="row">{{index+1}}</th>
                                        <td>{{directBonus.pv.toLocaleString()}}</td>
                                        <td>{{directBonus.earned_date}}</td>
                                        <td>
                                            <span v-if="directBonus.status=='0'"
                                                  class="badge bg-gradient-blooker text-white shadow-sm w-100">
                                                pending
                                            </span>
                                            <span v-else-if="directBonus.status=='1'"
                                                  class="badge bg-gradient-deepblue text-white shadow-sm w-100">
                                                processing
                                            </span>
                                            <span v-else-if="directBonus.status=='2'"
                                                  class="badge bg-gradient-quepal text-white shadow-sm w-100">
                                                paid
                                            </span>
                                            <span v-else-if="directBonus.status=='3'"
                                                  class="badge bg-gradient-bloody text-white shadow-sm w-100">
                                                cforward
                                            </span>
                                            <span v-else
                                                  class="badge bg-gradient-moonlit text-white shadow-sm w-100">
                                                {{ directBonus.status }}
                                            </span>
                                        </td>
                                        <td>{{directBonus.details}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end row-->


        </div>
    </div>

</template>

<script>
import DefaultLayout from '@/Layouts/DefaultLayout.vue'
import { Bar } from 'vue-chartjs'

export default {
    metaInfo: { title: 'Dashboard' },
    layout: DefaultLayout,
    props: {
        auth: Object,
        errors: Object,
        flash: Object,
        user: Object,

        latestDirectBonus: Object,
        transactions: Object,
        totalTransactions: Object,
        totalTransactionsProcessing: Object,
        totalTransactionsShipped: Object,

        earningToday: Object,
        earningWeek: Object,
        earningMonth: Object,
        totalEarning: Object,
        balanceEarning: Object,


    },
    mounted() {

        $(document).ready(function() {
            var table = $('#table').DataTable( {
                lengthMenu: [ 10, 25, 50, 100, 500 ],
                buttons: [ ]
            } );

            table.buttons().container()
                .appendTo( '#table_wrapper .col-md-6:eq(0)' );
        } );


    }

}
</script>


<style scoped>

.table-wrapper {
    max-height: 260px;
    overflow: auto;
    display:inline-block;
    width: 100%;
}

.pending{
    background: #fc4a1a;
    background: -webkit-linear-gradient( 45deg , #fc4a1a, #f7b733) !important;
    background: linear-gradient( 45deg , #fc4a1a, #f7b733) !important;
}
.cancelled{
    background: #ffdf40;
    background: -webkit-linear-gradient(45deg, #ffdf40, #ff8359)!important;
    background: linear-gradient(45deg, #ffdf40, #ff8359)!important;
}
.fraud{
    background: #ee0979;
    background: -webkit-linear-gradient( 45deg , #ee0979, #ff6a00) !important;
    background: linear-gradient( 45deg , #ee0979, #ff6a00) !important;
}
.processing{
    background: #42e695;
    background: -webkit-linear-gradient( 45deg , #42e695, #3bb2b8) !important;
    background: linear-gradient( 45deg , #42e695, #3bb2b8) !important;
}
.shipped{
    background: #6a11cb;
    background: -webkit-linear-gradient( 45deg , #6a11cb, #2575fc) !important;
    background: linear-gradient( 45deg , #6a11cb , #2575fc) !important
}



</style>

