<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Pemetaan SPKLU Kota Medan</title>
<meta name="title" content="Pemetaan SPKLU Kota Medan – GIS Stasiun Pengisian Kendaraan Listrik"/>
<meta name="description" content="Sistem Informasi Geografis (GIS) untuk pemetaan lokasi Stasiun Pengisian Kendaraan Listrik Umum (SPKLU) di Kota Medan, Sumatera Utara. Temukan titik pengisian EV terdekat dari PLN maupun swasta."/>
<meta name="keywords" content="SPKLU, stasiun pengisian kendaraan listrik, EV charging, peta SPKLU Medan, GIS Medan, kendaraan listrik Sumatera Utara, pengisian daya EV, PLN SPKLU, electric vehicle Medan"/>
<meta name="author" content="GIS SPKLU Kota Medan"/>
<meta name="robots" content="index, follow"/>
<meta name="language" content="Indonesian"/>
<meta name="revisit-after" content="7 days"/>
<meta name="category" content="GIS, Electric Vehicle, Transportation"/>
<meta name="coverage" content="Kota Medan, Sumatera Utara, Indonesia"/>
<meta name="generator" content="GIS SPKLU 2026"/>
<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet"/>

<!-- Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<!-- Tailwind -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- AOS -->
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css"/>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<style>
:root{
  --amber:#FBBF24;
  --orange:#F97316;
  --red-orange:#EF4444;
  --green:#10B981;
  --blue:#3B82F6;
  --slate-900:#0D1117;
  --slate-850:#111827;
  --slate-800:#1A2332;
  --slate-700:#243447;
  --slate-600:#2E4057;
  --text-primary:#F0F6FC;
  --text-muted:#8B949E;
  --text-dim:#4A5568;
  --border-glow:rgba(251,191,36,0.18);
  --glow-amber:0 0 20px rgba(251,191,36,0.35),0 0 60px rgba(251,191,36,0.12);
  --glow-orange:0 0 20px rgba(249,115,22,0.4),0 0 60px rgba(249,115,22,0.12);
  --glow-green:0 0 20px rgba(16,185,129,0.35),0 0 60px rgba(16,185,129,0.12);
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth;font-size:16px}
body{font-family:'Poppins',sans-serif;background:var(--slate-900);color:var(--text-primary);overflow-x:hidden}
::selection{background:rgba(251,191,36,0.25);color:#fff}
::-webkit-scrollbar{width:5px}
::-webkit-scrollbar-track{background:var(--slate-850)}
::-webkit-scrollbar-thumb{background:linear-gradient(180deg,var(--amber),var(--orange));border-radius:99px}

.grad-text{background:linear-gradient(120deg,var(--amber) 0%,var(--orange) 60%,#EF4444 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.mono{font-family:'Space Mono',monospace}

/* NAV */
#navbar{position:fixed;top:0;left:0;right:0;z-index:9999;height:60px;background:rgba(13,17,23,0.88);backdrop-filter:blur(20px) saturate(180%);border-bottom:1px solid var(--border-glow);display:flex;align-items:center}
.nav-inner{max-width:1280px;width:100%;margin:0 auto;padding:0 24px;display:flex;align-items:center;justify-content:space-between}
.nav-logo{display:flex;align-items:center;gap:10px;text-decoration:none}
.nav-logo-icon{width:34px;height:34px;border-radius:9px;background:linear-gradient(135deg,var(--amber),var(--orange));display:flex;align-items:center;justify-content:center;box-shadow:var(--glow-amber);flex-shrink:0}
.nav-title{font-size:13px;font-weight:700;color:var(--text-primary);line-height:1.2}
.nav-sub{font-size:10px;color:var(--text-muted);font-weight:400}
.nav-links{display:flex;align-items:center;gap:4px;flex-wrap:wrap}
.nav-links a{padding:6px 14px;border-radius:8px;font-size:12.5px;font-weight:500;color:var(--text-muted);text-decoration:none;transition:all .2s}
.nav-links a:hover{color:var(--amber);background:rgba(251,191,36,0.07)}
.nav-links a.active{color:var(--amber);background:rgba(251,191,36,0.1)}
.nav-badge{padding:4px 10px;border-radius:99px;font-size:10px;font-weight:700;background:rgba(251,191,36,0.1);color:var(--amber);border:1px solid rgba(251,191,36,0.25);font-family:'Space Mono',monospace;letter-spacing:.04em}
.nav-admin-btn{padding:6px 14px;border-radius:8px;font-size:12px;font-weight:600;color:var(--green);background:rgba(16,185,129,0.08);border:1px solid rgba(16,185,129,0.2);cursor:pointer;transition:all .2s;display:flex;align-items:center;gap:5px;text-decoration:none}
.nav-admin-btn:hover{background:rgba(16,185,129,0.15);border-color:rgba(16,185,129,0.4)}

/* CHIP */
.chip{display:inline-flex;align-items:center;gap:6px;font-size:10.5px;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:var(--amber);background:rgba(251,191,36,0.08);border:1px solid rgba(251,191,36,0.22);border-radius:99px;padding:5px 14px}

/* HERO */
#landing{min-height:100vh;padding-top:60px;position:relative;overflow:hidden;display:flex;flex-direction:column}
.hero-bg{position:absolute;inset:0;pointer-events:none;background:radial-gradient(ellipse 80% 55% at 50% -5%,rgba(251,191,36,0.10) 0%,transparent 70%),radial-gradient(ellipse 50% 40% at 95% 80%,rgba(249,115,22,0.08) 0%,transparent 60%),radial-gradient(ellipse 40% 35% at 5% 60%,rgba(239,68,68,0.05) 0%,transparent 60%),var(--slate-900)}
.grid-lines{position:absolute;inset:0;pointer-events:none;background-image:linear-gradient(rgba(251,191,36,0.04) 1px,transparent 1px),linear-gradient(90deg,rgba(251,191,36,0.04) 1px,transparent 1px);background-size:48px 48px}
.hero-content{position:relative;z-index:2;max-width:820px;margin:auto;padding:80px 24px 60px;text-align:center}
.hero-eyebrow{margin-bottom:20px;display:flex;justify-content:center}
.hero-title{font-size:clamp(28px,5.5vw,60px);font-weight:900;line-height:1.12;letter-spacing:-0.02em;margin-bottom:22px;color:var(--text-primary)}
.hero-desc{font-size:clamp(14px,1.5vw,17px);color:var(--text-muted);line-height:1.75;max-width:620px;margin:0 auto 44px}
.hero-cta{display:flex;justify-content:center;gap:12px;flex-wrap:wrap}
.btn-primary{display:inline-flex;align-items:center;gap:8px;padding:13px 28px;border-radius:12px;font-size:14px;font-weight:600;background:linear-gradient(135deg,var(--amber),var(--orange));color:#0D1117;text-decoration:none;box-shadow:var(--glow-amber);border:none;cursor:pointer;transition:transform .25s,box-shadow .25s,filter .25s}
.btn-primary:hover{transform:translateY(-2px);filter:brightness(1.08);box-shadow:0 0 30px rgba(251,191,36,0.5),0 0 70px rgba(251,191,36,0.2)}
.btn-secondary{display:inline-flex;align-items:center;gap:8px;padding:13px 28px;border-radius:12px;font-size:14px;font-weight:600;background:rgba(251,191,36,0.07);color:var(--amber);border:1px solid rgba(251,191,36,0.25);text-decoration:none;cursor:pointer;transition:all .25s}
.btn-secondary:hover{background:rgba(251,191,36,0.12);border-color:rgba(251,191,36,0.45)}

/* STAT STRIP */
.stat-strip{position:relative;z-index:2;max-width:1100px;margin:0 auto;padding:0 24px 70px;display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:16px}
.stat-card{background:linear-gradient(135deg,rgba(26,35,50,0.85),rgba(13,17,23,0.9));border:1px solid var(--border-glow);border-radius:16px;padding:22px 20px;text-align:center;backdrop-filter:blur(12px);transition:transform .3s,box-shadow .3s,border-color .3s;position:relative;overflow:hidden}
.stat-card::before{content:'';position:absolute;top:0;left:50%;transform:translateX(-50%);width:60%;height:1px;background:linear-gradient(90deg,transparent,var(--amber),transparent)}
.stat-card:hover{transform:translateY(-5px);border-color:rgba(251,191,36,0.4);box-shadow:var(--glow-amber)}
.stat-num{font-size:36px;font-weight:900;line-height:1;font-family:'Space Mono',monospace}
.stat-label{font-size:11px;color:var(--text-muted);margin-top:4px;font-weight:500;text-transform:uppercase;letter-spacing:.06em}

/* WHY */
#why{background:var(--slate-850);border-top:1px solid var(--border-glow);border-bottom:1px solid var(--border-glow);padding:80px 24px}
.why-inner{max-width:1100px;margin:0 auto}
.why-grid{display:grid;grid-template-columns:1fr 1fr;gap:24px;margin-top:48px}
@media(max-width:768px){.why-grid{grid-template-columns:1fr}}
.why-card{background:var(--slate-800);border:1px solid var(--border-glow);border-radius:18px;padding:28px;transition:all .3s;position:relative;overflow:hidden}
.why-card::after{content:'';position:absolute;bottom:0;left:0;right:0;height:2px;background:linear-gradient(90deg,transparent,var(--orange),var(--amber),transparent);opacity:0;transition:opacity .3s}
.why-card:hover{border-color:rgba(251,191,36,0.35);transform:translateY(-4px);box-shadow:0 12px 40px rgba(0,0,0,0.4)}
.why-card:hover::after{opacity:1}
.why-icon{width:48px;height:48px;border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:16px}
.why-card h3{font-size:16px;font-weight:700;margin-bottom:10px}
.why-card p{font-size:13.5px;color:var(--text-muted);line-height:1.7}
.quote-block{margin-top:48px;background:linear-gradient(135deg,rgba(251,191,36,0.07),rgba(249,115,22,0.04));border:1px solid rgba(251,191,36,0.2);border-radius:18px;padding:32px 36px;position:relative}
.quote-block::before{content:'"';position:absolute;top:-16px;left:24px;font-size:80px;color:var(--amber);opacity:.2;font-family:Georgia,serif;line-height:1}
.quote-block p{font-size:14.5px;color:var(--text-muted);line-height:1.8;font-style:italic}
.quote-source{margin-top:12px;font-size:12px;color:var(--amber);font-weight:600}

/* MAP SECTION */
#peta{padding-top:60px}
.map-section-wrap{max-width:1280px;margin:0 auto;padding:40px 24px 0}
.map-section-title{margin-bottom:32px;text-align:center}
.map-layout{display:grid;grid-template-columns:300px 1fr;border-radius:20px;overflow:hidden;border:1px solid var(--border-glow);box-shadow:0 24px 80px rgba(0,0,0,0.5);height:600px}
@media(max-width:900px){.map-layout{grid-template-columns:1fr;grid-template-rows:auto 1fr;height:auto}#sidebar{max-height:42vh}#map{height:55vw;min-height:320px}}

/* SIDEBAR */
#sidebar{background:var(--slate-800);border-right:1px solid var(--border-glow);display:flex;flex-direction:column;overflow:hidden}
.sb-head{padding:18px 14px 14px;border-bottom:1px solid var(--border-glow);background:linear-gradient(180deg,rgba(251,191,36,0.04),transparent)}
.sb-title{font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--amber);display:flex;align-items:center;gap:6px;margin-bottom:12px}
.sb-input{width:100%;background:rgba(13,17,23,0.7);border:1px solid rgba(251,191,36,0.18);border-radius:9px;padding:9px 12px 9px 36px;color:var(--text-primary);font-family:'Poppins',sans-serif;font-size:12.5px;outline:none;transition:all .2s}
.sb-input::placeholder{color:var(--text-dim)}
.sb-input:focus{border-color:rgba(251,191,36,0.55);box-shadow:0 0 0 3px rgba(251,191,36,0.09)}
.sb-select{width:100%;background:rgba(13,17,23,0.7);border:1px solid rgba(251,191,36,0.18);border-radius:9px;padding:9px 12px;color:var(--text-primary);font-family:'Poppins',sans-serif;font-size:12.5px;outline:none;appearance:none;cursor:pointer;transition:border-color .2s}
.sb-select:focus{border-color:rgba(251,191,36,0.5)}
.sb-select option{background:var(--slate-800)}
.sb-counter{padding:7px 14px 6px;font-size:11px;color:var(--text-dim);border-bottom:1px solid rgba(255,255,255,0.04)}
.sb-counter span{color:var(--amber);font-weight:700}
#loc-list{overflow-y:auto;flex:1;padding:8px}
#loc-list::-webkit-scrollbar{width:3px}
#loc-list::-webkit-scrollbar-thumb{background:rgba(251,191,36,0.25);border-radius:99px}
.loc-item{display:flex;align-items:flex-start;gap:10px;padding:11px 10px;border-radius:10px;cursor:pointer;border:1px solid transparent;transition:all .2s;margin-bottom:5px}
.loc-item:hover{background:rgba(251,191,36,0.05);border-color:rgba(251,191,36,0.2);transform:translateX(3px)}
.loc-item.active{background:rgba(251,191,36,0.08);border-color:rgba(251,191,36,0.35)}
.loc-icon{width:34px;height:34px;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:1px}
.loc-name{font-size:11.5px;font-weight:700;color:var(--text-primary);line-height:1.4}
.loc-meta{font-size:10px;color:var(--text-muted);margin-top:2px;line-height:1.4}
.loc-tags{display:flex;flex-wrap:wrap;gap:4px;margin-top:5px}
.tag{display:inline-flex;align-items:center;gap:3px;padding:2px 7px;border-radius:99px;font-size:9.5px;font-weight:600}
.tag-pln{background:rgba(251,191,36,0.12);color:var(--amber);border:1px solid rgba(251,191,36,0.28)}
.tag-commercial{background:rgba(249,115,22,0.12);color:#FB923C;border:1px solid rgba(249,115,22,0.28)}
.tag-power{background:rgba(16,185,129,0.1);color:#34D399;border:1px solid rgba(16,185,129,0.25)}
.tag-connector{background:rgba(99,102,241,0.1);color:#818CF8;border:1px solid rgba(99,102,241,0.25)}
.loc-empty{text-align:center;padding:40px 16px;color:var(--text-dim)}
.loc-empty p{font-size:12px;margin-top:10px}

#recommendation-box{background:linear-gradient(135deg,rgba(251,191,36,0.08),rgba(249,115,22,0.05));border-top:1px solid var(--border-glow);padding:12px 14px;font-size:11px;color:var(--text-muted);display:none}
#recommendation-box.show{display:block}
#recommendation-box strong{color:var(--amber);display:block;font-size:11.5px;margin-bottom:3px}

/* MAP */
#map{width:100%;height:100%}
.leaflet-container{background:var(--slate-900);font-family:'Poppins',sans-serif}
.leaflet-popup-content-wrapper{background:var(--slate-800)!important;border:1px solid rgba(251,191,36,0.3)!important;border-radius:16px!important;box-shadow:0 8px 40px rgba(0,0,0,0.6),0 0 24px rgba(251,191,36,0.1)!important;padding:0!important}
.leaflet-popup-content{margin:0!important;width:260px!important}
.leaflet-popup-tip{background:var(--slate-800)!important}
.leaflet-popup-close-button{color:var(--amber)!important;top:10px!important;right:10px!important;font-size:18px!important;font-weight:700!important}
.leaflet-control-zoom a{background:rgba(26,35,50,0.95)!important;color:var(--amber)!important;border:1px solid rgba(251,191,36,0.2)!important;font-weight:700!important}
.leaflet-control-zoom a:hover{background:rgba(251,191,36,0.08)!important}
.leaflet-control-attribution{background:rgba(13,17,23,0.8)!important;color:#4A5568!important;font-size:9px!important}
.custom-tooltip{background:rgba(13,17,23,0.96)!important;border:1px solid rgba(251,191,36,0.3)!important;border-radius:8px!important;color:var(--text-primary)!important;font-family:'Poppins',sans-serif!important;font-size:11px!important;font-weight:600!important;padding:5px 10px!important;white-space:nowrap!important;box-shadow:0 4px 16px rgba(0,0,0,0.5)!important}

/* POPUP CARD */
.pc{padding:18px}
.pc-header{border-bottom:1px solid rgba(255,255,255,0.07);padding-bottom:12px;margin-bottom:12px}
.pc-name{font-size:12.5px;font-weight:800;color:var(--text-primary);line-height:1.4;margin-bottom:3px}
.pc-addr{font-size:10.5px;color:var(--text-muted);line-height:1.5}
.pc-row{display:flex;justify-content:space-between;align-items:center;margin-bottom:7px}
.pc-label{font-size:10px;color:var(--text-dim);font-weight:500}
.pc-val{font-size:11px;font-weight:600;color:var(--text-primary)}
.pc-power{font-size:22px;font-weight:900;font-family:'Space Mono',monospace;line-height:1}
.power-unit{font-size:11px;color:var(--text-muted);font-weight:400}
.power-bar-bg{background:rgba(255,255,255,0.07);border-radius:99px;height:4px;overflow:hidden;margin-top:10px}
.power-bar-fill{height:100%;border-radius:99px;background:linear-gradient(90deg,var(--amber),var(--orange));transition:width .6s ease}
.power-bar-labels{display:flex;justify-content:space-between;font-size:9px;color:var(--text-dim);margin-top:3px}
.pc-coords{margin-top:12px;padding-top:10px;border-top:1px solid rgba(255,255,255,0.05);display:flex;align-items:center;gap:5px;font-family:'Space Mono',monospace;font-size:9.5px;color:var(--text-dim)}
.pc-btn-row{display:flex;gap:6px;margin-top:10px}
.pc-nav-btn{flex:1;padding:8px;border-radius:8px;background:linear-gradient(135deg,rgba(251,191,36,0.12),rgba(249,115,22,0.08));border:1px solid rgba(251,191,36,0.22);color:var(--amber);font-size:11px;font-weight:600;text-align:center;cursor:pointer;transition:all .2s;font-family:'Poppins',sans-serif}
.pc-nav-btn:hover{background:rgba(251,191,36,0.18);border-color:rgba(251,191,36,0.4)}

/* CUSTOM MARKER */
.ev-pin{width:38px;height:38px;border-radius:50% 50% 50% 4px;display:flex;align-items:center;justify-content:center;transform:rotate(-45deg);border:2px solid rgba(255,255,255,0.12)}
.ev-pin svg{transform:rotate(45deg)}
.pin-pln{background:linear-gradient(135deg,var(--amber),var(--orange));box-shadow:0 0 16px rgba(251,191,36,0.75),0 0 32px rgba(251,191,36,0.3)}
.pin-commercial{background:linear-gradient(135deg,#FB923C,#EF4444);box-shadow:0 0 16px rgba(249,115,22,0.75),0 0 32px rgba(249,115,22,0.3)}
@keyframes markerPulse{0%,100%{box-shadow:0 0 12px rgba(251,191,36,0.8),0 0 30px rgba(251,191,36,0.4)}50%{box-shadow:0 0 24px rgba(251,191,36,1),0 0 55px rgba(251,191,36,0.5)}}
.pin-active{animation:markerPulse 1.5s ease-in-out infinite}

/* MAP INFO GRID */
.map-info-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:16px;padding:28px 24px 60px;max-width:1280px;margin:0 auto}
.info-card{background:var(--slate-800);border:1px solid var(--border-glow);border-radius:14px;padding:20px;transition:all .3s}
.info-card:hover{border-color:rgba(251,191,36,0.35);transform:translateY(-3px);box-shadow:0 8px 30px rgba(0,0,0,0.3)}
.info-card-icon{width:40px;height:40px;border-radius:10px;display:flex;align-items:center;justify-content:center;margin-bottom:12px}
.info-card h4{font-size:13px;font-weight:700;margin-bottom:5px}
.info-card p{font-size:11.5px;color:var(--text-muted);line-height:1.65}

/* LEGEND */
.legend-wrap{max-width:1280px;margin:0 auto;padding:0 24px 24px;display:flex;align-items:center;flex-wrap:wrap;gap:12px}
.legend-item{display:flex;align-items:center;gap:7px;font-size:11.5px;color:var(--text-muted)}
.legend-dot{width:12px;height:12px;border-radius:50%;flex-shrink:0}

/* LOADING OVERLAY */
#loading-overlay{position:fixed;inset:0;z-index:99999;background:var(--slate-900);display:flex;flex-direction:column;align-items:center;justify-content:center;gap:16px;transition:opacity .5s}
#loading-overlay.hide{opacity:0;pointer-events:none}
.loading-spinner{width:48px;height:48px;border-radius:50%;border:3px solid rgba(251,191,36,0.15);border-top-color:var(--amber);animation:spin .8s linear infinite}
@keyframes spin{to{transform:rotate(360deg)}}
.loading-text{font-size:13px;color:var(--text-muted)}
.loading-text span{color:var(--amber);font-weight:600}

/* TOAST */
#toast-container{position:fixed;bottom:24px;right:24px;z-index:99998;display:flex;flex-direction:column;gap:8px}
.toast{padding:12px 18px;border-radius:12px;font-size:12.5px;font-weight:500;display:flex;align-items:center;gap:8px;animation:toastIn .3s ease;max-width:320px;box-shadow:0 8px 30px rgba(0,0,0,0.4)}
@keyframes toastIn{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
.toast-success{background:rgba(16,185,129,0.15);border:1px solid rgba(16,185,129,0.3);color:#34D399}
.toast-error{background:rgba(239,68,68,0.15);border:1px solid rgba(239,68,68,0.3);color:#F87171}
.toast-info{background:rgba(251,191,36,0.12);border:1px solid rgba(251,191,36,0.25);color:var(--amber)}

/* PROFILE */
#profil{background:linear-gradient(180deg,var(--slate-900) 0%,var(--slate-850) 100%);border-top:1px solid var(--border-glow);padding:80px 24px}
.profile-inner{max-width:900px;margin:0 auto}
.profile-card{background:rgba(26,35,50,0.6);border:1px solid var(--border-glow);border-radius:24px;backdrop-filter:blur(16px);transition:all .4s;overflow:hidden;position:relative}
.profile-card::before{content:'';position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,var(--amber),var(--orange),#EF4444)}
.profile-card:hover{border-color:rgba(249,115,22,0.4);box-shadow:0 0 50px rgba(249,115,22,0.18),0 0 90px rgba(249,115,22,0.07);transform:translateY(-4px)}
.profile-body{padding:40px}
.avatar{width:72px;height:72px;border-radius:50%;flex-shrink:0;background:linear-gradient(135deg,var(--amber),var(--orange));display:flex;align-items:center;justify-content:center;font-size:26px;font-weight:900;color:var(--slate-900);position:relative}
.avatar::after{content:'';position:absolute;inset:-3px;border-radius:50%;background:linear-gradient(135deg,var(--amber),var(--orange));z-index:-1;opacity:.35;filter:blur(8px)}
.profile-name{font-size:22px;font-weight:800;margin:4px 0 2px}
.profile-role{font-size:13px;color:var(--text-muted)}
.profile-tags{display:flex;flex-wrap:wrap;gap:8px;margin-top:14px}
.p-tag{padding:4px 12px;border-radius:99px;font-size:11px;font-weight:600}
.profile-detail-grid{display:grid;grid-template-columns:1fr 1fr;gap:0;border-top:1px solid rgba(255,255,255,0.06);margin-top:32px}
@media(max-width:640px){.profile-detail-grid{grid-template-columns:1fr}}
.pd-item{padding:20px;border-right:1px solid rgba(255,255,255,0.06);border-bottom:1px solid rgba(255,255,255,0.06)}
.pd-item:nth-child(even){border-right:none}
.pd-item:nth-last-child(-n+2){border-bottom:none}
@media(max-width:640px){.pd-item{border-right:none}}
.pd-label{font-size:10px;text-transform:uppercase;letter-spacing:.08em;color:var(--text-dim);font-weight:600;margin-bottom:5px}
.pd-val{font-size:13px;color:var(--text-primary);font-weight:500;line-height:1.5}

footer{background:var(--slate-900);border-top:1px solid var(--border-glow);padding:24px;text-align:center;font-size:11.5px;color:var(--text-dim)}
footer span{color:var(--amber);font-weight:600}

.section-hd{text-align:center;margin-bottom:48px}
.section-hd h2{font-size:clamp(22px,3.5vw,36px);font-weight:800;margin-top:12px;line-height:1.2}
.section-hd p{font-size:14px;color:var(--text-muted);margin-top:10px;max-width:560px;margin-left:auto;margin-right:auto;line-height:1.7}

@media(max-width:640px){.hero-content{padding:60px 20px 40px}.stat-strip{padding:0 20px 50px}.profile-body{padding:28px 20px}}
</style>
</head>
<body>

<!-- LOADING -->
<div id="loading-overlay">
  <div class="loading-spinner"></div>
  <div class="loading-text">Memuat data dari <span>Supabase</span>…</div>
</div>

<!-- TOAST -->
<div id="toast-container"></div>

<!-- NAVBAR -->
<nav id="navbar">
  <div class="nav-inner">
    <a class="nav-logo" href="#landing">
      <div class="nav-logo-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0D1117" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
      </div>
      <div>
        <div class="nav-title">GIS SPKLU</div>
        <div class="nav-sub">Kota Medan</div>
      </div>
    </a>
    <div class="nav-links">
      <a href="#landing" class="active">Beranda</a>
      <a href="#why">Latar Belakang</a>
      <a href="#peta">Peta</a>
      <a href="#profil">Profil</a>
      <span class="nav-badge">2026</span>
      <a href="admin.php" class="nav-admin-btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
        Admin
      </a>
    </div>
  </div>
</nav>

<!-- HERO -->
<section id="landing">
  <div class="hero-bg"></div>
  <div class="grid-lines"></div>
  <div class="hero-content" data-aos="fade-up" data-aos-duration="800">
    <div class="hero-eyebrow">
      <span class="chip">
        <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="10" r="3"/><path d="M12 2a8 8 0 0 0-8 8c0 5.4 7.05 11.5 7.35 11.76a1 1 0 0 0 1.3 0C13 21.5 20 15.4 20 10a8 8 0 0 0-8-8z"/></svg>
        Sistem Informasi Geografis · Sumatera Utara
      </span>
    </div>
    <h1 class="hero-title">Pemetaan Lokasi<br/><span class="grad-text">Stasiun Pengisian</span><br/>Kendaraan Listrik</h1>
    <p class="hero-desc">Sistem informasi berbasis peta interaktif untuk memetakan dan menganalisis sebaran <strong style="color:var(--text-primary)">SPKLU (Stasiun Pengisian Kendaraan Listrik Umum)</strong> di Kota Medan sebagai upaya mendukung transisi energi bersih dan mobilitas berkelanjutan.</p>
    <div class="hero-cta">
      <a href="#peta" class="btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="3 11 22 2 13 21 11 13 3 11"/></svg>
        Buka Peta Interaktif
      </a>
      <a href="#why" class="btn-secondary">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        Latar Belakang
      </a>
    </div>
  </div>
  <div class="stat-strip" data-aos="fade-up" data-aos-delay="200" data-aos-duration="800">
    <div class="stat-card"><div class="stat-num grad-text" id="s-total">—</div><div class="stat-label">Total SPKLU</div></div>
    <div class="stat-card"><div class="stat-num grad-text" id="s-kw">—</div><div class="stat-label">Total Kapasitas (kW)</div></div>
    <div class="stat-card"><div class="stat-num" style="color:var(--amber)" id="s-ports">—</div><div class="stat-label">Total Port Pengisian</div></div>
    <div class="stat-card"><div class="stat-num" style="color:var(--amber)" id="s-pln">—</div><div class="stat-label">Stasiun PLN</div></div>
    <div class="stat-card"><div class="stat-num" style="color:#FB923C" id="s-com">—</div><div class="stat-label">Stasiun Komersial</div></div>
  </div>
</section>

<!-- WHY -->
<section id="why">
  <div class="why-inner">
    <div class="section-hd" data-aos="fade-up">
      <span class="chip">
        <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
        Latar Belakang & Tujuan
      </span>
      <h2>Mengapa Pemetaan <span class="grad-text">SPKLU</span> Penting?</h2>
      <p>Peningkatan adopsi kendaraan listrik membutuhkan infrastruktur pengisian yang memadai dan mudah diakses.</p>
    </div>
    <div class="why-grid">
      <div class="why-card" data-aos="fade-up" data-aos-delay="0">
        <div class="why-icon" style="background:rgba(251,191,36,0.12);border:1px solid rgba(251,191,36,0.25)">
          <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--amber)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a10 10 0 1 0 10 10"/><path d="M12 6v6l4 2"/></svg>
        </div>
        <h3>Pertumbuhan Kendaraan Listrik yang Pesat</h3>
        <p>Kota Medan sebagai ibu kota Provinsi Sumatera Utara membutuhkan infrastruktur pengisian yang terencana.</p>
      </div>
      <div class="why-card" data-aos="fade-up" data-aos-delay="80">
        <div class="why-icon" style="background:rgba(249,115,22,0.12);border:1px solid rgba(249,115,22,0.25)">
          <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--orange)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="3 11 22 2 13 21 11 13 3 11"/></svg>
        </div>
        <h3>Kesenjangan Informasi Aksesibilitas</h3>
        <p>Sistem informasi geografis berbasis web mampu menyajikan data lokasi secara visual dalam satu platform terpadu.</p>
      </div>
      <div class="why-card" data-aos="fade-up" data-aos-delay="160">
        <div class="why-icon" style="background:rgba(99,102,241,0.12);border:1px solid rgba(99,102,241,0.25)">
          <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#818CF8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8m-4-4v4"/></svg>
        </div>
        <h3>Dukungan Kebijakan Energi Nasional</h3>
        <p>Perpres No. 55/2019 mendorong percepatan adopsi kendaraan listrik. Pemetaan SPKLU berkontribusi pada evaluasi kebijakan infrastruktur energi.</p>
      </div>
      <div class="why-card" data-aos="fade-up" data-aos-delay="240">
        <div class="why-icon" style="background:rgba(16,185,129,0.12);border:1px solid rgba(16,185,129,0.25)">
          <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#34D399" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg>
        </div>
        <h3>Transparansi Data Infrastruktur Publik</h3>
        <p>Visualisasi data spasial SPKLU meningkatkan transparansi dan memudahkan pemangku kepentingan dalam pengambilan keputusan berbasis data.</p>
      </div>
    </div>
    <div class="quote-block" data-aos="fade-up" data-aos-delay="100">
      <p>Pengembangan infrastruktur pengisian daya yang merata dan mudah diakses merupakan faktor penentu keberhasilan transisi menuju ekosistem kendaraan listrik.</p>
      <div class="quote-source">— Konteks Penelitian GIS SPKLU Kota Medan, 2026</div>
    </div>
  </div>
</section>

<!-- PETA -->
<section id="peta">
  <div class="map-section-wrap">
    <div class="section-hd" data-aos="fade-up">
      <span class="chip">
        <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"/><line x1="8" y1="2" x2="8" y2="18"/><line x1="16" y1="6" x2="16" y2="22"/></svg>
        Peta Interaktif
      </span>
      <h2>Sebaran <span class="grad-text">SPKLU</span> Kota Medan</h2>
      <p>Klik marker pada peta untuk detail lengkap. Gunakan filter sidebar untuk mempersempit pencarian.</p>
    </div>
    <div class="legend-wrap" data-aos="fade-up">
      <div class="legend-item"><div class="legend-dot" style="background:linear-gradient(135deg,var(--amber),var(--orange));box-shadow:0 0 6px rgba(251,191,36,0.5)"></div><span>PLN</span></div>
      <div class="legend-item"><div class="legend-dot" style="background:linear-gradient(135deg,#FB923C,#EF4444);box-shadow:0 0 6px rgba(249,115,22,0.5)"></div><span>Commercial</span></div>
      <div class="legend-item" style="margin-left:auto;font-size:10.5px;color:var(--text-dim)">
        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
        Data realtime dari Supabase REST API
      </div>
    </div>
    <div class="map-layout" data-aos="fade-up" data-aos-delay="100">
      <aside id="sidebar">
        <div class="sb-head">
          <div class="sb-title">
            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="6" x2="20" y2="6"/><line x1="8" y1="12" x2="16" y2="12"/><line x1="10" y1="18" x2="14" y2="18"/></svg>
            Filter Lokasi
          </div>
          <div style="position:relative;margin-bottom:10px">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--text-dim)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="position:absolute;left:10px;top:50%;transform:translateY(-50%);pointer-events:none"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" id="sb-search" class="sb-input" placeholder="Cari nama / alamat…"/>
          </div>
          <div style="position:relative;margin-bottom:8px">
            <select id="sb-provider" class="sb-select">
              <option value="all">Semua Provider</option>
              <option value="PLN">PLN</option>
              <option value="Commercial">Commercial</option>
            </select>
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="var(--text-dim)" stroke-width="2.5" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);pointer-events:none"><polyline points="6 9 12 15 18 9"/></svg>
          </div>
          <div style="position:relative">
            <select id="sb-power" class="sb-select">
              <option value="all">Semua Kapasitas</option>
              <option value="high">≥ 100 kW (High Power)</option>
              <option value="medium">50–99 kW (Medium)</option>
              <option value="low">&lt; 50 kW (AC/Slow)</option>
            </select>
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="var(--text-dim)" stroke-width="2.5" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);pointer-events:none"><polyline points="6 9 12 15 18 9"/></svg>
          </div>
        </div>
        <div class="sb-counter"><span id="sb-count">0</span> lokasi ditemukan</div>
        <div id="loc-list"></div>
        <div id="recommendation-box"><strong>💡 Rekomendasi Terdekat</strong><span id="rec-text">—</span></div>
      </aside>
      <div id="map"></div>
    </div>
  </div>

  <div class="map-info-grid">
    <div class="info-card" data-aos="fade-up" data-aos-delay="0">
      <div class="info-card-icon" style="background:rgba(251,191,36,0.1);border:1px solid rgba(251,191,36,0.2)">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--amber)" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
      </div>
      <h4>Tipe Konektor</h4>
      <p>SPKLU di Medan menggunakan standar <strong style="color:var(--text-primary)">CCS1</strong>, <strong style="color:var(--text-primary)">Type 2</strong>, dan <strong style="color:var(--text-primary)">CHAdeMO</strong>.</p>
    </div>
    <div class="info-card" data-aos="fade-up" data-aos-delay="80">
      <div class="info-card-icon" style="background:rgba(249,115,22,0.1);border:1px solid rgba(249,115,22,0.2)">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--orange)" stroke-width="2"><rect x="1" y="6" width="15" height="13" rx="2"/><path d="M16 10h2a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-2"/><path d="M7 8v4"/></svg>
      </div>
      <h4>Kapasitas Pengisian</h4>
      <p>Tersedia pengisian cepat DC hingga <strong style="color:var(--text-primary)">200 kW</strong> untuk waktu pengisian minimal.</p>
    </div>
    <div class="info-card" data-aos="fade-up" data-aos-delay="160">
      <div class="info-card-icon" style="background:rgba(16,185,129,0.1);border:1px solid rgba(16,185,129,0.2)">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#34D399" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
      </div>
      <h4>Persebaran Wilayah</h4>
      <p>SPKLU tersebar di <strong style="color:var(--text-primary)">Medan Baru, Medan Petisah, Medan Polonia</strong>, dan <strong style="color:var(--text-primary)">Medan Helvetia</strong>.</p>
    </div>
    <div class="info-card" data-aos="fade-up" data-aos-delay="240">
      <div class="info-card-icon" style="background:rgba(99,102,241,0.1);border:1px solid rgba(99,102,241,0.2)">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#818CF8" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
      </div>
      <h4>Operasional 24 Jam</h4>
      <p>Sebagian besar SPKLU PLN beroperasi <strong style="color:var(--text-primary)">24 jam penuh</strong>.</p>
    </div>
  </div>
</section>

<!-- PROFIL -->
<section id="profil">
  <div class="profile-inner">
    <div class="section-hd" data-aos="fade-up">
      <span class="chip">
        <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        Profil Pembuat
      </span>
      <h2>Tentang <span class="grad-text">Pembuat</span></h2>
    </div>
    <div class="profile-card" data-aos="fade-up" data-aos-delay="100">
      <div class="profile-body">
        <div style="display:flex;align-items:flex-start;gap:20px;flex-wrap:wrap">
          <div class="avatar">RK</div>
          <div style="flex:1;min-width:200px">
            <p style="font-size:11px;text-transform:uppercase;letter-spacing:.1em;color:var(--text-dim);font-weight:600">Dikembangkan &amp; Diteliti oleh</p>
            <h2 class="profile-name grad-text">Riska Khairani Nasution</h2>
            <p class="profile-role">Mahasiswa · Sistem Informasi Geografis</p>
            <div class="profile-tags">
              <span class="p-tag" style="background:rgba(251,191,36,0.1);color:var(--amber);border:1px solid rgba(251,191,36,0.25)">GIS &amp; Spasial</span>
              <span class="p-tag" style="background:rgba(249,115,22,0.1);color:#FB923C;border:1px solid rgba(249,115,22,0.25)">Web Development</span>
              <span class="p-tag" style="background:rgba(99,102,241,0.1);color:#818CF8;border:1px solid rgba(99,102,241,0.25)">Leaflet.js</span>
              <span class="p-tag" style="background:rgba(16,185,129,0.1);color:#34D399;border:1px solid rgba(16,185,129,0.25)">Data Analysis</span>
              <span class="p-tag" style="background:rgba(236,72,153,0.1);color:#F472B6;border:1px solid rgba(236,72,153,0.25)">UI/UX</span>
            </div>
          </div>
        </div>
        <div class="profile-detail-grid">
          <div class="pd-item"><div class="pd-label">Judul</div><div class="pd-val">Pemetaan Lokasi Stasiun Pengisian Kendaraan Listrik (SPKLU) di Kota Medan</div></div>
          <div class="pd-item"><div class="pd-label">Bidang Studi</div><div class="pd-val">Teknologi Rekayasa Perangkat Lunak</div></div>
          <div class="pd-item"><div class="pd-label">Lokasi</div><div class="pd-val">Kota Medan, Sumatera Utara, Indonesia</div></div>
          <div class="pd-item"><div class="pd-label">Tahun</div><div class="pd-val" style="color:var(--amber);font-family:'Space Mono',monospace">2026</div></div>
          <div class="pd-item"><div class="pd-label">Teknologi</div><div class="pd-val">HTML5 · Leaflet.js · Tailwind CSS · Supabase REST API · GeoJSON</div></div>
          <div class="pd-item"><div class="pd-label">Sumber Data</div><div class="pd-val">PLN UID Sumatera Utara · Google Maps 2026</div></div>
        </div>
      </div>
    </div>
  </div>
</section>

<footer>
  <p>GIS SPKLU Kota Medan &copy; 2026 · Dikembangkan oleh <span>Riska Khairani Nasution</span></p>
  <p style="margin-top:6px;font-size:10px">Data realtime dari Supabase REST API · PLN UID Sumatera Utara · Google Maps 2026.</p>
</footer>

<script>
/* ================================================================
   SUPABASE REST API CONFIG (no SDK)
================================================================ */
const SB_URL  = 'https://jufrpxkoslwnktjckaxv.supabase.co/rest/v1';
const SB_KEY  = 'sb_publishable_Yfc4Xtw5W4movKSoGNRrbw_octrCpAt';
const SB_HEADERS = {
  'apikey': SB_KEY,
  'Authorization': 'Bearer ' + SB_KEY,
  'Content-Type': 'application/json'
};

/* REST helpers */
async function sbSelect(table, params=''){
  const res = await fetch(`${SB_URL}/${table}?${params}`, {
    headers: { ...SB_HEADERS, 'Accept': 'application/json' }
  });
  if(!res.ok) throw new Error(await res.text());
  return res.json();
}

/* ================================================================
   STATE
================================================================ */
let SPKLU_DATA   = [];
let filteredData = [];
let markers      = {};
let activeId     = null;
const MAX_KW_REF = 200;

/* ================================================================
   TOAST
================================================================ */
function toast(msg, type='info', dur=3500){
  const el = document.createElement('div');
  el.className = `toast toast-${type}`;
  const icons = {success:'✓',error:'✕',info:'⚡'};
  el.innerHTML = `<span>${icons[type]||'ℹ'}</span><span>${msg}</span>`;
  document.getElementById('toast-container').appendChild(el);
  setTimeout(()=>{
    el.style.transition='opacity .3s,transform .3s';
    el.style.opacity='0';el.style.transform='translateY(6px)';
    setTimeout(()=>el.remove(),350);
  }, dur);
}

/* ================================================================
   MAP INIT
================================================================ */
const map = L.map('map',{center:[3.591,98.671],zoom:13,zoomControl:false,preferCanvas:true});
L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png',{
  attribution:'&copy; OSM &copy; CARTO',subdomains:'abcd',maxZoom:19
}).addTo(map);
L.control.zoom({position:'bottomright'}).addTo(map);

/* ================================================================
   MARKER ICON FACTORY
================================================================ */
function makeIcon(provider, active=false){
  const cls = provider==='PLN' ? 'pin-pln' : 'pin-commercial';
  const html = `<div class="ev-pin ${cls}${active?' pin-active':''}">
    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24"
      fill="none" stroke="#0D1117" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round">
      <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>
    </svg></div>`;
  return L.divIcon({html,className:'',iconSize:[38,38],iconAnchor:[19,38],popupAnchor:[0,-42]});
}

/* ================================================================
   POPUP HTML
================================================================ */
function makePopupHTML(s){
  const pct = Math.min(100, Math.round((s.max_kw/MAX_KW_REF)*100));
  const bc  = s.provider==='PLN' ? 'tag-pln' : 'tag-commercial';
  const connectors = (s.connector||'').split('/').map(c=>`<span class="tag tag-connector">${c.trim()}</span>`).join('');
  return `<div class="pc">
    <div class="pc-header">
      <div class="pc-name">${s.name}</div>
      <div class="pc-addr">${s.address}</div>
    </div>
    <div class="pc-row"><span class="pc-label">Provider</span><span class="tag ${bc}">${s.provider}</span></div>
    <div class="pc-row"><span class="pc-label">Port Tersedia</span><span class="pc-val">${s.ports} port</span></div>
    <div class="pc-row" style="align-items:flex-start">
      <span class="pc-label">Konektor</span>
      <div style="display:flex;gap:4px;flex-wrap:wrap;justify-content:flex-end">${connectors}</div>
    </div>
    <div class="pc-row" style="margin-bottom:4px">
      <span class="pc-label">Max Power</span>
      <span class="pc-power grad-text">${s.max_kw}<span class="power-unit"> kW</span></span>
    </div>
    <div class="power-bar-bg"><div class="power-bar-fill" style="width:${pct}%"></div></div>
    <div class="power-bar-labels"><span>0 kW</span><span style="color:var(--amber)">${pct}%</span><span>${MAX_KW_REF} kW</span></div>
    <div class="pc-coords">
      <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="10" r="3"/><path d="M12 2a8 8 0 0 0-8 8c0 5.4 7.05 11.5 7.35 11.76a1 1 0 0 0 1.3 0C13 21.5 20 15.4 20 10a8 8 0 0 0-8-8z"/></svg>
      ${parseFloat(s.lat).toFixed(5)}, ${parseFloat(s.lng).toFixed(5)}
    </div>
    <div class="pc-btn-row">
      <button class="pc-nav-btn" onclick="flyTo(${s.id})">⚡ Perbesar</button>
    </div>
  </div>`;
}

/* ================================================================
   MARKER ADD / REMOVE
================================================================ */
function addMarker(s){
  if(markers[s.id]) map.removeLayer(markers[s.id]);
  const m = L.marker([s.lat,s.lng],{icon:makeIcon(s.provider)})
    .addTo(map)
    .bindTooltip(s.name,{permanent:false,direction:'top',className:'custom-tooltip',offset:[0,-40]})
    .bindPopup(makePopupHTML(s),{maxWidth:280});
  m.on('click',()=>setActive(s.id));
  markers[s.id]=m;
}

function removeMarker(id){
  if(markers[id]){map.removeLayer(markers[id]);delete markers[id];}
}

/* ================================================================
   ACTIVE STATE
================================================================ */
function setActive(id){
  if(activeId && markers[activeId]){
    const prev=SPKLU_DATA.find(x=>x.id===activeId);
    if(prev) markers[activeId].setIcon(makeIcon(prev.provider,false));
  }
  activeId=id;
  if(markers[id]){
    const s=SPKLU_DATA.find(x=>x.id===id);
    if(s) markers[id].setIcon(makeIcon(s.provider,true));
  }
  document.querySelectorAll('.loc-item').forEach(el=>{
    el.classList.toggle('active',+el.dataset.id===id);
  });
  showRecommendation(id);
}

function flyTo(id){
  const s=SPKLU_DATA.find(x=>x.id===id);
  if(!s) return;
  setActive(id);
  map.flyTo([s.lat,s.lng],16,{animate:true,duration:1.2});
  setTimeout(()=>{if(markers[id]) markers[id].openPopup();},1400);
}

/* ================================================================
   RECOMMENDATION
================================================================ */
function showRecommendation(selectedId){
  const box=document.getElementById('recommendation-box');
  const txt=document.getElementById('rec-text');
  const sel=SPKLU_DATA.find(x=>x.id===selectedId);
  if(!sel){box.classList.remove('show');return;}
  const others=SPKLU_DATA.filter(x=>x.id!==selectedId)
    .map(x=>({...x,dist:Math.hypot(x.lat-sel.lat,x.lng-sel.lng)}))
    .sort((a,b)=>a.dist-b.dist).slice(0,2);
  if(!others.length){box.classList.remove('show');return;}
  txt.textContent=others.map(x=>`${x.name.replace('SPKLU ','').substring(0,28)} (${x.max_kw} kW)`).join(' · ');
  box.classList.add('show');
}

/* ================================================================
   FILTER
================================================================ */
function powerCategory(kw){return kw>=100?'high':kw>=50?'medium':'low';}

function applyFilter(){
  const q=document.getElementById('sb-search').value.trim().toLowerCase();
  const provider=document.getElementById('sb-provider').value;
  const power=document.getElementById('sb-power').value;
  filteredData=SPKLU_DATA.filter(s=>{
    const mN=s.name.toLowerCase().includes(q)||s.address.toLowerCase().includes(q);
    const mP=provider==='all'||s.provider===provider;
    const mW=power==='all'||powerCategory(s.max_kw)===power;
    return mN&&mP&&mW;
  });
  SPKLU_DATA.forEach(s=>{
    if(!markers[s.id]) return;
    const vis=filteredData.some(x=>x.id===s.id);
    if(vis&&!map.hasLayer(markers[s.id])) map.addLayer(markers[s.id]);
    else if(!vis&&map.hasLayer(markers[s.id])) map.removeLayer(markers[s.id]);
  });
  renderList(filteredData);
}

document.getElementById('sb-search').addEventListener('input',applyFilter);
document.getElementById('sb-provider').addEventListener('change',applyFilter);
document.getElementById('sb-power').addEventListener('change',applyFilter);

/* ================================================================
   RENDER LIST
================================================================ */
function renderList(data){
  document.getElementById('sb-count').textContent=data.length;
  const list=document.getElementById('loc-list');
  if(!data.length){
    list.innerHTML=`<div class="loc-empty">
      <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <p>Tidak ada lokasi ditemukan.</p></div>`;
    return;
  }
  list.innerHTML=data.map(s=>{
    const bc=s.provider==='PLN'?'tag-pln':'tag-commercial';
    const iconClr=s.provider==='PLN'?'var(--amber)':'#FB923C';
    const iconBg=s.provider==='PLN'
      ?'background:rgba(251,191,36,0.1);border:1px solid rgba(251,191,36,0.2)'
      :'background:rgba(249,115,22,0.1);border:1px solid rgba(249,115,22,0.2)';
    return `<div class="loc-item ${activeId===s.id?'active':''}" data-id="${s.id}" onclick="flyTo(${s.id})">
      <div class="loc-icon" style="${iconBg}">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="${iconClr}" stroke-width="2.8"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
      </div>
      <div style="flex:1;min-width:0">
        <div class="loc-name">${s.name}</div>
        <div class="loc-meta">${s.address.substring(0,60)}${s.address.length>60?'…':''}</div>
        <div class="loc-tags">
          <span class="tag ${bc}">${s.provider}</span>
          <span class="tag tag-power">${s.max_kw} kW</span>
          <span class="tag tag-connector">${s.ports} port</span>
        </div>
      </div>
      <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="var(--text-dim)" stroke-width="2.5" style="flex-shrink:0;margin-top:5px"><polyline points="9 18 15 12 9 6"/></svg>
    </div>`;
  }).join('');
}

/* ================================================================
   COUNT-UP
================================================================ */
function countUp(el, target, dur=1400){
  let start=0;
  const step=target/(dur/16);
  const t=setInterval(()=>{
    start=Math.min(start+step,target);
    el.textContent=Math.floor(start);
    if(start>=target) clearInterval(t);
  },16);
}

function updateStats(){
  const totalKw=SPKLU_DATA.reduce((a,s)=>a+s.max_kw,0);
  const totalPorts=SPKLU_DATA.reduce((a,s)=>a+s.ports,0);
  countUp(document.getElementById('s-total'),SPKLU_DATA.length);
  countUp(document.getElementById('s-kw'),totalKw);
  countUp(document.getElementById('s-ports'),totalPorts);
  countUp(document.getElementById('s-pln'),SPKLU_DATA.filter(s=>s.provider==='PLN').length);
  countUp(document.getElementById('s-com'),SPKLU_DATA.filter(s=>s.provider==='Commercial').length);
}

/* ================================================================
   LOAD DATA
================================================================ */
async function loadData(){
  try{
    const data = await sbSelect('spklu','order=id.asc');
    Object.values(markers).forEach(m=>map.removeLayer(m));
    markers={};
    SPKLU_DATA=data||[];
    filteredData=[...SPKLU_DATA];
    SPKLU_DATA.forEach(s=>addMarker(s));
    renderList(filteredData);
    updateStats();
  }catch(err){
    console.error(err);
    toast('Gagal memuat data: '+(err.message||err),'error',6000);
  }
}

/* ================================================================
   INIT
================================================================ */
window.addEventListener('load',async()=>{
  AOS.init({once:true,duration:700,easing:'ease-out-quad'});
  await loadData();

  const overlay=document.getElementById('loading-overlay');
  overlay.classList.add('hide');
  setTimeout(()=>{overlay.style.display='none';},600);

  const sections=['landing','why','peta','profil'];
  const navLinks=document.querySelectorAll('.nav-links a');
  const io=new IntersectionObserver(entries=>{
    entries.forEach(e=>{
      if(e.isIntersecting)
        navLinks.forEach(a=>a.classList.toggle('active',a.getAttribute('href')==='#'+e.target.id));
    });
  },{threshold:0.35});
  sections.forEach(id=>{const el=document.getElementById(id);if(el)io.observe(el);});

  setTimeout(()=>map.invalidateSize(),400);
});

window.addEventListener('resize',()=>map.invalidateSize());
</script>
</body>
</html>