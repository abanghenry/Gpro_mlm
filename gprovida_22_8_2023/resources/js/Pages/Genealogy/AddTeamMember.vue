<template>
    <div class="page-wrapper">
        <Head title="Add Team Member" />
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Genealogy</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-user-circle"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Add Team Member</li>
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
                                <h5 class="mb-0 text-primary">Add Team Member</h5>
                            </div>
                            <hr>
                            <form class="row g-3" @submit.prevent="createMember" >
                                <!-- Referral -->
                                <div class="row mb-3 mt-4">
                                    <label class="col-sm-3 col-form-label">Referral</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" v-model="form.referred_by"  readonly="readonly">
                                    </div>
                                </div>
                                <!-- Parent -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Parent</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" v-model="form.parent"  readonly="readonly">
                                    </div>
                                </div>

                                <!-- Username -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Username</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" v-model="form.username"
                                               required :class="{ 'is-invalid': form.errors.username }">
                                        <div  v-if="form.errors.username" class="form-error">{{ form.errors.username }}</div>
                                    </div>
                                </div>

                                <!-- Name -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Fullname</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" v-model="form.firstname"  placeholder="Firstname"
                                               required :class="{ 'is-invalid': form.errors.firstname }">
                                        <div  v-if="form.errors.firstname" class="form-error">{{ form.errors.firstname }}</div>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" v-model="form.lastname" placeholder="Lastname"
                                               required :class="{ 'is-invalid': form.errors.lastname }">
                                        <div  v-if="form.errors.lastname" class="form-error">{{ form.errors.lastname }}</div>
                                    </div>
                                </div>
                                <!-- Gender -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Gender</label>
                                    <div class="col-sm-8">
                                        <select class="form-select"  v-model="form.gender" required>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Profession -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Profession</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" v-model="form.profession"
                                               :class="{ 'is-invalid': form.errors.profession }">
                                        <div  v-if="form.errors.profession" class="form-error">{{ form.errors.profession }}</div>
                                    </div>
                                </div>
                                <!-- Email -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" v-model="form.email"
                                               required :class="{ 'is-invalid': form.errors.email }">
                                        <div  v-if="form.errors.email" class="form-error">{{ form.errors.email }}</div>
                                    </div>
                                </div>
                                <!-- Phone Number -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Phone Number</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" v-model="form.phone"
                                               required :class="{ 'is-invalid': form.errors.phone }">
                                        <div  v-if="form.errors.phone" class="form-error">{{ form.errors.phone }}</div>
                                    </div>
                                </div>
                                <!-- Address -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Address</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" v-model="form.address"
                                               required :class="{ 'is-invalid': form.errors.address }">
                                        <div  v-if="form.errors.address" class="form-error">{{ form.errors.address }}</div>
                                    </div>
                                </div>
                                <!-- Address 2 -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Address 2</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" v-model="form.address2"
                                               :class="{ 'is-invalid': form.errors.address2 }">
                                        <div  v-if="form.errors.address2" class="form-error">{{ form.errors.address2 }}</div>
                                    </div>
                                </div>
                                <!-- City -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">City</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" v-model="form.city"
                                               :class="{ 'is-invalid': form.errors.city }">
                                        <div  v-if="form.errors.city" class="form-error">{{ form.errors.city }}</div>
                                    </div>
                                </div>
                                <!-- State -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">State</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" v-model="form.state"
                                               required :class="{ 'is-invalid': form.errors.state }">
                                        <div v-if="form.errors.state" class="form-error">{{ form.errors.state }}</div>
                                    </div>
                                </div>

                                <!-- Country -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Choose Country</label>
                                    <div class="col-sm-8">
                                        <select class="form-select" v-model="form.country">
                                            <option selected="selected" :value="user.country">{{user.country}}</option>
                                            <template v-for="country in countries" :key="country.id">
                                                <option :value="country.name">{{country.name}}</option>
                                            </template>
                                        </select>
                                        <div v-if="form.errors.country" class="form-error">{{ form.errors.country }}</div>
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" v-model="form.password"
                                               required :class="{ 'is-invalid': form.errors.password }"  autocomplete="off" />
                                        <div  v-if="form.errors.password" class="form-error">{{ form.errors.password }}</div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Confirm Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" v-model="form.password_confirmation"
                                               required :class="{ 'is-invalid': form.errors.password_confirmation }"  autocomplete="off" />
                                        <div  v-if="form.errors.password_confirmation"
                                              class="form-error">{{ form.errors.password_confirmation }}</div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Choose Package</label>
                                    <div class="col-sm-8">
                                        <select  class="form-select" v-model="form.package_id" required>
                                            <option v-for="our_package in packages" :key="our_package.id"  :value="our_package.id">
                                                {{our_package.name}}
                                                <template v-for="priceItem in our_package.price">
                                                    <template v-if="priceItem.currency_id == this.user.currency_id">
                                                         ({{priceItem.currency_code}} {{priceItem.price.toLocaleString()}})
                                                    </template>

                                                </template>
                                            </option>
                                        </select>
                                        <div v-if="form.errors.package_id" class="form-error">{{ form.errors.package_id }}</div>
                                    </div>
                                </div>


                                <div class="row mb-3 mt-4">
                                    <label class="col-sm-3 col-form-label">Payment</label>
                                </div>
                                <!-- Payment Option -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Payment Option</label>
                                    <div class="col-sm-8">
                                        <select class="form-select"  v-model="form.payment_method" required @change="updatePinInput">
                                            <option value="epin">E-Pin</option>
                                            <option value="wallet">Wallet</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- e-pin -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Payment (E-Pin)</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" v-model="form.epin" :readonly="epinReadOnly"
                                                :class="{ 'is-invalid': form.errors.epin }"  autocomplete="off"  />
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
import { Head, Link } from '@inertiajs/inertia-vue3'
export default {
    name: "AddTeamMember",
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
        parent: Object,
        referral: Object,
        countries: Object,
        packages: Object,
        position: String,
    },
    remember: 'form',
    data() {
        return {
            form: this.$inertia.form({
                parent: this.parent.username,
                referred_by: this.referral.username,
                username: '',
                firstname: '',
                lastname: '',
                gender: this.user.gender,
                profession: '',
                skills: '',
                email: '',
                password:'',
                password_confirmation: '',
                phone: '',
                country: this.user.country,
                state: '',
                city: '',
                address: '',
                address2: '',
                package_id: this.packages[0].id,
                payment_method: 'epin',
                currency_id: this.user.currency_id,
                epin: '',
                position: this.position,
            }),
            epinReadOnly:false,
        }
    },
    methods: {
        createMember() {
            this.form.post(`/genealogy/store`)
        },

        updatePinInput(){
            if(this.form.payment_method=='epin'){
                this.epinReadOnly = false
            }else {
                this.epinReadOnly = true
            }
        }
    },
}

</script>

<style scoped>

</style>


