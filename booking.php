<?php
$success = false;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $phone    = trim($_POST['phone'] ?? '');
    $checkin  = trim($_POST['checkin'] ?? '');
    $checkout = trim($_POST['checkout'] ?? '');
    $room     = trim($_POST['room'] ?? '');
    $guests   = trim($_POST['guests'] ?? '');
    $notes    = trim($_POST['notes'] ?? '');

    if (empty($name))     $errors[] = "Nama diperlukan.";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Emel tidak sah.";
    if (empty($phone))    $errors[] = "Nombor telefon diperlukan.";
    if (empty($checkin))  $errors[] = "Tarikh daftar masuk diperlukan.";
    if (empty($checkout)) $errors[] = "Tarikh daftar keluar diperlukan.";
    if (empty($room))     $errors[] = "Sila pilih jenis bilik.";
    if (empty($guests))   $errors[] = "Bilangan tetamu diperlukan.";

    if (empty($errors)) {
        // Calculate nights & price
        $in  = new DateTime($checkin);
        $out = new DateTime($checkout);
        $nights = max(1, $in->diff($out)->days);

        $prices = [
            'standard' => 150,
            'deluxe'   => 220,
            'family'   => 250,
        ];
        $pricePerNight = $prices[$room] ?? 150;
        $total = $nights * $pricePerNight;

        // Here you would save to DB or send email
        $success = true;
    }
}

$room_sel   = $_POST['room'] ?? '';
$checkin_v  = $_POST['checkin'] ?? '';
$checkout_v = $_POST['checkout'] ?? '';
?>
<!DOCTYPE html>
<html lang="ms">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tempahan — Dnaz Homestay</title>
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
  padding: 16px 6%;
  background: rgba(248,244,239,0.97);
  backdrop-filter: blur(10px);
  box-shadow: 0 1px 0 rgba(0,0,0,0.08);
}

.nav-logo {
  display: flex;
  flex-direction: column;
  line-height: 1;
  text-decoration: none;
}
.nav-logo span:first-child {
  font-family: 'Cormorant Garamond', serif;
  font-size: 24px;
  font-weight: 600;
  color: var(--dark);
  letter-spacing: 0.02em;
}
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
  gap: 32px;
  align-items: center;
}
nav ul li a {
  text-decoration: none;
  font-size: 12px;
  letter-spacing: 0.15em;
  text-transform: uppercase;
  color: var(--text-muted);
  transition: 0.3s;
}
nav ul li a:hover { color: var(--gold); }

/* PAGE HEADER */
.page-header {
  padding-top: 120px;
  padding-bottom: 60px;
  text-align: center;
  background: var(--dark);
  position: relative;
  overflow: hidden;
}
.page-header::before {
  content: '';
  position: absolute;
  inset: 0;
  background: url('https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=1400') no-repeat center/cover;
  opacity: 0.12;
}
.page-header-inner {
  position: relative;
  z-index: 1;
}
.page-tag {
  display: inline-block;
  font-size: 10px;
  letter-spacing: 0.35em;
  text-transform: uppercase;
  color: var(--gold);
  margin-bottom: 16px;
  border-left: 2px solid var(--gold);
  padding-left: 14px;
}
.page-header h1 {
  font-family: 'Cormorant Garamond', serif;
  font-size: clamp(40px, 6vw, 70px);
  font-weight: 300;
  color: white;
  line-height: 1;
}
.page-header h1 em {
  font-style: italic;
  color: var(--gold-light);
}
.page-header p {
  color: rgba(255,255,255,0.45);
  font-size: 13px;
  margin-top: 14px;
  letter-spacing: 0.05em;
}

/* BOOKING LAYOUT */
.booking-wrap {
  max-width: 1100px;
  margin: 0 auto;
  padding: 80px 6% 100px;
  display: grid;
  grid-template-columns: 1.1fr 0.9fr;
  gap: 60px;
  align-items: start;
}

/* FORM SIDE */
.form-card {
  background: white;
  border-radius: 4px;
  padding: 50px;
  box-shadow: 0 10px 60px rgba(0,0,0,0.07);
}

.form-section-title {
  font-family: 'Cormorant Garamond', serif;
  font-size: 28px;
  font-weight: 400;
  color: var(--dark);
  margin-bottom: 30px;
  padding-bottom: 20px;
  border-bottom: 1px solid rgba(0,0,0,0.07);
  display: flex;
  align-items: center;
  gap: 12px;
}
.form-section-title span {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 32px; height: 32px;
  background: var(--green);
  color: var(--gold-light);
  border-radius: 50%;
  font-size: 14px;
  font-family: 'DM Sans', sans-serif;
  font-weight: 500;
}

