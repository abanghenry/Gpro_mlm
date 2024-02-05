<template>
    <div class="page-wrapper">
        <Head :title="`Testimonial ${auth.user.username}`" />
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Testimonial</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-user-circle"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Testimonial</li>
                        </ol>
                    </nav>
                </div>

                <div class="ms-auto">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" @click="addTestimonial">Add Testimonial</button>
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
                                <h5 class="mb-0 text-primary">My Testimonial</h5>
                            </div>
                            <hr>

                            <div class="table-responsive">
                                <table id="table" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>view</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="testimonial in testimonials" :key="testimonial.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                                        <td class="align-middle">{{ testimonial.id }}</td>
                                        <td class="align-middle" width="40%">
                                            {{ truncate( testimonial.message, 100, '...') }}
                                        </td>

                                        <td class="align-middle">{{ testimonial.created_date }}</td>
                                        <td class="align-middle">{{ testimonial.status }}</td>
                                        <td>
                                            <inertia-link :href="`/testimonial/${testimonial.id}`">
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
        testimonials: Object,
    },

    methods: {
        truncate(data,num,suffix) {
            const reqdString = data.split("").slice(0, num).join("")+ suffix;
            return reqdString;
        },

        addTestimonial() {
            this.$inertia.visit('/testimonial/create', {
                method: 'get',
                data: {  },
            })
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
