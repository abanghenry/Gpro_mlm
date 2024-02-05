
<template>
    <div class="page-wrapper">
        <!--<Head :title="`${form.username}`" />-->
        <Head title="Change Password" />
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Profile </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-user-circle"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Change Password</li>
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


                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-5">
                            <div class="card-title d-flex align-items-center">
                                <div>
                                    <i class="bx bx-lock me-1 font-22 text-primary"></i>
                                </div>
                                <h5 class="mb-0 text-primary">Change Password</h5>
                            </div>
                            <hr>
                            <form class="row g-3" @submit.prevent="update" autocomplete="off">
                                <div class="row mb-3 mt-4">
                                    <label class="col-sm-3 col-form-label">Username</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" v-model="form.username"  readonly="readonly">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Current Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" v-model="form.password"
                                               required :class="{'is-invalid': form.errors.password }"  autocomplete="off" />
                                        <div  v-if="form.errors.password" class="form-error">{{ form.errors.password }}</div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">New Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" v-model="form.new_password"
                                               required :class="{ 'is-invalid': form.errors.new_password }"  autocomplete="off" />
                                        <div  v-if="form.errors.new_password" class="form-error">{{ form.errors.new_password }}</div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Confirm Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" v-model="form.new_password_confirmation"
                                               required :class="{ 'is-invalid': form.errors.new_password_confirmation }"  autocomplete="off" />
                                        <div  v-if="form.errors.new_password_confirmation"
                                              class="form-error">{{ form.errors.new_password_confirmation }}</div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary px-5">Update</button>
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
    name: "ChangePassword",
    metaInfo: { title: 'Change Password' },
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
                username: this.user.username,
                password:'',
                new_password: '',
                new_password_confirmation: '',
            }),
        }
    },

    methods: {
        update() {
            this.form.post(`/profile/changepass`)
        },
    },


}

</script>

<style scoped>

</style>

