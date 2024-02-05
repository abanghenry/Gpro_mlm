<template>
    <div class="page-wrapper">
        <Head title="Add New Testimonial" />
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Testimonial</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-user-circle"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">View Testimonial</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="row">
                <div class="col-xl-9">
                    <div v-if="$page.props.flash.success" class="alert alert-success" role="alert">
                        {{ $page.props.flash.success }}
                    </div>
                    <div v-if="$page.props.flash.error" class="alert alert-danger" role="alert">
                        {{ $page.props.flash.error }}
                    </div>

                    <div v-if="errors.length>0" class="alert alert-danger" role="alert">
                        <p v-for="error in errors">
                            {{ error }}
                        </p>
                    </div>


                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-5">
                            <div class="card-title d-flex align-items-center">
                                <div>
                                    <i class="bx bx-lock me-1 font-22 text-primary"></i>
                                </div>
                                <h5 class="mb-0 text-primary">View Testimonial</h5>
                            </div>
                            <hr>
                            <form class="row g-3" @submit.prevent="backHome" >
                                <!-- Referral -->
                                <div class="row mb-3 mt-4">
                                    <label class="col-sm-3 col-form-label">Message</label>
                                    <div class="col-sm-8">
                                        <textarea readonly class="form-control" rows="8">{{testimonial.message}}</textarea>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" :value="testimonial.status"  readonly="readonly">
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Date Posted</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" :value="testimonial.created_date" readonly="readonly">
                                    </div>
                                </div>



                                <div class="row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary px-5">Back</button>
                                    </div>
                                </div>
                            </form>
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
    name: "View",
    components: {
        Head,
        Link,
    },
    layout: DefaultLayout,
    props: {
        auth: Object,
        errors: Object,
        flash: Object,
        testimonial: Object,
    },

    methods: {
        backHome() {
            this.$inertia.visit('/testimonial', {
                method: 'get',
                data: {  },
            })
        },
    },
}
</script>


<style scoped>

</style>
