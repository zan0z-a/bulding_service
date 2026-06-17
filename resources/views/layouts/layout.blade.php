<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<title>@yield('title', 'ServiceName — Поставки промышленного оборудования')</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
:root {
  --navy: #0d1b2a;
  --navy2: #1b2d42;
  --steel: #2563a8;
  --steel-light: #3b82f6;
  --accent: #f59e0b;
  --accent2: #fbbf24;
  --light: #f0f4f8;
  --muted: #8a9ab0;
  --white: #ffffff;
}
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: 'Manrope', sans-serif; background: var(--white); color: var(--navy); overflow-x: hidden; }
h1, h2, h3, h4, .display-font { font-family: 'Bebas Neue', sans-serif; letter-spacing: 0.04em; }

.navbar-custom {
  background: var(--navy);
  padding: 0;
  position: sticky; top: 0; z-index: 1000;
  border-bottom: 2px solid var(--accent);
}
.navbar-brand-text {
  font-family: 'Bebas Neue', sans-serif;
  font-size: 1.7rem;
  color: var(--white) !important;
  letter-spacing: 0.08em;
  line-height: 1;
}
.navbar-brand-text span { color: var(--accent); }
.topbar {
  background: var(--navy2);
  font-size: 0.8rem;
  color: var(--muted);
  padding: 6px 0;
}
.topbar a { color: var(--muted); text-decoration: none; }
.topbar a:hover { color: var(--accent); }
.topbar-phone { color: var(--accent) !important; font-weight: 600; font-size: 0.85rem; }
.nav-link-custom {
  color: rgba(255,255,255,0.82) !important;
  font-weight: 600;
  font-size: 0.88rem;
  letter-spacing: 0.05em;
  text-transform: uppercase;
  padding: 1.2rem 1rem !important;
  transition: color 0.2s;
}
.nav-link-custom:hover, .nav-link-custom.active { color: var(--accent) !important; }
.btn-nav-cta {
  background: var(--accent);
  color: var(--navy);
  font-weight: 700;
  font-size: 0.85rem;
  letter-spacing: 0.06em;
  text-transform: uppercase;
  border: none;
  padding: 0.55rem 1.4rem;
  border-radius: 2px;
  transition: background 0.2s, transform 0.15s;
}
.btn-nav-cta:hover { background: var(--accent2); transform: translateY(-1px); }
.navbar-toggler { border: none; color: var(--accent) !important; }
.navbar-toggler-icon { filter: brightness(0) saturate(100%) invert(72%) sepia(78%) saturate(600%) hue-rotate(3deg); }

.hero-section {
  position: relative;
  background: var(--navy);
  min-height: 580px;
  display: flex; align-items: center;
  overflow: hidden;
}
.hero-bg {
  position: absolute; inset: 0;
  background-image: url('https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=1400&q=80');
  background-size: cover; background-position: center;
  opacity: 0.22;
}
.hero-diagonal {
  position: absolute; right: 0; top: 0; bottom: 0;
  width: 45%;
  background: rgba(37, 99, 168, 0.18);
  clip-path: polygon(12% 0, 100% 0, 100% 100%, 0% 100%);
}
.hero-accent-line {
  position: absolute; left: 0; top: 0; bottom: 0;
  width: 4px;
  background: var(--accent);
}
.hero-content { position: relative; z-index: 2; }
.hero-eyebrow {
  display: inline-block;
  background: var(--accent);
  color: var(--navy);
  font-size: 0.75rem;
  font-weight: 700;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  padding: 4px 14px;
  margin-bottom: 1rem;
  border-radius: 2px;
}
.hero-title {
  font-size: clamp(2.8rem, 6vw, 5.2rem);
  color: var(--white);
  line-height: 0.95;
  margin-bottom: 1.2rem;
}
.hero-title .hl { color: var(--accent); }
.hero-subtitle {
  color: rgba(255,255,255,0.72);
  font-size: 1.05rem;
  line-height: 1.6;
  max-width: 520px;
  margin-bottom: 2rem;
}
.btn-hero-primary {
  background: var(--accent);
  color: var(--navy);
  font-weight: 700;
  font-size: 0.9rem;
  letter-spacing: 0.08em;
  text-transform: uppercase;
  padding: 0.8rem 2rem;
  border: none;
  border-radius: 2px;
  text-decoration: none;
  display: inline-block;
  transition: background 0.2s, transform 0.15s;
}
.btn-hero-primary:hover { background: var(--accent2); transform: translateY(-2px); color: var(--navy); }
.btn-hero-ghost {
  background: transparent;
  color: var(--white);
  font-weight: 600;
  font-size: 0.9rem;
  letter-spacing: 0.06em;
  text-transform: uppercase;
  padding: 0.78rem 1.8rem;
  border: 1.5px solid rgba(255,255,255,0.35);
  border-radius: 2px;
  text-decoration: none;
  display: inline-block;
  transition: border-color 0.2s, color 0.2s;
}
.btn-hero-ghost:hover { border-color: var(--accent); color: var(--accent); }

