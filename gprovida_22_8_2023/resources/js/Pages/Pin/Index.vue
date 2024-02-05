<template>
<div class="page-wrapper">
    <Head :title="`Pin Management ${auth.user.username}`" />
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Manage E-Pin </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-user-circle"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">My E-pins</li>
                    </ol>
                </nav>
            </div>

            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary" @click="requestEpins">Buy E-Pin</button>
                </div>
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
                            <h5 class="mb-0 text-primary">My E-pins</h5>
                        </div>
                        <hr>

                        <div class="table-responsive">
                            <table id="table" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Pin Number</th>
                                    <th>Package PV</th>
                                    <th>package</th>
                                    <th>Status</th>
                                    <th style="text-align: right">created at</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(epin, index) in epins" :key="epin.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                                    <td class="align-middle">{{ ++index}}</td>
                                    <td class="align-middle">{{epin.pin_number}}</td>
                                    <td class="align-middle">{{epin.package.pv}}</td>
                                    <td class="align-middle">{{epin.package.name}}</td>

                                    <td v-if="epin.status==0"> <span class="badge bg-success">Unused</span></td>
                                    <td v-else-if="epin.status==1"> <span class="badge bg-info">Used</span></td>
                                    <td v-else-if="epin.status==2"> <span class="badge bg-danger">cancelled</span></td>
                                    <td v-else="">{{epin.status}}</td>


                                    <td style="text-align: right" class="align-middle">{{ epin.updated_date }}</td>
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
    name: "Index",
    components: {
        Head,
        Link,
    },
    layout: DefaultLayout,
    props: {
        auth: Object,
        errors: Object,
        flash: Object,
        epins: Object,
    },

    methods: {

        requestEpins() {
            this.$inertia.visit('/pin/request', {
                method: 'get',
                data: {  },
            })
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