.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
  margin-bottom: 20px;
}
.form-group {
  display: flex;
  flex-direction: column;
  gap: 7px;
}
.form-group.full { grid-column: span 2; }

label {
  font-size: 10px;
  letter-spacing: 0.2em;
  text-transform: uppercase;
  color: var(--text-muted);
  font-weight: 400;
}

input, select, textarea {
  padding: 12px 16px;
  border: 1px solid #e2ddd8;
  border-radius: 3px;
  font-family: 'DM Sans', sans-serif;
  font-size: 14px;
  color: var(--dark);
  background: #fdfcfa;
  transition: 0.3s;
  outline: none;
  width: 100%;
}
input:focus, select:focus, textarea:focus {
  border-color: var(--gold);
  background: white;
  box-shadow: 0 0 0 3px rgba(201,169,110,0.1);
}
select { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%23c9a96e' stroke-width='1.5' fill='none'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 14px center; }
textarea { resize: vertical; min-height: 90px; }

.submit-btn {
  width: 100%;
  padding: 16px;
  background: var(--green);
  color: var(--gold-light);
  border: none;
  border-radius: 3px;
  font-family: 'DM Sans', sans-serif;
  font-size: 12px;
  letter-spacing: 0.2em;
  text-transform: uppercase;
  font-weight: 500;
  cursor: pointer;
  transition: 0.3s;
  margin-top: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
}
.submit-btn:hover { background: var(--green-light); transform: translateY(-2px); box-shadow: 0 8px 24px rgba(45,74,62,0.25); }

/* DIVIDER */
.form-divider {
  margin: 30px 0;
  border: none;
  border-top: 1px solid rgba(0,0,0,0.07);
}

/* ALERTS */
.alert {
  padding: 16px 20px;
  border-radius: 3px;
  font-size: 13px;
  margin-bottom: 28px;
  display: flex;
  gap: 12px;
  align-items: flex-start;
}
.alert-success {
  background: #edf7f1;
  border-left: 3px solid #27ae60;
  color: #1d7a43;
}
.alert-error {
  background: #fef2f2;
  border-left: 3px solid #e74c3c;
  color: #c0392b;
}
.alert ul { margin-top: 6px; padding-left: 16px; }
.alert ul li { margin-bottom: 4px; }

/* SUMMARY SIDE */
.summary-sticky { position: sticky; top: 100px; }

.summary-card {
  background: var(--dark);
  border-radius: 4px;
  overflow: hidden;
  margin-bottom: 24px;
}
.summary-img {
  width: 100%;
  height: 200px;
  object-fit: cover;
  display: block;
  opacity: 0.8;
}
.summary-body {
  padding: 32px;
}
.summary-room-tag {
  font-size: 9px;
  letter-spacing: 0.3em;
  text-transform: uppercase;
  color: var(--gold);
  margin-bottom: 8px;
}
.summary-room-name {
  font-family: 'Cormorant Garamond', serif;
  font-size: 26px;
  font-weight: 400;
  color: white;
  margin-bottom: 20px;
}

.summary-line {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 12px;
  padding: 10px 0;
  border-bottom: 1px solid rgba(255,255,255,0.07);
  color: rgba(255,255,255,0.55);
}
.summary-line:last-of-type { border-bottom: none; }
.summary-line strong { color: var(--gold-light); font-weight: 400; }

.summary-total {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 20px;
  padding-top: 20px;
  border-top: 1px solid rgba(255,255,255,0.12);
}
.summary-total span:first-child {
  font-size: 11px;
  letter-spacing: 0.15em;
  text-transform: uppercase;
  color: rgba(255,255,255,0.4);
}
.summary-total .total-price {
  font-family: 'Cormorant Garamond', serif;
  font-size: 36px;
  font-weight: 300;
  color: var(--gold);
  line-height: 1;
}
.summary-total .total-price small {
  font-size: 13px;
  color: rgba(255,255,255,0.3);
  font-family: 'DM Sans', sans-serif;
  margin-left: 4px;
}

/* INFO CARDS */
.info-card {
  background: white;
  border-radius: 4px;
  padding: 24px 28px;
  margin-bottom: 16px;
  display: flex;
  gap: 18px;
  align-items: flex-start;
  box-shadow: 0 4px 20px rgba(0,0,0,0.05);
}
.info-icon {
  width: 38px; height: 38px;
  background: #f0f8f4;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  color: var(--green);
}
.info-icon svg { width: 18px; }
.info-text h4 {
  font-size: 13px;
  font-weight: 500;
  color: var(--dark);
  margin-bottom: 4px;
}
.info-text p {
  font-size: 12px;
  color: var(--text-muted);
  line-height: 1.7;
}

/* SUCCESS PAGE */
.success-wrap {
  max-width: 680px;
  margin: 80px auto;
  padding: 0 6% 100px;
  text-align: center;
}
.success-icon {
  width: 80px; height: 80px;
  background: #edf7f1;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 30px;
  color: #27ae60;
}
.success-icon svg { width: 36px; }
.success-wrap h2 {
  font-family: 'Cormorant Garamond', serif;
  font-size: 42px;
  font-weight: 300;
  color: var(--dark);
  margin-bottom: 14px;
}
.success-wrap h2 em { color: var(--green); font-style: italic; }
.success-wrap p { color: var(--text-muted); font-size: 14px; line-height: 1.8; }

.booking-ref {
  background: var(--dark);
  border-radius: 4px;
  padding: 30px 40px;
  margin: 36px 0;
  text-align: left;
}
.booking-ref-label {
  font-size: 10px;
  letter-spacing: 0.3em;
  text-transform: uppercase;
  color: var(--gold);
  margin-bottom: 6px;
}
.booking-ref-num {
  font-family: 'Cormorant Garamond', serif;
  font-size: 32px;
  color: white;
  font-weight: 300;
}

.success-details {
  background: white;
  border-radius: 4px;
  padding: 30px 40px;
  margin-bottom: 36px;
  text-align: left;
  box-shadow: 0 4px 20px rgba(0,0,0,0.06);
}
.detail-row {
  display: flex;
  justify-content: space-between;
  padding: 10px 0;
  border-bottom: 1px solid #f0ebe4;
  font-size: 13px;
}
.detail-row:last-child { border-bottom: none; }
.detail-row .label { color: var(--text-muted); }
.detail-row .value { font-weight: 500; color: var(--dark); }

.back-btn {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  padding: 14px 32px;
  background: var(--green);
  color: var(--gold-light);
  text-decoration: none;
  font-size: 11px;
  letter-spacing: 0.2em;
  text-transform: uppercase;
  border-radius: 3px;
  transition: 0.3s;
}
.back-btn:hover { background: var(--green-light); }

/* FOOTER */
footer {
  background: var(--dark);
  color: rgba(255,255,255,0.3);
  text-align: center;
  padding: 24px;
  font-size: 12px;
  letter-spacing: 0.05em;
}

/* RESPONSIVE */
@media(max-width: 900px) {
  nav ul { display: none; }
  .booking-wrap { grid-template-columns: 1fr; }
  .summary-sticky { position: static; }
  .form-card { padding: 30px 24px; }
  .form-row { grid-template-columns: 1fr; }
  .form-group.full { grid-column: span 1; }
}
</style>
</head>
<body>

<!-- NAV -->
<nav>
  <a href="index.html" class="nav-logo">
    <span>Dnaz Homestay</span>
    <span>Ipoh · Perak · Malaysia</span>
  </a>
  <ul>
    <li><a href="index.php">← Kembali ke Laman Utama</a></li>
  </ul>
</nav>

<!-- PAGE HEADER -->
<div class="page-header">
  <div class="page-header-inner">
    <div class="page-tag">Dnaz Homestay</div>
    <h1>Buat <em>Tempahan</em></h1>
    <p>Isi borang di bawah untuk menempah bilik anda</p>
  </div>
</div>

<?php if ($success): ?>
<!-- ===== SUCCESS ===== -->
<?php
  $ref = 'DNZ-' . strtoupper(substr(md5($email . time()), 0, 8));
  $roomNames = ['standard' => 'Standard Room', 'deluxe' => 'Deluxe King Room', 'family' => 'Family Suite'];
  $roomName = $roomNames[$room] ?? $room;
  $in2  = new DateTime($checkin);
  $out2 = new DateTime($checkout);
  $nights2 = max(1, $in2->diff($out2)->days);
  $prices2 = ['standard'=>150,'deluxe'=>220,'family'=>250];
  $total2 = $nights2 * ($prices2[$room] ?? 150);
?>
<div class="success-wrap">
  <div class="success-icon">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 6L9 17l-5-5"/></svg>
  </div>
  <h2>Tempahan <em>Berjaya!</em></h2>
  <p>Terima kasih, <strong><?= htmlspecialchars($name) ?></strong>. Tempahan anda telah kami terima. Kami akan menghubungi anda melalui emel atau WhatsApp untuk pengesahan dalam masa 24 jam.</p>

  <div class="booking-ref">
    <div class="booking-ref-label">Nombor Rujukan</div>
    <div class="booking-ref-num"><?= $ref ?></div>
  </div>

  <div class="success-details">
    <div class="detail-row"><span class="label">Nama</span><span class="value"><?= htmlspecialchars($name) ?></span></div>
    <div class="detail-row"><span class="label">Bilik</span><span class="value"><?= $roomName ?></span></div>
    <div class="detail-row"><span class="label">Daftar Masuk</span><span class="value"><?= date('d M Y', strtotime($checkin)) ?></span></div>
    <div class="detail-row"><span class="label">Daftar Keluar</span><span class="value"><?= date('d M Y', strtotime($checkout)) ?></span></div>
    <div class="detail-row"><span class="label">Malam</span><span class="value"><?= $nights2 ?> malam</span></div>
    <div class="detail-row"><span class="label">Tetamu</span><span class="value"><?= htmlspecialchars($guests) ?> orang</span></div>
    <div class="detail-row"><span class="label">Jumlah Anggaran</span><span class="value">RM <?= number_format($total2) ?></span></div>
  </div>

  <a href="index.html" class="back-btn">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" style="width:16px"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
    Kembali ke Laman Utama
  </a>
</div>

<?php else: ?>
<!-- ===== FORM ===== -->
<div class="booking-wrap">

  <!-- LEFT: FORM -->
  <div>
    <div class="form-card">

      <?php if (!empty($errors)): ?>
      <div class="alert alert-error">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" style="width:20px;flex-shrink:0;margin-top:2px"><circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/></svg>
        <div>
          <strong>Sila betulkan ralat berikut:</strong>
          <ul><?php foreach ($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?></ul>
        </div>
      </div>
      <?php endif; ?>

      <form method="POST" action="booking.php" id="bookingForm">

        <!-- SECTION 1: PERSONAL INFO -->
        <div class="form-section-title">
          <span>1</span> Maklumat Tetamu
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Nama Penuh *</label>
            <input type="text" name="name" placeholder="Ahmad bin Abdullah" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required>
          </div>
          <div class="form-group">
            <label>Nombor Telefon *</label>
            <input type="tel" name="phone" placeholder="+60 12-345 6789" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>" required>
          </div>
          <div class="form-group full">
            <label>Alamat Emel *</label>
            <input type="email" name="email" placeholder="contoh@emel.com" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
          </div>
        </div>

        <hr class="form-divider">

        <!-- SECTION 2: BOOKING DETAILS -->
        <div class="form-section-title">
          <span>2</span> Butiran Tempahan
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Tarikh Daftar Masuk *</label>
            <input type="date" name="checkin" id="checkin" value="<?= htmlspecialchars($checkin_v) ?>" min="<?= date('Y-m-d') ?>" required>
          </div>
          <div class="form-group">
            <label>Tarikh Daftar Keluar *</label>
            <input type="date" name="checkout" id="checkout" value="<?= htmlspecialchars($checkout_v) ?>" min="<?= date('Y-m-d', strtotime('+1 day')) ?>" required>
          </div>
          <div class="form-group">
            <label>Jenis Bilik *</label>
            <select name="room" id="roomSelect" required>
              <option value="">-- Pilih Bilik --</option>
              <option value="standard" <?= $room_sel === 'standard' ? 'selected' : '' ?>>Standard Room — RM150/malam</option>
              <option value="deluxe"   <?= $room_sel === 'deluxe'   ? 'selected' : '' ?>>Deluxe King Room — RM220/malam</option>
              <option value="family"   <?= $room_sel === 'family'   ? 'selected' : '' ?>>Family Suite — RM250/malam</option>
            </select>
          </div>
          <div class="form-group">
            <label>Bilangan Tetamu *</label>
            <select name="guests" required>
              <option value="">-- Pilih --</option>
              <?php for ($i=1; $i<=8; $i++): ?>
              <option value="<?= $i ?>" <?= ($_POST['guests'] ?? '') == $i ? 'selected' : '' ?>><?= $i ?> orang</option>
              <?php endfor; ?>
            </select>
          </div>
          <div class="form-group full">
            <label>Permintaan Khas (Pilihan)</label>
            <textarea name="notes" placeholder="Contoh: bilik berhampiran tangga, tempat letak kereta, dan lain-lain..."><?= htmlspecialchars($_POST['notes'] ?? '') ?></textarea>
          </div>
        </div>

        <button type="submit" class="submit-btn">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" style="width:18px"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          Hantar Tempahan
        </button>

      </form>
    </div>
  </div>

  <!-- RIGHT: SUMMARY -->
  <div class="summary-sticky">

    <!-- Dynamic Summary Card -->
    <div class="summary-card">
      <img id="summaryImg" src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=600" alt="Room">
      <div class="summary-body">
        <div class="summary-room-tag">Bilik Dipilih</div>
        <div class="summary-room-name" id="summaryName">Sila pilih bilik</div>

        <div class="summary-line">
          <span>Daftar Masuk</span>
          <strong id="summaryIn">—</strong>
        </div>
        <div class="summary-line">
          <span>Daftar Keluar</span>
          <strong id="summaryOut">—</strong>
        </div>
        <div class="summary-line">
          <span>Tempoh Menginap</span>
          <strong id="summaryNights">—</strong>
        </div>
        <div class="summary-line">
          <span>Harga / Malam</span>
          <strong id="summaryRate">—</strong>
        </div>

        <div class="summary-total">
          <span>Jumlah Anggaran</span>
          <div class="total-price" id="summaryTotal">RM —<small>/trip</small></div>
        </div>
      </div>
    </div>

    <!-- Info Cards -->
    <div class="info-card">
      <div class="info-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
      </div>
      <div class="info-text">
        <h4>Tempahan Selamat</h4>
        <p>Maklumat anda dilindungi dan tidak akan dikongsi pihak ketiga.</p>
      </div>
    </div>
    <div class="info-card">
      <div class="info-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21L8.5 10.5s1 2 3 3l1.113-1.724a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
      </div>
      <div class="info-text">
        <h4>Hubungi Kami</h4>
        <p>+60 1X-XXX XXXX · hello@dnazhomestay.com</p>
      </div>
    </div>
    <div class="info-card">
      <div class="info-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
      </div>
      <div class="info-text">
        <h4>Daftar Masuk / Keluar</h4>
        <p>Check-in: 2:00 PM · Check-out: 12:00 PM (Tengah Hari)</p>
      </div>
    </div>

  </div>
</div>
<?php endif; ?>

<!-- FOOTER -->
<footer>
  © 2026 Dnaz Homestay · All Rights Reserved · Ipoh, Perak
</footer>

<script>
const roomData = {
  standard: { name: 'Standard Room',    rate: 150, img: 'https://images.unsplash.com/photo-1560185007-c5ca9d2c014d?w=600' },
  deluxe:   { name: 'Deluxe King Room', rate: 220, img: 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=600' },
  family:   { name: 'Family Suite',     rate: 250, img: 'https://images.unsplash.com/photo-1505691938895-1758d7feb511?w=600' },
};

function formatDate(str) {
  if (!str) return '—';
  const d = new Date(str);
  return d.toLocaleDateString('ms-MY', { day: 'numeric', month: 'short', year: 'numeric' });
}

function updateSummary() {
  const room     = document.getElementById('roomSelect').value;
  const checkin  = document.getElementById('checkin').value;
  const checkout = document.getElementById('checkout').value;

  const nameEl   = document.getElementById('summaryName');
  const inEl     = document.getElementById('summaryIn');
  const outEl    = document.getElementById('summaryOut');
  const nightsEl = document.getElementById('summaryNights');
  const rateEl   = document.getElementById('summaryRate');
  const totalEl  = document.getElementById('summaryTotal');
  const imgEl    = document.getElementById('summaryImg');

  if (room && roomData[room]) {
    nameEl.textContent = roomData[room].name;
    rateEl.textContent = 'RM ' + roomData[room].rate;
    imgEl.src = roomData[room].img;
  } else {
    nameEl.textContent = 'Sila pilih bilik';
    rateEl.textContent = '—';
  }

  inEl.textContent  = formatDate(checkin);
  outEl.textContent = formatDate(checkout);

  if (checkin && checkout && room && roomData[room]) {
    const diff = Math.max(1, Math.round((new Date(checkout) - new Date(checkin)) / 86400000));
    nightsEl.textContent = diff + ' malam';
    totalEl.innerHTML = 'RM ' + (diff * roomData[room].rate).toLocaleString() + '<small>/trip</small>';
  } else {
    nightsEl.textContent = '—';
    totalEl.innerHTML = 'RM —<small>/trip</small>';
  }

  // Ensure checkout min is after checkin
  if (checkin) {
    const next = new Date(checkin);
    next.setDate(next.getDate() + 1);
    document.getElementById('checkout').min = next.toISOString().split('T')[0];
  }
}

document.getElementById('roomSelect').addEventListener('change', updateSummary);
document.getElementById('checkin').addEventListener('change', updateSummary);
document.getElementById('checkout').addEventListener('change', updateSummary);

// Init
updateSummary();
</script>
</body>
</html>