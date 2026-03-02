<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dnaz Homestay</title>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style>
:root {
  --cream: #f8f4ef;
  --dark: #1a1a18;
  --gold: #c9a96e;
  --gold-light: #e8d5b0;
  --green: #2d4a3e;
  --green-light: #3d6b5a;
  --text-muted: #7a7269;
}

* { margin: 0; padding: 0; box-sizing: border-box; }

html { scroll-behavior: smooth; }

body {
  background: var(--cream);
  color: var(--dark);
  font-family: 'DM Sans', sans-serif;
  overflow-x: hidden;
}



/* NAV */
nav {
  position: fixed;
  top: 0; left: 0; right: 0;
  z-index: 100;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 24px 6%;
  transition: 0.5s;
}
nav.scrolled {
  background: rgba(248, 244, 239, 0.95);
  backdrop-filter: blur(10px);
  padding: 16px 6%;
  box-shadow: 0 1px 0 rgba(0,0,0,0.08);
}

.nav-logo {
  display: flex;
  flex-direction: column;
  line-height: 1;
}
.nav-logo span:first-child {
  font-family: 'Cormorant Garamond', serif;
  font-size: 26px;
  font-weight: 600;
  color: white;
  transition: color 0.5s;
  letter-spacing: 0.02em;
}
nav.scrolled .nav-logo span:first-child { color: var(--dark); }
.nav-logo span:last-child {
  font-size: 9px;
  letter-spacing: 0.3em;
  text-transform: uppercase;
  color: var(--gold);
  font-weight: 300;
  margin-top: 2px;
}

nav ul {
  list-style: none;
  display: flex;
  gap: 36px;
  align-items: center;
}
nav ul li a {
  text-decoration: none;
  font-size: 12px;
  letter-spacing: 0.18em;
  text-transform: uppercase;
  font-weight: 400;
  color: rgba(255,255,255,0.85);
  transition: 0.3s;
}
nav.scrolled ul li a { color: var(--text-muted); }
nav ul li a:hover { color: var(--gold); }

