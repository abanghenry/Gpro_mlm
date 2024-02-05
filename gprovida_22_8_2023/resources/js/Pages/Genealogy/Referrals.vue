<template>
    <div className="page-wrapper">
        <Head :title="`Referrals ${auth.user.username}`"/>
        <div className="page-content">
            <!--breadcrumb-->
            <div className="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div className="breadcrumb-title pe-3">Referrals</div>
                <div className="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol className="breadcrumb mb-0 p-0">
                            <li className="breadcrumb-item"><a href="javascript:;"><i className="bx bx-user-circle"></i></a>
                            </li>
                            <li className="breadcrumb-item active" aria-current="page">{{ auth.user.username }}</li>
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
                                <h5 className="mb-0 text-primary">Referrals</h5>
                            </div>
                            <hr>

                            <div class="table-responsive">
                                <table id="referrals" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Gender</th>
                                        <th>Phone</th>
                                        <th>State</th>
                                        <th>Country</th>
                                        <th>Date Activated</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="referral in referrals" :key="referral.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                                        <td class="align-middle">{{ referral.firstname }} {{ referral.lastname }}</td>
                                        <td class="align-middle">{{ referral.username }}</td>
                                        <td class="align-middle">{{ referral.gender }}</td>
                                        <td class="align-middle">{{ referral.phone }}</td>
                                        <td class="align-middle">{{ referral.state }}</td>
                                        <td class="align-middle">{{ referral.country }}</td>
                                        <td class="align-middle">{{ referral.date_activated }}</td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Gender</th>
                                        <th>Phone</th>
                                        <th>State</th>
                                        <th>Country</th>
                                        <th>Date Activated</th>
                                    </tr>
                                    </tfoot>
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
    name: "Genealogy",
    components: {
        Head,
        Link,
    },
    layout: DefaultLayout,
    props: {
        auth: Object,
        errors: Object,
        flash: Object,
        referrals: Object,
    },
    data() {
        return {

        }
    },

    methods: {
        update() {
            this.form.post(`/referrals`)
        },
    },

    mounted(){
        $(document).ready(function() {
            var table = $('#referrals').DataTable( {
                lengthMenu: [ 10, 25, 50, 100, 500 ],
                buttons: [ 'copy', 'excel', 'pdf', 'print']
            } );

            table.buttons().container()
                .appendTo( '#referrals_wrapper .col-md-6:eq(0)' );
        } );
    },



}

</script>

<style>
 .dataTables_length{
     margin-bottom: 20px;
 }

</style>
