# Penjelasan alur kerja file index.html
_Exported on 7/25/2025 at 10:42:23 GMT+7 from Cursor (1.2.4)_

---

**User**

bisakah kamu menjelaskan, itu di file index.html itu ada hubungannya dengan file lain apa aja? kalau aku ga salah, itu file untuk monitoring wiko, nanti jika wiko nya mati, maka di web nya di lokasi nya akan merah, bisakah kamu menjelaskan bagaimana alur kerja kok kalo mati itu bisa warna merah

---

**Cursor**

Berikut penjelasan alur kerja file `index.html` dan hubungannya dengan file lain, serta bagaimana status "mati" (offline) bisa berwarna merah di web dashboard monitoring wiko:

### 1. Hubungan `index.html` dengan File Lain
- **`index.html`** adalah halaman utama dashboard monitoring.
- File ini **mengambil data** dari file **`api-handler.php`** menggunakan AJAX/fetch (`fetch('./api-handler.php')`).
- File **`styles.css`** digunakan untuk styling, termasuk pewarnaan baris tabel.
- Ada juga penggunaan gambar dari folder `img/` untuk logo.

### 2. Alur Kerja Monitoring & Pewarnaan Merah
#### a. Pengambilan Data
- Saat halaman dibuka atau tombol refresh ditekan, fungsi `refreshData()` di `index.html` akan mengambil data dari `api-handler.php`.
- Data yang diambil berupa array lokasi wiko, masing-masing punya atribut seperti `name`, `total_sales`, `current_sales`, dan `customer_served`.

#### b. Penentuan Status Offline/Mati
- Fungsi `updateTable(data)` akan membuat baris tabel untuk setiap lokasi.
- **Jika semua data (`total_sales`, `current_sales`, `customer_served`) bernilai `null`, maka baris tersebut dianggap bermasalah (offline/mati).**
- Baris tersebut akan diberi class CSS `problem-row`:
  ```js
  const isProblematic =
    location.total_sales === null &&
    location.current_sales === null &&
    location.customer_served === null;
  const rowClass = isProblematic ? 'problem-row' : '';
  ```
- Baris dengan class `problem-row` akan diwarnai **merah**.

#### c. Pewarnaan Merah di CSS
- Di file `styles.css`:
  ```css
  tbody tr.problem-row {
      background: linear-gradient(90deg, red, rgb(247, 187, 9)) !important;
      text-shadow: 1px 1px 2px black;
      font-weight: bold;
  }
  tr.problem-row td {
      color: white;
  }
  ```
- Jadi, **baris yang bermasalah (wiko mati/offline) akan otomatis berwarna merah dengan teks putih**.

#### d. Update Jumlah Online/Offline
- Setelah data diambil, jumlah perangkat online dan offline juga dihitung dan ditampilkan:
  ```js
  let onlineDevices = data.filter(device => device.total_sales !== null).length;
  let offlineDevices = totalDevices - onlineDevices;
  document.getElementById('online-count').textContent = `${onlineDevices}/${totalDevices}`;
  document.getElementById('offline-count').textContent = `${offlineDevices}/${totalDevices}`;
  ```

### 3. Ringkasan Alur
1. **index.html** → fetch data dari **api-handler.php**
2. Data diolah di fungsi `updateTable`
3. Jika data wiko null semua → baris tabel diberi class `problem-row`
4. CSS `problem-row` → baris jadi **merah** (menandakan wiko mati/offline)
5. Jumlah online/offline diupdate di dashboard

**Kesimpulan:**  
Warna merah pada dashboard muncul otomatis jika data dari API (`api-handler.php`) untuk suatu lokasi wiko semuanya null, menandakan perangkat tersebut mati atau tidak terhubung. Pewarnaan diatur oleh class CSS `problem-row` di file `styles.css`.

Jika ingin penjelasan lebih detail tentang isi `api-handler.php` atau alur backend-nya, silakan tanya lagi!

```javascript
  const isProblematic =
    location.total_sales === null &&
    location.current_sales === null &&
    location.customer_served === null;
  const rowClass = isProblematic ? 'problem-row' : '';
```

