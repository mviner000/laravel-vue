import{d as w,i as v,j as y,v as x,o as n,g as b,T as V,c,w as i,a,u as s,Z as B,t as C,h as p,b as r,k as $,e as f,n as P,f as N}from"./app-CfUEMLMu.js";import{_ as U}from"./GuestLayout.vue_vue_type_script_setup_true_lang-Dloq4wiq.js";import{_,a as g,b as h}from"./TextInput.vue_vue_type_script_setup_true_lang-ah8j87XW.js";import{P as q}from"./PrimaryButton-BEI0njYy.js";import"./ApplicationLogo-DoniEmLH.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const L=["value"],R=w({__name:"Checkbox",props:{checked:{type:Boolean},value:{}},emits:["update:checked"],setup(d,{emit:e}){const m=e,l=d,o=v({get(){return l.checked},set(t){m("update:checked",t)}});return(t,u)=>y((n(),b("input",{type:"checkbox",value:t.value,"onUpdate:modelValue":u[0]||(u[0]=k=>o.value=k),class:"rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"},null,8,L)),[[x,o.value]])}}),j={key:0,class:"mb-4 font-medium text-sm text-green-600"},D={class:"mt-4"},E={class:"block mt-4"},F={class:"flex items-center"},M=r("span",{class:"ms-2 text-sm text-gray-600"},"Remember me",-1),S={class:"flex items-center justify-end mt-4"},I=w({__name:"Login",props:{canResetPassword:{type:Boolean},status:{}},setup(d){const e=V({email:"",password:"",remember:!1}),m=()=>{e.post(route("login"),{onFinish:()=>{e.reset("password")}})};return(l,o)=>(n(),c(U,null,{default:i(()=>[a(s(B),{title:"Log in"}),l.status?(n(),b("div",j,C(l.status),1)):p("",!0),r("form",{onSubmit:N(m,["prevent"])},[r("div",null,[a(_,{for:"email",value:"Email"}),a(g,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:s(e).email,"onUpdate:modelValue":o[0]||(o[0]=t=>s(e).email=t),required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),a(h,{class:"mt-2",message:s(e).errors.email},null,8,["message"])]),r("div",D,[a(_,{for:"password",value:"Password"}),a(g,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:s(e).password,"onUpdate:modelValue":o[1]||(o[1]=t=>s(e).password=t),required:"",autocomplete:"current-password"},null,8,["modelValue"]),a(h,{class:"mt-2",message:s(e).errors.password},null,8,["message"])]),r("div",E,[r("label",F,[a(R,{name:"remember",checked:s(e).remember,"onUpdate:checked":o[2]||(o[2]=t=>s(e).remember=t)},null,8,["checked"]),M])]),r("div",S,[l.canResetPassword?(n(),c(s($),{key:0,href:l.route("password.request"),class:"underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"},{default:i(()=>[f(" Forgot your password? ")]),_:1},8,["href"])):p("",!0),a(q,{class:P(["ms-4",{"opacity-25":s(e).processing}]),disabled:s(e).processing},{default:i(()=>[f(" Log in ")]),_:1},8,["class","disabled"])])],32)]),_:1}))}});export{I as default};
