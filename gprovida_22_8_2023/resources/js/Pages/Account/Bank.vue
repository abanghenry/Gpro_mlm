<template>
    <div className="page-wrapper">
        <Head :title="`Bank ${auth.user.username}`"/>
        <div className="page-content">
            <!--breadcrumb-->
            <div className="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div className="breadcrumb-title pe-3">Bank</div>
            </div>
            <!--end breadcrumb-->

            <div className="row" v-if="!toEdit">
                <div className="col-xl-12">
                    <div v-if="$page.props.flash.success" className="alert alert-success" role="alert">
                        {{ $page.props.flash.success }}
                    </div>
                    <div v-if="$page.props.flash.error" className="alert alert-danger" role="alert">
                        {{ $page.props.flash.error }}
                    </div>
                    <div className="card border-top border-0 border-4 border-primary">
                        <div className="card-body p-4">
                            <div className="card-title d-flex align-items-center">
                                <div>
                                    <i className="bx bx-lock me-1 font-22 text-primary"></i>
                                </div>
                                <h5 className="mb-0 text-primary">Bank</h5>
                            </div>
                            <hr>
                            <div class="table-responsive">
                                <table id="table" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Currency Name</th>
                                        <th>Bank Name</th>
                                        <th>Account Name</th>
                                        <th>Account Number</th>
                                        <th>Country</th>
                                        <th>Swift</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Default</th>
                                        <th>Edit</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="bank in banks" :key="bank.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                                        <td class="align-middle">{{ bank.currency.name }}</td>
                                        <td class="align-middle">{{ bank.bank_name }}</td>
                                        <td class="align-middle">{{ bank.bank_holder_name }}</td>
                                        <td class="align-middle">{{ bank.bank_account_number }}</td>
                                        <td class="align-middle">{{ bank.country }}</td>
                                        <td class="align-middle">{{ bank.swift }}</td>
                                        <td class="align-middle">{{ bank.type }}</td>
                                        <td class="align-middle">
                                            <span v-if="bank.status==1" class="badge bg-primary">Active</span>
                                            <span v-else class="badge bg-warning text-dark">Inactive</span>
                                        </td>
                                        <td class="align-middle">
                                            <span v-if="bank.default==1" class="badge bg-success">Default</span>
                                        </td>

                                        <td class="align-middle">
                                            <div class="d-flex order-actions">
                                                <button type="button" class="btn btn-sm btn-outline-info"
                                                        @click="editBank(bank.encrypted_id, $event)">
                                                    <i class="bx bxs-edit"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div className="row" v-if="toEdit || banks.length==0">
                <div className="col-xl-8">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-5">
                            <div class="card-title d-flex align-items-center">
                                <div>
                                    <i class="bx bx-lock me-1 font-22 text-primary"></i>
                                </div>
                                <h5 class="mb-0 text-primary">{{ this.formTitle}}</h5>
                            </div>
                            <hr>

                            <form class="row g-3" @submit.prevent="submitBank" >

                                <!-- Bank -->
                                <div class="row mb-3 mt-4">
                                    <label class="col-sm-4 col-form-label">Bank Name*</label>
                                    <div class="col-sm-7">
                                        <SimpleTypeahead
                                            v-model="form.bank_name"
                                            :defaultItem=form.bank_name
                                            class="form-control" required
                                            id="typeahead_id"
                                            placeholder="Enter Bank name"
                                            :items="['ACCESS BANK NIGERIA PLC',
                                                    'CORONATION MERCHANT BANK','ACCESS(DIAMOND) BANK LTD',
                                                    'ECOBANK PLC','FBN MORTGAGE LIMITED','FIDELITY BANK PLC',
                                                    'FINATRUST MICROFINANCE BANK','FIRST BANK OF NIGERIA PLC',
                                                    'FIRST CITY MONUMENT BANK','FSDH MERCHANT BANK LIMITED',
                                                    'GUARANTY TRUST BANK PLC','HERITAGE BANK COMPANY LTD',
                                                    'JAIZ BANK','JUBILEE LIFE MORTGAGE BANK',
                                                    'KEYSTONE BANK LIMITED','NEW PRUDENTIAL BANK',
                                                    'NIGERIA INTL BANK LTD (CITIBANK)',
                                                    'PROVIDUS BANK','RAND MERCHANT BANK',
                                                    'SAFETRUST MORTGAGE BANK','SEED CAPITAL MICROFINANCE BANK',
                                                    'POLARIS BANK PLC','STANBIC-IBTC BANK PLC',
                                                    'STANDARD CHARTERED BANK','STERLING BANK',
                                                    'STERLING MOBILE','SUNTRUST BANK','UBA PLC',
                                                    'UNION BANK','UNITY BANK PLC','VFD MICROFINANCE BANK',
                                                    'WEMA BANK PLC','ZENITH BANK PLC']"
                                            :minInputLength="2"
                                            @onInput="bankSelected"
                                        >
                                        </SimpleTypeahead>

                                    </div>
                                </div>
                                <!-- bank_holder_name -->
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label">Account Name*</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" v-model="form.bank_holder_name"  required />
                                    </div>
                                </div>
                                <!-- bank_account_number -->
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label">Account Number *</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" v-model="form.bank_account_number"  required />
                                    </div>
                                </div>
                                <!-- sort_code -->
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label">sort Code *</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" v-model="form.sort_code" required />
                                    </div>
                                </div>
                                <!-- bank_branch -->
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label">Bank branch</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" v-model="form.bank_branch"  />
                                    </div>
                                </div>
                                <!-- Type-->
                                <div class="row mb-3 mt-4">
                                    <label class="col-sm-4 col-form-label">Account Type</label>
                                    <div class="col-sm-7">
                                        <select  class="form-select" v-model="form.type" required>
                                            <option value="">Choose</option>
                                            <option value="saving">Saving</option>
                                            <option value="current">Current</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Currecny-->
                                <div class="row mb-3 mt-4">
                                    <label class="col-sm-4 col-form-label">Curreny</label>
                                    <div class="col-sm-7">
                                        <select  class="form-select" v-model="form.currency_id" required>
                                            <option v-for="currency in currencies" :key="currency.id"  :value="currency.id">
                                                {{currency.name}}
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Country-->
                                <div class="row mb-3 mt-4">
                                    <label class="col-sm-4 col-form-label">Country</label>
                                    <div class="col-sm-7">
                                        <select  class="form-select" v-model="form.country" required>
                                            <option v-for="country in countries" :key="country.id"  :value="country.name">
                                                {{country.name}}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <!-- status-->
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label">Status</label>
                                    <div class="col-sm-7">
                                        <select  class="form-select" v-model="form.status" required>
                                            <option value="1">Active</option>
                                            <option value="0">Disabled</option>
                                        </select>
                                        <div v-if="form.errors.status" class="form-error">{{ form.errors.status }}</div>
                                    </div>
                                </div>
                                <!-- default-->
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label">Make Default</label>
                                    <div class="col-sm-7">
                                        <div class="form-check form-switch">
                                            <input
                                                class="form-check-input" type="checkbox"
                                                v-model="form.default"  :true-value="1" :false-value="0" />
                                            <label class="form-check-label" ></label>
                                        </div>
                                    </div>
                                </div>

                                <!-- swift-->
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label">swift</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" v-model="form.swift" />
                                    </div>
                                </div>

                                <!-- international Account-->

                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label">For Account Outside Nigeria</label>
                                    <div class="col-sm-7">
                                        <hr>
                                    </div>
                                </div>

                                <!-- bic-->
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label">BIC</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" v-model="form.bic">
                                    </div>
                                </div>

                                <!-- routing_no -->
                                <div class="row mb-3">
                                    <label class="col-sm-4 col-form-label">routing No</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" v-model="form.routing_no"  />
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-4 col-form-label"></label>
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-primary px-5">Submit</button>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="button" class="btn btn-danger px-5" @click="cancel">Cancel</button>
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
import SimpleTypeahead from 'vue3-simple-typeahead';
import 'vue3-simple-typeahead/dist/vue3-simple-typeahead.css'; //Optional default CSS


