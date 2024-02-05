import{D as b}from"./DefaultLayout.5299b97b.js";import{H as p,L as u,r as _,o as s,c as t,a as f,b as e,t as l,d as i,F as v,e as h,w as g,f as w,g as y,j as x}from"./app.76d76681.js";import{_ as T}from"./_plugin-vue_export-helper.cdc0426e.js";const k={name:"Create",components:{Head:p,Link:u},layout:b,props:{auth:Object,errors:Object,flash:Object,user:Object},remember:"form",data(){return{form:this.$inertia.form({message:""})}},methods:{submitTestimonial(){this.form.post("/testimonial")}}},N={class:"page-wrapper"},j={class:"page-content"},V=x('<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"><div class="breadcrumb-title pe-3">Testimonial</div><div class="ps-3"><nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 p-0"><li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-user-circle"></i></a></li><li class="breadcrumb-item active" aria-current="page">Add New Testimonial</li></ol></nav></div></div>',1),C={class:"row"},D={class:"col-xl-9"},H={key:0,class:"alert alert-success",role:"alert"},L={key:1,class:"alert alert-danger",role:"alert"},O={key:2,class:"alert alert-danger",role:"alert"},S={class:"card border-top border-0 border-4 border-primary"},A={class:"card-body p-5"},B=e("div",{class:"card-title d-flex align-items-center"},[e("div",null,[e("i",{class:"bx bx-lock me-1 font-22 text-primary"})]),e("h5",{class:"mb-0 text-primary"},"Add New Testimonial")],-1),M=e("hr",null,null,-1),$={class:"row mb-3 mt-4"},F=e("label",{class:"col-sm-3 col-form-label"},"Message",-1),E={class:"col-sm-8"},U=e("div",{class:"row"},[e("label",{class:"col-sm-3 col-form-label"}),e("div",{class:"col-sm-9"},[e("button",{type:"submit",class:"btn btn-primary px-5"},"Submit")])],-1);function q(r,o,c,z,d,n){const m=_("Head");return s(),t("div",N,[f(m,{title:"Add New Testimonial"}),e("div",j,[V,e("div",C,[e("div",D,[r.$page.props.flash.success?(s(),t("div",H,l(r.$page.props.flash.success),1)):i("",!0),r.$page.props.flash.error?(s(),t("div",L,l(r.$page.props.flash.error),1)):i("",!0),c.errors.length>0?(s(),t("div",O,[(s(!0),t(v,null,h(c.errors,a=>(s(),t("p",null,l(a),1))),256))])):i("",!0),e("div",S,[e("div",A,[B,M,e("form",{class:"row g-3",onSubmit:o[1]||(o[1]=g((...a)=>n.submitTestimonial&&n.submitTestimonial(...a),["prevent"]))},[e("div",$,[F,e("div",E,[w(e("textarea",{class:"form-control",rows:"8","onUpdate:modelValue":o[0]||(o[0]=a=>d.form.message=a)},null,512),[[y,d.form.message]])])]),U],32)])])])])])])}const K=T(k,[["render",q]]);export{K as default};