.nav-book {
  background: var(--gold);
  color: var(--dark) !important;
  padding: 10px 24px;
  border-radius: 2px;
  font-weight: 500 !important;
}
nav.scrolled .nav-book { color: var(--dark) !important; }
.nav-book:hover { background: #b8914a; color: white !important; }

/* HERO */
.hero {
  height: 100vh;
  position: relative;
  display: flex;
  align-items: flex-end;
  padding-bottom: 10vh;
}

.hero-bg {
  position: absolute;
  inset: 0;
  background: url('https://images.unsplash.com/photo-1566073771259-6a8506099945?w=1600') no-repeat center center/cover;
}
.hero-bg::after {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(
    to bottom,
    rgba(10,15,10,0.2) 0%,
    rgba(10,15,10,0.1) 40%,
    rgba(10,15,10,0.7) 100%
  );
}

.hero-content {
  position: relative;
  z-index: 2;
  padding: 0 6%;
  max-width: 900px;
  animation: heroFadeUp 1.2s ease both;
  animation-delay: 0.3s;
}

@keyframes heroFadeUp {
  from { opacity: 0; transform: translateY(40px); }
  to { opacity: 1; transform: translateY(0); }
}

.hero-tag {
  display: inline-block;
  font-size: 10px;
  letter-spacing: 0.35em;
  text-transform: uppercase;
  color: var(--gold);
  margin-bottom: 20px;
  border-left: 2px solid var(--gold);
  padding-left: 14px;
}

.hero h1 {
  font-family: 'Cormorant Garamond', serif;
  font-size: clamp(52px, 8vw, 100px);
  font-weight: 300;
  color: white;
  line-height: 0.95;
  letter-spacing: -0.01em;
  margin-bottom: 30px;
}
.hero h1 em {
  font-style: italic;
  color: var(--gold-light);
}

.hero-bottom {
  display: flex;
  align-items: center;
  gap: 50px;
}

.hero-sub {
  font-size: 13px;
  color: rgba(255,255,255,0.65);
  letter-spacing: 0.04em;
  line-height: 1.7;
  max-width: 280px;
}

.btn-primary {
  display: inline-flex;
  align-items: center;
  gap: 14px;
  padding: 16px 36px;
  background: var(--gold);
  color: var(--dark);
  text-decoration: none;
  font-size: 11px;
  letter-spacing: 0.2em;
  text-transform: uppercase;
  font-weight: 500;
  border-radius: 2px;
  transition: 0.4s;
  white-space: nowrap;
}
.btn-primary:hover { background: white; transform: translateX(6px); }
.btn-primary svg { width: 18px; transition: transform 0.3s; }
.btn-primary:hover svg { transform: translateX(4px); }

/* SCROLL INDICATOR */
.scroll-hint {
  position: absolute;
  bottom: 40px;
  right: 6%;
  z-index: 2;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 8px;
  color: rgba(255,255,255,0.5);
  font-size: 9px;
  letter-spacing: 0.3em;
  text-transform: uppercase;
}
.scroll-line {
  width: 1px;
  height: 50px;
  background: linear-gradient(to bottom, transparent, rgba(255,255,255,0.4));
  animation: scrollPulse 2s infinite;
}
@keyframes scrollPulse {
  0%, 100% { transform: scaleY(1); opacity: 0.5; }
  50% { transform: scaleY(1.3); opacity: 1; }
}

/* STATS BAR */
.stats {
  background: var(--green);
  display: flex;
  justify-content: center;
}
.stats-inner {
  display: flex;
  max-width: 900px;
  width: 100%;
}
.stat-item {
  flex: 1;
  padding: 36px 30px;
  text-align: center;
  border-right: 1px solid rgba(255,255,255,0.08);
  position: relative;
  overflow: hidden;
}
.stat-item:last-child { border-right: none; }
.stat-item::before {
  content: '';
  position: absolute;
  bottom: 0; left: 50%;
  transform: translateX(-50%) scaleX(0);
  width: 40px; height: 2px;
  background: var(--gold);
  transition: transform 0.4s;
}
.stat-item:hover::before { transform: translateX(-50%) scaleX(1); }
.stat-num {
  font-family: 'Cormorant Garamond', serif;
  font-size: 42px;
  font-weight: 300;
  color: var(--gold-light);
  line-height: 1;
}
.stat-label {
  font-size: 10px;
  letter-spacing: 0.2em;
  text-transform: uppercase;
  color: rgba(255,255,255,0.45);
  margin-top: 6px;
}

/* ABOUT */
.about {
  padding: 120px 6%;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 80px;
  align-items: center;
  max-width: 1200px;
  margin: 0 auto;
}

.about-img-wrap {
  position: relative;
}
.about-img {
  width: 100%;
  height: 520px;
  object-fit: cover;
  border-radius: 4px;
  display: block;
}
.about-img-accent {
  position: absolute;
  bottom: -25px;
  right: -25px;
  width: 180px;
  height: 180px;
  border: 2px solid var(--gold);
  border-radius: 4px;
  z-index: -1;
}
.about-badge {
  position: absolute;
  top: 30px;
  left: -30px;
  background: var(--green);
  color: var(--gold-light);
  width: 100px; height: 100px;
  border-radius: 50%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  font-family: 'Cormorant Garamond', serif;
  box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}
.about-badge span:first-child {
  font-size: 32px;
  font-weight: 600;
  line-height: 1;
}
.about-badge span:last-child {
  font-size: 10px;
  letter-spacing: 0.1em;
  opacity: 0.7;
}

.about-text-tag {
  font-size: 10px;
  letter-spacing: 0.35em;
  text-transform: uppercase;
  color: var(--gold);
  border-left: 2px solid var(--gold);
  padding-left: 14px;
  margin-bottom: 20px;
  display: block;
}

.about h2 {
  font-family: 'Cormorant Garamond', serif;
  font-size: 48px;
  font-weight: 300;
  line-height: 1.15;
  color: var(--dark);
  margin-bottom: 24px;
}
.about h2 em { color: var(--green); font-style: italic; }

.about > div > p {
  color: var(--text-muted);
  line-height: 1.85;
  font-size: 14px;
  margin-bottom: 40px;
}

.amenities {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 14px 24px;
}
.amenity {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 12px;
  color: var(--dark);
  letter-spacing: 0.04em;
}
.amenity-dot {
  width: 6px; height: 6px;
  background: var(--gold);
  border-radius: 50%;
  flex-shrink: 0;
}

/* SECTION HEADER */
.section-header {
  text-align: center;
  margin-bottom: 60px;
}
.section-header .tag {
  display: inline-block;
  font-size: 10px;
  letter-spacing: 0.35em;
  text-transform: uppercase;
  color: var(--gold);
  margin-bottom: 16px;
}
.section-header h2 {
  font-family: 'Cormorant Garamond', serif;
  font-size: clamp(36px, 4vw, 54px);
  font-weight: 300;
  color: var(--dark);
  line-height: 1.1;
}
.section-header h2 em { color: var(--green); font-style: italic; }

/* ROOMS */
.rooms-section {
  padding: 100px 6%;
  background: var(--dark);
}
.rooms-section .section-header h2 { color: white; }
.rooms-section .section-header h2 em { color: var(--gold-light); }

.rooms-grid {
  display: grid;
  grid-template-columns: 1.4fr 1fr;
  gap: 4px;
  max-width: 1200px;
  margin: 0 auto;
  border-radius: 6px;
  overflow: hidden;
}

.room-card {
  position: relative;
  overflow: hidden;
  group: true;
}
.room-card.large { grid-row: span 2; min-height: 600px; }
.room-card.small { min-height: 297px; }

.room-card img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transition: transform 0.8s ease;
  filter: brightness(0.75);
}
.room-card:hover img {
  transform: scale(1.06);
  filter: brightness(0.6);
}

