<template>
    <div id="app" class="app wrapper">
        <!--start header -->
        <LayoutHeader />
        <!--end header -->

        <!-- app-sidebar -->
        <sidebar />

        <!-- app-content -->
        <slot />

        <!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>

        <!-- app-footer -->
        <LayoutFooter />
    </div>
</template>

<script>
import LayoutHeader from "@/Layouts/Partial/LayoutHeader.vue";
import Sidebar from "@/Layouts/Partial/Sidebar.vue";
import LayoutFooter from "@/Layouts/Partial/LayoutFooter.vue";
//import axios from "axios";

export default {
    name: "DefaultLayout",
    components: {
        LayoutHeader,
        Sidebar,
        LayoutFooter,
    },
    props: {
        auth: Object,
        errors: Object,
        store:Object,
    },


    /*
    data() {
        return {
            app_name: process.env.MIX_APP_NAME,
        };
    },
    watch: {
        "$page.props.flash": {
            handler() {
                if (this.$page.props.flash.message) {
                    notification_info(this.$page.props.flash.message);
                }
                if (this.$page.props.flash.success) {
                    notification_success(this.$page.props.flash.success);
                }
                if (this.$page.props.flash.error) {
                    notification_error(this.$page.props.flash.error);
                }
            },
            deep: true,
        },
    },
    */
};
</script>
