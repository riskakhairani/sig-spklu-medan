<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Admin Dashboard — GIS SPKLU Kota Medan</title>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<style>
:root{
  --amber:#FBBF24;--orange:#F97316;--red:#EF4444;--green:#10B981;--blue:#3B82F6;--purple:#8B5CF6;
  --slate-900:#0D1117;--slate-850:#111827;--slate-800:#1A2332;--slate-700:#243447;
  --text-primary:#F0F6FC;--text-muted:#8B949E;--text-dim:#4A5568;
  --border:#1E2D3D;--border-glow:rgba(251,191,36,0.15);
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{font-size:16px;height:100%}
body{font-family:'Poppins',sans-serif;background:var(--slate-900);color:var(--text-primary);min-height:100%;display:flex;flex-direction:column}
::-webkit-scrollbar{width:5px;height:5px}
::-webkit-scrollbar-track{background:var(--slate-850)}
::-webkit-scrollbar-thumb{background:var(--amber);border-radius:99px}
.grad-text{background:linear-gradient(120deg,var(--amber),var(--orange));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}

/* ── BACK BUTTON ── */
.btn-back-home{
  position:fixed;top:20px;left:20px;z-index:10000;
  display:flex;align-items:center;gap:8px;
  padding:9px 16px 9px 12px;
  border-radius:12px;
  background:rgba(26,35,50,0.85);
  border:1px solid rgba(251,191,36,0.22);
  color:var(--text-muted);
  font-family:'Poppins',sans-serif;
  font-size:12px;font-weight:600;
  cursor:pointer;text-decoration:none;
  backdrop-filter:blur(14px);
  transition:all .25s cubic-bezier(.34,1.56,.64,1);
  box-shadow:0 4px 20px rgba(0,0,0,0.35);
}
.btn-back-home:hover{
  background:rgba(251,191,36,0.1);
  border-color:rgba(251,191,36,0.55);
  color:var(--amber);
  transform:translateX(-3px);
  box-shadow:0 4px 24px rgba(251,191,36,0.18);
}
.btn-back-home .back-icon{
  width:26px;height:26px;border-radius:7px;
  background:linear-gradient(135deg,rgba(251,191,36,0.18),rgba(249,115,22,0.18));
  border:1px solid rgba(251,191,36,0.28);
  display:flex;align-items:center;justify-content:center;
  transition:all .25s;flex-shrink:0;
}
.btn-back-home:hover .back-icon{
  background:linear-gradient(135deg,rgba(251,191,36,0.3),rgba(249,115,22,0.3));
}
.btn-back-home .back-label{line-height:1}
.btn-back-home .back-sub{font-size:9.5px;color:var(--text-dim);font-weight:400;margin-top:1px;display:block}

/* LOGIN */
#login-page{position:fixed;inset:0;z-index:9999;background:var(--slate-900);display:flex;align-items:center;justify-content:center;padding:20px}
#login-page.hidden{display:none}
.login-wrap{width:100%;max-width:420px;animation:fadeInUp .5s ease both}
@keyframes fadeInUp{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}
.login-card{background:var(--slate-800);border:1px solid rgba(251,191,36,0.2);border-radius:24px;padding:40px;box-shadow:0 32px 80px rgba(0,0,0,0.6);position:relative;overflow:hidden}
.login-card::before{content:'';position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,var(--amber),var(--orange),#EF4444)}
.login-logo{width:56px;height:56px;border-radius:16px;background:linear-gradient(135deg,var(--amber),var(--orange));display:flex;align-items:center;justify-content:center;margin-bottom:24px;box-shadow:0 0 24px rgba(251,191,36,0.4)}
.login-title{font-size:24px;font-weight:800;margin-bottom:4px}
.login-sub{font-size:13px;color:var(--text-muted);margin-bottom:32px}
.field{margin-bottom:18px}
.field label{display:block;font-size:11px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:.06em;margin-bottom:7px}
.field input{width:100%;background:rgba(13,17,23,0.7);border:1px solid rgba(251,191,36,0.18);border-radius:10px;padding:12px 16px;color:var(--text-primary);font-family:'Poppins',sans-serif;font-size:13.5px;outline:none;transition:all .2s}
.field input:focus{border-color:rgba(251,191,36,0.55);box-shadow:0 0 0 3px rgba(251,191,36,0.1)}
.field input::placeholder{color:var(--text-dim)}
.btn-login{width:100%;padding:13px;border-radius:12px;background:linear-gradient(135deg,var(--amber),var(--orange));color:#0D1117;font-size:14px;font-weight:700;border:none;cursor:pointer;font-family:'Poppins',sans-serif;transition:all .25s;box-shadow:0 0 20px rgba(251,191,36,0.3);margin-top:8px}
.btn-login:hover{filter:brightness(1.08);transform:translateY(-2px)}
.login-error{margin-top:14px;padding:10px 14px;background:rgba(239,68,68,0.12);border:1px solid rgba(239,68,68,0.3);border-radius:8px;font-size:12px;color:#F87171;display:none}
.login-hint{margin-top:16px;font-size:11.5px;color:var(--text-dim);text-align:center;line-height:1.6}
.login-hint strong{color:var(--text-muted)}

/* divider in login card */
.login-divider{display:flex;align-items:center;gap:12px;margin:20px 0 0}
.login-divider-line{flex:1;height:1px;background:rgba(255,255,255,0.06)}
.login-divider-text{font-size:10px;color:var(--text-dim);white-space:nowrap}

/* back to map button inside login card */
.btn-back-map{
  display:flex;align-items:center;justify-content:center;gap:8px;
  width:100%;padding:11px;margin-top:0;
  border-radius:11px;
  background:rgba(255,255,255,0.04);
  border:1px solid var(--border);
  color:var(--text-muted);
  font-family:'Poppins',sans-serif;
  font-size:12.5px;font-weight:600;
  cursor:pointer;text-decoration:none;
  transition:all .25s;
}
.btn-back-map:hover{
  background:rgba(59,130,246,0.08);
  border-color:rgba(59,130,246,0.3);
  color:#60A5FA;
  transform:translateY(-1px);
}
.btn-back-map svg{transition:transform .25s}
.btn-back-map:hover svg{transform:translateX(-3px)}

/* DASHBOARD */
#dashboard{display:none;flex:1;flex-direction:column}
#dashboard.show{display:flex}
.topbar{height:64px;background:rgba(13,17,23,0.95);backdrop-filter:blur(20px);border-bottom:1px solid var(--border-glow);display:flex;align-items:center;padding:0 28px;gap:16px;position:sticky;top:0;z-index:100;flex-shrink:0}
.topbar-logo{display:flex;align-items:center;gap:10px}
.topbar-logo-icon{width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,var(--amber),var(--orange));display:flex;align-items:center;justify-content:center;box-shadow:0 0 16px rgba(251,191,36,0.4)}
.topbar-title{font-size:14px;font-weight:700;line-height:1.2}
.topbar-sub{font-size:10px;color:var(--text-muted)}
.topbar-badge{padding:4px 12px;border-radius:99px;font-size:10px;font-weight:700;background:rgba(16,185,129,0.12);color:#34D399;border:1px solid rgba(16,185,129,0.3);font-family:'Space Mono',monospace}
/* back to map in topbar */
.btn-topbar-map{
  display:flex;align-items:center;gap:6px;
  padding:7px 14px;border-radius:9px;
  background:rgba(59,130,246,0.07);
  border:1px solid rgba(59,130,246,0.2);
  color:#60A5FA;font-size:12px;font-weight:500;
  cursor:pointer;text-decoration:none;
  transition:all .2s;font-family:'Poppins',sans-serif;
  white-space:nowrap;
}
.btn-topbar-map:hover{background:rgba(59,130,246,0.15);border-color:rgba(59,130,246,0.4)}
.btn-topbar-map svg{transition:transform .2s}
.btn-topbar-map:hover svg{transform:translateX(-2px)}
.topbar-user{display:flex;align-items:center;gap:10px;padding:6px 14px 6px 10px;border-radius:10px;background:rgba(255,255,255,0.04);border:1px solid var(--border);font-size:12px;color:var(--text-muted)}
.user-avatar{width:28px;height:28px;border-radius:8px;background:linear-gradient(135deg,var(--amber),var(--orange));display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:800;color:#0D1117}
.btn-logout-top{display:flex;align-items:center;gap:6px;padding:7px 14px;border-radius:9px;background:rgba(239,68,68,0.07);border:1px solid rgba(239,68,68,0.18);color:#F87171;font-size:12px;font-weight:500;cursor:pointer;transition:all .2s;font-family:'Poppins',sans-serif}
.btn-logout-top:hover{background:rgba(239,68,68,0.15)}
.ml-auto{margin-left:auto}
.main-content{flex:1;padding:28px;max-width:1440px;width:100%;margin:0 auto;display:flex;flex-direction:column;gap:20px}
.rls-banner{background:rgba(234,179,8,0.06);border:1px solid rgba(234,179,8,0.25);border-radius:12px;padding:16px 20px;display:none;line-height:1.8}
.rls-banner.show{display:block}
.rls-banner h3{font-size:13px;font-weight:700;color:#FDE047;margin-bottom:8px;display:flex;align-items:center;gap:8px}
.rls-banner p{font-size:11.5px;color:#D4B43A;margin-bottom:8px}
.rls-banner code{display:block;background:rgba(0,0,0,0.4);border:1px solid rgba(234,179,8,0.2);border-radius:6px;padding:8px 12px;font-family:'Space Mono',monospace;font-size:10.5px;color:#FDE047;margin-bottom:4px;word-break:break-all}
.stats-row{display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:14px}
.stat-box{background:var(--slate-800);border:1px solid var(--border);border-radius:14px;padding:18px 20px;position:relative;overflow:hidden;transition:all .3s}
.stat-box::before{content:'';position:absolute;top:0;left:0;right:0;height:2px}
.stat-box.amber::before{background:linear-gradient(90deg,var(--amber),var(--orange))}
.stat-box.green::before{background:linear-gradient(90deg,var(--green),#059669)}
.stat-box.blue::before{background:linear-gradient(90deg,var(--blue),#6366F1)}
.stat-box.orange::before{background:linear-gradient(90deg,var(--orange),var(--red))}
.stat-box.purple::before{background:linear-gradient(90deg,var(--purple),#EC4899)}
.stat-box:hover{transform:translateY(-3px);box-shadow:0 8px 30px rgba(0,0,0,0.3)}
.stat-box-num{font-size:30px;font-weight:900;font-family:'Space Mono',monospace;line-height:1}
.stat-box-label{font-size:11px;color:var(--text-muted);margin-top:4px;text-transform:uppercase;letter-spacing:.05em;font-weight:500}
.table-card{background:var(--slate-800);border:1px solid var(--border);border-radius:18px;overflow:hidden}
.table-header{padding:20px 24px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px}
.table-title{font-size:15px;font-weight:700;display:flex;align-items:center;gap:8px}
.table-actions{display:flex;align-items:center;gap:10px;flex-wrap:wrap}
.search-input{background:rgba(13,17,23,0.6);border:1px solid rgba(251,191,36,0.15);border-radius:9px;padding:8px 14px 8px 34px;color:var(--text-primary);font-family:'Poppins',sans-serif;font-size:12.5px;outline:none;transition:all .2s;width:220px}
.search-input::placeholder{color:var(--text-dim)}
.search-input:focus{border-color:rgba(251,191,36,0.45);box-shadow:0 0 0 3px rgba(251,191,36,0.08)}
.filter-select{background:rgba(13,17,23,0.6);border:1px solid rgba(251,191,36,0.15);border-radius:9px;padding:8px 14px;color:var(--text-primary);font-family:'Poppins',sans-serif;font-size:12.5px;outline:none;appearance:none;cursor:pointer}
.filter-select option{background:var(--slate-800)}
.btn-add{display:flex;align-items:center;gap:7px;padding:9px 18px;border-radius:10px;background:linear-gradient(135deg,var(--amber),var(--orange));color:#0D1117;font-size:12.5px;font-weight:700;border:none;cursor:pointer;font-family:'Poppins',sans-serif;transition:all .2s;white-space:nowrap;box-shadow:0 0 16px rgba(251,191,36,0.25)}
.btn-add:hover{filter:brightness(1.08);transform:translateY(-1px)}
.table-wrap{overflow-x:auto}
table{width:100%;border-collapse:collapse}
thead tr{background:rgba(13,17,23,0.5)}
thead th{padding:12px 16px;text-align:left;font-size:10.5px;font-weight:600;color:var(--text-dim);text-transform:uppercase;letter-spacing:.07em;border-bottom:1px solid var(--border);white-space:nowrap}
thead th.sort{cursor:pointer;user-select:none;transition:color .2s}
thead th.sort:hover{color:var(--amber)}
thead th.sorted{color:var(--amber)}
tbody tr{border-bottom:1px solid rgba(255,255,255,0.04);transition:background .15s}
tbody tr:hover{background:rgba(251,191,36,0.03)}
tbody tr:last-child{border-bottom:none}
td{padding:14px 16px;font-size:12.5px;vertical-align:middle}
td.id-cell{font-family:'Space Mono',monospace;font-size:11px;color:var(--text-dim)}
td.name-cell{font-weight:600}
td.name-cell .name-text{white-space:nowrap;overflow:hidden;text-overflow:ellipsis;display:block;max-width:200px}
td.name-cell .addr-text{font-size:10.5px;color:var(--text-muted);margin-top:2px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:200px}
td.coord-cell{font-family:'Space Mono',monospace;font-size:10px;color:var(--text-dim);white-space:nowrap}
.badge{display:inline-flex;align-items:center;gap:4px;padding:3px 9px;border-radius:99px;font-size:10px;font-weight:600;white-space:nowrap}
.badge-pln{background:rgba(251,191,36,0.12);color:var(--amber);border:1px solid rgba(251,191,36,0.28)}
.badge-com{background:rgba(249,115,22,0.12);color:#FB923C;border:1px solid rgba(249,115,22,0.28)}
.badge-kw{background:rgba(16,185,129,0.1);color:#34D399;border:1px solid rgba(16,185,129,0.22)}
.badge-port{background:rgba(99,102,241,0.1);color:#818CF8;border:1px solid rgba(99,102,241,0.22)}
.action-btns{display:flex;gap:6px;align-items:center}
.btn-edit{padding:6px 12px;border-radius:7px;background:rgba(59,130,246,0.1);border:1px solid rgba(59,130,246,0.22);color:#60A5FA;font-size:11px;font-weight:600;cursor:pointer;transition:all .2s;font-family:'Poppins',sans-serif;display:flex;align-items:center;gap:4px}
.btn-edit:hover{background:rgba(59,130,246,0.2)}
.btn-delete{padding:6px 12px;border-radius:7px;background:rgba(239,68,68,0.08);border:1px solid rgba(239,68,68,0.22);color:#F87171;font-size:11px;font-weight:600;cursor:pointer;transition:all .2s;font-family:'Poppins',sans-serif;display:flex;align-items:center;gap:4px}
.btn-delete:hover{background:rgba(239,68,68,0.2)}
.table-footer{padding:14px 24px;border-top:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;font-size:12px;color:var(--text-dim)}
.empty-state{text-align:center;padding:60px 24px;color:var(--text-dim)}
.empty-state p{font-size:13px;margin-top:12px}
.sort-arrow{display:inline-block;margin-left:4px;opacity:.4;font-size:10px}
.sorted .sort-arrow{opacity:1}
#modal-overlay{position:fixed;inset:0;z-index:9990;background:rgba(0,0,0,0.72);backdrop-filter:blur(10px);display:none;align-items:center;justify-content:center;padding:20px}
#modal-overlay.show{display:flex}
.modal-box{background:var(--slate-800);border:1px solid var(--border-glow);border-radius:22px;width:100%;max-width:580px;max-height:92vh;overflow-y:auto;box-shadow:0 32px 80px rgba(0,0,0,0.6);position:relative}
.modal-box::before{content:'';position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,var(--amber),var(--orange),#EF4444);border-radius:22px 22px 0 0}
.modal-box::-webkit-scrollbar{width:3px}
.modal-box::-webkit-scrollbar-thumb{background:rgba(251,191,36,0.3);border-radius:99px}
.modal-head{padding:28px 28px 0;display:flex;align-items:center;justify-content:space-between}
.modal-head-title{font-size:17px;font-weight:800}
.modal-close{width:32px;height:32px;border-radius:9px;background:rgba(255,255,255,0.06);border:1px solid var(--border);color:var(--text-muted);cursor:pointer;font-size:16px;display:flex;align-items:center;justify-content:center;transition:all .2s}
.modal-close:hover{background:rgba(239,68,68,0.15);color:#F87171}
.modal-body{padding:24px 28px 28px}
.mfield{margin-bottom:18px}
.mfield label{display:block;font-size:11px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:.06em;margin-bottom:7px}
.mfield input,.mfield select{width:100%;background:rgba(13,17,23,0.7);border:1px solid rgba(251,191,36,0.18);border-radius:10px;padding:11px 14px;color:var(--text-primary);font-family:'Poppins',sans-serif;font-size:13px;outline:none;transition:all .2s}
.mfield input:focus,.mfield select:focus{border-color:rgba(251,191,36,0.5);box-shadow:0 0 0 3px rgba(251,191,36,0.08)}
.mfield input::placeholder{color:var(--text-dim)}
.mfield select{appearance:none;cursor:pointer}
.mfield select option{background:var(--slate-800)}
.mgrid{display:grid;grid-template-columns:1fr 1fr;gap:14px}
@media(max-width:500px){.mgrid{grid-template-columns:1fr}}
.modal-error{padding:10px 14px;border-radius:9px;background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.25);color:#F87171;font-size:12px;margin-bottom:14px;display:none;line-height:1.5}
.modal-actions{display:flex;gap:10px;margin-top:24px}
.btn-save{flex:1;padding:12px;border-radius:11px;background:linear-gradient(135deg,var(--amber),var(--orange));color:#0D1117;font-size:13.5px;font-weight:700;border:none;cursor:pointer;font-family:'Poppins',sans-serif;transition:all .2s;box-shadow:0 0 16px rgba(251,191,36,0.25)}
.btn-save:hover{filter:brightness(1.07);transform:translateY(-1px)}
.btn-save:disabled{opacity:.5;cursor:not-allowed;transform:none}
.btn-cancel{padding:12px 22px;border-radius:11px;background:rgba(255,255,255,0.05);border:1px solid var(--border);color:var(--text-muted);font-size:13px;font-weight:600;cursor:pointer;font-family:'Poppins',sans-serif;transition:all .2s}
.btn-cancel:hover{background:rgba(255,255,255,0.09);color:var(--text-primary)}
#map-picker{width:100%;height:220px;border-radius:10px;border:1px solid rgba(251,191,36,0.18);overflow:hidden;margin-top:8px}
.map-picker-hint{font-size:10.5px;color:var(--text-dim);margin-top:6px;display:flex;align-items:center;gap:5px}
#confirm-overlay{position:fixed;inset:0;z-index:9995;background:rgba(0,0,0,0.78);backdrop-filter:blur(10px);display:none;align-items:center;justify-content:center;padding:20px}
#confirm-overlay.show{display:flex}
.confirm-box{background:var(--slate-800);border:1px solid rgba(239,68,68,0.3);border-radius:18px;padding:28px;max-width:360px;width:100%;box-shadow:0 24px 60px rgba(0,0,0,0.6)}
.confirm-title{font-size:15px;font-weight:700;color:#F87171;margin-bottom:8px;display:flex;align-items:center;gap:8px}
.confirm-msg{font-size:13px;color:var(--text-muted);line-height:1.65;margin-bottom:22px;white-space:pre-line}
.confirm-actions{display:flex;gap:10px}
.btn-confirm-yes{flex:1;padding:11px;border-radius:9px;background:rgba(239,68,68,0.18);border:1px solid rgba(239,68,68,0.35);color:#F87171;font-size:13px;font-weight:600;cursor:pointer;font-family:'Poppins',sans-serif;transition:all .2s}
.btn-confirm-yes:hover{background:rgba(239,68,68,0.3)}
.btn-confirm-no{flex:1;padding:11px;border-radius:9px;background:rgba(255,255,255,0.05);border:1px solid var(--border);color:var(--text-muted);font-size:13px;font-weight:600;cursor:pointer;font-family:'Poppins',sans-serif;transition:all .2s}
.btn-confirm-no:hover{background:rgba(255,255,255,0.09);color:var(--text-primary)}
#toast-container{position:fixed;bottom:24px;right:24px;z-index:99999;display:flex;flex-direction:column;gap:8px}
.toast{padding:12px 18px;border-radius:12px;font-size:12.5px;font-weight:500;display:flex;align-items:center;gap:8px;animation:toastIn .3s ease;max-width:380px;box-shadow:0 8px 30px rgba(0,0,0,0.4)}
@keyframes toastIn{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
.toast-success{background:rgba(16,185,129,0.15);border:1px solid rgba(16,185,129,0.3);color:#34D399}
.toast-error{background:rgba(239,68,68,0.15);border:1px solid rgba(239,68,68,0.3);color:#F87171}
.toast-info{background:rgba(251,191,36,0.12);border:1px solid rgba(251,191,36,0.25);color:var(--amber)}
.loading-row td{text-align:center;padding:48px;color:var(--text-dim);font-size:12px}
.spin{display:inline-block;width:20px;height:20px;border:2px solid rgba(251,191,36,0.15);border-top-color:var(--amber);border-radius:50%;animation:spin .7s linear infinite;vertical-align:middle;margin-right:8px}
@keyframes spin{to{transform:rotate(360deg)}}
@media(max-width:768px){
  .topbar{padding:0 16px}
  .main-content{padding:16px}
  .stats-row{grid-template-columns:1fr 1fr}
  .table-header{flex-direction:column;align-items:flex-start}
  .table-actions{width:100%}
  .search-input{width:100%}
  .btn-back-home{top:12px;left:12px;padding:7px 12px 7px 10px;font-size:11px}
  .btn-topbar-map span.map-label{display:none}
}
</style>
</head>
<body>

<div id="toast-container"></div>

<!-- FLOATING BACK BUTTON (visible on login page) -->
<a href="index.php" class="btn-back-home" id="btn-back-floating" title="Kembali ke Peta">
  <div class="back-icon">
    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
      <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
      <polyline points="9 22 9 12 15 12 15 22"/>
    </svg>
  </div>
  <div>
    <div class="back-label">Peta SPKLU</div>
    <span class="back-sub">index.php</span>
  </div>
</a>

<!-- LOGIN -->
<div id="login-page">
  <div class="login-wrap">
    <div class="login-card">
      <div class="login-logo">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#0D1117" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
      </div>
      <h1 class="login-title">Admin <span class="grad-text">Dashboard</span></h1>
      <p class="login-sub">GIS SPKLU Kota Medan — Panel Manajemen</p>
      <div class="field">
        <label>Email Admin</label>
        <input type="email" id="l-email" placeholder="admin@gmail.com"/>
      </div>
      <div class="field">
        <label>Password</label>
        <input type="password" id="l-pass" placeholder="••••••••" onkeydown="if(event.key==='Enter')doLogin()"/>
      </div>
      <button class="btn-login" onclick="doLogin()">Masuk ke Dashboard</button>
      <div class="login-error" id="login-error"></div>

      <!-- divider + back to map inside card -->
      <div class="login-divider">
        <div class="login-divider-line"></div>
        <span class="login-divider-text">atau</span>
        <div class="login-divider-line"></div>
      </div>
      <a href="index.php" class="btn-back-map" style="margin-top:12px">
        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
        Kembali ke Halaman Peta
      </a>

      <p class="login-hint" style="margin-top:14px">Default: <strong>admin@gmail.com</strong> / <strong>admin123</strong></p>
    </div>
  </div>
</div>

<!-- DASHBOARD -->
<div id="dashboard">
  <div class="topbar">
    <div class="topbar-logo">
      <div class="topbar-logo-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#0D1117" stroke-width="2.8"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
      </div>
      <div>
        <div class="topbar-title">GIS SPKLU — Admin</div>
        <div class="topbar-sub">Kota Medan · 2026</div>
      </div>
    </div>
    <span class="topbar-badge">● LIVE</span>

    <!-- Back to map in topbar -->
    <a href="index.php" class="btn-topbar-map">
      <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
      <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
      <span class="map-label">Lihat Peta</span>
    </a>

    <div class="ml-auto" style="display:flex;align-items:center;gap:10px;flex-wrap:wrap">
      <div class="topbar-user">
        <div class="user-avatar" id="user-avatar-text">AD</div>
        <span id="user-email-display">—</span>
      </div>
      <button class="btn-logout-top" onclick="doLogout()">
        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
        Logout
      </button>
    </div>
  </div>

  <div class="main-content">
    <!-- BANNER RLS -->
    <div class="rls-banner" id="rls-banner">
      <h3>⚠ Perlu fix RLS di Supabase agar INSERT / UPDATE / DELETE bisa bekerja</h3>
      <p>Jalankan SQL berikut di <strong>Supabase Dashboard → SQL Editor</strong> lalu refresh halaman:</p>
      <code>DROP POLICY IF EXISTS "Auth users can insert" ON spklu;</code>
      <code>DROP POLICY IF EXISTS "Auth users can update" ON spklu;</code>
      <code>DROP POLICY IF EXISTS "Auth users can delete" ON spklu;</code>
      <code>CREATE POLICY "anon insert" ON spklu FOR INSERT TO anon WITH CHECK (true);</code>
      <code>CREATE POLICY "anon update" ON spklu FOR UPDATE TO anon USING (true) WITH CHECK (true);</code>
      <code>CREATE POLICY "anon delete" ON spklu FOR DELETE TO anon USING (true);</code>
    </div>

    <!-- STATS -->
    <div class="stats-row">
      <div class="stat-box amber"><div class="stat-box-num grad-text" id="st-total">—</div><div class="stat-box-label">Total SPKLU</div></div>
      <div class="stat-box green"><div class="stat-box-num" style="color:#34D399" id="st-pln">—</div><div class="stat-box-label">PLN</div></div>
      <div class="stat-box orange"><div class="stat-box-num" style="color:#FB923C" id="st-com">—</div><div class="stat-box-label">Commercial</div></div>
      <div class="stat-box blue"><div class="stat-box-num" style="color:#60A5FA" id="st-ports">—</div><div class="stat-box-label">Total Port</div></div>
      <div class="stat-box purple"><div class="stat-box-num" style="color:#A78BFA" id="st-kw">—</div><div class="stat-box-label">Total kW</div></div>
    </div>

    <!-- TABLE -->
    <div class="table-card">
      <div class="table-header">
        <div class="table-title">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--amber)" stroke-width="2.5"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
          Data SPKLU
          <span style="font-size:11px;color:var(--text-dim);font-weight:400">(<span id="tbl-count">0</span> entri)</span>
        </div>
        <div class="table-actions">
          <div style="position:relative">
            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="var(--text-dim)" stroke-width="2.5" style="position:absolute;left:10px;top:50%;transform:translateY(-50%);pointer-events:none"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" id="tbl-search" class="search-input" placeholder="Cari nama / alamat…" oninput="applyFilter()"/>
          </div>
          <select id="tbl-provider" class="filter-select" onchange="applyFilter()">
            <option value="all">Semua Provider</option>
            <option value="PLN">PLN</option>
            <option value="Commercial">Commercial</option>
          </select>
          <button class="btn-add" onclick="openAddModal()">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah SPKLU
          </button>
        </div>
      </div>
      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th class="sort sorted" data-sort="id" onclick="sortBy('id')">ID <span class="sort-arrow">↑</span></th>
              <th class="sort" data-sort="name" onclick="sortBy('name')">Nama &amp; Alamat <span class="sort-arrow">↑</span></th>
              <th>Provider</th>
              <th class="sort" data-sort="max_kw" onclick="sortBy('max_kw')">Max kW <span class="sort-arrow">↕</span></th>
              <th>Port</th>
              <th>Konektor</th>
              <th>Koordinat</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="tbl-body">
            <tr class="loading-row"><td colspan="8"><span class="spin"></span>Memuat data…</td></tr>
          </tbody>
        </table>
      </div>
      <div class="table-footer">
        <span style="color:var(--text-muted)">Menampilkan <span style="color:var(--amber)" id="tbl-showing">0</span> dari <span style="color:var(--amber)" id="tbl-total">0</span> data</span>
        <span style="color:var(--text-dim)">Klik header kolom untuk mengurutkan</span>
      </div>
    </div>
  </div>
</div>

<!-- MODAL -->
<div id="modal-overlay" onclick="if(event.target===this)closeModal()">
  <div class="modal-box">
    <div class="modal-head">
      <div class="modal-head-title" id="modal-title">Tambah SPKLU Baru</div>
      <button class="modal-close" onclick="closeModal()">✕</button>
    </div>
    <div class="modal-body">
      <input type="hidden" id="f-id"/>
      <div class="mfield"><label>Nama Stasiun *</label><input type="text" id="f-name" placeholder="SPKLU PLN …"/></div>
      <div class="mfield"><label>Alamat Lengkap *</label><input type="text" id="f-address" placeholder="Jl. …, Medan, Sumatera Utara"/></div>
      <div class="mgrid">
        <div class="mfield"><label>Provider *</label><select id="f-provider"><option value="PLN">PLN</option><option value="Commercial">Commercial</option></select></div>
        <div class="mfield"><label>Tipe Konektor *</label><input type="text" id="f-connector" placeholder="CCS1/Type2/CHAdeMO"/></div>
      </div>
      <div class="mgrid">
        <div class="mfield"><label>Jumlah Port *</label><input type="number" id="f-ports" placeholder="1" min="1" max="20"/></div>
        <div class="mfield"><label>Max Power (kW) *</label><input type="number" id="f-maxkw" placeholder="50" min="1" max="500"/></div>
      </div>
      <div class="mfield">
        <label>Koordinat — klik peta atau isi manual *</label>
        <div id="map-picker"></div>
        <p class="map-picker-hint">
          <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
          Klik pada peta untuk memilih titik lokasi
        </p>
      </div>
      <div class="mgrid">
        <div class="mfield"><label>Latitude *</label><input type="number" id="f-lat" placeholder="3.591…" step="any" oninput="syncMapFromInput()"/></div>
        <div class="mfield"><label>Longitude *</label><input type="number" id="f-lng" placeholder="98.671…" step="any" oninput="syncMapFromInput()"/></div>
      </div>
      <div class="modal-error" id="modal-error"></div>
      <div class="modal-actions">
        <button class="btn-save" id="modal-save-btn" onclick="saveForm()"><span id="save-btn-text">Simpan Data</span></button>
        <button class="btn-cancel" onclick="closeModal()">Batal</button>
      </div>
    </div>
  </div>
</div>

<!-- CONFIRM -->
<div id="confirm-overlay">
  <div class="confirm-box">
    <div class="confirm-title">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
      Konfirmasi Hapus
    </div>
    <div class="confirm-msg" id="confirm-msg">Apakah Anda yakin ingin menghapus data ini?</div>
    <div class="confirm-actions">
      <button class="btn-confirm-yes" id="confirm-yes">Ya, Hapus</button>
      <button class="btn-confirm-no" id="confirm-no">Batal</button>
    </div>
  </div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
const SB_URL   = 'https://jufrpxkoslwnktjckaxv.supabase.co';
const SB_REST  = SB_URL + '/rest/v1';
const ANON_KEY = 'sb_publishable_Yfc4Xtw5W4movKSoGNRrbw_octrCpAt';

const ADMIN_USERS = [{ email:'admin@gmail.com', password:'admin123' }];

let DATA=[], filteredData=[];
let currentSort={col:'id',dir:'asc'};
let mapPicker=null, pickerMarker=null, editingId=null;

function hdr(extra={}) {
  return {'apikey':ANON_KEY,'Authorization':'Bearer '+ANON_KEY,'Content-Type':'application/json','Accept':'application/json',...extra};
}
function esc(s){return String(s??'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;')}
function parseErr(raw){try{const o=JSON.parse(raw);return o.message||o.error_description||o.error||o.hint||raw;}catch{return raw||'Unknown error';}}

/* TOAST */
function toast(msg,type='info',dur=4000){
  const el=document.createElement('div');
  el.className=`toast toast-${type}`;
  el.innerHTML=`<span>${{success:'✓',error:'✕',info:'⚡'}[type]||'ℹ'}</span><span>${msg}</span>`;
  document.getElementById('toast-container').appendChild(el);
  setTimeout(()=>{el.style.transition='opacity .3s,transform .3s';el.style.opacity='0';el.style.transform='translateY(6px)';setTimeout(()=>el.remove(),350);},dur);
}

/* CONFIRM */
function showConfirm(msg){
  return new Promise(resolve=>{
    document.getElementById('confirm-msg').textContent=msg;
    document.getElementById('confirm-overlay').classList.add('show');
    const done=val=>{document.getElementById('confirm-overlay').classList.remove('show');resolve(val);};
    document.getElementById('confirm-yes').onclick=()=>done(true);
    document.getElementById('confirm-no').onclick=()=>done(false);
  });
}

/* AUTH */
function doLogin(){
  const email=document.getElementById('l-email').value.trim().toLowerCase();
  const pass=document.getElementById('l-pass').value;
  const errEl=document.getElementById('login-error');
  errEl.style.display='none';
  if(!email||!pass){errEl.textContent='Email dan password wajib diisi.';errEl.style.display='block';return;}
  const match=ADMIN_USERS.find(u=>u.email===email&&u.password===pass);
  if(!match){errEl.textContent='Email atau password salah.';errEl.style.display='block';return;}
  sessionStorage.setItem('admin_ok','1');
  sessionStorage.setItem('admin_email',email);
  showDashboard(email);
  toast('Selamat datang! 👋','success');
}

function showDashboard(email){
  document.getElementById('login-page').classList.add('hidden');
  document.getElementById('btn-back-floating').style.display='none'; // hide floating btn when in dashboard
  document.getElementById('dashboard').classList.add('show');
  document.getElementById('user-email-display').textContent=email;
  document.getElementById('user-avatar-text').textContent=email.split('@')[0].substring(0,2).toUpperCase();
  loadData();
}

function doLogout(){
  sessionStorage.removeItem('admin_ok');
  sessionStorage.removeItem('admin_email');
  DATA=[];filteredData=[];
  document.getElementById('dashboard').classList.remove('show');
  document.getElementById('login-page').classList.remove('hidden');
  document.getElementById('btn-back-floating').style.display='flex'; // show back btn again
  document.getElementById('l-email').value='';
  document.getElementById('l-pass').value='';
  document.getElementById('login-error').style.display='none';
  toast('Logout berhasil.','info');
}

/* LOAD DATA */
async function loadData(){
  document.getElementById('tbl-body').innerHTML='<tr class="loading-row"><td colspan="8"><span class="spin"></span>Memuat data…</td></tr>';
  try{
    const res=await fetch(`${SB_REST}/spklu?order=id.asc`,{headers:hdr()});
    if(!res.ok){const raw=await res.text();throw new Error(parseErr(raw));}
    DATA=await res.json();
    applyFilter();updateStats();
  }catch(err){
    document.getElementById('tbl-body').innerHTML=`<tr class="loading-row"><td colspan="8">❌ Gagal memuat: ${esc(err.message)}</td></tr>`;
    toast('Gagal memuat data: '+err.message,'error',7000);
  }
}

function updateStats(){
  document.getElementById('st-total').textContent=DATA.length;
  document.getElementById('st-pln').textContent=DATA.filter(d=>d.provider==='PLN').length;
  document.getElementById('st-com').textContent=DATA.filter(d=>d.provider==='Commercial').length;
  document.getElementById('st-ports').textContent=DATA.reduce((a,d)=>a+(+d.ports||0),0);
  document.getElementById('st-kw').textContent=DATA.reduce((a,d)=>a+(+d.max_kw||0),0);
}

/* FILTER + SORT + RENDER */
function applyFilter(){
  const q=document.getElementById('tbl-search').value.trim().toLowerCase();
  const pv=document.getElementById('tbl-provider').value;
  filteredData=DATA.filter(d=>((d.name||'').toLowerCase().includes(q)||(d.address||'').toLowerCase().includes(q))&&(pv==='all'||d.provider===pv));
  filteredData.sort((a,b)=>{let va=a[currentSort.col]??'',vb=b[currentSort.col]??'';if(typeof va==='string'){va=va.toLowerCase();vb=vb.toLowerCase();}return va<vb?(currentSort.dir==='asc'?-1:1):va>vb?(currentSort.dir==='asc'?1:-1):0;});
  renderTable();
}

function sortBy(col){
  currentSort.dir=currentSort.col===col?(currentSort.dir==='asc'?'desc':'asc'):'asc';
  currentSort.col=col;
  document.querySelectorAll('thead th.sort').forEach(th=>{const arrow=th.querySelector('.sort-arrow');th.classList.toggle('sorted',th.dataset.sort===col);arrow.textContent=th.dataset.sort===col?(currentSort.dir==='asc'?'↑':'↓'):'↕';});
  applyFilter();
}

function renderTable(){
  const tbody=document.getElementById('tbl-body');
  document.getElementById('tbl-count').textContent=filteredData.length;
  document.getElementById('tbl-showing').textContent=filteredData.length;
  document.getElementById('tbl-total').textContent=DATA.length;
  if(!filteredData.length){
    tbody.innerHTML=`<tr><td colspan="8"><div class="empty-state"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="opacity:.3"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg><p>${DATA.length===0?'Belum ada data. Klik "Tambah SPKLU" untuk mulai.':'Tidak ada data yang cocok.'}</p></div></td></tr>`;
    return;
  }
  tbody.innerHTML=filteredData.map(d=>`<tr>
    <td class="id-cell">#${d.id}</td>
    <td class="name-cell"><span class="name-text" title="${esc(d.name)}">${esc(d.name)}</span><span class="addr-text" title="${esc(d.address)}">${esc(d.address)}</span></td>
    <td>${d.provider==='PLN'?'<span class="badge badge-pln">⚡ PLN</span>':'<span class="badge badge-com">🔌 Commercial</span>'}</td>
    <td><span class="badge badge-kw">${d.max_kw} kW</span></td>
    <td><span class="badge badge-port">${d.ports} port</span></td>
    <td style="font-size:11px;color:var(--text-muted)">${esc(d.connector)}</td>
    <td class="coord-cell">${(+d.lat).toFixed(5)},<br/>${(+d.lng).toFixed(5)}</td>
    <td><div class="action-btns">
      <button class="btn-edit" onclick="openEditModal(${d.id})"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>Edit</button>
      <button class="btn-delete" onclick="deleteItem(${d.id})"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>Hapus</button>
    </div></td>
  </tr>`).join('');
}

/* MAP PICKER */
function initMapPicker(){
  if(!mapPicker){
    mapPicker=L.map('map-picker',{center:[3.591,98.671],zoom:12});
    L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png',{attribution:'&copy; OSM &copy; CARTO',subdomains:'abcd',maxZoom:19}).addTo(mapPicker);
    mapPicker.on('click',e=>{document.getElementById('f-lat').value=e.latlng.lat.toFixed(7);document.getElementById('f-lng').value=e.latlng.lng.toFixed(7);setPickerMarker(e.latlng.lat,e.latlng.lng);});
  }
  setTimeout(()=>mapPicker.invalidateSize(),200);
}
function syncMapFromInput(){
  const la=+document.getElementById('f-lat').value,ln=+document.getElementById('f-lng').value;
  if(mapPicker&&!isNaN(la)&&!isNaN(ln)&&la>=-90&&la<=90&&ln>=-180&&ln<=180){setPickerMarker(la,ln);mapPicker.setView([la,ln],14);}
}
function setPickerMarker(lat,lng){
  if(pickerMarker)mapPicker.removeLayer(pickerMarker);
  pickerMarker=L.circleMarker([lat,lng],{radius:10,color:'#FBBF24',fillColor:'#F97316',fillOpacity:.85,weight:2}).addTo(mapPicker).bindPopup(`${(+lat).toFixed(5)}, ${(+lng).toFixed(5)}`).openPopup();
}

/* MODAL */
function resetForm(){
  ['f-id','f-name','f-address','f-connector','f-lat','f-lng'].forEach(id=>document.getElementById(id).value='');
  document.getElementById('f-provider').value='PLN';document.getElementById('f-ports').value='1';document.getElementById('f-maxkw').value='';document.getElementById('modal-error').style.display='none';
}
function openAddModal(){
  editingId=null;document.getElementById('modal-title').textContent='➕ Tambah SPKLU Baru';document.getElementById('save-btn-text').textContent='Simpan Data';resetForm();
  document.getElementById('modal-overlay').classList.add('show');
  setTimeout(()=>{initMapPicker();if(pickerMarker){mapPicker.removeLayer(pickerMarker);pickerMarker=null;}mapPicker.setView([3.591,98.671],12);},150);
}
function openEditModal(id){
  const d=DATA.find(x=>x.id===id);if(!d)return;
  editingId=id;document.getElementById('modal-title').textContent='✎ Edit SPKLU';document.getElementById('save-btn-text').textContent='Update Data';
  document.getElementById('f-id').value=d.id;document.getElementById('f-name').value=d.name;document.getElementById('f-address').value=d.address;
  document.getElementById('f-provider').value=d.provider;document.getElementById('f-ports').value=d.ports;document.getElementById('f-maxkw').value=d.max_kw;
  document.getElementById('f-connector').value=d.connector;document.getElementById('f-lat').value=d.lat;document.getElementById('f-lng').value=d.lng;
  document.getElementById('modal-error').style.display='none';document.getElementById('modal-overlay').classList.add('show');
  setTimeout(()=>{initMapPicker();setPickerMarker(+d.lat,+d.lng);mapPicker.setView([+d.lat,+d.lng],15);},150);
}
function closeModal(){document.getElementById('modal-overlay').classList.remove('show');}

/* SAVE */
async function saveForm(){
  const name=document.getElementById('f-name').value.trim(),address=document.getElementById('f-address').value.trim();
  const lat=parseFloat(document.getElementById('f-lat').value),lng=parseFloat(document.getElementById('f-lng').value);
  const provider=document.getElementById('f-provider').value,ports=parseInt(document.getElementById('f-ports').value);
  const max_kw=parseInt(document.getElementById('f-maxkw').value),connector=document.getElementById('f-connector').value.trim();
  const errEl=document.getElementById('modal-error');
  const setErr=msg=>{errEl.textContent=msg;errEl.style.display='block';};
  errEl.style.display='none';
  if(!name)return setErr('Nama stasiun wajib diisi.');
  if(!address)return setErr('Alamat wajib diisi.');
  if(!connector)return setErr('Tipe konektor wajib diisi.');
  if(isNaN(ports)||ports<1)return setErr('Jumlah port tidak valid (min 1).');
  if(isNaN(max_kw)||max_kw<1)return setErr('Max kW tidak valid (min 1).');
  if(isNaN(lat)||isNaN(lng)||lat<-90||lat>90||lng<-180||lng>180)return setErr('Koordinat tidak valid. Klik peta atau isi latitude/longitude.');
  const btn=document.getElementById('modal-save-btn');btn.disabled=true;document.getElementById('save-btn-text').textContent='Menyimpan…';
  const payload={name,address,lat,lng,provider,ports,max_kw,connector};
  try{
    if(editingId){
      const res=await fetch(`${SB_REST}/spklu?id=eq.${editingId}`,{method:'PATCH',headers:hdr({'Prefer':'return=representation'}),body:JSON.stringify(payload)});
      if(!res.ok){const raw=await res.text();if(res.status===403||res.status===401)showRLSBanner();throw new Error(parseErr(raw));}
      const result=await res.json();const updated=Array.isArray(result)?result[0]:result;
      const idx=DATA.findIndex(x=>x.id===editingId);if(idx>=0)DATA[idx]={...DATA[idx],...(updated||payload)};
      toast('✓ Data berhasil diperbarui!','success');
    }else{
      const res=await fetch(`${SB_REST}/spklu`,{method:'POST',headers:hdr({'Prefer':'return=representation'}),body:JSON.stringify(payload)});
      if(!res.ok){const raw=await res.text();if(res.status===403||res.status===401)showRLSBanner();throw new Error(parseErr(raw));}
      const result=await res.json();const created=Array.isArray(result)?result[0]:result;
      if(created)DATA.push(created);else await loadData();
      toast('✓ SPKLU baru berhasil ditambahkan!','success');
    }
    applyFilter();updateStats();closeModal();
  }catch(err){setErr('⚠ '+err.message);toast('Gagal menyimpan: '+err.message,'error',6000);}
  finally{btn.disabled=false;document.getElementById('save-btn-text').textContent=editingId?'Update Data':'Simpan Data';}
}

/* DELETE */
async function deleteItem(id){
  const d=DATA.find(x=>x.id===id);if(!d)return;
  if(!await showConfirm(`Hapus "${d.name}"?\nTindakan ini tidak dapat dibatalkan.`))return;
  try{
    const res=await fetch(`${SB_REST}/spklu?id=eq.${id}`,{method:'DELETE',headers:hdr()});
    if(!res.ok){const raw=await res.text();if(res.status===403||res.status===401)showRLSBanner();throw new Error(parseErr(raw));}
    DATA=DATA.filter(x=>x.id!==id);applyFilter();updateStats();toast('Data berhasil dihapus.','success');
  }catch(err){toast('Gagal menghapus: '+err.message,'error',6000);}
}

function showRLSBanner(){document.getElementById('rls-banner').classList.add('show');}

/* INIT */
window.addEventListener('load',()=>{
  if(sessionStorage.getItem('admin_ok')==='1'){
    document.getElementById('btn-back-floating').style.display='none';
    showDashboard(sessionStorage.getItem('admin_email')||'admin@gmail.com');
  }
});
</script>
</body>
</html>