import{D as u}from"./DefaultLayout.5299b97b.js";import{H as p,L as _,r as b,o as t,c as a,a as h,b as e,t as l,d as i,F as m,e as g,j as v,l as o}from"./app.76d76681.js";import{_ as x}from"./_plugin-vue_export-helper.cdc0426e.js";const f={name:"Payment",components:{Head:p,Link:_},layout:u,props:{auth:Object,errors:Object,flash:Object,payments:Object,user:Object},remember:"form",data(){},mounted(){$(document).ready(function(){var d=$("#table").DataTable({lengthMenu:[10,25,50,100,500],buttons:[]});d.buttons().container().appendTo("#table_wrapper .col-md-6:eq(0)")})}},y={class:"page-wrapper"},k={class:"page-content"},w=v('<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"><div class="breadcrumb-title pe-3">Payments</div><div class="ps-3"><nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 p-0"><li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-user-circle"></i></a></li><li class="breadcrumb-item active" aria-current="page">Payments</li></ol></nav></div></div>',1),D={class:"row"},j={class:"col-xl-12"},P={key:0,class:"alert alert-success",role:"alert"},H={key:1,class:"alert alert-danger",role:"alert"},L={class:"card border-top border-0 border-4 border-primary"},N={class:"card-body p-4"},O=e("div",{class:"card-title d-flex align-items-center"},[e("div",null,[e("i",{class:"bx bx-lock me-1 font-22 text-primary"})]),e("h5",{class:"mb-0 text-primary"},"Payments History")],-1),V=e("hr",null,null,-1),S={class:"table-responsive"},T={id:"table",class:"table table-striped table-bordered"},B=e("thead",null,[e("tr",null,[e("th",null,"ID"),e("th",null,"Amount"),e("th",null,"Type"),e("th",null,"Status"),e("th",null,"Description"),e("th",null,"Due Date"),e("th",null,"Paid Date")])],-1),C={class:"align-middle"},F={class:"align-middle"},q={class:"align-middle"},A={class:"align-middle"},E={key:0,class:"badge rounded-pill text-warning bg-light-warning p-2 text-uppercase px-3"},I={key:1,class:"badge rounded-pill text-info bg-light-success p-2 text-uppercase px-3"},M={key:2,class:"badge rounded-pill text-success bg-light-warning p-2 text-uppercase px-3"},R=e("i",{class:"bx bxs-circle align-middle me-1"},null,-1),z={key:3,class:"badge rounded-pill text-success bg-light-primary p-2 text-uppercase px-3"},G=e("i",{class:"bx bxs-circle align-middle me-1"},null,-1),J={key:4,class:"badge rounded-pill text-light bg-dark p-2 text-uppercase px-3"},K={class:"align-middle"},Q={class:"align-middle"},U={class:"align-middle"};function W(d,X,r,Y,Z,ee){const c=b("Head");return t(),a("div",y,[h(c,{title:`Referral ${r.auth.user.username}`},null,8,["title"]),e("div",k,[w,e("div",D,[e("div",j,[d.$page.props.flash.success?(t(),a("div",P,l(d.$page.props.flash.success),1)):i("",!0),d.$page.props.flash.error?(t(),a("div",H,l(d.$page.props.flash.error),1)):i("",!0),e("div",L,[e("div",N,[O,V,e("div",S,[e("table",T,[B,e("tbody",null,[(t(!0),a(m,null,g(r.payments,(s,n)=>(t(),a("tr",{key:s.id,class:"hover:bg-gray-100 focus-within:bg-gray-100"},[e("td",C,l(n+1),1),e("td",F,l(r.user.currency.prefix)+l(s.amount.toLocaleString()),1),e("td",q,l(s.bonus_type),1),e("td",A,[s.status=="pending"?(t(),a("div",E," pending ")):s.status=="paid"?(t(),a("div",I," Paid ")):s.status=="flushed"?(t(),a("div",M,[R,o("flushed ")])):s.status=="cforward"?(t(),a("div",z,[G,o("cforward ")])):(t(),a("div",J,l(s.status_order),1))]),e("td",K,l(s.description),1),e("td",Q,l(s.due_date),1),e("td",U,l(s.paid_date),1)]))),128))])])])])])])])])])}const le=x(f,[["render",W]]);export{le as default};