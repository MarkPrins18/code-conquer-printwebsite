/* ===========================
   BOUW³D — Over Ons (CSS)
   Locatie: C:\xampp\htdocs\opdrachten\Test2-OverOns\OverOns.css
   =========================== */

/* --------- Design tokens --------- */
:root{
  --side-w: 38vw;
  --bg: #f3f4f6;
  --card: #ffffff;
  --text: #0f172a;
  --muted: #475569;
  --line: #e5e7eb;
  --brand: #f59e0b;
  --brand-ink: #1f2937;
  --radius-lg: 18px;
  --shadow: 0 10px 25px rgba(15,23,42,.08);
  --shadow-sm: 0 4px 14px rgba(15,23,42,.06);
  --container: 1120px;
  --gap: 22px;
}

/* --------- Basis --------- */
*,
*::before,
*::after{ box-sizing: border-box; }

html, body{ height: 100%; }

body{
  margin: 0;
  color: var(--text);
  background: var(--bg);
  font: 500 16px/1.6 system-ui, -apple-system, Segoe UI, Roboto, Arial, "Noto Sans";
}

.desktop-only{ display: block; }
.mobile-only{ display: none; }

/* --------- Rechter vaste foto --------- */
.side-photo{
  position: fixed;
  top: 0; right: 0;
  width: var(--side-w);
  height: 100vh;
  object-fit: cover;
  object-position: center;
  border-left: 1px solid var(--line);
  filter: contrast(1.02) saturate(1.05);
  z-index: 1;
}

/* --------- Pagina-opbouw --------- */
.page{
  min-height: 100%;
  position: relative;
  z-index: 2;
  margin-right: var(--side-w);
  display: grid;
  grid-template-rows: auto 1fr auto;
}

.site-header{
  display: grid;
  grid-template-columns: 1fr auto;
  align-items: center;
  gap: var(--gap);
  padding: 18px clamp(18px, 4vw, 28px);
}

.logo{
  display: inline-block;
  background: #fff;
  color: var(--text);
  text-decoration: none;
  font-weight: 900;
  padding: 6px 10px;
  border-radius: 10px;
  box-shadow: var(--shadow-sm);
  letter-spacing: .4px;
}

.main-nav ul{
  display: flex;
  gap: 14px;
  list-style: none;
  margin: 0;
  padding: 0;
}

.main-nav a{
  text-decoration: none;
  color: var(--muted);
  font-weight: 600;
  padding: 8px 12px;
  border-radius: 10px;
}

.main-nav a:hover,
.main-nav a.active{
  background: #fff;
  color: var(--text);
  box-shadow: var(--shadow-sm);
}

.mobile-hero{
  margin-top: 12px;
  width: 100%;
  height: 42vh;
  object-fit: cover;
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-sm);
}

.content{
  width: 100%;
  max-width: var(--container);
  padding: 10px clamp(18px, 4vw, 28px) 40px;
}

.intro h1{
  margin: 16px 0 6px;
  font-size: clamp(26px, 3.2vw, 34px);
  letter-spacing: .3px;
}

.lede{ margin: 0 0 18px; color: var(--muted); }

/* --------- Cards --------- */
.card{
  background: var(--card);
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow);
  border: 1px solid var(--line);
}

/* --------- KPI's (met slide-animatie) --------- */
.stats{
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: var(--gap);
  margin: 14px 0 18px;
}
.kpi{ padding: 16px 18px; }
.stat{
  font-weight: 900;
  font-size: clamp(26px, 4vw, 34px);
  line-height: 1.1;
}
.stat-label{ margin-top: 6px; color: var(--muted); font-size: 14px; }

/* --------- Pillars --------- */
.pillars{
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: var(--gap);
  margin: 6px 0 22px;
}
.pillars .card{ padding: 18px; }
.pillars h2{ margin: 2px 0 8px; font-size: clamp(18px, 2.4vw, 22px); }

/* --------- Team --------- */
.team h2{ margin: 8px 0 10px; }
.team-grid{
  display: grid;
  grid-template-columns: repeat(5, minmax(0, 1fr));
  gap: var(--gap);
}
.person.card{ padding: 14px; text-align: center; }
.avatar{
  height: 140px;
  border-radius: 16px;
  background: linear-gradient(180deg, #eef2ff, #e2e8f0);
  display: grid; place-items: center;
  border: 1px dashed #cbd5e1;
  overflow: hidden;
}
.avatar .ph{
  width: 72%; height: 72%;
  border-radius: 12px;
  background: linear-gradient(180deg, #e5e7eb, #cbd5e1);
  box-shadow: inset 0 2px 10px rgba(0,0,0,.06);
}
.person-name{ margin: 10px 0 2px; font-size: 16px; }
.person-role{ margin: 0; color: var(--muted); font-size: 14px; }

/* --------- Slide-animatie (herbruikbaar) --------- */
/* Voeg class .slide-x aan het element toe dat je wilt laten bewegen */
.slide-x{
  display: inline-block;
  position: relative;
  will-change: transform;
  animation: slideX 2.8s ease-in-out infinite alternate;
}

/* Staggering — subtiel verschillende delays */
.stats .kpi:nth-child(1) .slide-x{ animation-delay: 0s; }
.stats .kpi:nth-child(2) .slide-x{ animation-delay: .15s; }
.stats .kpi:nth-child(3) .slide-x{ animation-delay: .30s; }

.team-grid .person:nth-child(1) .slide-x{ animation-delay: .10s; }
.team-grid .person:nth-child(2) .slide-x{ animation-delay: .25s; }
.team-grid .person:nth-child(3) .slide-x{ animation-delay: .40s; }
.team-grid .person:nth-child(4) .slide-x{ animation-delay: .55s; }
.team-grid .person:nth-child(5) .slide-x{ animation-delay: .70s; }

@keyframes slideX{
  from { transform: translateX(-18px); }
  to   { transform: translateX( 18px); }
}

/* Toegankelijkheid: minder beweging respecteren */
@media (prefers-reduced-motion: reduce){
  .slide-x{ animation: none !important; }
}

/* --------- CTA --------- */
.cta{
  margin: 20px 0 30px;
  padding: 18px;
  display: grid;
  gap: 8px;
}
.btn-primary{
  display: inline-block;
  background: var(--brand);
  color: var(--brand-ink);
  text-decoration: none;
  font-weight: 800;
  padding: 10px 14px;
  border-radius: 12px;
  box-shadow: var(--shadow-sm);
  border: 1px solid #fbbf24;
}
.btn-primary:hover{ filter: brightness(1.05); }

/* --------- Footer --------- */
.site-footer{
  padding: 22px clamp(18px, 4vw, 28px);
  color: var(--muted);
  border-top: 1px solid var(--line);
}

/* --------- Responsive --------- */
@media (max-width: 1280px){
  .team-grid{ grid-template-columns: repeat(4, 1fr); }
}
@media (max-width: 1024px){
  .desktop-only{ display: none; }
  .mobile-only{ display: block; }
  .page{ margin-right: 0; }
  .stats{ grid-template-columns: 1fr; }
  .pillars{ grid-template-columns: 1fr; }
  .team-grid{ grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 560px){
  .main-nav ul{ gap: 6px; flex-wrap: wrap; }
  .team-grid{ grid-template-columns: 1fr; }
}