.room-overlay {
  position: absolute;
  inset: 0;
  padding: 36px;
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
  background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 60%);
}

.room-tag {
  font-size: 9px;
  letter-spacing: 0.3em;
  text-transform: uppercase;
  color: var(--gold);
  margin-bottom: 8px;
}
.room-name {
  font-family: 'Cormorant Garamond', serif;
  font-size: 30px;
  font-weight: 400;
  color: white;
  line-height: 1.1;
}
.room-card.large .room-name { font-size: 42px; }

.room-meta {
  display: flex;
  align-items: center;
  gap: 20px;
  margin-top: 12px;
}
.room-price {
  font-size: 13px;
  color: var(--gold-light);
  font-weight: 300;
}
.room-btn {
  display: inline-block;
  font-size: 9px;
  letter-spacing: 0.25em;
  text-transform: uppercase;
  color: white;
  text-decoration: none;
  border-bottom: 1px solid rgba(255,255,255,0.4);
  padding-bottom: 2px;
  opacity: 0;
  transform: translateX(-10px);
  transition: 0.4s;
}
.room-card:hover .room-btn {
  opacity: 1;
  transform: translateX(0);
}

/* EXPERIENCE */
.experience {
  padding: 120px 6%;
  max-width: 1200px;
  margin: 0 auto;
}

.exp-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 2px;
  margin-top: 60px;
}

.exp-card {
  background: white;
  padding: 48px 36px;
  position: relative;
  overflow: hidden;
  transition: 0.4s;
}
.exp-card::before {
  content: '';
  position: absolute;
  bottom: 0; left: 0;
  width: 100%; height: 3px;
  background: var(--gold);
  transform: scaleX(0);
  transform-origin: left;
  transition: transform 0.4s;
}
.exp-card:hover::before { transform: scaleX(1); }
.exp-card:hover { transform: translateY(-4px); box-shadow: 0 20px 50px rgba(0,0,0,0.08); }

.exp-icon {
  width: 48px; height: 48px;
  margin-bottom: 28px;
  color: var(--green);
}
.exp-card h3 {
  font-family: 'Cormorant Garamond', serif;
  font-size: 26px;
  font-weight: 400;
  color: var(--dark);
  margin-bottom: 14px;
}
.exp-card p {
  font-size: 13px;
  color: var(--text-muted);
  line-height: 1.8;
}

