---

## 🌿 Website Posyandu  

Sistem informasi **Posyandu** untuk pengelolaan data imunisasi balita dan orang tua, pengelolaan data balita dan orang tua, serta riwayat pemeriksaan balita. Dibangun menggunakan **Laravel, Vue.js, dan Inertia.js**.  

### 🚀 Fitur Utama  
- **Manajemen Data Balita & Orang Tua**: Tambah, edit, dan hapus data balita serta orang tua.  
- **Pencatatan Imunisasi**: Monitoring jadwal dan riwayat imunisasi balita.  
- **Riwayat Pemeriksaan Balita**: Mencatat hasil pemeriksaan kesehatan balita.  
- **Autentikasi & Hak Akses**: Sistem login dan peran pengguna.  

### 🛠️ Teknologi yang Digunakan  
- **Backend**: Laravel  
- **Frontend**: Vue.js dengan Inertia.js  
- **Database**: MySQL 
- **Lainnya**: Tailwind CSS

### ⚙️ Cara Instalasi  

1. **Clone repository ini**  
   ```sh
   git clone https://github.com/agustiawan5209/web-posyandu
   cd repository
   ```

2. **Instal dependensi backend**  
   ```sh
   composer install
   cp .env.example .env
   php artisan key:generate
   ```

3. **Instal dependensi frontend**  
   ```sh
   npm install
   npm run dev
   ```

4. **Migrasi database**  
   ```sh
   php artisan migrate --seed
   ```

5. **Jalankan server**  
   ```sh
   php artisan serve
   ```

6. **Akses aplikasi**  
   Buka browser dan masuk ke `http://localhost:8000`.  

### 📜 Lisensi  
Proyek ini menggunakan lisensi **MIT**.  

---
😊
