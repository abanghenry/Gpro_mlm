import{D as p}from"./DefaultLayout.5299b97b.js";import{_ as x}from"./_plugin-vue_export-helper.cdc0426e.js";import{r as y,o,c as i,b as t,t as s,d as w,a as r,i as _,l as m,F as b,e as g,j as h,x as f,p as k,k as S}from"./app.76d76681.js";const L={metaInfo:{title:"Dashboard"},layout:p,props:{auth:Object,errors:Object,flash:Object,user:Object,orderSummary:Object,lastorders:Object,latestReferralBonus:Object,latestBinaryBonus:Object,latestDirectBonus:Object,latestPayment:Object,currentReferralBonus:Object,currentStockistBonus:Object,totalEarning:Object,totalPendingEarning:Object,earningLoyalty:Object,earningGlobal:Object,earningSpecial:Object,earningStockist:Object,estimateBinaryEarning:Object},mounted(){var c=document.getElementById("chart4").getContext("2d"),v=c.createLinearGradient(0,0,0,300);v.addColorStop(0,"#ee0979"),v.addColorStop(1,"#ff6a00");var d=c.createLinearGradient(0,0,0,300);d.addColorStop(0,"#283c86"),d.addColorStop(1,"#39bd3c");var u=c.createLinearGradient(0,0,0,300);u.addColorStop(0,"#7f00ff"),u.addColorStop(1,"#e100ff"),new Chart(c,{type:"pie",data:{labels:["Completed","Pending","Process","Process3"],datasets:[{backgroundColor:[v,d,u],hoverBackgroundColor:[v,d,u],data:[50,50,50],borderWidth:[1,1,1]}]},options:{maintainAspectRatio:!1,cutoutPercentage:0,legend:{position:"bottom",display:!1,labels:{boxWidth:8}},tooltips:{displayColors:!1}}})}},a=c=>(k("data-v-566bd6eb"),c=c(),S(),c),P={class:"page-wrapper"},D={class:"page-content"},j={class:"row"},O={key:0,className:"alert alert-success",role:"alert"},C={key:1,className:"alert alert-danger",role:"alert"},E={class:"page-breadcrumb d-none d-sm-flex align-items-center mb-3"},V=a(()=>t("div",{class:"breadcrumb-title pe-3",style:{"border-right":"none"}},"Welcome to Gprovida",-1)),z={class:"ms-auto"},R={class:"row row-cols-auto g-3"},G={class:"col"},N={class:"col"},A=a(()=>t("span",null,"Referrals",-1)),I={class:"col"},B=a(()=>t("span",null,"Make Order",-1)),q={class:"col"},T=a(()=>t("span",null,"Genelogy",-1)),W={class:"row"},F={class:"col-md-12 col-xl-12"},H={class:"card radius-10",style:{background:"rgba(0, 111, 255, 0.1)","border-radius":"4px",border:"1px solid rgba(0, 111, 255, 0.12)"}},Y={class:"card-body",style:{padding:"12px 24px"}},J={class:"row",style:{display:"flex","-webkit-box-align":"center","align-items":"center"}},M=a(()=>t("div",{class:"col-xl-1 col-lg-2 col-md-12"},[t("div",{class:"d-flex align-items-center mr-2"},[t("img",{src:"/images/rank/logo.png",height:"100"})])],-1)),Q={class:"col-xl-7 col-lg-6 col-md-12"},U={class:"mb-1 px-3"},K={class:"font-weight-bold text-primary"},X=a(()=>t("p",{class:"mb-0 px-3 fs-16"}," GPro HEALTHY & WEALTHY FAMILY",-1)),Z={class:"col-xl-4 col-lg-4 col-md-12 text-lg-right"},$={class:"d-flex align-items-center"},tt={class:"ms-auto"},st={class:"row"},et={class:"col-md-12 col-xl-10"},dt={class:"card radius-10 bg-primary bg-gradient"},at={class:"card-body"},ot=a(()=>t("h5",{class:"card-title text-white"},"Estimated earnings",-1)),it={class:"row row-cols-1 row-cols-md-2 row-cols-xl-5"},ct={class:"col"},lt={class:"d-flex align-items-center"},nt=a(()=>t("p",{class:"mb-0 text-white"},"Referral Bonus",-1)),rt={class:"my-1 text-white"},_t=a(()=>t("p",{class:"mb-0 text-white"},"Current referral bonus",-1)),ht={class:"col"},bt={class:"d-flex align-items-center"},gt=a(()=>t("p",{class:"mb-0 text-white"},"Stockist Bonus",-1)),vt={class:"my-1 text-white"},ut=a(()=>t("p",{class:"mb-0 text-white"},"Current Stockist Referral Bonus",-1)),mt={class:"col"},wt={class:"d-flex align-items-center"},pt=a(()=>t("p",{class:"mb-0 text-white"},"Product PV",-1)),xt={class:"my-1 text-white"},yt=a(()=>t("p",{class:"mb-0 text-white"},"Product repurchase PV",-1)),ft={class:"col"},kt={class:"d-flex align-items-center"},St=a(()=>t("p",{class:"mb-0 text-white"},"Binary PV",-1)),Lt={class:"my-1 text-white"},Pt=a(()=>t("p",{class:"mb-0 text-white"},"Current Binary PV",-1)),Dt={class:"col"},jt={class:"d-flex align-items-center"},Ot=a(()=>t("p",{class:"mb-0 text-white"},"Total Earning",-1)),Ct={class:"my-1 text-white"},Et=a(()=>t("p",{class:"mb-0 text-white"},"Total Paid Earning",-1)),Vt={class:"col-md-12 col-xl-2"},zt={class:"card radius-10 bg-primary bg-gradient"},Rt={class:"card-body"},Gt=a(()=>t("h5",{class:"card-title text-white"},"Balance",-1)),Nt={class:"d-flex align-items-center"},At={class:"my-1 text-white"},It={class:"mb-0 text-white"},Bt={class:"mb-0 text-white"},qt={class:"row row-cols-1 row-cols-md-2 row-cols-xl-4"},Tt={class:"col"},Wt={class:"card radius-10 bg-success bg-gradient"},Ft={class:"card-body"},Ht={class:"d-flex align-items-center"},Yt={class:"my-1 text-white"},Jt=a(()=>t("p",{class:"mb-0 text-white"},"Ranking Right PV",-1)),Mt=a(()=>t("div",{class:"text-white ms-auto font-35"},[t("i",{class:"bx bx-trophy"})],-1)),Qt={class:"col"},Ut={class:"card radius-10 bg-info"},Kt={class:"card-body"},Xt={class:"d-flex align-items-center"},Zt={class:"my-1 text-dark"},$t=a(()=>t("p",{class:"mb-0 text-dark"},"Ranking Left PV",-1)),ts=a(()=>t("div",{class:"text-dark ms-auto font-35"},[t("i",{class:"bx bx-trophy"})],-1)),ss={class:"col"},es={class:"card radius-10 bg-danger bg-gradient"},ds={class:"card-body"},as={class:"d-flex align-items-center"},os={key:0,class:"my-1 text-white"},is={key:1,class:"my-1 text-white"},cs=a(()=>t("p",{class:"mb-0 text-white"},"Pairing Left PV",-1)),ls=a(()=>t("div",{class:"text-white ms-auto font-35"},[t("i",{class:"bx bx-coin-stack"})],-1)),ns={class:"col"},rs={class:"card radius-10 bg-warning bg-gradient"},_s={class:"card-body"},hs={class:"d-flex align-items-center"},bs={key:0,class:"my-1 text-white"},gs={key:1,class:"my-1 text-white"},vs=a(()=>t("p",{class:"mb-0 text-dark"},"Pairing Right PV",-1)),us=a(()=>t("div",{class:"text-dark ms-auto font-35"},[t("i",{class:"bx bx-coin-stack"})],-1)),ms={class:"row row-cols-1 row-cols-md-2 row-cols-xl-4"},ws={class:"col"},ps={class:"card radius-10 border-start border-0 border-3 border-warning"},xs={class:"card-body"},ys={class:"d-flex align-items-center"},fs=a(()=>t("p",{class:"mb-0 text-secondary"},"Expected Binary Earning",-1)),ks={class:"my-1 text-warning"},Ss=a(()=>t("div",{class:"mb-0 font-13 text-black-50"},"view Details",-1)),Ls=a(()=>t("div",{class:"widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"},[t("i",{class:"bx bxs-wallet"})],-1)),Ps={class:"col"},Ds={class:"card radius-10 border-start border-0 border-3 border-info"},js={class:"card-body"},Os={class:"d-flex align-items-center"},Cs=a(()=>t("p",{class:"mb-0 text-secondary"},"Loyalty Bonus",-1)),Es={class:"my-1 text-info"},Vs=a(()=>t("div",{class:"mb-0 font-13 text-black-50"},"view Details",-1)),zs=a(()=>t("div",{class:"widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"},[t("i",{class:"bx bxs-wallet"})],-1)),Rs={class:"col"},Gs={class:"card radius-10 border-start border-0 border-3 border-danger"},Ns={class:"card-body"},As={class:"d-flex align-items-center"},Is=a(()=>t("p",{class:"mb-0 text-secondary"},"Global Sales",-1)),Bs={class:"my-1 text-danger"},qs=a(()=>t("div",{class:"mb-0 font-13 text-black-50"},"view Details",-1)),Ts=a(()=>t("div",{class:"widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"},[t("i",{class:"bx bxs-wallet"})],-1)),Ws={class:"col"},Fs={class:"card radius-10 border-start border-0 border-3 border-success"},Hs={class:"card-body"},Ys={class:"d-flex align-items-center"},Js=a(()=>t("p",{class:"mb-0 text-secondary"},"Special Bonus",-1)),Ms={class:"my-1 text-success"},Qs=a(()=>t("div",{class:"mb-0 font-13 text-black-50"},"view Details",-1)),Us=a(()=>t("div",{class:"widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"},[t("i",{class:"bx bxs-wallet"})],-1)),Ks={class:"card radius-10"},Xs={class:"card-body"},Zs=h('<div class="d-flex align-items-center" data-v-566bd6eb><div data-v-566bd6eb><h6 class="mb-0" data-v-566bd6eb>Recent Orders</h6></div><div class="dropdown ms-auto" data-v-566bd6eb><a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown" data-v-566bd6eb><i class="bx bx-dots-horizontal-rounded font-22 text-option" data-v-566bd6eb></i></a></div></div>',1),$s={class:"table-responsive"},te={class:"table align-middle mb-0"},se=a(()=>t("thead",{class:"table-light"},[t("tr",null,[t("th",null,"Product"),t("th",null,"Photo"),t("th",null,"Product ID"),t("th",null,"Status"),t("th",null,"Amount"),t("th",null,"Qty"),t("th",null,"Total"),t("th",null,"Date")])],-1)),ee=["src","alt"],de={key:0,class:"badge bg-gradient-blooker text-white shadow-sm w-100"},ae={key:1,class:"badge bg-gradient-deepblue text-white shadow-sm w-100"},oe={key:2,class:"badge bg-gradient-quepal text-white shadow-sm w-100"},ie={key:3,class:"badge bg-gradient-bloody text-white shadow-sm w-100"},ce={key:4,class:"badge bg-gradient-ibiza text-white shadow-sm w-100"},le={key:5,class:"badge bg-gradient-moonlit text-white shadow-sm w-100"},ne={class:"row row-cols-1 row-cols-lg-3"},re={class:"col d-flex"},_e={class:"card radius-10 w-100"},he=h('<div class="card-header bg-transparent" data-v-566bd6eb><div class="d-flex align-items-center" data-v-566bd6eb><div data-v-566bd6eb><h6 class="mb-0" data-v-566bd6eb>Orders Summary</h6></div><div class="dropdown ms-auto" data-v-566bd6eb><a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown" data-v-566bd6eb><i class="bx bx-dots-horizontal-rounded font-22 text-option" data-v-566bd6eb></i></a></div></div></div><div class="card-body" data-v-566bd6eb><div class="chart-container-1" data-v-566bd6eb><canvas id="chart4" data-v-566bd6eb></canvas></div></div>',2),be={class:"list-group list-group-flush"},ge={class:"list-group-item d-flex bg-transparent justify-content-between align-items-center"},ve=h('<div class="col d-flex" data-v-566bd6eb><div class="card radius-10 w-100" data-v-566bd6eb><div class="card-header bg-transparent" data-v-566bd6eb><div class="d-flex align-items-center" data-v-566bd6eb><div data-v-566bd6eb><h6 class="mb-0" data-v-566bd6eb>Company News</h6></div><div class="dropdown ms-auto" data-v-566bd6eb><a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown" data-v-566bd6eb><i class="bx bx-dots-horizontal-rounded font-22 text-option" data-v-566bd6eb></i></a></div></div></div><div class="card-body" data-v-566bd6eb><div class="chart-container-1" data-v-566bd6eb><p data-v-566bd6eb>no news</p></div></div></div></div>',1),ue={class:"col d-flex"},me={class:"card radius-10 w-100"},we=h('<div class="card-header bg-transparent" data-v-566bd6eb><div class="d-flex align-items-center" data-v-566bd6eb><div data-v-566bd6eb><h6 class="mb-0" data-v-566bd6eb>Account Profile</h6></div><div class="dropdown ms-auto" data-v-566bd6eb><a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown" data-v-566bd6eb><i class="bx bx-dots-horizontal-rounded font-22 text-option" data-v-566bd6eb></i></a></div></div></div>',1),pe={class:"card-body"},xe={class:"chart-container-1"},ye={class:"d-md-flex align-items-center py-1"},fe=a(()=>t("div",{class:"d-flex align-items-center",style:{width:"35%"}},[t("p",{class:"mb-0"},[t("b",null,"Firstname: ")])],-1)),ke={class:""},Se={class:"mb-0"},Le={class:"d-md-flex align-items-center py-1"},Pe=a(()=>t("div",{class:"d-flex align-items-center",style:{width:"35%"}},[t("p",{class:"mb-0"},[t("b",null,"Lastname: ")])],-1)),De={class:""},je={class:"mb-0"},Oe={class:"d-md-flex align-items-center py-1"},Ce=a(()=>t("div",{class:"d-flex align-items-center",style:{width:"35%"}},[t("p",{class:"mb-0"},[t("b",null,"Username: ")])],-1)),Ee={class:""},Ve={class:"mb-0"},ze={class:"d-md-flex align-items-center py-1"},Re=a(()=>t("div",{class:"d-flex align-items-center",style:{width:"35%"}},[t("p",{class:"mb-0"},[t("b",null,"Email: ")])],-1)),Ge={class:""},Ne={class:"mb-0"},Ae={class:"d-md-flex align-items-center py-1"},Ie=a(()=>t("div",{class:"d-flex align-items-center",style:{width:"35%"}},[t("p",{class:"mb-0"},[t("b",null,"Phone No: ")])],-1)),Be={class:""},qe={class:"mb-0"},Te={class:"d-md-flex align-items-center py-1"},We=a(()=>t("div",{class:"d-flex align-items-center",style:{width:"35%"}},[t("p",{class:"mb-0"},[t("b",null,"Date of Join: ")])],-1)),Fe={class:""},He={class:"mb-0"},Ye={class:"d-md-flex align-items-center py-1"},Je=a(()=>t("div",{class:"d-flex align-items-center",style:{width:"35%"}},[t("p",{class:"mb-0"},[t("b",null,"Country: ")])],-1)),Me={class:""},Qe={class:"mb-0"},Ue={class:"d-md-flex align-items-center py-1"},Ke=a(()=>t("div",{class:"d-flex align-items-center",style:{width:"35%"}},[t("p",{class:"mb-0"},[t("b",null,"Joining Package: ")])],-1)),Xe={class:""},Ze={class:"mb-0"},$e={class:"row row-cols-1 row-cols-lg-2"},td={class:"col d-flex"},sd={class:"card radius-10 w-100"},ed=h('<div class="card-header bg-transparent" data-v-566bd6eb><div class="d-flex align-items-center" data-v-566bd6eb><div data-v-566bd6eb><h6 class="mb-0" data-v-566bd6eb>Lastest 10 Referral Bonus</h6></div><div class="dropdown ms-auto" data-v-566bd6eb><a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown" data-v-566bd6eb><i class="bx bx-dots-horizontal-rounded font-22 text-option" data-v-566bd6eb></i></a></div></div></div>',1),dd={class:"card-body",style:{height:"300px","font-size":"12px"}},ad={class:"table-wrapper"},od={class:"table table-striped table-sm mb-0"},id=a(()=>t("thead",{class:"table-dark"},[t("tr",null,[t("th",{scope:"col"},"#"),t("th",{scope:"col"},"Amount"),t("th",{scope:"col"},"Date Earned"),t("th",{scope:"col"},"Status"),t("th",{scope:"col"},"Details")])],-1)),cd={scope:"row"},ld={key:0,class:"badge bg-gradient-blooker text-white shadow-sm w-100"},nd={key:1,class:"badge bg-gradient-deepblue text-white shadow-sm w-100"},rd={key:2,class:"badge bg-gradient-quepal text-white shadow-sm w-100"},_d={key:3,class:"badge bg-gradient-bloody text-white shadow-sm w-100"},hd={key:4,class:"badge bg-gradient-moonlit text-white shadow-sm w-100"},bd={class:"col d-flex"},gd={class:"card radius-10 w-100"},vd=h('<div class="card-header bg-transparent" data-v-566bd6eb><div class="d-flex align-items-center" data-v-566bd6eb><div data-v-566bd6eb><h6 class="mb-0" data-v-566bd6eb>Last 10 Direct Purchase Bonus</h6></div><div class="dropdown ms-auto" data-v-566bd6eb><a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown" data-v-566bd6eb><i class="bx bx-dots-horizontal-rounded font-22 text-option" data-v-566bd6eb></i></a></div></div></div>',1),ud={class:"card-body",style:{height:"300px","font-size":"12px"}},md={class:"table-wrapper"},wd={class:"table table-striped table-sm mb-0"},pd=a(()=>t("thead",{class:"table-dark"},[t("tr",null,[t("th",{scope:"col"},"#"),t("th",{scope:"col"},"PV"),t("th",{scope:"col"},"Date Earned"),t("th",{scope:"col"},"Status"),t("th",{scope:"col"},"Details")])],-1)),xd={scope:"row"},yd={key:0,class:"badge bg-gradient-blooker text-white shadow-sm w-100"},fd={key:1,class:"badge bg-gradient-deepblue text-white shadow-sm w-100"},kd={key:2,class:"badge bg-gradient-quepal text-white shadow-sm w-100"},Sd={key:3,class:"badge bg-gradient-bloody text-white shadow-sm w-100"},Ld={key:4,class:"badge bg-gradient-moonlit text-white shadow-sm w-100"},Pd={class:"row row-cols-1 row-cols-lg-2"},Dd={class:"col d-flex"},jd={class:"card radius-10 w-100"},Od=h('<div class="card-header bg-transparent" data-v-566bd6eb><div class="d-flex align-items-center" data-v-566bd6eb><div data-v-566bd6eb><h6 class="mb-0" data-v-566bd6eb>Last 10 Binary PV earned</h6></div><div class="dropdown ms-auto" data-v-566bd6eb><a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown" data-v-566bd6eb><i class="bx bx-dots-horizontal-rounded font-22 text-option" data-v-566bd6eb></i></a></div></div></div>',1),Cd={class:"card-body",style:{"font-size":"12px"}},Ed={class:"table-wrapper"},Vd={class:"table table-striped table-sm mb-0"},zd=a(()=>t("thead",{class:"table-dark"},[t("tr",null,[t("th",{scope:"col"},"#"),t("th",{scope:"col"},"PV"),t("th",{scope:"col"},"Date Earned"),t("th",{scope:"col"},"Status"),t("th",{scope:"col"},"Details")])],-1)),Rd={scope:"row"},Gd={key:0,class:"badge bg-gradient-blooker text-white shadow-sm w-100"},Nd={key:1,class:"badge bg-gradient-deepblue text-white shadow-sm w-100"},Ad={key:2,class:"badge bg-gradient-quepal text-white shadow-sm w-100"},Id={key:3,class:"badge bg-gradient-bloody text-white shadow-sm w-100"},Bd={key:4,class:"badge bg-gradient-moonlit text-white shadow-sm w-100"},qd={class:"col d-flex"},Td={class:"card radius-10 w-100"},Wd=h('<div class="card-header bg-transparent" data-v-566bd6eb><div class="d-flex align-items-center" data-v-566bd6eb><div data-v-566bd6eb><h6 class="mb-0" data-v-566bd6eb>Last 10 Payments</h6></div><div class="dropdown ms-auto" data-v-566bd6eb><a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown" data-v-566bd6eb><i class="bx bx-dots-horizontal-rounded font-22 text-option" data-v-566bd6eb></i></a></div></div></div>',1),Fd={class:"card-body",style:{"font-size":"12px"}},Hd={class:"table-wrapper"},Yd={class:"table table-striped table-sm mb-0"},Jd=a(()=>t("thead",{class:"table-dark"},[t("tr",null,[t("th",{scope:"col"},"#"),t("th",{scope:"col"},"Amount"),t("th",{scope:"col"},"Date Paid"),t("th",{scope:"col"},"Status"),t("th",{scope:"col"},"Details")])],-1)),Md={scope:"row"},Qd={key:0,class:"badge bg-gradient-blooker text-white shadow-sm w-100"},Ud={key:1,class:"badge bg-gradient-deepblue text-white shadow-sm w-100"},Kd={key:2,class:"badge bg-gradient-quepal text-white shadow-sm w-100"},Xd={key:3,class:"badge bg-gradient-bloody text-white shadow-sm w-100"},Zd={key:4,class:"badge bg-gradient-moonlit text-white shadow-sm w-100"};function $d(c,v,d,u,ta,sa){const n=y("inertia-link");return o(),i("div",P,[t("div",D,[t("div",j,[c.$page.props.flash.success?(o(),i("div",O,s(c.$page.props.flash.success),1)):w("",!0),c.$page.props.flash.error?(o(),i("div",C,s(c.$page.props.flash.error),1)):w("",!0)]),t("div",E,[V,t("div",z,[t("div",R,[t("div",G,[r(n,{href:c.route("payment"),class:"btn btn-primary button-icon mr-3 mt-1 mb-1"},{default:_(()=>[t("span",null,"Wallet Balance: "+s(d.user.currency.prefix)+s(d.user.wallet.toLocaleString()),1)]),_:1},8,["href"])]),t("div",N,[r(n,{href:c.route("referral"),class:"btn btn-success button-icon mr-3 mt-1 mb-1"},{default:_(()=>[A]),_:1},8,["href"])]),t("div",I,[r(n,{href:c.route("order"),class:"btn btn-warning button-icon mr-3 mt-1 mb-1"},{default:_(()=>[B]),_:1},8,["href"])]),t("div",q,[r(n,{href:c.route("genealogy"),class:"btn btn-info button-icon mr-3 mt-1 mb-1"},{default:_(()=>[T]),_:1},8,["href"])])])])]),t("div",W,[t("div",F,[t("div",H,[t("div",Y,[t("div",J,[M,t("div",Q,[t("h3",U,[m("Hello "),t("span",K,s(d.user.firstname)+" "+s(d.user.lastname),1)]),X]),t("div",Z,[t("div",$,[t("div",tt,[r(n,{href:c.route("profile"),class:"btn btn-danger mt-1 mb-1"},{default:_(()=>[m(" View Profile ")]),_:1},8,["href"])])])])])])])])]),t("div",st,[t("div",et,[t("div",dt,[t("div",at,[ot,t("div",it,[t("div",ct,[t("div",lt,[t("div",null,[nt,t("h4",rt,s(d.user.currency.prefix)+s(d.currentReferralBonus.toLocaleString()),1),_t])])]),t("div",ht,[t("div",bt,[t("div",null,[gt,t("h4",vt,s(d.user.currency.prefix)+s(d.currentStockistBonus.toLocaleString()),1),ut])])]),t("div",mt,[t("div",wt,[t("div",null,[pt,t("h4",xt,s(d.user.current_direct_pv+0),1),yt])])]),t("div",ft,[t("div",kt,[t("div",null,[St,t("h4",Lt,s(d.user.current_binary_pv+0),1),Pt])])]),t("div",Dt,[t("div",jt,[t("div",null,[Ot,t("h4",Ct,s(d.user.currency.prefix)+s(d.totalEarning.toLocaleString()),1),Et])])])])])])]),t("div",Vt,[t("div",zt,[t("div",Rt,[Gt,t("div",Nt,[t("div",null,[t("h4",At,s(d.user.currency.prefix)+s(d.totalPendingEarning.toLocaleString()),1),t("p",It,"Last payment "+s(d.user.currency.prefix)+s(d.totalEarning.toLocaleString()),1),t("p",Bt,"Wallet: "+s(d.user.currency.prefix)+s(d.user.wallet.toLocaleString()),1)])])])])])]),t("div",qt,[t("div",Tt,[t("div",Wt,[t("div",Ft,[t("div",Ht,[t("div",null,[t("h4",Yt,s(d.user.award_pv_right+0),1),Jt]),Mt])])])]),t("div",Qt,[t("div",Ut,[t("div",Kt,[t("div",Xt,[t("div",null,[t("h4",Zt,s(d.user.award_pv_left+0),1),$t]),ts])])])]),t("div",ss,[t("div",es,[t("div",ds,[t("div",as,[t("div",null,[d.user.downlines.length>0?(o(),i("h4",os,s(d.user.downlines[0].current_binary_pv+d.user.downlines[0].spill_over_binary_pv+0),1)):(o(),i("h4",is,"0")),cs]),ls])])])]),t("div",ns,[t("div",rs,[t("div",_s,[t("div",hs,[t("div",null,[d.user.downlines.length>1?(o(),i("h4",bs,s(d.user.downlines[1].current_binary_pv+d.user.downlines[1].spill_over_binary_pv+0),1)):(o(),i("h4",gs,"0")),vs]),us])])])])]),t("div",ms,[t("div",ws,[t("div",ps,[t("div",xs,[t("div",ys,[t("div",null,[fs,t("h4",ks,s(d.user.currency.prefix)+s(d.estimateBinaryEarning.toLocaleString()),1),r(n,{href:"/bonusbinary"},{default:_(()=>[Ss]),_:1})]),Ls])])])]),t("div",Ps,[t("div",Ds,[t("div",js,[t("div",Os,[t("div",null,[Cs,t("h4",Es,s(d.user.currency.prefix)+s(d.earningLoyalty.toLocaleString()),1),r(n,{href:"/payment?type=loyalty"},{default:_(()=>[Vs]),_:1})]),zs])])])]),t("div",Rs,[t("div",Gs,[t("div",Ns,[t("div",As,[t("div",null,[Is,t("h4",Bs,s(d.user.currency.prefix)+s(d.earningGlobal.toLocaleString()),1),r(n,{href:"/payment?type=global"},{default:_(()=>[qs]),_:1})]),Ts])])])]),t("div",Ws,[t("div",Fs,[t("div",Hs,[t("div",Ys,[t("div",null,[Js,t("h4",Ms,s(d.user.currency.prefix)+s(d.earningSpecial.toLocaleString()),1),r(n,{href:"/payment?type=special"},{default:_(()=>[Qs]),_:1})]),Us])])])])]),t("div",Ks,[t("div",Xs,[Zs,t("div",$s,[t("table",te,[se,t("tbody",null,[(o(!0),i(b,null,g(d.lastorders,e=>(o(),i("tr",{key:e.id},[t("td",null,s(e.name),1),t("td",null,[t("img",{src:e.product.image_url,class:"product-img-2",alt:e.name},null,8,ee)]),t("td",null,s(e.product.sku),1),t("td",null,[e.order.status_order=="pending"?(o(),i("span",de," pending ")):e.order.status_order=="processing"?(o(),i("span",ae," processing ")):e.order.status_order=="shipped"?(o(),i("span",oe," shipped ")):e.order.status_order=="cancelled"?(o(),i("span",ie," cancelled ")):e.order.status_order=="fraud"?(o(),i("span",ce," fraud ")):(o(),i("span",le,s(e.order.status_order),1))]),t("td",null,s(e.currency.prefix)+s(e.amount.toLocaleString()),1),t("td",null,s(e.qty),1),t("td",null,s(e.currency.prefix)+s(e.total.toLocaleString()),1),t("td",null,s(e.order_date),1)]))),128))])])])])]),t("div",ne,[t("div",re,[t("div",_e,[he,t("ul",be,[(o(!0),i(b,null,g(d.orderSummary,(e,l)=>(o(),i("li",ge,[m(s(l)+" ",1),t("span",{class:f(["badge rounded-pill",`${l}`])},s(e),3)]))),256))])])]),ve,t("div",ue,[t("div",me,[we,t("div",pe,[t("div",xe,[t("div",ye,[fe,t("div",ke,[t("p",Se,s(d.user.firstname),1)])]),t("div",Le,[Pe,t("div",De,[t("p",je,s(d.user.lastname),1)])]),t("div",Oe,[Ce,t("div",Ee,[t("p",Ve,s(d.user.username),1)])]),t("div",ze,[Re,t("div",Ge,[t("p",Ne,s(d.user.email),1)])]),t("div",Ae,[Ie,t("div",Be,[t("p",qe,s(d.user.phone),1)])]),t("div",Te,[We,t("div",Fe,[t("p",He,s(d.user.joined_date),1)])]),t("div",Ye,[Je,t("div",Me,[t("p",Qe,s(d.user.country),1)])]),t("div",Ue,[Ke,t("div",Xe,[t("p",Ze,s(d.user.package.name),1)])])])])])])]),t("div",$e,[t("div",td,[t("div",sd,[ed,t("div",dd,[t("div",ad,[t("table",od,[id,t("tbody",null,[(o(!0),i(b,null,g(d.latestReferralBonus,(e,l)=>(o(),i("tr",{key:e.id},[t("th",cd,s(l+1),1),t("td",null,s(e.currency_code)+s(e.amount.toLocaleString()),1),t("td",null,s(e.earned_date),1),t("td",null,[e.status=="0"?(o(),i("span",ld," pending ")):e.status=="1"?(o(),i("span",nd," processing ")):e.status=="2"?(o(),i("span",rd," paid ")):e.status=="3"?(o(),i("span",_d," cforward ")):(o(),i("span",hd,s(e.status),1))]),t("td",null,s(e.details),1)]))),128))])])])])])]),t("div",bd,[t("div",gd,[vd,t("div",ud,[t("div",md,[t("table",wd,[pd,t("tbody",null,[(o(!0),i(b,null,g(d.latestDirectBonus,(e,l)=>(o(),i("tr",{key:e.id},[t("th",xd,s(l+1),1),t("td",null,s(e.pv.toLocaleString()),1),t("td",null,s(e.earned_date),1),t("td",null,[e.status=="0"?(o(),i("span",yd," pending ")):e.status=="1"?(o(),i("span",fd," processing ")):e.status=="2"?(o(),i("span",kd," paid ")):e.status=="3"?(o(),i("span",Sd," cforward ")):(o(),i("span",Ld,s(e.status),1))]),t("td",null,s(e.details),1)]))),128))])])])])])])]),t("div",Pd,[t("div",Dd,[t("div",jd,[Od,t("div",Cd,[t("div",Ed,[t("table",Vd,[zd,t("tbody",null,[(o(!0),i(b,null,g(d.latestBinaryBonus,(e,l)=>(o(),i("tr",{key:e.id},[t("th",Rd,s(l+1),1),t("td",null,s(e.pv.toLocaleString()),1),t("td",null,s(e.earned_date),1),t("td",null,[e.status=="0"?(o(),i("span",Gd," pending ")):e.status=="1"?(o(),i("span",Nd," processing ")):e.status=="2"?(o(),i("span",Ad," paid ")):e.status=="3"?(o(),i("span",Id," cforward ")):(o(),i("span",Bd,s(e.status),1))]),t("td",null,s(e.details),1)]))),128))])])])])])]),t("div",qd,[t("div",Td,[Wd,t("div",Fd,[t("div",Hd,[t("table",Yd,[Jd,t("tbody",null,[(o(!0),i(b,null,g(d.latestPayment,(e,l)=>(o(),i("tr",{key:e.id},[t("th",Md,s(l+1),1),t("td",null,s(e.currency.prefix)+s(e.amount.toLocaleString()),1),t("td",null,s(e.paid_date),1),t("td",null,[e.status=="pending"?(o(),i("span",Qd," pending ")):e.status=="flushed"?(o(),i("span",Ud," flushed ")):e.status=="paid"?(o(),i("span",Kd," paid ")):e.status=="cforward"?(o(),i("span",Xd," cforward ")):(o(),i("span",Zd,s(e.status),1))]),t("td",null,s(e.description),1)]))),128))])])])])])])])])])}const oa=x(L,[["render",$d],["__scopeId","data-v-566bd6eb"]]);export{oa as default};