/* TESTIMONIAL */
.testimonial-section {
  padding: 100px 6%;
  background: var(--green);
  position: relative;
  overflow: hidden;
}
.testimonial-section::before {
  content: '"';
  position: absolute;
  top: -40px;
  left: 6%;
  font-family: 'Cormorant Garamond', serif;
  font-size: 400px;
  color: rgba(255,255,255,0.04);
  line-height: 1;
  pointer-events: none;
}

.testimonial-inner {
  max-width: 800px;
  margin: 0 auto;
  text-align: center;
}
.testimonial-stars {
  display: flex;
  justify-content: center;
  gap: 6px;
  margin-bottom: 32px;
}
.star { color: var(--gold); font-size: 18px; }

.testimonial-text {
  font-family: 'Cormorant Garamond', serif;
  font-size: clamp(24px, 3vw, 36px);
  font-weight: 300;
  font-style: italic;
  color: white;
  line-height: 1.6;
  margin-bottom: 36px;
}
.testimonial-author {
  font-size: 11px;
  letter-spacing: 0.25em;
  text-transform: uppercase;
  color: var(--gold);
}

/* CTA */
.cta {
  padding: 140px 6%;
  background: url('https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=1400') no-repeat center/cover;
  position: relative;
  text-align: center;
}
.cta::after {
  content: '';
  position: absolute;
  inset: 0;
  background: rgba(26, 26, 24, 0.75);
}
.cta-inner {
  position: relative;
  z-index: 2;
}
.cta h2 {
  font-family: 'Cormorant Garamond', serif;
  font-size: clamp(42px, 6vw, 72px);
  font-weight: 300;
  color: white;
  margin-bottom: 20px;
}
.cta h2 em { color: var(--gold-light); font-style: italic; }
.cta p {
  color: rgba(255,255,255,0.6);
  font-size: 14px;
  margin-bottom: 44px;
}

/* FOOTER */
footer {
  background: var(--dark);
  padding: 60px 6% 30px;
}
.footer-top {
  display: grid;
  grid-template-columns: 1.5fr 1fr 1fr;
  gap: 60px;
  padding-bottom: 50px;
  border-bottom: 1px solid rgba(255,255,255,0.08);
  margin-bottom: 30px;
}
.footer-brand span {
  font-family: 'Cormorant Garamond', serif;
  font-size: 28px;
  font-weight: 600;
  color: white;
  display: block;
  margin-bottom: 6px;
}
.footer-tagline {
  font-size: 10px;
  letter-spacing: 0.2em;
  color: var(--gold);
  text-transform: uppercase;
  margin-bottom: 20px;
}
.footer-brand p {
  font-size: 13px;
  color: rgba(255,255,255,0.4);
  line-height: 1.8;
}

.footer-col h4 {
  font-size: 10px;
  letter-spacing: 0.25em;
  text-transform: uppercase;
  color: var(--gold);
  margin-bottom: 20px;
}
.footer-col a, .footer-col p {
  display: block;
  font-size: 13px;
  color: rgba(255,255,255,0.45);
  text-decoration: none;
  margin-bottom: 10px;
  transition: color 0.3s;
}
.footer-col a:hover { color: var(--gold-light); }

.footer-bottom {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 11px;
  color: rgba(255,255,255,0.25);
  letter-spacing: 0.05em;
}

/* ANIMATIONS */
.fade-up {
  opacity: 0;
  transform: translateY(30px);
  transition: opacity 0.7s ease, transform 0.7s ease;
}
.fade-up.visible {
  opacity: 1;
  transform: translateY(0);
}

@media(max-width: 900px) {
  nav ul { display: none; }
  .about { grid-template-columns: 1fr; gap: 50px; }
  .about-img { height: 350px; }
  .about-badge { display: none; }
  .rooms-grid { grid-template-columns: 1fr; }
  .room-card.large { grid-row: span 1; min-height: 400px; }
  .exp-grid { grid-template-columns: 1fr; }
  .footer-top { grid-template-columns: 1fr; gap: 30px; }
}
</style>
</head>
<body>

