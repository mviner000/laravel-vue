import{_ as a}from"./_plugin-vue_export-helper-DlAUqK2U.js";import{o as n,g as l,D as p,E as i,b as c}from"./app-Ce0v2jJL.js";const r={mounted(){const e=document.createElement("script");e.src="https://upload-widget.cloudinary.com/global/all.js",e.type="text/javascript",e.async=!0,document.head.appendChild(e),e.onload=()=>{const t=cloudinary.createUploadWidget({cloudName:"dqpzvvd0v",uploadPreset:"mrpfvufw"},(d,o)=>{!d&&o&&o.event==="success"&&console.log("Upload successful! Here is the result:",o.info)});document.getElementById("upload_widget").addEventListener("click",function(){t.open()},!1)}}},s=e=>(p("data-v-4375311b"),e=e(),i(),e),u=s(()=>c("h2",null,"upload",-1)),_=s(()=>c("button",{id:"upload_widget",class:"cloudinary-button"},"Upload files",-1)),f=[u,_];function m(e,t,d,o,h,v){return n(),l("div",null,f)}const b=a(r,[["render",m],["__scopeId","data-v-4375311b"]]);export{b as default};
