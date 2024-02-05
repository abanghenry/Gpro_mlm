<template>
    <div className="page-wrapper">
        <Head :title="`Bitcoin ${auth.user.username}`"/>
        <div className="page-content">
            <!--breadcrumb-->
            <div className="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div className="breadcrumb-title pe-3">Bitcoin</div>
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
                                <h5 className="mb-0 text-primary">Bitcoin</h5>
                            </div>
                            <hr>

                            <div class="table-responsive">
                                <table id="table" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Address Name</th>
                                        <th>Status</th>
                                        <th>Default</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(bitcoin, index) in bitcoins" :key="bitcoin.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                                        <td class="align-middle">{{ index+1}}</td>
                                        <td class="align-middle">{{ bitcoin.bit_address }}</td>
                                        <td class="align-middle">
                                            <span v-if="bitcoin.status==1" class="badge bg-primary">Active</span>
                                            <span v-else class="badge bg-warning text-dark">Inactive</span>
                                        </td>
                                        <td class="align-middle">
                                            <span v-if="bitcoin.default==1" class="badge bg-success">Default</span>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex order-actions">
                                                <button type="button" class="btn btn-sm btn-outline-info"
                                                        @click="editBitcoin(bitcoin.encrypted_id, $event)">
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


            <div className="row">
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

                            <form class="row g-3" @submit.prevent="submitBitcoin" >
                                <!-- Bitcoin Address-->
                                <div class="row mb-3 mt-4">
                                    <label class="col-sm-4 col-form-label">Bitcoin Address</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" v-model="form.bit_address" />
                                        <div v-if="form.errors.bit_address" class="form-error">{{ form.errors.bit_address }}</div>
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



                                <div class="row">
                                    <label class="col-sm-4 col-form-label"></label>
                                    <div class="col-sm-7">
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
import {Head, Link} from '@inertiajs/inertia-vue3'

export default {
    name: "Bitcoin",
    components: {
        Head,
        Link,
    },
    layout: DefaultLayout,
    props: {
        auth: Object,
        errors: Object,
        flash: Object,
        bitcoins: Object,
    },
    data() {
        return {
            formTitle:"Add New Bitcoin Address",
            toEdit:false,
            toEditId:'',
            form: this.$inertia.form({
                id:null,
                bit_address: '',
                status: '1',
                default:'0'
            }),
        }
    },

    methods: {
        submitBitcoin() {
            if(this.toEdit){
                this.form.put(`/bitcoin`)
                this.form.bit_address ='';
                this.form.status='1'
                this.form.default= '0';
                this.form.id= null;
                this.formTitle= "Add Bitcoin Address";
                this.toEdit=false;
            }else{
                this.form.post(`/bitcoin`)
            }

        },
        editBitcoin(id, e){
            e.stopPropagation();
            let selectedAddress = this.bitcoins.filter( function (bitcoin) {
                return bitcoin.encrypted_id == id
            });
            this.form.bit_address = selectedAddress[0].bit_address;
            this.form.status= selectedAddress[0].status;
            this.form.default= selectedAddress[0].default;
            this.form.id= selectedAddress[0].id;

            this.formTitle= "Edit Bitcoin Address";
            this.toEdit=true;

        }
    },

    mounted(){
        $(document).ready(function() {
            var table = $('#table').DataTable( {
                lengthMenu: [ 10, 25, 50, 100, 500 ],
                buttons: [ 'copy', 'excel', 'pdf', 'print'],
            } );

            table.buttons().container()
                .appendTo( '#table_wrapper .col-md-6:eq(0)' );
        } );
    },



}

</script>

<style>
.dataTables_length{
    margin-bottom: 20px;
}

</style>
