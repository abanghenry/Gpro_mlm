<template>
    <!--sidebar wrapper -->
    <div class="sidebar-wrapper" data-simplebar="true">
        <div class="sidebar-header">
            <div>
                <img src="/assets/images/logo-icon.png" class="logo-icon" alt="logo icon" />
            </div>
            <div>
                <h4 class="logo-text">GProvida</h4>
            </div>
            <div class="toggle-icon ms-auto">
                <i class="bx bx-arrow-to-left"></i>
            </div>
        </div>
        <!--navigation-->
        <ul class="metismenu" id="menu">
            <li>
                <inertia-link :href="route('dashboard')">
                    <div class="parent-icon"><i class="bx bx-home-circle"></i></div>
                    <div class="menu-title">Dasboard</div>
                </inertia-link>
            </li>

            <template v-if="$page.props.store.user_stores">
                <li v-if="$page.props.store.user_stores.length>0">
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><i class="bx bx-home-circle"></i></div>
                        <div class="menu-title">Stockist Dasboard</div>
                    </a>
                    <ul>
                        <li v-for="outlet in $page.props.store.user_stores">
                            <inertia-link :href="`/stockist/${outlet.encrypted_id}`">
                                <div class="menu-title">{{ outlet.name }}</div>
                            </inertia-link>
                        </li>
                    </ul>
                </li>
            </template>




            <li class="menu-label">Profile</li>
            <li>
                <inertia-link :href="route('profile')">
                    <div class="parent-icon"><i class="bx bx-user-circle"></i></div>
                    <div class="menu-title">Profile</div>
                </inertia-link>
            </li>
            <li>
                <inertia-link :href="route('change-password')">
                    <div class="parent-icon"><i class="bx bx-lock"></i></div>
                    <div class="menu-title">Change Password</div>
                </inertia-link>
            </li>

            <li class="menu-label">Earnings</li>
            <li>
                <inertia-link :href="route('genealogy')">
                    <div class="parent-icon"><i class="bx bx-user"></i></div>
                    <div class="menu-title">Genealogy</div>
                </inertia-link>
            </li>

            <li>
                <inertia-link :href="route('upgrade')">
                    <div class="parent-icon"><i class="bx bx-user-plus"></i></div>
                    <div class="menu-title">Upgrade</div>
                </inertia-link>
            </li>

            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="bx bx-dollar-circle"></i></div>
                    <div class="menu-title">Payout</div>
                </a>
                <ul>
                    <li>
                        <inertia-link :href="route('payment')">
                            <div class="parent-icon"><i class="bx bx-right-arrow-alt"></i></div>
                            <div class="menu-title">Payment</div>
                        </inertia-link>
                    </li>
                    <li>
                        <inertia-link :href="route('bonusreferral')">
                            <div class="parent-icon"><i class="bx bx-right-arrow-alt"></i></div>
                            <div class="menu-title">Referral Bonus</div>
                        </inertia-link>
                    </li>
                    <li>
                        <inertia-link :href="route('bonusproduct')">
                            <div class="parent-icon"><i class="bx bx-right-arrow-alt"></i></div>
                            <div class="menu-title">Product PV</div>
                        </inertia-link>
                    </li>
                    <li>
                        <inertia-link :href="route('bonusbinary')">
                            <div class="parent-icon"><i class="bx bx-right-arrow-alt"></i></div>
                            <div class="menu-title">Binary PV</div>
                        </inertia-link>
                    </li>
                </ul>
            </li>

            <li>
                <inertia-link :href="route('referral')">
                    <div class="parent-icon"><i class="bx bx-line-chart-down"></i></div>
                    <div class="menu-title">My Referrals</div>
                </inertia-link>
            </li>


            <li class="menu-label">Products</li>
            <li>
                <inertia-link :href="route('order')">
                    <div class="parent-icon"><i class="bx bx-cart"></i></div>
                    <div class="menu-title">Make Order</div>
                </inertia-link>
            </li>
            <li>
                <inertia-link :href="route('order-history')">
                    <div class="parent-icon"><i class="bx bx-chart"></i></div>
                    <div class="menu-title">Order History</div>
                </inertia-link>
            </li>


            <li class="menu-label">Epin</li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon">
                        <i class="bx bx-wallet"></i>
                    </div>
                    <div class="menu-title">manage E-PIN</div>
                </a>
                <ul>
                    <li>
                        <inertia-link :href="route('pin')">
                            <div class="menu-title">My E-Pin</div>
                        </inertia-link>
                    </li>
                    <li>
                        <inertia-link :href="route('pin-used')">
                            <div class="menu-title">Used E-Pin</div>
                        </inertia-link>
                    </li>
                    <li>
                        <inertia-link :href="route('pin-request')">
                            <div class="menu-title">Request E-Pin</div>
                        </inertia-link>
                    </li>


                    <li>
                        <inertia-link :href="route('pin-report-rx')">
                            <div class="menu-title">Received Pin Report</div>
                        </inertia-link>
                    </li>
                </ul>
            </li>

            <li class="menu-label">Bank</li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="bx bx-map-alt"></i></div>
                    <div class="menu-title">Bank Details</div>
                </a>
                <ul>
                    <li>
                        <inertia-link :href="route('bank-account')">
                            <div class="menu-title">Bank Account</div>
                        </inertia-link>
                    </li>
                    <li>
                        <inertia-link :href="route('bitcoin-wallet')">
                            <div class="menu-title">Bitcoin Wallet</div>
                        </inertia-link>
                    </li>
                </ul>
            </li>


            <li class="menu-label">More </li>
            <li>
                <inertia-link href="/testimonial" >
                    <div class="parent-icon"><i class="bx bx-comment-check"></i></div>
                    <div class="menu-title">Testimonial</div>
                </inertia-link>
            </li>
            <li>
                <inertia-link href="/support" >
                    <div class="parent-icon"><i class="bx bx-support"></i></div>
                    <div class="menu-title">Support</div>
                </inertia-link>
            </li>

            <li>
                <inertia-link href="/logout">
                    <div class="parent-icon"><i class="bx bx-log-out-circle"></i></div>
                    <div class="menu-title">Logout</div>
                </inertia-link>

            </li>

        </ul>
        <!--end navigation-->
    </div>
    <!--end sidebar wrapper -->
