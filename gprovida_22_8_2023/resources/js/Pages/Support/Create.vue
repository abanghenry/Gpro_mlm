<template>
    <div class="page-wrapper">
        <Head title="Add New Testimonial" />
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Support Tickets </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-user-circle"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Submit Ticket</li>
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
                                <h5 class="mb-0 text-primary">Create support ticket</h5>
                            </div>
                            <hr>
                            <form class="row g-3" @submit.prevent="submitTicket" >

                                <!-- Name-->
                                <div class="row mb-3 mt-4">
                                    <label class="col-sm-3 col-form-label">Fullname</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" v-model="form.fullname" readonly  />
                                    </div>

                                </div>

                                <!-- Email-->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" v-model="form.email" readonly>
                                    </div>
                                </div>


                                <!-- subject -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Subject</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" v-model="form.subject" required >
                                    </div>
                                </div>
                                <!-- Ticket priority -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Ticket priority</label>
                                    <div class="col-sm-8">
                                        <select class="form-select"  v-model="form.urgency" required>
                                            <option value="low">Normal</option>
                                            <option value="mid">High</option>
                                            <option value="high">Critical</option>
                                        </select>
                                    </div>
                                </div>


                                <!-- Message-->
                                <div class="row mb-3 mt-4">
                                    <label class="col-sm-3 col-form-label">Message</label>
                                    <div class="col-sm-8">
                                        <textarea  class="form-control" rows="8" v-model="form.message" required></textarea>
                                    </div>
                                </div>


                                <div class="row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary px-5">Submit</button>
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
    name: "Create",
    components: {
        Head,
        Link,
    },
    layout: DefaultLayout,
    props: {
        auth: Object,
        errors: Object,
        flash: Object,
        user: Object,
    },
    remember: 'form',
    data() {
        return {
            form: this.$inertia.form({
                fullname: this.user.firstname+" "+this.user.lastname,
                email: this.user.email,
                subject: '',
                message: '',
                urgency: 'low',
            }),
        }
    },
    methods: {
        submitTicket() {
            this.form.post(`/support`)
        },
    },
}
</script>


<style scoped>

</style>