```css
  tbody tr.problem-row {
      background: linear-gradient(90deg, red, rgb(247, 187, 9)) !important;
      text-shadow: 1px 1px 2px black;
      font-weight: bold;
  }
  tr.problem-row td {
      color: white;
  }
```

```javascript
  let onlineDevices = data.filter(device => device.total_sales !== null).length;
  let offlineDevices = totalDevices - onlineDevices;
  document.getElementById('online-count').textContent = `${onlineDevices}/${totalDevices}`;
  document.getElementById('offline-count').textContent = `${offlineDevices}/${totalDevices}`;
```

---

**User**

apakah kemudian hanya berbekal 2 file tersebut itu saya bisa membuat sebuah log/history kapan saja perangkat itu mati dan kemudian hidup kembali? apkah itu bisa dilakukan? jika iya apakah itu memerlukan file tambahan? jika iya tolong buatkan kode nya, jika butuh file tambahan nanti akan saya buatkan file baru, dan kemudian saya copy kode yang kamu punya, terus saya ingin agar nanti ada menu baru/halaman baru untuk menampilkan log tersebut, tolong buatkan

---

**Cursor**

Bisa! Dengan hanya berbekal `index.html` dan `api-handler.php`, **secara teori** kamu bisa mendeteksi status perangkat (mati/hidup) secara real-time, **tapi untuk membuat log/history** (kapan perangkat mati dan hidup kembali), kamu **perlu file tambahan** untuk menyimpan dan menampilkan riwayat tersebut.

### Kenapa Perlu File Tambahan?
- **Log/history** harus disimpan secara permanen (misal di file `.log` atau database).
- `api-handler.php` hanya menampilkan status saat ini, tidak menyimpan perubahan status.
- Diperlukan file PHP baru (misal: `device-log.php`) untuk mencatat dan membaca log.
- Diperlukan halaman baru (misal: `log.html`) untuk menampilkan log/history ke user.

---

## Rencana Solusi

1. **Buat file log** (misal: `device_status.log`) untuk menyimpan perubahan status.
2. **Modifikasi `api-handler.php`** agar setiap kali status perangkat berubah (dari hidup ke mati atau sebaliknya), perubahan itu dicatat ke file log.
3. **Buat file PHP baru** (misal: `device-log.php`) untuk membaca isi log dan mengirimkannya ke frontend.
4. **Buat halaman baru** (misal: `log.html`) untuk menampilkan log/history ke user.
5. **Tambahkan menu/link** di `index.html` untuk menuju halaman log.

---

## 1. Format File Log (`device_status.log`)
Setiap baris:  
`[timestamp] [device_name] [status]`  
Contoh:  
`2024-06-10 14:23:01 WikoA OFFLINE`  
`2024-06-10 14:25:10 WikoA ONLINE`

---

## 2. Modifikasi `api-handler.php` (pseudo code)
- Setiap kali API dipanggil, cek status perangkat sekarang.
- Bandingkan dengan status sebelumnya (bisa disimpan di file temporary, misal: `device_status_last.json`).
- Jika ada perubahan status, catat ke `device_status.log`.

---

## 3. File PHP untuk Membaca Log (`device-log.php`)
```php
<?php
$logFile = 'device_status.log';
if (file_exists($logFile)) {
    $lines = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $logs = [];
    foreach ($lines as $line) {
        // Format: [timestamp] [device_name] [status]
        if (preg_match('/^(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}) (.+) (ONLINE|OFFLINE)$/', $line, $matches)) {
            $logs[] = [
                'timestamp' => $matches[1],
                'device' => $matches[2],
                'status' => $matches[3]
            ];
        }
    }
    echo json_encode(array_reverse($logs)); // terbaru di atas
} else {
    echo json_encode([]);
}
?>
```

---

