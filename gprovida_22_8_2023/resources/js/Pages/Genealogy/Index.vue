<template>
    <div class="page-wrapper">
        <Head :title="`Genealogy ${auth.user.username}`" />
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Genealogy</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-user-circle"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <inertia-link :href="route('genealogy')">
                                    {{ auth.user.username }}
                                </inertia-link>
                            </li>
                        </ol>
                    </nav>
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
                        <div class="card-body p-4" style="min-height: 700px">
                            <div class="card-title d-flex align-items-center">
                                <div>
                                    <i class="bx bx-lock me-1 font-22 text-primary"></i>
                                </div>
                                <h5 class="mb-0 text-primary">Genealogy</h5>
                            </div>
                            <hr>

                            <div class="genealogy overflow-auto">
                                <div style="min-width: 1000px">
                                    <div class="tree">
                                        <ul>
                                            <li>
                                                <a class="tooltipster" :data-tooltip-content="`#tooltip${user.id}`" :href="route('genealogy.view',user.encrypted_id )">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <img class="profile-rounded-image-small block-d" src="/images/user_small.png" width="37" height="37">
                                                            <p>
                                                                {{ user.username }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </a>
                                                <div class="tooltip_templates">
                                                <span :id="`tooltip${user.id}`">
                                                    <ul>
                                                        <li>User Id: {{ user.id }} </li>
                                                        <li>Name: {{ user.firstname }} {{ user.lastname }} </li>
                                                        <li>Username: {{ user.username }} </li>
                                                        <li>Phone: {{ user.phone }} </li>
                                                        <li>Shopping Link:</li>
                                                    </ul>
                                                </span>
                                                </div>
                                                <ul >
                                                    <template v-for="child in user.downlines" :key="user.id">
                                                        <li :id="child.position">
                                                            <inertia-link class="tooltipster" :data-tooltip-content="`#tooltip${child.id}`" :href="route('genealogy.view',child.encrypted_id )">
                                                                <div class="row">
                                                                    <div class="col-xs-12">
                                                                        <img class="profile-rounded-image-small block-d" src="/images/user_small.png" width="37" height="37">
                                                                        <p>
                                                                            {{ child.username }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </inertia-link>
                                                            <div class="tooltip_templates">
                                                            <span :id="`tooltip${child.id}`">
                                                            <ul>
                                                                <li>User Id: {{ child.id }} </li>
                                                                <li>Name: {{ child.firstname }} {{ child.lastname }} </li>
                                                                <li>Username: {{ child.username }} </li>
                                                                <li>Phone: {{ child.phone }} </li>
                                                                <li>Shopping Link: </li>
                                                            </ul>
                                                        </span>
                                                            </div>
                                                            <ul>
                                                                <template v-for="grandChild in child.downlines" :key="user.id">
                                                                    <li :id="grandChild.position">
                                                                        <inertia-link class="tooltipster" :data-tooltip-content="`#tooltip${grandChild.id}`" :href="route('genealogy.view',grandChild.encrypted_id )">
                                                                            <div class="row">
                                                                                <div class="col-xs-12">
                                                                                    <img class="profile-rounded-image-small block-d" src="/images/user_small.png" width="37" height="37">
                                                                                    <p>
                                                                                        {{ grandChild.username }}
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </inertia-link>
                                                                        <div class="tooltip_templates">
                                                                        <span :id="`tooltip${grandChild.id}`">
                                                                            <ul>
                                                                                <li>User Id: {{ grandChild.id }} </li>
                                                                                <li>Name: {{ grandChild.firstname }} {{ grandChild.lastname }} </li>
                                                                                <li>Username: {{ grandChild.username }} </li>
                                                                                <li>Phone: {{ grandChild.phone }} </li>
                                                                                <li>Shopping Link: </li>
                                                                            </ul>
                                                                        </span>
                                                                        </div>
                                                                        <ul>
                                                                            <template v-for="greatGrandChild in grandChild.downlines" :key="user.id">
                                                                                <li :id="greatGrandChild.position">
                                                                                    <inertia-link class="tooltipster" :data-tooltip-content="`#tooltip${greatGrandChild.id}`" :href="route('genealogy.view',greatGrandChild.encrypted_id )">
                                                                                        <div class="row">
                                                                                            <div class="col-xs-12">
                                                                                                <img class="profile-rounded-image-small block-d" src="/images/user_small.png" width="37" height="37">
                                                                                                <p>
                                                                                                    {{ greatGrandChild.username }}
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </inertia-link>
                                                                                    <div class="tooltip_templates">
                                                                                    <span :id="`tooltip${greatGrandChild.id}`">
                                                                                    <ul>
                                                                                        <li>User Id: {{ greatGrandChild.id }} </li>
                                                                                        <li>Name: {{ greatGrandChild.firstname }} {{ greatGrandChild.lastname }} </li>
                                                                                        <li>Username: {{ greatGrandChild.username }} </li>
                                                                                        <li>Phone: {{ greatGrandChild.phone }} </li>
                                                                                        <li>Shopping Link: </li>
                                                                                    </ul>
                                                                                </span>
                                                                                    </div>
                                                                                </li>
                                                                            </template>
                                                                            <template v-if="grandChild.downlines.length == 0">
                                                                                <li>
                                                                                    <inertia-link :href="route('genealogy.create')+`?referred_by=${auth.user.id}`+`&parent=${grandChild.id}`+`&location=1`">
                                                                                        <div class="row">
                                                                                            <div class="col-xs-12">
                                                                                                <img class="profile-rounded-image-small" src="/images/user-add-new.png" alt="Add new member" title="Add new member" width="37" height="37">
                                                                                            </div>
                                                                                        </div>
                                                                                    </inertia-link>
                                                                                </li>
                                                                                <li>
                                                                                    <inertia-link :href="route('genealogy.create')+`?referred_by=${auth.user.id}`+`&parent=${grandChild.id}`+`&location=2`">
                                                                                        <div class="row">
                                                                                            <div class="col-xs-12">
                                                                                                <img class="profile-rounded-image-small" src="/images/user-add-new.png" alt="Add new member" title="Add new member" width="37" height="37">
                                                                                            </div>
                                                                                        </div>
                                                                                    </inertia-link>
                                                                                </li>
                                                                            </template>
                                                                            <template v-if="grandChild.downlines.length == 1">
                                                                                <li>
                                                                                    <inertia-link :href="route('genealogy.create')+`?referred_by=${auth.user.id}`+`&parent=${grandChild.id}`">
                                                                                        <div class="row">
                                                                                            <div class="col-xs-12">
                                                                                                <img class="profile-rounded-image-small" src="/images/user-add-new.png" alt="Add new member" title="Add new member" width="37" height="37">
                                                                                            </div>
                                                                                        </div>
                                                                                    </inertia-link>
                                                                                </li>
                                                                            </template>
                                                                        </ul>
                                                                    </li>
                                                                </template>
                                                                <template v-if="child.downlines.length == 0">
                                                                    <li>
                                                                        <inertia-link :href="route('genealogy.create')+`?referred_by=${auth.user.id}`+`&parent=${child.id}`+`&location=1`">
                                                                            <div class="row">
                                                                                <div class="col-xs-12">
                                                                                    <img class="profile-rounded-image-small" src="/images/user-add-new.png" alt="Add new member" title="Add new member" width="37" height="37">
                                                                                </div>
                                                                            </div>
                                                                        </inertia-link>
                                                                    </li>
                                                                    <li>
                                                                        <inertia-link :href="route('genealogy.create')+`?referred_by=${auth.user.id}`+`&parent=${child.id}`+`&location=2`">
                                                                            <div class="row">
                                                                                <div class="col-xs-12">
                                                                                    <img class="profile-rounded-image-small" src="/images/user-add-new.png" alt="Add new member" title="Add new member" width="37" height="37">
                                                                                </div>
                                                                            </div>
                                                                        </inertia-link>
                                                                    </li>
                                                                </template>
                                                                <template v-if="child.downlines.length == 1">
                                                                    <li>
                                                                        <inertia-link :href="route('genealogy.create')+`?referred_by=${auth.user.id}`+`&parent=${child.id}`">
                                                                            <div class="row">
                                                                                <div class="col-xs-12">
                                                                                    <img class="profile-rounded-image-small" src="/images/user-add-new.png" alt="Add new member" title="Add new member" width="37" height="37">
                                                                                </div>
                                                                            </div>
                                                                        </inertia-link>
                                                                    </li>
                                                                </template>
                                                            </ul>
                                                        </li>
                                                    </template>
                                                    <template v-if="user.downlines.length == 1">
                                                        <li>
                                                            <inertia-link :href="route('genealogy.create')+`?referred_by=${auth.user.id}`+`&parent=${user.id}`">
                                                                <div class="row">
                                                                    <div class="col-xs-12">
                                                                        <img class="profile-rounded-image-small" src="/images/user-add-new.png"
                                                                             alt="Add new member" title="Add new member Right" width="37" height="37">
                                                                    </div>
                                                                </div>
                                                            </inertia-link>
                                                        </li>
                                                    </template>
                                                    <template v-if="user.downlines.length == 0">
                                                        <li>
                                                            <inertia-link :href="route('genealogy.create')+`?referred_by=${auth.user.id}`+`&parent=${user.id}`+`&location=1`">
                                                                <div class="row">
                                                                    <div class="col-xs-12">
                                                                        <img class="profile-rounded-image-small" src="/images/user-add-new.png"
                                                                             alt="Add new member" title="Add new member left" width="37" height="37">
                                                                    </div>
                                                                </div>
                                                            </inertia-link>
                                                        </li>
                                                        <li>
                                                            <inertia-link :href="route('genealogy.create')+`?referred_by=${auth.user.id}`+`&parent=${user.id}`+`&location=2`">
                                                                <div class="row">
                                                                    <div class="col-xs-12">
                                                                        <img class="profile-rounded-image-small" src="/images/user-add-new.png" alt="Add new member" title="Add new member" width="37" height="37">
                                                                    </div>
                                                                </div>
                                                            </inertia-link>
                                                        </li>
                                                    </template>
                                                </ul>
                                            </li>
                                        </ul>
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
    name: "Genealogy",
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
            }),
        }
    },
    methods: {
        update() {
            this.form.post(`/profile-genealogy`)
        },
    },
    mounted(){
        $(document).ready(function() {
            $('.tooltipster').tooltipster({
                'side': 'right',
                'interactive': true,
                'delay': [300,1000]
            });
        });
    },
}

</script>

<style scoped>
 .tooltip_templates {
     display: none;
 }
</style>