.stats-row {
  background: var(--accent);
  padding: 1.2rem 0;
}
.stat-item { text-align: center; }
.stat-num {
  font-family: 'Bebas Neue', sans-serif;
  font-size: 2.4rem;
  color: var(--navy);
  letter-spacing: 0.06em;
  line-height: 1;
}
.stat-label {
  font-size: 0.72rem;
  font-weight: 700;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: rgba(13,27,42,0.72);
}

.section-eyebrow {
  display: inline-block;
  font-size: 0.75rem;
  font-weight: 700;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: var(--steel);
  margin-bottom: 0.5rem;
}
.section-title {
  font-size: clamp(2rem, 4vw, 3rem);
  color: var(--navy);
  line-height: 1;
  margin-bottom: 1rem;
}
.section-lead {
  font-size: 1rem;
  color: #4a5568;
  line-height: 1.7;
  max-width: 560px;
}

.catalog-section { background: var(--light); padding: 80px 0; }
.cat-card {
  background: var(--white);
  border-radius: 4px;
  overflow: hidden;
  transition: transform 0.22s, box-shadow 0.22s;
  height: 100%;
  display: flex; flex-direction: column;
  border: 1px solid rgba(0,0,0,0.06);
}
.cat-card:hover { transform: translateY(-5px); box-shadow: 0 12px 32px rgba(13,27,42,0.13); }
.cat-card-img {
  height: 190px;
  overflow: hidden;
  position: relative;
}
.cat-card-img img {
  width: 100%; height: 100%;
  object-fit: cover;
  transition: transform 0.4s;
}
.cat-card:hover .cat-card-img img { transform: scale(1.05); }
.cat-card-tag {
  position: absolute; top: 12px; left: 12px;
  background: var(--steel);
  color: var(--white);
  font-size: 0.7rem;
  font-weight: 700;
  letter-spacing: 0.08em;
  text-transform: uppercase;
  padding: 3px 10px;
  border-radius: 2px;
}
.cat-card-body { padding: 1.2rem; flex: 1; display: flex; flex-direction: column; }
.cat-card-title {
  font-family: 'Bebas Neue', sans-serif;
  font-size: 1.35rem;
  color: var(--navy);
  letter-spacing: 0.04em;
  margin-bottom: 0.4rem;
}
.cat-card-desc { font-size: 0.85rem; color: #64748b; line-height: 1.55; flex: 1; }
.cat-card-link {
  display: inline-flex; align-items: center; gap: 6px;
  font-size: 0.82rem; font-weight: 700;
  color: var(--steel);
  letter-spacing: 0.06em;
  text-transform: uppercase;
  text-decoration: none;
  margin-top: 1rem;
  transition: color 0.2s;
}
.cat-card-link:hover { color: var(--accent); }

.why-section { padding: 80px 0; background: var(--white); }
.why-img-wrap {
  position: relative;
  border-radius: 4px;
  overflow: hidden;
}
.why-img-wrap img { width: 100%; height: 420px; object-fit: cover; display: block; }
.why-img-badge {
  position: absolute; bottom: 24px; right: -20px;
  background: var(--accent);
  color: var(--navy);
  padding: 1rem 1.4rem;
  border-radius: 4px;
  font-family: 'Bebas Neue', sans-serif;
  font-size: 2rem;
  letter-spacing: 0.06em;
  line-height: 1;
  text-align: center;
  box-shadow: 0 8px 24px rgba(0,0,0,0.18);
}
.why-img-badge small { display: block; font-family: 'Manrope', sans-serif; font-size: 0.7rem; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; }
.why-item { display: flex; align-items: flex-start; gap: 16px; margin-bottom: 1.6rem; }
.why-icon {
  width: 48px; height: 48px; min-width: 48px;
  background: var(--light);
  border-radius: 4px;
  display: flex; align-items: center; justify-content: center;
  font-size: 1.4rem;
  color: var(--steel);
  transition: background 0.2s;
}
.why-item:hover .why-icon { background: var(--accent); color: var(--navy); }
.why-item-title { font-weight: 700; font-size: 0.95rem; margin-bottom: 3px; color: var(--navy); }
.why-item-desc { font-size: 0.85rem; color: #64748b; line-height: 1.55; }

.process-section { background: var(--navy); padding: 80px 0; }
.process-section .section-title { color: var(--white); }
.process-section .section-eyebrow { color: var(--accent); }
.process-step {
  position: relative;
  padding: 1.8rem;
  background: rgba(255,255,255,0.05);
  border: 1px solid rgba(255,255,255,0.08);
  border-radius: 4px;
  height: 100%;
  transition: background 0.2s;
}
.process-step:hover { background: rgba(255,255,255,0.09); }
.step-num {
  font-family: 'Bebas Neue', sans-serif;
  font-size: 3.5rem;
  color: var(--accent);
  opacity: 0.35;
  line-height: 1;
  margin-bottom: 0.5rem;
}
.step-title { font-family: 'Bebas Neue', sans-serif; font-size: 1.4rem; color: var(--white); letter-spacing: 0.04em; margin-bottom: 0.5rem; }
.step-desc { font-size: 0.85rem; color: rgba(255,255,255,0.6); line-height: 1.6; }

.gallery-section { padding: 80px 0; background: var(--light); }
.gallery-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  grid-template-rows: 220px 220px;
  gap: 8px;
}
.g-item { overflow: hidden; border-radius: 4px; }
.g-item img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s; display: block; }
.g-item:hover img { transform: scale(1.06); }
.g-item.big {
  grid-column: 1 / 2;
  grid-row: 1 / 3;
}
@media (max-width: 768px) {
  .gallery-grid { grid-template-columns: 1fr 1fr; grid-template-rows: auto; }
  .g-item.big { grid-column: 1 / 3; grid-row: auto; height: 200px; }
  .g-item { height: 160px; }
}