## 4. Halaman Log (`log.html`)
```html
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Log Status Perangkat</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="header">
        <div class="container-nav">
            <div class="logo-nav">
                <img class="logo" src="./img/logo_cleon.png" alt="Logo Cleon">
            </div>
            <div class="nav-links">
                <a href="./index.html">Dashboard</a>
                <a href="./log.html">Log Perangkat</a>
            </div>
        </div>
    </nav>
    <main>
        <h2>Log Status Perangkat</h2>
        <div id="log-container">Loading log...</div>
    </main>
    <script>
        fetch('device-log.php')
            .then(res => res.json())
            .then(logs => {
                const container = document.getElementById('log-container');
                if (logs.length === 0) {
                    container.innerHTML = "<p>Tidak ada log.</p>";
                    return;
                }
                let html = "<table><thead><tr><th>Waktu</th><th>Perangkat</th><th>Status</th></tr></thead><tbody>";
                logs.forEach(log => {
                    html += `<tr>
                        <td>${log.timestamp}</td>
                        <td>${log.device}</td>
                        <td style="color:${log.status === 'OFFLINE' ? 'red' : 'green'};font-weight:bold">${log.status}</td>
                    </tr>`;
                });
                html += "</tbody></table>";
                container.innerHTML = html;
            });
    </script>
</body>
</html>
```

---

## 5. Tambahkan Menu di `index.html`
Tambahkan di bagian `<div class="nav-links">`:
```html
<a href="./log.html">Log Perangkat</a>
```

---

## 6. (Opsional) CSS Table di `styles.css`
Agar tabel log tampil rapi, pastikan ada style untuk table (sudah ada di file kamu).

---

### **Kesimpulan**
- **Perlu file tambahan:** `device_status.log`, `device-log.php`, dan `log.html`.
- **Perlu modifikasi** di `api-handler.php` untuk mencatat perubahan status ke log.
- **Frontend**: Tambahkan halaman baru dan menu untuk log.

---

**Jika kamu setuju, silakan buat file kosong:**
- `device_status.log`
- `device-log.php`
- `log.html`

Lalu kabari saya, saya akan bantu buatkan kode modifikasi untuk `api-handler.php` agar bisa mencatat log status perangkat!

```php
<?php
$logFile = 'device_status.log';
if (file_exists($logFile)) {
    $lines = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $logs = [];
    foreach ($lines as $line) {
        // Format: [timestamp] [device_name] [status]
        if (preg_match('/^(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}) (.+) (ONLINE|OFFLINE)$/', $line, $matches)) {
            $logs[] = [
                'timestamp' => $matches[1],
                'device' => $matches[2],
                'status' => $matches[3]
            ];
        }
    }
    echo json_encode(array_reverse($logs)); // terbaru di atas
} else {
    echo json_encode([]);
}
?>
```

```html
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Log Status Perangkat</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="header">
        <div class="container-nav">
            <div class="logo-nav">
                <img class="logo" src="./img/logo_cleon.png" alt="Logo Cleon">
            </div>
            <div class="nav-links">
                <a href="./index.html">Dashboard</a>
                <a href="./log.html">Log Perangkat</a>
            </div>
        </div>
    </nav>
    <main>
        <h2>Log Status Perangkat</h2>
        <div id="log-container">Loading log...</div>
    </main>
    <script>
        fetch('device-log.php')
            .then(res => res.json())
            .then(logs => {
                const container = document.getElementById('log-container');
                if (logs.length === 0) {
                    container.innerHTML = "<p>Tidak ada log.</p>";
                    return;
                }
                let html = "<table><thead><tr><th>Waktu</th><th>Perangkat</th><th>Status</th></tr></thead><tbody>";
                logs.forEach(log => {
                    html += `<tr>
                        <td>${log.timestamp}</td>
                        <td>${log.device}</td>
                        <td style="color:${log.status === 'OFFLINE' ? 'red' : 'green'};font-weight:bold">${log.status}</td>
                    </tr>`;
                });
                html += "</tbody></table>";
                container.innerHTML = html;
            });
    </script>
</body>
</html>
```

```html
<a href="./log.html">Log Perangkat</a>
```

---

**User**

ke saya setuju, saya sudah buat file device-log.php dan device_status.log
 tolong nanti berikan saya isi code nya, kemudian saya msih mau tanya, jika saya buat file log.html apakah itu berarti nanti akan beda halaman? atau masih satu halaman sama index? karena saya tidak ingin itu di beda halaman, saya hanya ingin nambah menu log di web yang sudah ada

---

**Cursor**

Bagus, kamu sudah membuat file yang dibutuhkan!

