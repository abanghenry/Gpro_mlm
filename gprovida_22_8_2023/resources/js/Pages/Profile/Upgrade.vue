<template>
    <div className="page-wrapper">
        <Head title="Upgrade Package"/>
        <div className="page-content">
            <!--breadcrumb-->
            <div className="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div className="breadcrumb-title pe-3">Profile</div>
                <div className="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol className="breadcrumb mb-0 p-0">
                            <li className="breadcrumb-item"><a href="javascript:;"><i className="bx bx-user-circle"></i></a>
                            </li>
                            <li className="breadcrumb-item active" aria-current="page">Upgrade Package</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

            <div className="row">
                <div className="col-xl-9">
                    <div v-if="$page.props.flash.success" className="alert alert-success" role="alert">
                        {{ $page.props.flash.success }}
                    </div>
                    <div v-if="$page.props.flash.error" className="alert alert-danger" role="alert">
                        {{ $page.props.flash.error }}
                    </div>


                    <div className="card border-top border-0 border-4 border-primary">
                        <div className="card-body p-5">
                            <div className="card-title d-flex align-items-center">
                                <div>
                                    <i className="bx bx-lock me-1 font-22 text-primary"></i>
                                </div>
                                <h5 className="mb-0 text-primary">Upgrade Package</h5>
                            </div>
                            <hr>
                            <form className="row g-3" @submit.prevent="update" autocomplete="off">
                                <div className="row mb-3 mt-4">
                                    <label className="col-sm-3 col-form-label">Username</label>
                                    <div className="col-sm-9">
                                        <input type="text" className="form-control" v-model="form.username" readOnly="readonly">
                                    </div>
                                </div>
                                <div className="row mb-3 mt-4">
                                    <label className="col-sm-3 col-form-label">Current Package</label>
                                    <div className="col-sm-9">
                                        <input type="text" className="form-control" v-model="form.currentPackageName" readOnly="readonly">
                                    </div>
                                </div>

                                <div className="row mb-3">
                                    <label className="col-sm-3 col-form-label">New Package</label>
                                    <div className="col-sm-9">
                                        <select class="form-select"  v-model="form.newPackage" required @change="calculateCost">
                                            <option v-for="our_package in packages" :key="our_package.id"  :value="our_package.id">
                                                {{our_package.name}}
                                                <template v-for="priceItem in our_package.price_user">
                                                    <template v-if="priceItem.currency_id == this.user.currency_id">
                                                        ({{priceItem.currency_code}}{{priceItem.price.toLocaleString()}})
                                                    </template>
                                                </template>
                                            </option>
                                        </select>
                                        <div v-if="form.errors.newPackage" className="form-error">
                                            {{ form.errors.newPackage }}
                                        </div>
                                    </div>
                                </div>

                                <div className="row mb-3">
                                    <label className="col-sm-3 col-form-label">Upgrade Cost</label>
                                    <div className="col-sm-9">
                                        <input type="number" className="form-control" v-model="form.upgradeCost" readonly />
                                    </div>
                                </div>
                                <div className="row mb-3">
                                    <label className="col-sm-3 col-form-label">Current Wallet Amount</label>
                                    <div className="col-sm-9">
                                        <input type="number" className="form-control" v-model="form.wallet" readonly />
                                    </div>
                                </div>

                                <div className="row">
                                    <label className="col-sm-3 col-form-label"></label>
                                    <div className="col-sm-9">
                                        <button type="submit" className="btn btn-primary px-5">Upgrade</button>
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
import {Head, Link} from '@inertiajs/inertia-vue3'

export default {
    name: "Upgrade",
    metaInfo: {title: 'Change Password'},
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
        packages: Object,
    },
    remember: 'form',
    data() {
        return {
            form: this.$inertia.form({
                username: this.user.username,
                currentPackageName: this.user.package.name,
                currentPackageID: this.user.package.id,
                newPackage: '',
                upgradeCost: 0,
                wallet: this.user.wallet,
                newPackageCost:0,
            }),
        }
    },

    methods: {
        update() {
            if(this.form.upgradeCost>this.form.wallet){
                alert("You don't have enough money in your wallet to make this upgrade")
                return false
            }
            if(this.user.package.price_user[0].price > this.form.newPackageCost){
                alert("You can't upgrade to lower plan")
                return false
            }
            if(this.user.package.price_user[0].price == this.form.newPackageCost){
                alert("You can't upgrade to the same plan")
                return false
            }
            this.form.post(`/upgrade`)
            this.form.currentPackageName=null;
            this.form.currentPackageID=null;
            this.form.newPackage =null;
            this.form.upgradeCost =null;
            this.form.wallet =null;

        },

        calculateCost(){
            let selectedPackage = this.packages.find(x => x.id==this.form.newPackage);
            let prices = selectedPackage.price_user
            let priceUserCurrency = prices.find(y => y.currency_id == this.user.currency_id)
            let newPackageCost  = priceUserCurrency.price

            this.form.newPackageCost = newPackageCost
            this.form.upgradeCost = newPackageCost - this.user.package.price_user[0].price
        }
    },


}

</script>

<style scoped>

</style>