.clients-section { background: var(--white); padding: 50px 0; border-top: 1px solid var(--light); border-bottom: 1px solid var(--light); }
.client-logo {
  display: flex; align-items: center; justify-content: center;
  opacity: 0.45; transition: opacity 0.2s;
  padding: 0.5rem;
}
.client-logo:hover { opacity: 0.85; }
.client-logo-text {
  font-family: 'Bebas Neue', sans-serif;
  font-size: 1.5rem;
  color: var(--navy2);
  letter-spacing: 0.1em;
  border: 2px solid currentColor;
  padding: 4px 14px;
  border-radius: 2px;
}

.cta-section {
  position: relative;
  background: var(--steel);
  padding: 70px 0;
  overflow: hidden;
}
.cta-bg {
  position: absolute; inset: 0;
  background-image: url('https://images.unsplash.com/photo-1581091012184-7e0cdfbb6797?w=1200&q=70');
  background-size: cover; background-position: center;
  opacity: 0.12;
}
.cta-section .section-title { color: var(--white); }
.cta-section p { color: rgba(255,255,255,0.8); font-size: 1.05rem; max-width: 540px; line-height: 1.65; }
.btn-cta-white {
  background: var(--white);
  color: var(--navy);
  font-weight: 700; font-size: 0.88rem;
  letter-spacing: 0.08em; text-transform: uppercase;
  padding: 0.85rem 2rem; border: none; border-radius: 2px;
  text-decoration: none; display: inline-block;
  transition: background 0.2s, transform 0.15s;
}
.btn-cta-white:hover { background: var(--accent); color: var(--navy); transform: translateY(-2px); }
.btn-cta-outline {
  background: transparent;
  color: var(--white);
  font-weight: 600; font-size: 0.88rem;
  letter-spacing: 0.06em; text-transform: uppercase;
  padding: 0.83rem 1.8rem;
  border: 1.5px solid rgba(255,255,255,0.45);
  border-radius: 2px;
  text-decoration: none; display: inline-block;
  transition: border-color 0.2s, color 0.2s;
}
.btn-cta-outline:hover { border-color: var(--accent); color: var(--accent); }