### Jawaban Pertanyaan:
- **Jika kamu membuat file `log.html`, itu memang akan menjadi halaman terpisah dari `index.html`.**
- **Kalau kamu ingin log/history tampil di halaman yang sama (index.html),** maka kita cukup menambah menu/tab/section baru di dalam `index.html` tanpa membuat halaman baru.
- Data log akan diambil dari `device-log.php` dan ditampilkan di section khusus di halaman utama.

---

## Solusi: Log Tampil di Halaman yang Sama

### 1. **Jangan pakai `log.html`** (boleh dihapus atau diabaikan).
### 2. **Tambahkan tombol/menu "Log" di navbar `index.html`.**
### 3. **Tambahkan section baru di `index.html` untuk menampilkan log.**
### 4. **Gunakan JavaScript untuk menampilkan/sembunyikan section log atau dashboard.**
### 5. **Ambil data log dari `device-log.php` via AJAX/fetch.**

---

## Contoh Implementasi

### **A. Tambah Menu di Navbar**
Di `<div class="nav-links">`:
```html
<a href="#" id="menu-dashboard">Dashboard</a>
<a href="#" id="menu-log">Log Perangkat</a>
```

### **B. Tambah Section Log di index.html**
Letakkan setelah section dashboard (atau di bawah `<main>`):
```html
<div id="log-section" style="display:none;">
  <h2>Log Status Perangkat</h2>
  <div id="log-container">Loading log...</div>
</div>
```

### **C. Tambah Script untuk Navigasi & Fetch Log**
Di bagian `<script>` paling bawah sebelum `</body>`:
```html
<script>
document.getElementById('menu-dashboard').onclick = function() {
  document.querySelector('main').style.display = '';
  document.getElementById('log-section').style.display = 'none';
};
document.getElementById('menu-log').onclick = function() {
  document.querySelector('main').style.display = 'none';
  document.getElementById('log-section').style.display = '';
  fetch('device-log.php')
    .then(res => res.json())
    .then(logs => {
      const container = document.getElementById('log-container');
      if (logs.length === 0) {
        container.innerHTML = "<p>Tidak ada log.</p>";
        return;
      }
      let html = "<table><thead><tr><th>Waktu</th><th>Perangkat</th><th>Status</th></tr></thead><tbody>";
      logs.forEach(log => {
        html += `<tr>
          <td>${log.timestamp}</td>
          <td>${log.device}</td>
          <td style="color:${log.status === 'OFFLINE' ? 'red' : 'green'};font-weight:bold">${log.status}</td>
        </tr>`;
      });
      html += "</tbody></table>";
      container.innerHTML = html;
    });
};
</script>
```

---

## **Kesimpulan**
- **Log akan tampil di halaman yang sama (index.html),** bukan di halaman terpisah.
- Cukup tambahkan section dan script di index.html.
- Tidak perlu file `log.html`.

---

### **Selanjutnya**
1. Apakah kamu ingin saya langsung buatkan kode lengkap untuk modifikasi `index.html` dan isi `device-log.php`?
2. Setelah itu, saya akan bantu modifikasi `api-handler.php` agar bisa mencatat log status perangkat.

Silakan konfirmasi, atau jika ada bagian yang ingin diubah, kabari saja!

```html
<a href="#" id="menu-dashboard">Dashboard</a>
<a href="#" id="menu-log">Log Perangkat</a>
```

```html
<div id="log-section" style="display:none;">
  <h2>Log Status Perangkat</h2>
  <div id="log-container">Loading log...</div>
</div>
```

```html
<script>
document.getElementById('menu-dashboard').onclick = function() {
  document.querySelector('main').style.display = '';
  document.getElementById('log-section').style.display = 'none';
};
document.getElementById('menu-log').onclick = function() {
  document.querySelector('main').style.display = 'none';
  document.getElementById('log-section').style.display = '';
  fetch('device-log.php')
    .then(res => res.json())
    .then(logs => {
      const container = document.getElementById('log-container');
      if (logs.length === 0) {
        container.innerHTML = "<p>Tidak ada log.</p>";
        return;
      }
      let html = "<table><thead><tr><th>Waktu</th><th>Perangkat</th><th>Status</th></tr></thead><tbody>";
      logs.forEach(log => {
        html += `<tr>
          <td>${log.timestamp}</td>
          <td>${log.device}</td>
          <td style="color:${log.status === 'OFFLINE' ? 'red' : 'green'};font-weight:bold">${log.status}</td>
        </tr>`;
      });
      html += "</tbody></table>";
      container.innerHTML = html;
    });
};
</script>
```

