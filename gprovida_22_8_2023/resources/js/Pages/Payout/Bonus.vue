<template>
    <div class="page-wrapper">
        <Head :title="`Bonus ${auth.user.username}`" />
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">{{title}} Bonus</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-user-circle"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ title }} Bonus</li>
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
                                <h5 class="mb-0 text-primary">{{ title }} Bonus</h5>
                            </div>
                            <hr>


                            <div class="table-responsive">
                                <table id="table" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>PV</th>
                                        <th>Source</th>
                                        <th>Status</th>
                                        <th>Description</th>
                                        <th>Date Earned</th>
                                        <th>Date Paid</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(payment, index) in bonus" :key="payment.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                                        <td class="align-middle">{{ index+1 }}</td>
                                        <td class="align-middle">{{ payment.pv }}</td>
                                        <td class="align-middle">{{payment.source}}</td>
                                        <td class="align-middle">
                                            <div v-if="payment.status=='0'"
                                                 class="badge rounded-pill text-warning bg-light-warning  p-2 text-uppercase px-3">
                                                pending
                                            </div>
                                            <div v-else-if="payment.status=='2'"
                                                 class="badge rounded-pill text-info bg-light-success p-2 text-uppercase px-3">
                                                Paid
                                            </div>
                                            <div v-else-if="payment.status=='1'"
                                                 class="badge rounded-pill text-success bg-light-warning p-2 text-uppercase px-3">
                                                <i class="bx bxs-circle align-middle me-1"></i>processing
                                            </div>
                                            <div v-else-if="payment.status=='3'"
                                                 class="badge rounded-pill text-success bg-light-primary p-2 text-uppercase px-3">
                                                <i class="bx bxs-circle align-middle me-1"></i>flushed
                                            </div>
                                            <div v-else-if="payment.status=='4'"
                                                 class="badge rounded-pill text-success bg-light-primary p-2 text-uppercase px-3">
                                                <i class="bx bxs-circle align-middle me-1"></i>cforward
                                            </div>
                                            <div v-else
                                                 class="badge rounded-pill text-light bg-dark p-2 text-uppercase px-3">
                                                {{ payment.status }}
                                            </div>

                                        </td>
                                        <td class="align-middle">{{ payment.details }}</td>
                                        <td class="align-middle">{{ payment.earned_date }}</td>
                                        <td class="align-middle">{{ payment.paid_date }}</td>

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
    name: "Referral Bonus",
    components: {
        Head,
        Link,
    },
    layout: DefaultLayout,
    props: {
        auth: Object,
        errors: Object,
        flash: Object,
        bonus: Object,
        user:Object,
        title:String,
    },
    remember: 'form',
    data() {

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