export default {
    name: "Bank",
    components: {
        SimpleTypeahead,
        Head,
        Link,
    },
    layout: DefaultLayout,
    props: {
        auth: Object,
        errors: Object,
        flash: Object,
        banks: Object,
        currencies:Object,
        countries:Object,
        user:Object,
        nigeriaBanks:Object,
    },
    data() {
        return {
            formTitle:"Add New Bank Address",
            toEdit:false,
            toEditId:'',
            form: this.$inertia.form({
                id:null,
                status: '1',
                default:'0',
                currency_id: this.user.currency_id,
                bank_name: '',
                bank_holder_name: '',
                bank_account_number: '',
                bank_branch: '',
                country: this.user.country,
                type: '',
                swift: '',
                bic: '',
                sort_code: '',
                routing_no: '',
            }),
        }
    },

    methods: {
        bankSelected(item){
            console.log("selected: "+item.input)
            this.form.bank_name =item.input
            // fin sort, swift and routing
            let selectedBank = this.nigeriaBanks.filter( function (bank) {
                // return bank.name == item.input
                return bank.name.includes(item.input)
            });
            if(selectedBank.length>0){
                this.form.sort_code = selectedBank[0].code,
                this.form.swift= selectedBank[0].code,
                this.form.routing_no=selectedBank[0].code
            }else{
                this.form.sort_code = "",
                this.form.swift="",
                this.form.routing_no=""
            }

        },
        submitBank() {
            if(this.toEdit){
                this.form.put(`/bank`)
                this.form.reset();
                this.formTitle= "Add Bitcoin Address";
                this.toEdit=false;
            }else{
                this.form.post(`/bank`)
            }
        },
        editBank(id, e){
            e.stopPropagation();
            let selectedAddress = this.banks.filter( function (bank) {
                return bank.encrypted_id == id
            });
            this.form.currency_id = selectedAddress[0].currency_id;
            this.form.bank_name= selectedAddress[0].bank_name;
            this.form.bank_holder_name= selectedAddress[0].bank_holder_name;
            this.form.bank_account_number= selectedAddress[0].bank_account_number;
            this.form.bank_branch = selectedAddress[0].bank_branch;
            this.form.country= selectedAddress[0].country;
            this.form.type= selectedAddress[0].type;
            this.form.swift= selectedAddress[0].swift;
            this.form.bic = selectedAddress[0].bic;
            this.form.sort_code = selectedAddress[0].sort_code;
            this.form.routing_no = selectedAddress[0].routing_no;
            this.form.status= selectedAddress[0].status;
            this.form.default= selectedAddress[0].default;
            this.form.id= selectedAddress[0].id;

            this.formTitle= "Edit Bank Details";
            this.toEdit=true;
        },

        cancel(){
            this.toEdit=false;
        }
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

watch: {
        form(val){
            console.log(val)
        }
    }

}

</script>

<style>
.dataTables_length{
    margin-bottom: 20px;
}

</style>