</template>

<script>
export default {
    name: "Sidebar",
    props: {
        auth: Object,
        message: Object,
    },

    updated() {
        if($(".wrapper").hasClass("toggled")){   // remove toggled on load
            $(".wrapper").removeClass("toggled"),
                $(".sidebar-wrapper").unbind("hover")
        }
    },
    mounted(){
        $(document).ready(function() {

            $(".wrapper").hasClass("toggled") ? ($(".wrapper").removeClass("toggled"),
                $(".sidebar-wrapper").unbind("hover")) : ($(".wrapper").addClass("toggled"),
                $(".sidebar-wrapper").hover(function() {
                    $(".wrapper").addClass("sidebar-hovered")
                }, function() {
                    $(".wrapper").removeClass("sidebar-hovered")
                }))

            for (var e = window.location, o = $(".metismenu li a").filter(function() {
                return this.href == e
            }).addClass("").parent().addClass("mm-active"); o.is("li");) o = o.parent("").addClass("mm-show").parent("").addClass("mm-active")

            $("#menu").metisMenu()



            $(".mobile-toggle-menu").on("click", function() {
                $(".wrapper").addClass("toggled")
            });
            $(".toggle-icon").click(function() {
                $(".wrapper").hasClass("toggled") ? ($(".wrapper").removeClass("toggled"), $(".sidebar-wrapper").unbind("hover")) : ($(".wrapper").addClass("toggled"), $(".sidebar-wrapper").hover(function() {
                    $(".wrapper").addClass("sidebar-hovered")
                }, function() {
                    $(".wrapper").removeClass("sidebar-hovered")
                }))
            });




        } );
    },


};
</script>

<style scoped></style>