.contact-section { background: var(--white); padding: 80px 0; }
.form-card {
  background: var(--light);
  border-radius: 4px;
  padding: 2.5rem 2rem;
}
.form-label-custom { font-size: 0.8rem; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; color: var(--navy2); margin-bottom: 6px; }
.form-control-custom {
  background: var(--white);
  border: 1px solid rgba(0,0,0,0.1);
  border-radius: 2px;
  padding: 0.7rem 1rem;
  font-size: 0.9rem;
  font-family: 'Manrope', sans-serif;
  color: var(--navy);
  width: 100%;
  transition: border-color 0.2s;
  outline: none;
}
.form-control-custom:focus { border-color: var(--steel); }
textarea.form-control-custom { resize: vertical; min-height: 110px; }
.btn-submit {
  background: var(--navy);
  color: var(--white);
  font-weight: 700; font-size: 0.88rem;
  letter-spacing: 0.08em; text-transform: uppercase;
  padding: 0.85rem 2.4rem; border: none; border-radius: 2px;
  cursor: pointer; width: 100%;
  transition: background 0.2s, transform 0.15s;
}
.btn-submit:hover { background: var(--steel); transform: translateY(-1px); }
.contact-info-item { display: flex; align-items: flex-start; gap: 14px; margin-bottom: 1.6rem; }
.contact-icon {
  width: 44px; height: 44px; min-width: 44px;
  background: var(--navy);
  border-radius: 4px;
  display: flex; align-items: center; justify-content: center;
  color: var(--accent);
  font-size: 1.2rem;
}
.contact-info-label { font-size: 0.75rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--muted); margin-bottom: 2px; }
.contact-info-value { font-size: 0.95rem; font-weight: 600; color: var(--navy); }
.contact-info-value a { color: var(--navy); text-decoration: none; }
.contact-info-value a:hover { color: var(--steel); }
.map-placeholder {
  background: var(--light);
  border-radius: 4px;
  border: 1px solid rgba(0,0,0,0.07);
  overflow: hidden;
  line-height: 0;
}

footer {
  background: var(--navy);
  color: rgba(255,255,255,0.6);
  padding: 50px 0 24px;
  border-top: 2px solid var(--accent);
}
.footer-brand { font-family: 'Bebas Neue', sans-serif; font-size: 2rem; color: var(--white); letter-spacing: 0.08em; margin-bottom: 0.8rem; }
.footer-brand span { color: var(--accent); }
.footer-desc { font-size: 0.85rem; line-height: 1.65; max-width: 300px; color: rgba(255,255,255,0.5); }
.footer-heading { font-size: 0.72rem; font-weight: 700; letter-spacing: 0.14em; text-transform: uppercase; color: var(--accent); margin-bottom: 1rem; }
footer a { color: rgba(255,255,255,0.6); text-decoration: none; font-size: 0.88rem; transition: color 0.2s; }
footer a:hover { color: var(--accent); }
footer ul { list-style: none; padding: 0; }
footer ul li { margin-bottom: 0.5rem; }
.footer-social { color: rgba(255,255,255,0.6); font-size: 1.4rem; display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 4px; transition: color 0.2s, background 0.2s; }
.footer-social:hover { color: var(--accent); background: rgba(255,255,255,0.07); }
.footer-bottom { border-top: 1px solid rgba(255,255,255,0.08); padding-top: 1.2rem; margin-top: 2.5rem; font-size: 0.8rem; color: rgba(255,255,255,0.35); }