<!-- NAV -->
<nav id="navbar">
  <div class="nav-logo">
    <span>Dnaz Homestay</span>
    <span>Ipoh · Perak · Malaysia</span>
  </div>
  <ul>
    <li><a href="#">Home</a></li>
    <li><a href="#rooms">Rooms</a></li>
    <li><a href="#about">About</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="booking.php" class="nav-book">Book Now</a></li>
  </ul>
</nav>

<!-- HERO -->
<section class="hero">
  <div class="hero-bg"></div>
  <div class="hero-content">
    <div class="hero-tag">Homestay · Ipoh, Perak</div>
    <h1>Where <em>Rest</em><br>Feels Like<br>Home</h1>
    <div class="hero-bottom">
      <p class="hero-sub">Comfortable stays for families, travellers, and explorers seeking warmth in the heart of Ipoh.</p>
      <a href="booking.php" class="btn-primary">
        Reserve a Room
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </a>
    </div>
  </div>
  <div class="scroll-hint">
    <div class="scroll-line"></div>
    Scroll
  </div>
</section>

<!-- STATS -->
<div class="stats">
  <div class="stats-inner">
    <div class="stat-item fade-up">
      <div class="stat-num">5+</div>
      <div class="stat-label">Years Operating</div>
    </div>
    <div class="stat-item fade-up">
      <div class="stat-num">500+</div>
      <div class="stat-label">Happy Guests</div>
    </div>
    <div class="stat-item fade-up">
      <div class="stat-num">4.9</div>
      <div class="stat-label">Average Rating</div>
    </div>
    <div class="stat-item fade-up">
      <div class="stat-num">24h</div>
      <div class="stat-label">Guest Support</div>
    </div>
  </div>
</div>

<!-- ABOUT -->
<section class="about" id="about">
  <div class="about-img-wrap fade-up">
    <img class="about-img" src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800" alt="Homestay interior">
    <div class="about-img-accent"></div>
    <div class="about-badge">
      <span>5★</span>
      <span>Rated</span>
    </div>
  </div>
  <div class="fade-up">
    <span class="about-text-tag">Our Story</span>
    <h2>More Than a Place<br>to <em>Sleep</em></h2>
    <p>Dnaz Homestay was built with one purpose — to make every guest feel at home. Nestled in Ipoh's most convenient neighbourhood, we offer cozy rooms with modern comforts, warm hospitality, and everything you need for a perfect stay.</p>
    <div class="amenities">
      <div class="amenity"><div class="amenity-dot"></div>High-Speed WiFi</div>
      <div class="amenity"><div class="amenity-dot"></div>Air Conditioning</div>
      <div class="amenity"><div class="amenity-dot"></div>Private Parking</div>
      <div class="amenity"><div class="amenity-dot"></div>Daily Housekeeping</div>
      <div class="amenity"><div class="amenity-dot"></div>Smart TV</div>
      <div class="amenity"><div class="amenity-dot"></div>Breakfast Available</div>
    </div>
  </div>
</section>

<!-- ROOMS -->
<section class="rooms-section" id="rooms">
  <div class="section-header fade-up">
    <div class="tag">Accommodations</div>
    <h2>Our <em>Rooms</em></h2>
  </div>
  <div class="rooms-grid fade-up">
    <div class="room-card large">
      <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=900" alt="Deluxe Room">
      <div class="room-overlay">
        <div class="room-tag">Most Popular</div>
        <div class="room-name">Deluxe<br>King Room</div>
        <div class="room-meta">
          <div class="room-price">From RM 220 / night</div>
          <a href="booking.php" class="room-btn">Book →</a>
        </div>
      </div>
    </div>
    <div class="room-card small">
      <img src="https://images.unsplash.com/photo-1560185007-c5ca9d2c014d?w=700" alt="Standard Room">
      <div class="room-overlay">
        <div class="room-tag">Best Value</div>
        <div class="room-name">Standard Room</div>
        <div class="room-meta">
          <div class="room-price">From RM 150 / night</div>
          <a href="booking.php" class="room-btn">Book →</a>
        </div>
      </div>
    </div>
    <div class="room-card small">
      <img src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=700" alt="Family Room">
      <div class="room-overlay">
        <div class="room-tag">For Families</div>
        <div class="room-name">Family Suite</div>
        <div class="room-meta">
          <div class="room-price">From RM 250 / night</div>
          <a href="booking.php" class="room-btn">Book →</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- EXPERIENCE -->
