<template>
    <div class="page-wrapper">
        <Head :title="`Support Tickets ${auth.user.username}`" />
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">My Support Tickets</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-user-circle"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Your ticket history</li>
                        </ol>
                    </nav>
                </div>

                <div class="ms-auto">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" @click="openTicket">Open Ticket</button>
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
                                <h5 class="mb-0 text-primary">My Ticket history</h5>
                            </div>
                            <hr>

                            <div class="table-responsive">
                                <table id="table" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <th>Status</th>
                                        <th style="text-align: right">last Updated</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="support in supports" :key="support.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                                        <td class="align-middle">
                                            <inertia-link :href="`/support/${support.encrypted_id}`">
                                                {{support.subject}}
                                            </inertia-link>
                                        </td>
                                        <td class="align-middle">
                                            <span class="status"  :style="{ color: support.status.color}" >{{ support.status.name }}</span>
                                        </td>
                                        <td style="text-align: right" class="align-middle">{{ support.updated_date }}</td>
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
        supports: Object,
    },

    methods: {
        truncate(data,num,suffix) {
            const reqdString = data.split("").slice(0, num).join("")+ suffix;
            return reqdString;
        },

        openTicket() {
            this.$inertia.visit('/support/create', {
                method: 'get',
                data: {  },
            })
        },
    },

    mounted(){
        $(document).ready(function() {
            var table = $('#table').DataTable( {
                lengthMenu: [ 10, 25, 50, 100, 500 ],
                buttons: [ ],
                "columnDefs": [
                    { "width": "65%", "targets": 0 }
                ],
                "columns": [
                    { "width": "65%" },
                    null,
                    null
                ],

            } );

            table.buttons().container()
                .appendTo( '#table_wrapper .col-md-6:eq(0)' );
        } );
    },
}

</script>

<style scoped>

.status {
    display: block;
    border: 2px solid #ccc;
    border-radius: 4px;
    background-color: #fff;
    color: #333;
    padding: 2px;
    text-align: center;
}

</style>
