 /* ============
   Interactieve team-foto's
   - Klik op “Foto kiezen” of sleep een foto op de avatar
   - Alleen front-end; bestanden worden niet opgeslagen (preview in de pagina)
==============*/
const cards = document.querySelectorAll('.member-card');

cards.forEach((card) => {
  const input = card.querySelector('.file-input');
  const btn   = card.querySelector('.upload-btn');
  const img   = card.querySelector('.avatar');
  const wrap  = card.querySelector('[data-dropzone]');

  btn.addEventListener('click', () => input.click());

  input.addEventListener('change', () => {
    const file = input.files?.[0];
    if (!file) return;
    const url = URL.createObjectURL(file);
    img.src = url;
    img.onload = () => URL.revokeObjectURL(url);
  });

  ['dragenter','dragover'].forEach(evt =>
    wrap.addEventListener(evt, (e)=>{ e.preventDefault(); card.dataset.dragover = 'true'; })
  );
  ['dragleave','drop'].forEach(evt =>
    wrap.addEventListener(evt, (e)=>{ e.preventDefault(); delete card.dataset.dragover; })
  );
  wrap.addEventListener('drop', (e)=>{
    const file = e.dataTransfer.files?.[0];
    if (!file || !file.type.startsWith('image/')) return;
    const url = URL.createObjectURL(file);
    img.src = url;
    img.onload = () => URL.revokeObjectURL(url);
  });
});

/* ============
   Controls voor scene
==============*/
const $ = (sel, ctx=document) => ctx.querySelector(sel);
const speedSlider = $('#speed');
const toggleBtn   = $('#toggleAnim');
let playing = true;
let playbackRate = 1;

function applySpeed(mult){ playbackRate = Number(mult)||1; document.documentElement.style.setProperty('--anim-rate', playbackRate); }
function setPlaying(p){
  playing=p;
  document.body.classList.toggle('paused', !playing);
  toggleBtn.textContent = playing ? '⏸︎ Pauzeer animatie' : '▶︎ Start animatie';
  toggleBtn.setAttribute('aria-pressed', String(playing));
  if (playing) startSparks(); else stopSparks();
}
speedSlider?.addEventListener('input', e => applySpeed(e.target.value));
toggleBtn?.addEventListener('click', ()=> setPlaying(!playing));
applySpeed(speedSlider?.value || 1);

/* ============
   Vonken (canvas)
==============*/
const canvas = document.getElementById('sparks');
const ctx = canvas.getContext('2d', { alpha:true });
let raf=null, particles=[], last=performance.now();
function resizeCanvas(){ canvas.width = canvas.clientWidth; canvas.height = canvas.clientHeight; }
addEventListener('resize', resizeCanvas); resizeCanvas();
function nozzlePoint(){ const rect = document.querySelector('.scene').getBoundingClientRect(); return { x: rect.width*0.62, y: rect.height*0.36 }; }
function makeSpark(){ const {x,y}=nozzlePoint(); const angle=(-Math.PI/2)+(Math.random()*Math.PI/6 - Math.PI/12); const speed=40+Math.random()*80; const life=400+Math.random()*500; particles.push({x,y,vx:Math.cos(angle)*speed,vy:Math.sin(angle)*speed,life,age:0,size:1+Math.random()*2,hue:38+Math.random()*10}); }
function tick(now){
  const dt = (now-last)*playbackRate; last=now;
  ctx.clearRect(0,0,canvas.width,canvas.height);
  if (Math.random()<0.12*playbackRate){ for(let i=0;i<1+Math.floor(Math.random()*2);i++) makeSpark(); }
  for(let i=particles.length-1;i>=0;i--){
    const p=particles[i]; p.age+=dt; if(p.age>=p.life){particles.splice(i,1);continue;}
    p.vy+=60*(dt/1000); p.x+=p.vx*(dt/1000); p.y+=p.vy*(dt/1000);
    const t=1-(p.age/p.life), a=Math.max(0,Math.min(1,t));
    ctx.globalCompositeOperation='lighter';
    ctx.beginPath(); ctx.arc(p.x,p.y,p.size*2,0,Math.PI*2); ctx.fillStyle=`rgba(255,200,80,${0.15*a})`; ctx.fill();
    ctx.beginPath(); ctx.arc(p.x,p.y,p.size,0,Math.PI*2); ctx.fillStyle=`hsla(${p.hue},95%,60%,${0.9*a})`; ctx.fill();
  }
  raf=requestAnimationFrame(tick);
}
function startSparks(){ if(raf) return; last=performance.now(); raf=requestAnimationFrame(tick); }
function stopSparks(){ if(raf) cancelAnimationFrame(raf); raf=null; }
startSparks();

/* Motion preference */
if (matchMedia('(prefers-reduced-motion: reduce)').matches){ setPlaying(false); }

/* Pauzeer CSS-animaties wanneer body.paused is */
const style=document.createElement('style'); style.textContent=`
  body.paused .scene-bg, body.paused .worklight, body.paused .screen-glow,
  body.paused .printhead, body.paused .printhead .nozzle::after,
  body.paused .head-led, body.paused .print-part, body.paused .steam{
    animation-play-state: paused !important;
  }`; document.head.appendChild(style);