<section class="experience">
  <div class="section-header fade-up">
    <div class="tag">Why Choose Us</div>
    <h2>The Dnaz <em>Experience</em></h2>
  </div>
  <div class="exp-grid">
    <div class="exp-card fade-up">
      <svg class="exp-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
      <h3>Feels Like Home</h3>
      <p>Every detail is designed to make you feel welcome — from the decor to the little extras we leave in your room.</p>
    </div>
    <div class="exp-card fade-up">
      <svg class="exp-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><circle cx="12" cy="11" r="3"/></svg>
      <h3>Prime Location</h3>
      <p>Situated near Ipoh's best eateries, attractions, and transport links — everything is within easy reach.</p>
    </div>
    <div class="exp-card fade-up">
      <svg class="exp-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
      <h3>Safe & Secure</h3>
      <p>Your safety is our priority. Our property features secure access, CCTV, and a 24-hour on-call team.</p>
    </div>
  </div>
</section>

<!-- TESTIMONIAL -->
<section class="testimonial-section">
  <div class="testimonial-inner fade-up">
    <div class="testimonial-stars">
      <span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span>
    </div>
    <p class="testimonial-text">"Absolutely loved our stay at Dnaz Homestay. The room was spotless, the host was incredibly helpful, and the location was perfect for exploring Ipoh. Will definitely be back!"</p>
    <div class="testimonial-author">— Aina R. · Kuala Lumpur</div>
  </div>
</section>

<!-- CTA -->
<section class="cta" id="contact">
  <div class="cta-inner fade-up">
    <h2>Ready for a <em>Perfect</em> Stay?</h2>
    <p>Book directly for best rates — no hidden fees, no fuss.</p>
    <a href="booking.php" class="btn-primary" style="display:inline-flex; margin: 0 auto;">
      Reserve Your Room
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="width:18px"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
    </a>
  </div>
</section>

<!-- FOOTER -->
<footer>
  <div class="footer-top">
    <div class="footer-brand">
      <span>Dnaz Homestay</span>
      <div class="footer-tagline">Ipoh · Perak · Malaysia</div>
      <p>A cozy and comfortable homestay offering affordable, heartfelt hospitality in the heart of Ipoh.</p>
    </div>
    <div class="footer-col">
      <h4>Navigation</h4>
      <a href="#">Home</a>
      <a href="#rooms">Rooms</a>
      <a href="#about">About</a>
      <a href="booking.php">Book Now</a>
    </div>
    <div class="footer-col" id="contact-info">
      <h4>Contact</h4>
      <p>📞 +60 1X-XXX XXXX</p>
      <p>📧 hello@dnazhomestay.com</p>
      <p>📍 Ipoh, Perak, Malaysia</p>
    </div>
  </div>
  <div class="footer-bottom">
    <span>© 2026 Dnaz Homestay · All Rights Reserved</span>
    <span>Made with ♥ in Ipoh</span>
  </div>
</footer>

<script>
// Navbar scroll
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => {
  navbar.classList.toggle('scrolled', window.scrollY > 60);
});

// Intersection Observer for fade-up
const observer = new IntersectionObserver((entries) => {
  entries.forEach((entry, i) => {
    if (entry.isIntersecting) {
      setTimeout(() => entry.target.classList.add('visible'), i * 100);
    }
  });
}, { threshold: 0.1 });
document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
</script>
</body>
</html>