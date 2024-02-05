import{D as n}from"./DefaultLayout.5299b97b.js";import{H as i,L as _,r as m,o as e,c as d,a as h,b as s,t,d as l,F as b,e as u,j as y}from"./app.76d76681.js";import{_ as v}from"./_plugin-vue_export-helper.cdc0426e.js";const f={name:"Order Detail",components:{Head:i,Link:_},layout:n,props:{auth:Object,errors:Object,flash:Object,order:Object},remember:"form",data(){return{}},methods:{}},g={class:"page-wrapper"},w={class:"page-content"},x=y('<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"><div class="breadcrumb-title pe-3">Products</div><div class="ps-3"><nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 p-0"><li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-user-circle"></i></a></li><li class="breadcrumb-item active" aria-current="page">Orders</li></ol></nav></div></div>',1),O={key:0,class:"alert alert-success",role:"alert"},S={key:1,class:"alert alert-danger",role:"alert"},j={class:"row"},D={class:"col-xl-5"},L={class:"card border-primary border-bottom border-3 border-0"},P={class:"card-body"},k=s("h5",{class:"card-title text-primary"},"Order",-1),N=s("hr",null,null,-1),B={class:"row"},H=s("dt",{class:"col-sm-4 mb-3"},"orderRef:",-1),V={class:"col-sm-8 mb-3"},A=s("dt",{class:"col-sm-4 mb-3"},"Status",-1),C={class:"col-sm-8 mb-3"},E=s("dt",{class:"col-sm-4 mb-3"},"Payment Method",-1),F={class:"col-sm-8 mb-3"},I=s("dt",{class:"col-sm-4 mb-3"},"Payment Status",-1),R={class:"col-sm-8 mb-3"},T=s("dt",{class:"col-sm-4 mb-3"},"Total Sales:",-1),q={class:"col-sm-8 mb-3"},M=s("dt",{class:"col-sm-4 mb-3"},"Shipping Cost:",-1),Q={class:"col-sm-8 mb-3"},U=s("dt",{class:"col-sm-4 mb-3"},"Total:",-1),W={class:"col-sm-8 mb-3"},z={class:"col-xl-7"},G={class:"card border-primary border-bottom border-3 border-0"},J={class:"card-body"},K=s("h5",{class:"card-title text-primary"},"Items",-1),X=s("hr",null,null,-1),Y={class:"table-responsive"},Z={class:"table mb-0"},p=s("thead",{class:"table-light"},[s("tr",null,[s("th",null,"Name"),s("th",null,"Item Price"),s("th",null,"Quantity"),s("th",null,"Amount")])],-1),$={width:"40%"},ss={class:"row"},ts={class:"col-xl-5"},os={class:"card border-primary border-bottom border-3 border-0"},es={class:"card-body"},ds=s("h5",{class:"card-title text-primary"},"Store",-1),cs=s("hr",null,null,-1),rs={class:"row"},ls={class:"col-sm-3 mb-3"},as={class:"card-title text-primary"},ns=s("dd",{class:"col-sm-9 mb-3"},null,-1),is=s("dt",{class:"col-sm-3 mb-3"},"Description:",-1),_s={class:"col-sm-9 mb-3"},ms=s("dt",{class:"col-sm-3 mb-3"},"Address",-1),hs={class:"col-sm-9 mb-3"},bs=s("dd",{class:"col-sm-3 mb-3"},null,-1),us={class:"col-sm-9 mb-3"},ys=s("dd",{class:"col-sm-3 mb-3"},null,-1),vs={class:"col-sm-9 mb-3"},fs=s("dt",{class:"col-sm-3 mb-3"},"Phone:",-1),gs={class:"col-sm-9 mb-3"},ws=s("dt",{class:"col-sm-3 mb-3"},"Email:",-1),xs={class:"col-sm-9 mb-3"},Os=s("dt",{class:"col-sm-3 mb-3"},"Website:",-1),Ss={class:"col-sm-9 mb-3"},js={class:"col-xl-7"},Ds={class:"card border-primary border-bottom border-3 border-0"},Ls={class:"card-body"},Ps=s("h5",{class:"card-title text-primary"},"Order By",-1),ks=s("hr",null,null,-1),Ns={class:"row"},Bs={class:"col-sm-3 mb-3"},Hs={class:"card-title text-primary"},Vs=s("dd",{class:"col-sm-9 mb-3"},null,-1),As=s("dt",{class:"col-sm-2 mb-3"},"Username:",-1),Cs={class:"col-sm-9 mb-3"},Es=s("dt",{class:"col-sm-2 mb-3"},"Address",-1),Fs={class:"col-sm-9 mb-3"},Is=s("dd",{class:"col-sm-2 mb-3"},null,-1),Rs={class:"col-sm-9 mb-3"},Ts=s("dd",{class:"col-sm-2 mb-3"},null,-1),qs={class:"col-sm-9 mb-3"},Ms=s("dt",{class:"col-sm-2 mb-3"},"Phone:",-1),Qs={class:"col-sm-9 mb-3"},Us=s("dt",{class:"col-sm-2 mb-3"},"Email:",-1),Ws={class:"col-sm-9 mb-3"},zs=s("dt",{class:"col-sm-2 mb-3"},"gender:",-1),Gs={class:"col-sm-9 mb-3"};function Js(c,Ks,o,Xs,Ys,Zs){const a=m("Head");return e(),d("div",g,[h(a,{title:`Order ${o.auth.user.username}`},null,8,["title"]),s("div",w,[x,c.$page.props.flash.success?(e(),d("div",O,t(c.$page.props.flash.success),1)):l("",!0),c.$page.props.flash.error?(e(),d("div",S,t(c.$page.props.flash.error),1)):l("",!0),s("div",j,[s("div",D,[s("div",L,[s("div",P,[k,N,s("dl",B,[H,s("dd",V,t(o.order.orderRef),1),A,s("dd",C,t(o.order.status_order),1),E,s("dd",F,t(o.order.payment_method),1),I,s("dd",R,t(o.order.payment_status),1),T,s("dd",q,t(o.order.total_sales),1),M,s("dd",Q,t(o.order.total_shipping),1),U,s("dd",W,t(o.order.net_total),1)])])])]),s("div",z,[s("div",G,[s("div",J,[K,X,s("div",Y,[s("table",Z,[p,s("tbody",null,[(e(!0),d(b,null,u(o.order.items,r=>(e(),d("tr",null,[s("td",$,t(r.name),1),s("td",null,t(o.order.currency.prefix)+t(r.amount.toLocaleString()),1),s("td",null,t(r.qty),1),s("td",null,t(o.order.currency.prefix)+t(r.total.toLocaleString()),1)]))),256))])])])])])])]),s("div",ss,[s("div",ts,[s("div",os,[s("div",es,[ds,cs,s("dl",rs,[s("dt",ls,[s("h6",as,t(o.order.store.name),1)]),ns,is,s("dd",_s,t(o.order.store.description),1),ms,s("dd",hs,t(o.order.store.address)+" "+t(o.order.store.address2),1),bs,s("dd",us,t(o.order.store.city)+" "+t(o.order.store.state)+", ",1),ys,s("dd",vs,t(o.order.store.country),1),fs,s("dd",gs,t(o.order.store.phone),1),ws,s("dd",xs,t(o.order.store.email),1),Os,s("dd",Ss,t(o.order.store.website),1)])])])]),s("div",js,[s("div",Ds,[s("div",Ls,[Ps,ks,s("dl",Ns,[s("dd",Bs,[s("h6",Hs,t(o.order.owner.firstname)+t(o.order.owner.lastname),1)]),Vs,As,s("dd",Cs,t(o.order.owner.username),1),Es,s("dd",Fs,t(o.order.owner.address)+" "+t(o.order.owner.address2),1),Is,s("dd",Rs,t(o.order.owner.city)+" "+t(o.order.owner.state)+", ",1),Ts,s("dd",qs,t(o.order.owner.country),1),Ms,s("dd",Qs,t(o.order.owner.phone),1),Us,s("dd",Ws,t(o.order.owner.email),1),zs,s("dd",Gs,t(o.order.owner.gender),1)])])])])])])])}const tt=v(f,[["render",Js]]);export{tt as default};
