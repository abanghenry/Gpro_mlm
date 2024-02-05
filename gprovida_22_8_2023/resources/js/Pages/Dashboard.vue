<template>
    <div class="page-wrapper">
        <div class="page-content">
            <!-- messages -->
            <div class="row">
                <div v-if="$page.props.flash.success" className="alert alert-success" role="alert">
                    {{ $page.props.flash.success }}
                </div>
                <div v-if="$page.props.flash.error" className="alert alert-danger" role="alert">
                    {{ $page.props.flash.error }}
                </div>
            </div>


            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3" style="border-right: none">Welcome to Gprovida</div>
                <div class="ms-auto">
                    <div class="row row-cols-auto g-3">
                        <div class="col">
                            <inertia-link :href="route('payment')" class="btn btn-primary button-icon mr-3 mt-1 mb-1">
                                <span>Wallet Balance: {{user.currency.prefix}}{{user.wallet.toLocaleString()}}</span>

                            </inertia-link>
                        </div>
                        <div class="col">
                            <inertia-link :href="route('referral')" class="btn btn-success button-icon mr-3 mt-1 mb-1">
                                <span>Referrals</span>
                            </inertia-link>
                        </div>
                        <div class="col">
                            <inertia-link :href="route('order')" class="btn btn-warning button-icon mr-3 mt-1 mb-1">
                                <span>Make Order</span>
                            </inertia-link>
                        </div>
                        <div class="col">
                            <inertia-link :href="route('genealogy')" class="btn btn-info button-icon mr-3 mt-1 mb-1">
                                <span>Genelogy</span>
                            </inertia-link>
                        </div>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->

            <!--profile-->
            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card radius-10" style="background: rgba(0, 111, 255, 0.1);
                                            border-radius: 4px; border: 1px solid rgba(0, 111, 255, 0.12);">
                        <div class="card-body" style="padding: 12px 24px">
                            <div class="row" style="display: flex; -webkit-box-align: center; align-items: center;">
                                <div class="col-xl-1 col-lg-2 col-md-12">
                                    <div class="d-flex align-items-center mr-2">
                                      <img src="/images/rank/logo.png"
                                      height="100">
                                    </div>
                                </div>
                                <div class="col-xl-7 col-lg-6 col-md-12">
                                    <h3 class="mb-1 px-3">Hello  <span class="font-weight-bold text-primary">{{user.firstname}} {{user.lastname}}</span></h3>
                                    <p class="mb-0  px-3 fs-16"> GPro HEALTHY &amp; WEALTHY FAMILY</p>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 text-lg-right">
                                    <div class="d-flex align-items-center">
                                        <div class="ms-auto">
                                            <inertia-link :href="route('profile')" class="btn btn-danger mt-1 mb-1">
                                                View Profile
                                            </inertia-link>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Earnings-->
            <div class="row">
                <div class="col-md-12 col-xl-10">
                    <div class="card radius-10 bg-primary bg-gradient">
                        <div class="card-body">
                            <h5 class="card-title text-white">Estimated earnings</h5>
                            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-5">
                                <div class="col">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-white">Referral Bonus</p>
                                            <h4 class="my-1 text-white">{{user.currency.prefix}}{{ currentReferralBonus.toLocaleString() }}</h4>
                                            <p class="mb-0 text-white">Current referral bonus</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-white">Stockist Bonus</p>
                                            <h4 class="my-1 text-white">{{ user.currency.prefix}}{{ currentStockistBonus.toLocaleString() }}</h4>
                                            <p class="mb-0 text-white">Current Stockist Referral Bonus</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-white">Product PV</p>
                                            <h4 class="my-1 text-white">{{ user.current_direct_pv+0 }}</h4>
                                            <p class="mb-0 text-white">Product repurchase PV</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-white">Binary PV</p>
                                            <h4 class="my-1 text-white">{{ user.current_binary_pv+0 }}</h4>
                                            <p class="mb-0 text-white">Current Binary PV</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-white">Total Earning</p>
                                            <h4 class="my-1 text-white">
                                                {{ user.currency.prefix}}{{ totalEarning.toLocaleString()  }}</h4>
                                            <p class="mb-0 text-white">Total Paid Earning</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xl-2">
                    <div class="card radius-10 bg-primary bg-gradient">
                        <div class="card-body">
                            <h5 class="card-title text-white">Balance</h5>
                            <div class="d-flex align-items-center">
                                <div>
                                    <h4 class="my-1 text-white">{{user.currency.prefix}}{{ totalPendingEarning.toLocaleString() }}</h4>
                                    <p class="mb-0 text-white">Last payment {{user.currency.prefix}}{{ totalEarning.toLocaleString() }}</p>
                                    <p class="mb-0 text-white">Wallet: {{user.currency.prefix}}{{ user.wallet.toLocaleString() }}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                <div class="col">
                    <div class="card radius-10 bg-success bg-gradient">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h4 class="my-1 text-white">{{ user.award_pv_right+0}}</h4>
                                    <p class="mb-0 text-white">Ranking Right PV</p>
                                </div>
                                <div class="text-white ms-auto font-35"><i class='bx bx-trophy'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 bg-info">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h4 class="my-1 text-dark">{{ user.award_pv_left+0}}</h4>
                                    <p class="mb-0 text-dark">Ranking Left PV</p>
                                </div>
                                <div class="text-dark ms-auto font-35"><i class='bx bx-trophy'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 bg-danger bg-gradient">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h4 class="my-1 text-white" v-if="user.downlines.length>0">
                                       {{ user.downlines[0].current_binary_pv+user.downlines[0].spill_over_binary_pv+0 }}
                                    </h4>
                                    <h4 class="my-1 text-white" v-else>0</h4>
                                    <p class="mb-0 text-white">Pairing Left PV</p>
                                </div>
                                <div class="text-white ms-auto font-35"><i class='bx bx-coin-stack'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 bg-warning bg-gradient">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h4 class="my-1 text-white" v-if="user.downlines.length>1">
                                        {{ user.downlines[1].current_binary_pv+user.downlines[1].spill_over_binary_pv+0 }}
                                    </h4>
                                    <h4 class="my-1 text-white" v-else>0</h4>
                                    <p class="mb-0 text-dark">Pairing Right PV</p>
                                </div>
                                <div class="text-dark ms-auto font-35"><i class='bx bx-coin-stack'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-warning">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Expected Binary Earning</p>
                                    <h4 class="my-1 text-warning">{{user.currency.prefix}}{{ estimateBinaryEarning.toLocaleString() }}</h4>
                                    <inertia-link href="/bonusbinary" >
                                        <div class="mb-0 font-13 text-black-50">view Details</div>
                                    </inertia-link>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto">
                                    <i class='bx bxs-wallet'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-info">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Loyalty Bonus</p>
                                    <h4 class="my-1 text-info">{{user.currency.prefix}}{{ earningLoyalty.toLocaleString() }}</h4>
                                    <inertia-link href="/payment?type=loyalty" >
                                        <div class="mb-0 font-13 text-black-50">view Details</div>
                                    </inertia-link>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto">
                                    <i class='bx bxs-wallet'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-danger">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Global Sales</p>
                                    <h4 class="my-1 text-danger">{{user.currency.prefix}}{{ earningGlobal.toLocaleString() }}</h4>
                                    <inertia-link href="/payment?type=global" >
                                        <div class="mb-0 font-13 text-black-50">view Details</div>
                                    </inertia-link>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto">
                                    <i class='bx bxs-wallet'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-success">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Special Bonus</p>
                                    <h4 class="my-1 text-success">{{user.currency.prefix}}{{ earningSpecial.toLocaleString() }}</h4>
                                    <inertia-link href="/payment?type=special" >
                                        <div class="mb-0 font-13 text-black-50">view Details</div>
                                    </inertia-link>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">
                                    <i class='bx bxs-wallet' ></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!--end row-->

            <!-- recent order -->
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Recent Orders</h6>
                        </div>
                        <div class="dropdown ms-auto">
                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th>Photo</th>
                                <th>Product ID</th>
                                <th>Status</th>
                                <th>Amount</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="lastorder in lastorders" :key="lastorder.id">
                                <td>{{lastorder.name}}</td>
                                <td><img :src="lastorder.product.image_url" class="product-img-2" :alt="lastorder.name"></td>
                                <td>{{lastorder.product.sku }}</td>
                                <td>
                                    <span v-if="lastorder.order.status_order=='pending'"
                                         class="badge bg-gradient-blooker text-white shadow-sm w-100">
                                        pending
                                    </span>
                                    <span v-else-if="lastorder.order.status_order=='processing'"
                                         class="badge bg-gradient-deepblue text-white shadow-sm w-100">
                                        processing
                                    </span>
                                    <span v-else-if="lastorder.order.status_order=='shipped'"
                                         class="badge bg-gradient-quepal text-white shadow-sm w-100">
                                        shipped
                                    </span>
                                    <span v-else-if="lastorder.order.status_order=='cancelled'"
                                         class="badge bg-gradient-bloody text-white shadow-sm w-100">
                                        cancelled
                                    </span>
                                    <span v-else-if="lastorder.order.status_order=='fraud'"
                                         class="badge bg-gradient-ibiza text-white shadow-sm w-100">
                                        fraud
                                    </span>
                                    <span v-else
                                         class="badge bg-gradient-moonlit text-white shadow-sm w-100">
                                        {{ lastorder.order.status_order }}
                                    </span>
                                </td>
                                <td>{{lastorder.currency.prefix}}{{lastorder.amount.toLocaleString() }}</td>
                                <td>{{lastorder.qty}}</td>
                                <td>{{lastorder.currency.prefix}}{{lastorder.total.toLocaleString() }}</td>
                                <td>{{lastorder.order_date}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- order summary, news, & profile -->
            <div class="row row-cols-1 row-cols-lg-3">
                <div class="col d-flex">
                    <div class="card radius-10 w-100">
                        <div class="card-header bg-transparent">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0">Orders Summary</h6>
                                </div>
                                <div class="dropdown ms-auto">
                                    <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container-1">
                                <canvas id="chart4"></canvas>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush">



                            <li v-for="(summary, key) in orderSummary" class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                                {{key}}

                                <span class="badge rounded-pill" :class="`${key}`">{{summary}}</span>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col d-flex">
                    <div class="card radius-10 w-100">
                        <div class="card-header bg-transparent">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0">Company News</h6>
                                </div>
                                <div class="dropdown ms-auto">
                                    <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container-1">
                                 <p>no news</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col d-flex">
                    <div class="card radius-10 w-100">
                        <div class="card-header bg-transparent">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0">Account Profile</h6>
                                </div>
                                <div class="dropdown ms-auto">
                                    <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container-1">
                                <div class="d-md-flex align-items-center py-1">
                                    <div class="d-flex align-items-center" style="width:35%">
                                        <p class="mb-0"><b>Firstname: </b></p>
                                    </div>
                                    <div class="">
                                        <p class="mb-0">{{ user.firstname }}</p>
                                    </div>
                                </div>
                                <div class="d-md-flex align-items-center py-1">
                                    <div class="d-flex align-items-center" style="width:35%">
                                        <p class="mb-0"><b>Lastname: </b></p>
                                    </div>
                                    <div class="">
                                        <p class="mb-0">{{user.lastname }} </p>
                                    </div>
                                </div>
                                <div class="d-md-flex align-items-center py-1">
                                    <div class="d-flex align-items-center" style="width:35%">
                                        <p class="mb-0"><b>Username: </b></p>
                                    </div>
                                    <div class="">
                                        <p class="mb-0">{{user.username }}  </p>
                                    </div>
                                </div>
                                <div class="d-md-flex align-items-center py-1">
                                    <div class="d-flex align-items-center" style="width:35%">
                                        <p class="mb-0"><b>Email: </b></p>
                                    </div>
                                    <div class="">
                                        <p class="mb-0">{{ user.email }}</p>
                                    </div>
                                </div>
                                <div class="d-md-flex align-items-center py-1">
                                    <div class="d-flex align-items-center" style="width:35%">
                                        <p class="mb-0"><b>Phone No: </b></p>
                                    </div>
                                    <div class="">
                                        <p class="mb-0">{{ user.phone }} </p>
                                    </div>
                                </div>
                                <div class="d-md-flex align-items-center py-1">
                                    <div class="d-flex align-items-center" style="width:35%">
                                        <p class="mb-0"><b>Date of Join: </b></p>
                                    </div>
                                    <div class="">
                                        <p class="mb-0">{{ user.joined_date }} </p>
                                    </div>
                                </div>
                                <div class="d-md-flex align-items-center py-1">
                                    <div class="d-flex align-items-center" style="width:35%">
                                        <p class="mb-0"><b>Country: </b></p>
                                    </div>
                                    <div class="">
                                        <p class="mb-0">{{ user.country }} </p>
                                    </div>
                                </div>
                                <div class="d-md-flex align-items-center py-1">
                                    <div class="d-flex align-items-center" style="width:35%">
                                        <p class="mb-0"><b>Joining Package: </b></p>
                                    </div>
                                    <div class="">
                                        <p class="mb-0">{{ user.package.name }} </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end row-->




            <!-- Last 10 Referral & Direct Bonus -->
            <div class="row row-cols-1 row-cols-lg-2">
                <div class="col d-flex">
                    <div class="card radius-10 w-100">
                        <div class="card-header bg-transparent">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0">Lastest 10 Referral Bonus</h6>
                                </div>
                                <div class="dropdown ms-auto">
                                    <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="height: 300px; font-size: 12px">
                            <div class="table-wrapper">
                              <table class="table table-striped table-sm mb-0 ">
                                <thead class="table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Date Earned</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(referralBonus, index) in latestReferralBonus" :key="referralBonus.id">
                                    <th scope="row">{{index+1}}</th>
                                    <td>{{referralBonus.currency_code}}{{referralBonus.amount.toLocaleString()}}</td>
                                    <td>{{referralBonus.earned_date}}</td>
                                    <td>
                                    <span v-if="referralBonus.status=='0'"
                                          class="badge bg-gradient-blooker text-white shadow-sm w-100">
                                        pending
                                    </span>
                                        <span v-else-if="referralBonus.status=='1'"
                                              class="badge bg-gradient-deepblue text-white shadow-sm w-100">
                                        processing
                                    </span>
                                        <span v-else-if="referralBonus.status=='2'"
                                              class="badge bg-gradient-quepal text-white shadow-sm w-100">
                                        paid
                                    </span>
                                        <span v-else-if="referralBonus.status=='3'"
                                              class="badge bg-gradient-bloody text-white shadow-sm w-100">
                                        cforward
                                    </span>
                                        <span v-else
                                              class="badge bg-gradient-moonlit text-white shadow-sm w-100">
                                        {{ referralBonus.status }}
                                    </span>
                                    </td>
                                    <td>{{referralBonus.details}}</td>
                                </tr>
                                </tbody>
                              </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col d-flex">
                    <div class="card radius-10 w-100">
                        <div class="card-header bg-transparent">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0">Last 10 Direct Purchase Bonus</h6>
                                </div>
                                <div class="dropdown ms-auto">
                                    <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="height: 300px; font-size: 12px">
                            <div class="table-wrapper">
                                <table class="table table-striped table-sm mb-0 ">
                                    <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">PV</th>
                                        <th scope="col">Date Earned</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Details</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(directBonus, index) in latestDirectBonus" :key="directBonus.id">
                                        <th scope="row">{{index+1}}</th>
                                        <td>{{directBonus.pv.toLocaleString()}}</td>
                                        <td>{{directBonus.earned_date}}</td>
                                        <td>
                                            <span v-if="directBonus.status=='0'"
                                                  class="badge bg-gradient-blooker text-white shadow-sm w-100">
                                                pending
                                            </span>
                                                    <span v-else-if="directBonus.status=='1'"
                                                          class="badge bg-gradient-deepblue text-white shadow-sm w-100">
                                                processing
                                            </span>
                                                    <span v-else-if="directBonus.status=='2'"
                                                          class="badge bg-gradient-quepal text-white shadow-sm w-100">
                                                paid
                                            </span>
                                                    <span v-else-if="directBonus.status=='3'"
                                                          class="badge bg-gradient-bloody text-white shadow-sm w-100">
                                                cforward
                                            </span>
                                                    <span v-else
                                                          class="badge bg-gradient-moonlit text-white shadow-sm w-100">
                                                {{ directBonus.status }}
                                            </span>
                                        </td>
                                        <td>{{directBonus.details}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end row-->
            <!-- Last 10 Binary  & Payment -->
            <div class="row row-cols-1 row-cols-lg-2">
                <div class="col d-flex">
                    <div class="card radius-10 w-100">
                        <div class="card-header bg-transparent">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0">Last 10 Binary PV earned</h6>
                                </div>
                                <div class="dropdown ms-auto">
                                    <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                                        <i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="font-size: 12px">
                            <div class="table-wrapper">
                                <table class="table table-striped table-sm mb-0 ">
                                    <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">PV</th>
                                        <th scope="col">Date Earned</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Details</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(binaryBonus, index) in latestBinaryBonus" :key="binaryBonus.id">
                                        <th scope="row">{{index+1}}</th>
                                        <td>{{binaryBonus.pv.toLocaleString()}}</td>
                                        <td>{{binaryBonus.earned_date}}</td>
                                        <td>
                                            <span v-if="binaryBonus.status=='0'"
                                                  class="badge bg-gradient-blooker text-white shadow-sm w-100">
                                                pending
                                            </span>
                                            <span v-else-if="binaryBonus.status=='1'"
                                                  class="badge bg-gradient-deepblue text-white shadow-sm w-100">
                                                processing
                                            </span>
                                            <span v-else-if="binaryBonus.status=='2'"
                                                  class="badge bg-gradient-quepal text-white shadow-sm w-100">
                                                paid
                                            </span>
                                            <span v-else-if="binaryBonus.status=='3'"
                                                  class="badge bg-gradient-bloody text-white shadow-sm w-100">
                                                cforward
                                            </span>
                                            <span v-else
                                                  class="badge bg-gradient-moonlit text-white shadow-sm w-100">
                                                {{ binaryBonus.status }}
                                            </span>
                                        </td>
                                        <td>{{binaryBonus.details}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col d-flex">
                    <div class="card radius-10 w-100">
                        <div class="card-header bg-transparent">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0">Last 10 Payments</h6>
                                </div>
                                <div class="dropdown ms-auto">
                                    <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="font-size: 12px">
                            <div class="table-wrapper">
                                <table class="table table-striped table-sm mb-0 ">
                                    <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Date Paid</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Details</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(payment, index) in latestPayment" :key="payment.id">
                                        <th scope="row">{{index+1}}</th>
                                        <td>{{payment.currency.prefix}}{{payment.amount.toLocaleString()}}</td>
                                        <td>{{payment.paid_date}}</td>
                                        <td>
                                            <span v-if="payment.status=='pending'"
                                                  class="badge bg-gradient-blooker text-white shadow-sm w-100">
                                                pending
                                            </span>
                                            <span v-else-if="payment.status=='flushed'"
                                                  class="badge bg-gradient-deepblue text-white shadow-sm w-100">
                                                flushed
                                            </span>
                                            <span v-else-if="payment.status=='paid'"
                                                  class="badge bg-gradient-quepal text-white shadow-sm w-100">
                                                paid
                                            </span>
                                            <span v-else-if="payment.status=='cforward'"
                                                  class="badge bg-gradient-bloody text-white shadow-sm w-100">
                                                cforward
                                            </span>
                                            <span v-else
                                                  class="badge bg-gradient-moonlit text-white shadow-sm w-100">
                                                {{ payment.status }}
                                            </span>
                                        </td>
                                        <td>{{payment.description}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end row-->


        </div>
    </div>

</template>

<script>
import DefaultLayout from '@/Layouts/DefaultLayout.vue'
import { Bar } from 'vue-chartjs'

export default {
    metaInfo: { title: 'Dashboard' },
    layout: DefaultLayout,
    props: {
        auth: Object,
        errors: Object,
        flash: Object,
        user: Object,
        orderSummary:Object,
        lastorders:Object,
        latestReferralBonus:Object,
        latestBinaryBonus:Object,
        latestDirectBonus:Object,
        latestPayment:Object,
        currentReferralBonus: Object,
        currentStockistBonus: Object,
        totalEarning: Object,
        totalPendingEarning: Object,
        earningLoyalty: Object,
        earningGlobal: Object,
        earningSpecial: Object,
        earningStockist: Object,
        estimateBinaryEarning: Object,
    },
    mounted() {

        // chart 4

        var ctx = document.getElementById("chart4").getContext('2d');

        var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
        gradientStroke1.addColorStop(0, '#ee0979');
        gradientStroke1.addColorStop(1, '#ff6a00');

        var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
        gradientStroke2.addColorStop(0, '#283c86');
        gradientStroke2.addColorStop(1, '#39bd3c');

        var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 300);
        gradientStroke3.addColorStop(0, '#7f00ff');
        gradientStroke3.addColorStop(1, '#e100ff');


        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ["Completed", "Pending", "Process", "Process3"],
                datasets: [{
                    backgroundColor: [
                        gradientStroke1,
                        gradientStroke2,
                        gradientStroke3
                    ],

                    hoverBackgroundColor: [
                        gradientStroke1,
                        gradientStroke2,
                        gradientStroke3
                    ],

                    data: [50, 50, 50],
                    borderWidth: [1, 1, 1]
                }]
            },
            options: {
                maintainAspectRatio: false,
                cutoutPercentage: 0,
                legend: {
                    position: 'bottom',
                    display: false,
                    labels: {
                        boxWidth:8
                    }
                },
                tooltips: {
                    displayColors:false,
                },
            }
        });

    }

}
</script>


<style scoped>

.table-wrapper {
    max-height: 260px;
    overflow: auto;
    display:inline-block;
    width: 100%;
}

.pending{
    background: #fc4a1a;
    background: -webkit-linear-gradient( 45deg , #fc4a1a, #f7b733) !important;
    background: linear-gradient( 45deg , #fc4a1a, #f7b733) !important;
}
.cancelled{
    background: #ffdf40;
    background: -webkit-linear-gradient(45deg, #ffdf40, #ff8359)!important;
    background: linear-gradient(45deg, #ffdf40, #ff8359)!important;
}
.fraud{
    background: #ee0979;
    background: -webkit-linear-gradient( 45deg , #ee0979, #ff6a00) !important;
    background: linear-gradient( 45deg , #ee0979, #ff6a00) !important;
}
.processing{
    background: #42e695;
    background: -webkit-linear-gradient( 45deg , #42e695, #3bb2b8) !important;
    background: linear-gradient( 45deg , #42e695, #3bb2b8) !important;
}
.shipped{
    background: #6a11cb;
    background: -webkit-linear-gradient( 45deg , #6a11cb, #2575fc) !important;
    background: linear-gradient( 45deg , #6a11cb , #2575fc) !important
}



</style>

