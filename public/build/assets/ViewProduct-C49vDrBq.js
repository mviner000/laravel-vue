import{G as ot,H as it,I as st,o as I,g as N,b as s,j as E,C as z,J as ut,t as P,h as X,f as lt,F as ft,K as mt,D as ht,E as pt}from"./app-Ce0v2jJL.js";import{_ as gt}from"./_plugin-vue_export-helper-DlAUqK2U.js";var at={exports:{}};(function(c,u){(function(g,T){c.exports=T()})(ot,function(){var g=1e3,T=6e4,l=36e5,b="millisecond",d="second",C="minute",U="hour",h="day",M="week",v="month",A="quarter",k="year",F="date",j="Invalid Date",J=/^(\d{4})[-/]?(\d{1,2})?[-/]?(\d{0,2})[Tt\s]*(\d{1,2})?:?(\d{1,2})?:?(\d{1,2})?[.:]?(\d+)?$/,G=/\[([^\]]+)]|Y{1,4}|M{1,4}|D{1,2}|d{1,4}|H{1,2}|h{1,2}|a|A|m{1,2}|s{1,2}|Z{1,2}|SSS/g,Z={name:"en",weekdays:"Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday".split("_"),months:"January_February_March_April_May_June_July_August_September_October_November_December".split("_"),ordinal:function(o){var r=["th","st","nd","rd"],t=o%100;return"["+o+(r[(t-20)%10]||r[t]||r[0])+"]"}},Q=function(o,r,t){var n=String(o);return!n||n.length>=r?o:""+Array(r+1-n.length).join(t)+o},Y={s:Q,z:function(o){var r=-o.utcOffset(),t=Math.abs(r),n=Math.floor(t/60),e=t%60;return(r<=0?"+":"-")+Q(n,2,"0")+":"+Q(e,2,"0")},m:function o(r,t){if(r.date()<t.date())return-o(t,r);var n=12*(t.year()-r.year())+(t.month()-r.month()),e=r.clone().add(n,v),i=t-e<0,a=r.clone().add(n+(i?-1:1),v);return+(-(n+(t-e)/(i?e-a:a-e))||0)},a:function(o){return o<0?Math.ceil(o)||0:Math.floor(o)},p:function(o){return{M:v,y:k,w:M,d:h,D:F,h:U,m:C,s:d,ms:b,Q:A}[o]||String(o||"").toLowerCase().replace(/s$/,"")},u:function(o){return o===void 0}},D="en",w={};w[D]=Z;var W="$isDayjsObject",q=function(o){return o instanceof et||!(!o||!o[W])},tt=function o(r,t,n){var e;if(!r)return D;if(typeof r=="string"){var i=r.toLowerCase();w[i]&&(e=i),t&&(w[i]=t,e=i);var a=r.split("-");if(!e&&a.length>1)return o(a[0])}else{var m=r.name;w[m]=r,e=m}return!n&&e&&(D=e),e||!n&&D},y=function(o,r){if(q(o))return o.clone();var t=typeof r=="object"?r:{};return t.date=o,t.args=arguments,new et(t)},f=Y;f.l=tt,f.i=q,f.w=function(o,r){return y(o,{locale:r.$L,utc:r.$u,x:r.$x,$offset:r.$offset})};var et=function(){function o(t){this.$L=tt(t.locale,null,!0),this.parse(t),this.$x=this.$x||t.x||{},this[W]=!0}var r=o.prototype;return r.parse=function(t){this.$d=function(n){var e=n.date,i=n.utc;if(e===null)return new Date(NaN);if(f.u(e))return new Date;if(e instanceof Date)return new Date(e);if(typeof e=="string"&&!/Z$/i.test(e)){var a=e.match(J);if(a){var m=a[2]-1||0,p=(a[7]||"0").substring(0,3);return i?new Date(Date.UTC(a[1],m,a[3]||1,a[4]||0,a[5]||0,a[6]||0,p)):new Date(a[1],m,a[3]||1,a[4]||0,a[5]||0,a[6]||0,p)}}return new Date(e)}(t),this.init()},r.init=function(){var t=this.$d;this.$y=t.getFullYear(),this.$M=t.getMonth(),this.$D=t.getDate(),this.$W=t.getDay(),this.$H=t.getHours(),this.$m=t.getMinutes(),this.$s=t.getSeconds(),this.$ms=t.getMilliseconds()},r.$utils=function(){return f},r.isValid=function(){return this.$d.toString()!==j},r.isSame=function(t,n){var e=y(t);return this.startOf(n)<=e&&e<=this.endOf(n)},r.isAfter=function(t,n){return y(t)<this.startOf(n)},r.isBefore=function(t,n){return this.endOf(n)<y(t)},r.$g=function(t,n,e){return f.u(t)?this[n]:this.set(e,t)},r.unix=function(){return Math.floor(this.valueOf()/1e3)},r.valueOf=function(){return this.$d.getTime()},r.startOf=function(t,n){var e=this,i=!!f.u(n)||n,a=f.p(t),m=function(V,$){var H=f.w(e.$u?Date.UTC(e.$y,$,V):new Date(e.$y,$,V),e);return i?H:H.endOf(h)},p=function(V,$){return f.w(e.toDate()[V].apply(e.toDate("s"),(i?[0,0,0,0]:[23,59,59,999]).slice($)),e)},_=this.$W,x=this.$M,S=this.$D,B="set"+(this.$u?"UTC":"");switch(a){case k:return i?m(1,0):m(31,11);case v:return i?m(1,x):m(0,x+1);case M:var L=this.$locale().weekStart||0,K=(_<L?_+7:_)-L;return m(i?S-K:S+(6-K),x);case h:case F:return p(B+"Hours",0);case U:return p(B+"Minutes",1);case C:return p(B+"Seconds",2);case d:return p(B+"Milliseconds",3);default:return this.clone()}},r.endOf=function(t){return this.startOf(t,!1)},r.$set=function(t,n){var e,i=f.p(t),a="set"+(this.$u?"UTC":""),m=(e={},e[h]=a+"Date",e[F]=a+"Date",e[v]=a+"Month",e[k]=a+"FullYear",e[U]=a+"Hours",e[C]=a+"Minutes",e[d]=a+"Seconds",e[b]=a+"Milliseconds",e)[i],p=i===h?this.$D+(n-this.$W):n;if(i===v||i===k){var _=this.clone().set(F,1);_.$d[m](p),_.init(),this.$d=_.set(F,Math.min(this.$D,_.daysInMonth())).$d}else m&&this.$d[m](p);return this.init(),this},r.set=function(t,n){return this.clone().$set(t,n)},r.get=function(t){return this[f.p(t)]()},r.add=function(t,n){var e,i=this;t=Number(t);var a=f.p(n),m=function(x){var S=y(i);return f.w(S.date(S.date()+Math.round(x*t)),i)};if(a===v)return this.set(v,this.$M+t);if(a===k)return this.set(k,this.$y+t);if(a===h)return m(1);if(a===M)return m(7);var p=(e={},e[C]=T,e[U]=l,e[d]=g,e)[a]||1,_=this.$d.getTime()+t*p;return f.w(_,this)},r.subtract=function(t,n){return this.add(-1*t,n)},r.format=function(t){var n=this,e=this.$locale();if(!this.isValid())return e.invalidDate||j;var i=t||"YYYY-MM-DDTHH:mm:ssZ",a=f.z(this),m=this.$H,p=this.$m,_=this.$M,x=e.weekdays,S=e.months,B=e.meridiem,L=function($,H,R,rt){return $&&($[H]||$(n,i))||R[H].slice(0,rt)},K=function($){return f.s(m%12||12,$,"0")},V=B||function($,H,R){var rt=$<12?"AM":"PM";return R?rt.toLowerCase():rt};return i.replace(G,function($,H){return H||function(R){switch(R){case"YY":return String(n.$y).slice(-2);case"YYYY":return f.s(n.$y,4,"0");case"M":return _+1;case"MM":return f.s(_+1,2,"0");case"MMM":return L(e.monthsShort,_,S,3);case"MMMM":return L(S,_);case"D":return n.$D;case"DD":return f.s(n.$D,2,"0");case"d":return String(n.$W);case"dd":return L(e.weekdaysMin,n.$W,x,2);case"ddd":return L(e.weekdaysShort,n.$W,x,3);case"dddd":return x[n.$W];case"H":return String(m);case"HH":return f.s(m,2,"0");case"h":return K(1);case"hh":return K(2);case"a":return V(m,p,!0);case"A":return V(m,p,!1);case"m":return String(p);case"mm":return f.s(p,2,"0");case"s":return String(n.$s);case"ss":return f.s(n.$s,2,"0");case"SSS":return f.s(n.$ms,3,"0");case"Z":return a}return null}($)||a.replace(":","")})},r.utcOffset=function(){return 15*-Math.round(this.$d.getTimezoneOffset()/15)},r.diff=function(t,n,e){var i,a=this,m=f.p(n),p=y(t),_=(p.utcOffset()-this.utcOffset())*T,x=this-p,S=function(){return f.m(a,p)};switch(m){case k:i=S()/12;break;case v:i=S();break;case A:i=S()/3;break;case M:i=(x-_)/6048e5;break;case h:i=(x-_)/864e5;break;case U:i=x/l;break;case C:i=x/T;break;case d:i=x/g;break;default:i=x}return e?i:f.a(i)},r.daysInMonth=function(){return this.endOf(v).$D},r.$locale=function(){return w[this.$L]},r.locale=function(t,n){if(!t)return this.$L;var e=this.clone(),i=tt(t,n,!0);return i&&(e.$L=i),e},r.clone=function(){return f.w(this.$d,this)},r.toDate=function(){return new Date(this.valueOf())},r.toJSON=function(){return this.isValid()?this.toISOString():null},r.toISOString=function(){return this.$d.toISOString()},r.toString=function(){return this.$d.toUTCString()},o}(),nt=et.prototype;return y.prototype=nt,[["$ms",b],["$s",d],["$m",C],["$H",U],["$W",h],["$M",v],["$y",k],["$D",F]].forEach(function(o){nt[o[1]]=function(r){return this.$g(r,o[0],o[1])}}),y.extend=function(o,r){return o.$i||(o(r,et,y),o.$i=!0),y},y.locale=tt,y.isDayjs=q,y.unix=function(o){return y(1e3*o)},y.en=w[D],y.Ls=w,y.p={},y})})(at);var yt=at.exports;const dt=it(yt);var ct={exports:{}};(function(c,u){(function(g,T){c.exports=T()})(ot,function(){return function(g,T,l){g=g||{};var b=T.prototype,d={future:"in %s",past:"%s ago",s:"a few seconds",m:"a minute",mm:"%d minutes",h:"an hour",hh:"%d hours",d:"a day",dd:"%d days",M:"a month",MM:"%d months",y:"a year",yy:"%d years"};function C(h,M,v,A){return b.fromToBase(h,M,v,A)}l.en.relativeTime=d,b.fromToBase=function(h,M,v,A,k){for(var F,j,J,G=v.$locale().relativeTime||d,Z=g.thresholds||[{l:"s",r:44,d:"second"},{l:"m",r:89},{l:"mm",r:44,d:"minute"},{l:"h",r:89},{l:"hh",r:21,d:"hour"},{l:"d",r:35},{l:"dd",r:25,d:"day"},{l:"M",r:45},{l:"MM",r:10,d:"month"},{l:"y",r:17},{l:"yy",d:"year"}],Q=Z.length,Y=0;Y<Q;Y+=1){var D=Z[Y];D.d&&(F=A?l(h).diff(v,D.d,!0):v.diff(h,D.d,!0));var w=(g.rounding||Math.round)(Math.abs(F));if(J=F>0,w<=D.r||!D.r){w<=1&&Y>0&&(D=Z[Y-1]);var W=G[D.l];k&&(w=k(""+w)),j=typeof W=="string"?W.replace("%d",w):W(w,M,D.l,J);break}}if(M)return j;var q=J?G.future:G.past;return typeof q=="function"?q(j):q.replace("%s",j)},b.to=function(h,M){return C(h,M,this,!0)},b.from=function(h,M){return C(h,M,this)};var U=function(h){return h.$u?l.utc():l()};b.toNow=function(h){return this.to(U(this),h)},b.fromNow=function(h){return this.from(U(this),h)}}})})(ct);var _t=ct.exports;const bt=it(_t);dt.extend(bt);const vt={data(){return{products:[],loading:!1,error:null,success:null,formData:{name:"",barcode:"",quantity:0,description:"",selling_price:0,grocery_price:0,image:null},uploadProgress:0}},mounted(){this.fetchProducts();const c=document.createElement("script");c.src="https://upload-widget.cloudinary.com/global/all.js",c.type="text/javascript",c.async=!0,document.head.appendChild(c),c.onload=()=>{cloudinary.createUploadWidget({cloudName:"dqpzvvd0v",uploadPreset:"mrpfvufw"},(u,g)=>{!u&&g&&g.event==="success"&&(console.log("Upload successful! Here is the result:",g.info),this.formData.image=g.info.secure_url)})}},methods:{fetchProducts(){this.loading=!0,st.get("/api/products").then(c=>{this.products=c.data.results.sort((u,g)=>new Date(g.created_at)-new Date(u.created_at)),this.loading=!1}).catch(c=>{console.error("Error fetching products:",c),this.error="Failed to fetch products",this.loading=!1})},formatTimeAgo(c){return dt(c).fromNow()},createProduct(){this.loading=!0;const c=new FormData;c.append("name",this.formData.name),c.append("barcode",this.formData.barcode),c.append("quantity",this.formData.quantity),c.append("description",this.formData.description),c.append("selling_price",this.formData.selling_price),c.append("grocery_price",this.formData.grocery_price),c.append("image",this.formData.image),st.post("/api/addnewproduct",c,{onUploadProgress:u=>{this.uploadProgress=u.loaded/u.total*100}}).then(u=>{this.success=u.data.message,this.loading=!1,this.resetForm(),this.fetchProducts()}).catch(u=>{console.error(u),this.error="Failed to create product",this.loading=!1,this.uploadProgress=0})},deleteProduct(c){confirm("Are you sure you want to delete this product?")&&st.delete(`/api/productsdelete/${c}`).then(u=>{this.products=this.products.filter(g=>g.id!==c),console.log(u.data.message),window.location.reload()}).catch(u=>{console.error(u)})},onFileChange(c){this.formData.image=c.target.files[0]},resetForm(){this.formData={name:"",barcode:"",quantity:0,description:"",selling_price:0,grocery_price:0,image:null},document.getElementById("image").value=""}}},O=c=>(ht("data-v-dce76934"),c=c(),pt(),c),xt={class:"p-6"},Dt=O(()=>s("div",{class:"mb-4"},[s("h2",{class:"text-xl font-bold"},"Upload")],-1)),wt=O(()=>s("h2",{class:"text-2xl font-bold mb-4"},"Create New Product",-1)),$t={class:"mb-4"},Mt=O(()=>s("label",{for:"name",class:"block text-sm font-medium text-gray-700"},"Name:",-1)),St={class:"mb-4"},kt=O(()=>s("label",{for:"barcode",class:"block text-sm font-medium text-gray-700"},"Barcode:",-1)),Pt={class:"mb-4"},Ot=O(()=>s("label",{for:"quantity",class:"block text-sm font-medium text-gray-700"},"Quantity:",-1)),Tt={class:"mb-4"},Ct=O(()=>s("label",{for:"description",class:"block text-sm font-medium text-gray-700"},"Description:",-1)),Ft={class:"mb-4"},Ut=O(()=>s("label",{for:"selling_price",class:"block text-sm font-medium text-gray-700"},"Selling Price:",-1)),Ht={class:"mb-4"},It=O(()=>s("label",{for:"grocery_price",class:"block text-sm font-medium text-gray-700"},"Grocery Price:",-1)),Nt={class:"mb-4"},jt=O(()=>s("label",{for:"image",class:"block text-sm font-medium text-gray-700"},"Image:",-1)),Yt=["disabled"],qt={key:0,class:"w-full bg-gray-200 rounded-full dark:bg-gray-700 mt-4"},Lt={class:"hidden"},Vt={key:1,class:"text-green-600 mt-2"},At={key:2,class:"text-red-600 mt-2"},Wt=O(()=>s("h2",{class:"text-2xl font-bold mb-4"},"Product List",-1)),Bt={class:"w-full"},Et=O(()=>s("thead",null,[s("tr",null,[s("th",{class:"px-4 py-2"},"Name"),s("th",{class:"px-4 py-2"},"Barcode"),s("th",{class:"px-4 py-2"},"Quantity"),s("th",{class:"px-4 py-2"},"Description"),s("th",{class:"px-4 py-2"},"Selling Price"),s("th",{class:"px-4 py-2"},"Grocery Price"),s("th",{class:"px-4 py-2"},"Product Created"),s("th",{class:"px-4 py-2"},"Image"),s("th",{class:"px-4 py-2"},"Actions")])],-1)),zt={class:"border px-4 py-2"},Jt={class:"border px-4 py-2"},Gt={class:"border px-4 py-2"},Zt={class:"border px-4 py-2"},Qt={class:"border px-4 py-2"},Kt={class:"border px-4 py-2"},Rt={class:"border px-4 py-2"},Xt={class:"border px-4 py-2"},te=["src"],ee={class:"border px-4 py-2"},re=["onClick"],se={class:"card mt-8"},ne={key:0,class:"text-gray-700 mt-2"},oe={key:1,class:"text-red-600 mt-2"};function ie(c,u,g,T,l,b){return I(),N("div",xt,[Dt,wt,s("form",{onSubmit:u[7]||(u[7]=lt((...d)=>b.createProduct&&b.createProduct(...d),["prevent"])),class:"mb-8"},[s("div",$t,[Mt,E(s("input",{type:"text",id:"name","onUpdate:modelValue":u[0]||(u[0]=d=>l.formData.name=d),required:"",class:"mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"},null,512),[[z,l.formData.name]])]),s("div",St,[kt,E(s("input",{type:"text",id:"barcode","onUpdate:modelValue":u[1]||(u[1]=d=>l.formData.barcode=d),class:"mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"},null,512),[[z,l.formData.barcode]])]),s("div",Pt,[Ot,E(s("input",{type:"number",id:"quantity","onUpdate:modelValue":u[2]||(u[2]=d=>l.formData.quantity=d),class:"mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"},null,512),[[z,l.formData.quantity,void 0,{number:!0}]])]),s("div",Tt,[Ct,E(s("textarea",{id:"description","onUpdate:modelValue":u[3]||(u[3]=d=>l.formData.description=d),class:"mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"},null,512),[[z,l.formData.description]])]),s("div",Ft,[Ut,E(s("input",{type:"number",id:"selling_price","onUpdate:modelValue":u[4]||(u[4]=d=>l.formData.selling_price=d),class:"mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"},null,512),[[z,l.formData.selling_price,void 0,{number:!0}]])]),s("div",Ht,[It,E(s("input",{type:"number",id:"grocery_price","onUpdate:modelValue":u[5]||(u[5]=d=>l.formData.grocery_price=d),class:"mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"},null,512),[[z,l.formData.grocery_price,void 0,{number:!0}]])]),s("div",Nt,[jt,s("input",{type:"file",id:"image",accept:"image/*",onChange:u[6]||(u[6]=(...d)=>b.onFileChange&&b.onFileChange(...d)),class:"mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"},null,32)]),s("button",{type:"submit",disabled:l.loading,class:"bg-indigo-600 text-white px-4 py-2 rounded-md disabled:opacity-50"},"Create Product",8,Yt),l.loading?(I(),N("div",qt,[s("div",{class:"bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full",style:ut({width:l.uploadProgress+"%",height:"20px",transition:"width 1s linear"})},[s("span",Lt,P(Math.round(l.uploadProgress))+"%",1)],4)])):X("",!0),l.success?(I(),N("div",Vt,P(l.success),1)):X("",!0),l.error?(I(),N("div",At,P(l.error),1)):X("",!0)],32),Wt,s("table",Bt,[Et,s("tbody",null,[(I(!0),N(ft,null,mt(l.products,d=>(I(),N("tr",{key:d.id},[s("td",zt,P(d.name),1),s("td",Jt,P(d.barcode),1),s("td",Gt,P(d.quantity),1),s("td",Zt,P(d.description),1),s("td",Qt,P(d.selling_price),1),s("td",Kt,P(d.grocery_price),1),s("td",Rt,P(b.formatTimeAgo(d.created_at)),1),s("td",Xt,[s("img",{src:d.image_url,alt:"Product Image",class:"w-24 h-auto"},null,8,te)]),s("td",ee,[s("button",{onClick:C=>b.deleteProduct(d.id),class:"bg-red-600 text-white px-2 py-1 rounded-md"},"Delete",8,re)])]))),128))])]),s("div",se,[l.loading?(I(),N("div",ne,"Loading...")):X("",!0),l.error?(I(),N("div",oe,P(l.error),1)):X("",!0)])])}const ce=gt(vt,[["render",ie],["__scopeId","data-v-dce76934"]]);export{ce as default};