.divider-accent { width: 48px; height: 3px; background: var(--accent); margin: 1rem 0 1.6rem; border-radius: 2px; }
.success-toast { display: none; background: #16a34a; color: white; padding: 12px 20px; border-radius: 4px; font-size: 0.9rem; font-weight: 600; margin-top: 12px; }

/* ─── BREAKPOINT: TABLET ≤991px ───────────────────────────────── */
@media (max-width: 991px) {
  .why-img-badge { right: 10px; }
  .hero-section { min-height: 460px; }
  .catalog-section,
  .why-section,
  .gallery-section,
  .contact-section,
  .process-section { padding: 60px 0; }
  .cta-section { padding: 50px 0; }
  .navbar-collapse.show,
  .navbar-collapse.collapsing {
    padding: 0.3rem 0 0.8rem;
    border-top: 1px solid rgba(255,255,255,0.09);
    margin-top: 3px;
  }
  .navbar-collapse .nav-link-custom {
    padding: 0.65rem 0.5rem !important;
    border-bottom: 1px solid rgba(255,255,255,0.07);
  }
  .navbar-collapse .nav-item:last-child .nav-link-custom { border-bottom: none; }
  .navbar-collapse .ms-lg-3 { margin-left: 0 !important; }
  .navbar-collapse .btn-nav-cta {
    display: block;
    width: 100%;
    text-align: center;
    margin: 0.7rem 0 0.2rem;
    padding: 0.7rem 1rem;
  }
}

/* ─── BREAKPOINT: MOBILE ≤767px ────────────────────────────────── */
@media (max-width: 767px) {
  .why-img-wrap img { height: 280px; }
  .why-img-badge { bottom: 16px; right: 16px; font-size: 1.5rem; }
  .stats-row .col-6.col-md-3 { border-bottom: 1px solid rgba(13,27,42,0.12); }
  .catalog-section,
  .why-section,
  .gallery-section,
  .contact-section,
  .process-section { padding: 44px 0; }
  .cta-section { padding: 40px 0; }
  .clients-section { padding: 30px 0; }
  .hero-section { min-height: 0 !important; }
  .hero-content.py-5 { padding-top: 44px !important; padding-bottom: 44px !important; }
  .hero-diagonal { display: none; }
  .hero-subtitle { font-size: 0.93rem; max-width: 100%; }
  .catalog-section .row.mb-5,
  .process-section .row.mb-5,
  .gallery-section .row.mb-4,
  .contact-section .row.mb-5 { margin-bottom: 1.8rem !important; }
  .process-step { padding: 1.2rem 1rem; }
  .step-num { font-size: 3rem; }
  .cta-section .col-lg-5 .d-flex { flex-direction: column !important; }
  .btn-cta-white,
  .btn-cta-outline { display: block; width: 100%; text-align: center; }
  .form-card { padding: 1.4rem 1.1rem; }
  .map-placeholder iframe { display: block; width: 100% !important; height: 220px; }
  footer .row.g-5 { row-gap: 2rem !important; }
  .footer-desc { max-width: 100%; }
}

/* ─── BREAKPOINT: МАЛЕНЬКИЙ ТЕЛЕФОН ≤575px ─────────────────────── */
@media (max-width: 575px) {
  .hero-title { font-size: clamp(2rem, 11vw, 2.8rem) !important; }
  .hero-content .d-flex.gap-3 { flex-direction: column !important; }
  .btn-hero-primary,
  .btn-hero-ghost {
    width: 100%;
    text-align: center !important;
    display: block;
  }
  .stats-row .col-6:nth-child(3),
  .stats-row .col-6:nth-child(4) { border-bottom: none !important; }
  .gallery-grid {
    grid-template-columns: 1fr !important;
    grid-template-rows: auto !important;
  }
  .g-item.big {
    grid-column: 1 / 2 !important;
    grid-row: auto !important;
    height: 220px !important;
  }
  .g-item { height: 160px !important; }
  .cta-section .section-title { font-size: clamp(1.6rem, 8vw, 2.2rem); }
  .client-logo-text { font-size: 1.1rem; padding: 3px 10px; }
  .footer-bottom { flex-direction: column !important; gap: 4px !important; }
}

/* ─── BREAKPOINT: СОВСЕМ МАЛЕНЬКИЙ ТЕЛЕФОН ≤400px ──────────────── */
@media (max-width: 400px) {
  .hero-title { font-size: 1.95rem !important; }
  .stat-num { font-size: 1.7rem; }
  .form-card { padding: 1rem 0.75rem; }
  .navbar-brand-text { font-size: 1.42rem; }
  .btn-hero-primary,
  .btn-hero-ghost { font-size: 0.82rem; padding: 0.7rem; }
}
</style>
@stack('styles')
</head>
<body>

@include('partials.header')

@yield('content')

@include('partials.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();

            var form = this;
            var submitBtn = document.getElementById('submitBtn');
            var successToast = document.getElementById('successToast');
            var errorToast = document.getElementById('errorToast');
            var errorMessage = document.getElementById('errorMessage');

            successToast.style.display = 'none';
            errorToast.style.display = 'none';

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Отправка...';

            var formData = new FormData(form);

            fetch('/contact/send', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            })
            .then(function(response) { return response.json(); })
            .then(function(data) {
                if (data.success) {
                    successToast.style.display = 'block';
                    form.reset();
                } else {
                    errorMessage.textContent = data.message || 'Ошибка отправки. Позвоните нам: 8 800 999-99-99';
                    errorToast.style.display = 'block';
                }
            })
            .catch(function(error) {
                errorMessage.textContent = 'Ошибка отправки. Позвоните нам: 8 800 999-99-99';
                errorToast.style.display = 'block';
            })
            .finally(function() {
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Отправить заявку <i class="bi bi-send ms-2"></i>';

                setTimeout(function() {
                    successToast.style.display = 'none';
                    errorToast.style.display = 'none';
                }, 6000);
            });
        });
    }
});
</script>

@stack('scripts')
</body>
</html>
