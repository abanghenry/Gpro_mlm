<template>
    <div class="page-wrapper">
        <Head title="Support Ticket" />
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Support Ticket </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-user-circle"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">View Ticket</li>
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
                                <h5 class="mb-0 text-primary">Reply</h5>
                            </div>
                            <hr>
                            <form class="row g-3" @submit.prevent="updateTicket" >

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

                                <hr/>
                                <h4>Ticket Information</h4>
                                <!-- subject -->
                                <div class="row">
                                    <label class="col-sm-4 col-form-label"><b>Ticket ID</b></label>
                                    <label class="col-sm-4 col-form-label"><b>Subject</b></label>
                                    <label class="col-sm-4 col-form-label"><b>Priority</b></label>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label">{{ticket.ticket_id}}</label>
                                    <label class="col-sm-4 col-form-label">{{ticket.subject}}</label>
                                    <label class="col-sm-4 col-form-label">{{ticket.urgency}}</label>
                                </div>
                            </form>


                             <br/><br/><br/>
                            <div v-for="child in ticket.children" class="chat-content-leftside mb-5">
                                <div class="d-flex">
                                    <img src="/assets/images/avatars/avatar-3.png" class="rounded-circle" alt="" width="48" height="48">
                                    <div class="flex-grow-1 ms-2">
                                        <p class="mb-0 chat-time"><b>{{ child.user.firstname }} {{ child.user.lastname }}, </b></p>
                                        <p class="chat-left-msg">{{ child.message }} </p>
                                        <p class="mb-0 chat-time">{{ child.created_date }}</p>
                                    </div>
                                </div>
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
    name: "Edit",
    components: {
        Head,
        Link,
    },
    layout: DefaultLayout,
    props: {
        auth: Object,
        errors: Object,
        flash: Object,
        ticket: Object,
        user: Object,
    },
    remember: 'form',
    data() {
        return {
            form: this.$inertia.form({
                id: this.ticket.id,
                fullname: this.user.firstname+" "+this.user.lastname,
                email: this.user.email,
                message: '',
            }),
        }
    },
    methods: {
        updateTicket() {
            this.form.put(`/support/`+this.ticket.id)
        },
    },
}
</script>





<style scoped>

</style>
