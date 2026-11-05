/* Fast Lights - theme script */
document.addEventListener('submit',function(e){var f=e.target;if(f.hasAttribute('data-demo')){e.preventDefault();var b=f.querySelector('button[type=submit]');if(b)b.textContent='Thank you! (demo)'}});
document.addEventListener('click',function(e){
var c=e.target.closest('.chip');if(c){var pg=c.closest('.page');pg.querySelectorAll('.chip').forEach(function(x){x.classList.remove('on')});c.classList.add('on');pg.querySelectorAll('.mas .t').forEach(function(t){t.style.display=(c.dataset.f==='all'||t.dataset.c===c.dataset.f)?'':'none'});return}
var s=e.target.closest('[data-t]');if(s){e.preventDefault();var el=document.getElementById(s.dataset.t);if(el)el.scrollIntoView({behavior:'smooth',block:'start'});document.querySelectorAll('.sv-side a[data-t]').forEach(function(a){a.classList.toggle('on',a===s)});return}
var t=e.target.closest('.mas .t');if(t){e.preventDefault();var list=[].slice.call(t.closest('.mas').querySelectorAll('.t')).filter(function(x){return x.style.display!=='none'}),i=list.indexOf(t);
var lb=document.createElement('div');lb.className='lb';lb.innerHTML='<div class="im"></div><button class="pv">&#8592;</button><button class="nx">&#8594;</button><button class="x">&#10005;</button>';
function show(){lb.querySelector('.im').style.backgroundImage=getComputedStyle(list[i]).backgroundImage}show();
lb.onclick=function(ev){if(ev.target.classList.contains('pv')){i=(i-1+list.length)%list.length;show()}else if(ev.target.classList.contains('nx')){i=(i+1)%list.length;show()}else{lb.remove()}};document.body.appendChild(lb)}});
document.addEventListener('keydown',function(e){if(e.key==='Escape'){var l=document.querySelector('.lb');if(l)l.remove()}});(function(){
document.documentElement.classList.add('js-anim');
var bar=document.createElement('div');bar.className='prog';document.body.appendChild(bar);
function sc(){var h=document.documentElement,m=h.scrollHeight-innerHeight;bar.style.width=(m>0?h.scrollTop/m*100:0)+'%';var d=document.querySelector('.hdr');if(d)d.classList.toggle('sc',h.scrollTop>30)}
addEventListener('scroll',sc,{passive:true});
var SEL={'*':'.head,.sechead,.kick,h1,.lead,.btns,.ab-mini>div,.ab-bento .pic,.ab-story>*,.abstat,.vcard,.svs-card,.sp,.ct3-card,.ct3-info,.qband blockquote,.fl-card,.step,.stat,.tier,.vrow,.role,.tl>*,.sv-row,.svchips a,.sv-side,.bpost,.feat,.widget,.bsearch,.mas .t,.chips,.pills a,.faq2 details,.faq details,.ccard,.cform-card,.next,.resp,.mapcard,.ctabar .cin,.cta .container>*,.trust .grid>*,.tcard,.post,.split>*,.glass,.editorial>*,.bl-top p'};
var io=('IntersectionObserver' in window)?new IntersectionObserver(function(es){es.forEach(function(e){if(e.isIntersecting){e.target.classList.add('in');io.unobserve(e.target);var c=e.target.querySelector('[data-cnt]');}})},{threshold:.12,rootMargin:'0px 0px -6% 0px'}):null;
var cio=('IntersectionObserver' in window)?new IntersectionObserver(function(es){es.forEach(function(e){if(e.isIntersecting){cio.unobserve(e.target);count(e.target)}})},{threshold:.6}):null;
function count(el){var m=el.dataset.cnt.match(/^(\d+)(.*)$/);if(!m)return;var to=+m[1],t0=null;function st(t){if(!t0)t0=t;var p=Math.min((t-t0)/1400,1),v=Math.round(to*(1-Math.pow(1-p,3)));el.textContent=v+m[2];if(p<1)requestAnimationFrame(st)}requestAnimationFrame(st)}
function prep(pg){
 if(!pg.dataset.fx){pg.dataset.fx=1;
  pg.querySelectorAll('.ab-hero,.sv-hero,.gl-hero,.bl-top,.ct-hero').forEach(function(h){if(!h.querySelector('.fx-beams')){var f=document.createElement('div');f.className='fx-beams';f.innerHTML='<i></i><i></i><i></i>';h.insertBefore(f,h.firstChild)}});
  pg.querySelectorAll('.stat b,.ab-mini b,.abstat b').forEach(function(b){if(/^\d/.test(b.textContent)){b.dataset.cnt=b.textContent.trim()}});
 }
 pg.querySelectorAll('.rv').forEach(function(e){e.classList.remove('in','rv')});
 var seen=new Map();
 pg.querySelectorAll(SEL['*']).forEach(function(e){
  if(e.closest('.fx-beams'))return;
  var p=e.parentElement,n=seen.get(p)||0;seen.set(p,n+1);
  e.style.setProperty('--d',Math.min(n*.09,.6)+'s');e.classList.add('rv');
  if(e.matches('.vrow,.step:nth-child(odd)'))e.classList.add('rv-l');
  if(e.matches('.glass,.ct-side>*,.sv-side'))e.classList.add('rv-r');
  if(e.matches('.stat,.role,.pills a,.ccard'))e.classList.add('rv-z');
  if(io)io.observe(e);else e.classList.add('in');
 });
 pg.querySelectorAll('[data-cnt]').forEach(function(b){b.textContent='0'+b.dataset.cnt.replace(/^\d+/,'');if(cio)cio.observe(b);else count(b)});
}
function run(){var pg=document.querySelector('.page:not([hidden])');if(pg){prep(pg);sc()}}
addEventListener('hashchange',function(){setTimeout(run,30)});
setTimeout(run,60);
})();
(function(){
var card=document.querySelector('.svs-card');if(!card)return;
var cs=[].slice.call(card.querySelectorAll('.svc')),ps=[].slice.call(card.querySelectorAll('.svp')),cur=0,bk=null,hover=false;
function set(i){cur=i;clearTimeout(bk);cs.forEach(function(c,k){c.classList.remove('on');ps[k].classList.toggle('on',k===i)});var c=cs[i],r=c.querySelector('circle');if(r){r.style.animation='none';void r.getBBox();r.style.animation=''}void c.offsetWidth;c.classList.add('on');bk=setTimeout(fb,3600)}
function fb(){if(hover||card.offsetParent===null){bk=setTimeout(fb,1000);return}next()}
function next(){set((cur+1)%cs.length)}
cs.forEach(function(c,k){var r=c.querySelector('circle');if(r)r.addEventListener('animationend',function(){if(c.classList.contains('on'))next()});c.addEventListener('click',function(){set(k)})});
card.addEventListener('mouseenter',function(){hover=true});card.addEventListener('mouseleave',function(){hover=false});
set(0);
})();

