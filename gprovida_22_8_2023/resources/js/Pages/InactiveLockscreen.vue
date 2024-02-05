<template>
    <div class="page-wrapper">
        <Head title="Add Team Member" />
        <div class="page-content">

            <div class="row">
                <div class="col-xl-12">
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
                    <div class="card">
                        <div class="card-body p-5">
                            <div class="card-title">
                                <h5 class="mb-0 text-primary  my-auto">User not Activated</h5>
                            </div>
                            <div class="row">
                                <div class="col-xl-8">
                                    Thanks for signing up! Before getting started,
                                    Admin will have to verify your payment and activate your account <br/><br/>
                                    You can also change your activation method and used the EPIN you bought
                                    for automatic activation.
                                </div>
                            </div>


                            <hr>
                            <form class="row g-3" @submit.prevent="activateMember" >

                                <!-- Payment Option -->
                                <div class="row mb-3 mt-4">
                                    <label class="col-sm-3 col-form-label">Payment Option</label>
                                    <div class="col-sm-8">
                                        <select class="form-select"  v-model="form.payment_method" required>
                                            <option value="epin">E-Pin</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- e-pin -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Payment (E-Pin)</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" v-model="form.epin"
                                               required :class="{ 'is-invalid': form.errors.epin }"  autocomplete="off" />
                                        <div  v-if="form.errors.epin"
                                              class="form-error">{{ form.errors.epin }}</div>
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
import {Head, Link} from "@inertiajs/inertia-vue3";

export default {
    name: "InactiveLockscreen",
    layout: DefaultLayout,
    components: {
        Head,
        Link,
    },

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
                userId: this.user.id,
                payment_method: 'epin',
                currency_id: this.user.currency_id,
                epin: '',
                package_id: this.user.package_id,
            }),
        }
    },
    methods: {
        activateMember() {
            this.form.post(`/genealogy/changeToEpin`)
        },
    },
}
</script>

<style scoped>

</style>