---

**User**

yang, langsung saja buatkan full versi nya dan saya acc untuk saranmu no 1 dan 2, langsung buatkan

---

**Cursor**

```html
// ... existing code ...
      <div class="nav-links">
        <a href="#" id="menu-dashboard">Dashboard</a>
        <a href="#" id="menu-log">Log Perangkat</a>
      </div>
// ... existing code ...
  </main>
  <div id="log-section" style="display:none;">
    <h2>Log Status Perangkat</h2>
    <div id="log-container">Loading log...</div>
  </div>
// ... existing code ...
<script>
// ... existing code ...
document.getElementById('menu-dashboard').onclick = function() {
  document.querySelector('main').style.display = '';
  document.getElementById('log-section').style.display = 'none';
};
document.getElementById('menu-log').onclick = function() {
  document.querySelector('main').style.display = 'none';
  document.getElementById('log-section').style.display = '';
  fetch('device-log.php')
    .then(res => res.json())
    .then(logs => {
      const container = document.getElementById('log-container');
      if (logs.length === 0) {
        container.innerHTML = "<p>Tidak ada log.</p>";
        return;
      }
      let html = "<table><thead><tr><th>Waktu</th><th>Perangkat</th><th>Status</th></tr></thead><tbody>";
      logs.forEach(log => {
        html += `<tr>
          <td>${log.timestamp}</td>
          <td>${log.device}</td>
          <td style=\"color:${log.status === 'OFFLINE' ? 'red' : 'green'};font-weight:bold\">${log.status}</td>
        </tr>`;
      });
      html += "</tbody></table>";
      container.innerHTML = html;
    });
};
// ... existing code ...
```

```php
<?php
$logFile = 'device_status.log';
if (file_exists($logFile)) {
    $lines = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $logs = [];
    foreach ($lines as $line) {
        // Format: [timestamp] [device_name] [status]
        if (preg_match('/^(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}) (.+) (ONLINE|OFFLINE)$/', $line, $matches)) {
            $logs[] = [
                'timestamp' => $matches[1],
                'device' => $matches[2],
                'status' => $matches[3]
            ];
        }
    }
    echo json_encode(array_reverse($logs)); // terbaru di atas
} else {
    echo json_encode([]);
}

```

```php
// ... existing code ...

// --- Tambahan untuk logging status perangkat ---
$logFile = 'device_status.log';
$lastStatusFile = 'device_status_last.json';

// Ambil status terakhir dari file (jika ada)
$lastStatus = [];
if (file_exists($lastStatusFile)) {
    $lastStatus = json_decode(file_get_contents($lastStatusFile), true);
    if (!is_array($lastStatus)) $lastStatus = [];
}

// Array untuk status sekarang
$currentStatus = [];

// Proses hasil dan logging
foreach ($results as $result) {
    $device = $result['name'];
    $isOnline = !(
        $result['total_sales'] === null &&
        $result['current_sales'] === null &&
        $result['customer_served'] === null
    );
    $statusNow = $isOnline ? 'ONLINE' : 'OFFLINE';
    $currentStatus[$device] = $statusNow;
    $last = isset($lastStatus[$device]) ? $lastStatus[$device] : null;
    if ($last !== null && $last !== $statusNow) {
        // Status berubah, catat ke log
        $timestamp = date('Y-m-d H:i:s');
        $logLine = "$timestamp $device $statusNow\n";
        file_put_contents($logFile, $logLine, FILE_APPEND);
    }
    // Jika belum pernah ada status, jangan log (hanya log perubahan)
}
// Simpan status sekarang untuk perbandingan berikutnya
file_put_contents($lastStatusFile, json_encode($currentStatus));

// ... existing code ...
```

Semua kode sudah saya buatkan sesuai permintaan:

---

## 1. **index.html**
- Sudah ditambah menu "Log Perangkat" di navbar.
- Sudah ada section log di halaman yang sama (bukan halaman baru).
- Navigasi antar dashboard/log sudah otomatis, dan log diambil dari `device-log.php`.

---