/* contact form: validate + send via email / WhatsApp (static build) */
document.addEventListener('submit',function(e){
var f=e.target;if(!f.classList||!f.classList.contains('cform')||!f.hasAttribute('data-demo'))return;
e.preventDefault();e.stopImmediatePropagation();
var bad=0;f.querySelectorAll('.fl input,.fl textarea').forEach(function(i){i.classList.remove('bad')});
var nm=f.querySelector('input[type=text]'),em=f.querySelector('input[type=email]'),ph=f.querySelector('input[type=tel]');
if(!nm.value.trim()){nm.classList.add('bad');bad++}
if(!/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(em.value.trim())){em.classList.add('bad');bad++}
var old=f.querySelector('.cmsg');if(old)old.remove();
if(bad){var m=document.createElement('div');m.className='cmsg err';m.textContent='Please apni name aur sahi email darj karein.';f.querySelector('.sub').before(m);return}
var L=[];f.querySelectorAll('.fl').forEach(function(w){var i=w.querySelector('input,select,textarea'),l=w.querySelector('label');if(i&&l&&String(i.value).trim())L.push(l.textContent.trim()+': '+i.value.trim())});
var r=f.querySelector('input[type=radio]:checked');if(r)L.splice(4,0,'Service: '+r.nextElementSibling.textContent.trim());
var body='New quote request - Fast Lights\n\n'+L.join('\n');
var mail='mailto:hamzajaved.sahil@gmail.com?subject='+encodeURIComponent('Quote request - '+nm.value.trim())+'&body='+encodeURIComponent(body);
var wa='https://wa.me/923262699626?text='+encodeURIComponent(body);
var box=document.createElement('div');box.className='cdone';
box.innerHTML='<div class="ok">&#10003;</div><h3>Shukriya, '+nm.value.trim().replace(/[<>&]/g,'')+'!</h3><p>Aap ka message tayyar hai. Apna email app khul gaya hai, bas Send dabayein. Agar na khule to neeche se bhejein.</p><div class="btns"><a class="btn" href="'+mail+'">Email se bhejein</a><a class="btn btn--ghost" target="_blank" rel="noopener" href="'+wa+'">WhatsApp se bhejein</a></div><button type="button" class="again">Naya message likhein</button>';
f.style.display='none';f.after(box);
box.querySelector('.again').onclick=function(){box.remove();f.style.display='';f.reset()};
window.location.href=mail;
},true);