## 2. **device-log.php**
- Sudah berisi kode untuk membaca file `device_status.log` dan mengembalikan data log dalam format JSON ke frontend.

---

## 3. **api-handler.php**
- Sudah dimodifikasi:
  - Setiap kali status perangkat berubah (ONLINE ⇄ OFFLINE), perubahan akan dicatat ke file `device_status.log` dengan format:
    ```
    [timestamp] [device_name] [status]
    ```
  - Status terakhir perangkat disimpan di `device_status_last.json` (file ini akan otomatis dibuat).
  - Hanya perubahan status yang dicatat ke log (bukan setiap polling).

---

### **Cara Kerja:**
- Dashboard tetap seperti biasa.
- Jika klik menu "Log Perangkat", akan muncul tabel log status perangkat (waktu, nama perangkat, status).
- Log akan otomatis terisi jika ada perangkat yang mati/hidup kembali.

---

**Kamu tidak perlu membuat halaman baru. Semua sudah terintegrasi di index.html.**

---

### **Langkah Selanjutnya:**
- Jalankan dashboard seperti biasa.
- Coba matikan/nyalakan salah satu perangkat, lalu klik menu "Log Perangkat" untuk melihat history-nya.

Jika ada error, bug, atau ingin customisasi tampilan log, silakan kabari saya!

```plaintext
    [timestamp] [device_name] [status]
```

---

**User**

ini kan file nya sebenarnya sebelumnya jalan di armbian server, nah kalo sekarang saya ingin coba jalanin di komputer saya apakah bisa? gimana caranya

---

**Cursor**

Tentu bisa! Kamu bisa menjalankan project ini di komputer kamu (macOS) asalkan ada **web server** dan **PHP** yang aktif, karena file utama (`api-handler.php`, `device-log.php`) adalah file PHP.

### **Langkah Menjalankan di Komputer Lokal (macOS):**

#### **1. Pastikan PHP Sudah Terinstall**
- Cek versi PHP di terminal:
  ```sh
  php -v
  ```
- Jika belum ada, install via Homebrew:
  ```sh
  brew install php
  ```

#### **2. Jalankan Web Server Lokal**
- Masuk ke folder project:
  ```sh
  cd /Users/ndalemkarundrajan/Downloads/dashboard_aseli
  ```
- Jalankan built-in PHP server:
  ```sh
  php -S localhost:8000
  ```
- Ini akan menjalankan web server di http://localhost:8000

#### **3. Akses dari Browser**
- Buka browser, akses:
  ```
  http://localhost:8000/index.html
  ```

#### **4. Catatan Penting**
- **API eksternal**: Jika `api-handler.php` mengambil data dari IP lokal/server lain (misal `http://172.16.x.x`), pastikan komputer kamu bisa mengakses IP tersebut. Jika tidak, data akan gagal diambil (tapi fitur log, tampilan, dsb tetap bisa kamu tes).
- **Permission**: Pastikan file `device_status.log` dan `device_status_last.json` bisa ditulis oleh PHP. Jika error permission, jalankan:
  ```sh
  chmod 666 device_status.log
  chmod 666 device_status_last.json
  ```
  (atau buat file kosong `device_status_last.json` jika belum ada)

#### **5. (Opsional) Testing Tanpa Koneksi ke Perangkat**
- Kamu bisa edit sementara bagian pengambilan data di `api-handler.php` agar return data dummy, supaya bisa tes tampilan/log tanpa harus benar-benar terhubung ke perangkat.

---

### **Kesimpulan**
- **Bisa dijalankan di komputer lokal** dengan PHP built-in server.
- Tidak perlu install software berat, cukup PHP saja.
- Semua fitur (termasuk log) bisa dicoba, kecuali data real dari perangkat jika IP tidak bisa diakses.

---

Jika ada error atau butuh bantuan modifikasi agar bisa testing tanpa perangkat asli, kabari saja!

```shellscript
  php -v
```

```shellscript
  brew install php
```

```shellscript
  cd /Users/ndalemkarundrajan/Downloads/dashboard_aseli
```

```shellscript
  php -S localhost:8000
```

```plaintext
  http://localhost:8000/index.html
```

```shellscript
  chmod 666 device_status.log
  chmod 666 device_status_last.json
```

