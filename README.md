# SIG Kependudukan Kec. Tanggtada

Ikuti langkah-langkah berikut untuk menjalankan aplikasi di komputer lokal Anda.

### 1️⃣ Clone Repository

Clone repository dari GitHub:

```bash
git clone https://github.com/anfahrul/gis-kependudukan-app.git
```

Masuk ke folder proyek:

```bash
cd gis-kependudukan-app
```

### 2️⃣ Install Dependencies

Pastikan sudah menginstal **`Composer`** dan **`Node.js`**

Install dependensi backend:

```bash
composer install
```

Install dependensi frontend:

```bash
npm install
```

### 3️⃣ Konfigurasi File .env

Salin file **`.env.example`** menjadi **`.env`**:

```bash
cp .env.example .env
```

Lalu buka file **`.env`** dan sesuaikan konfigurasi berikut:

```bash
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gis-kependudukan-app-db
DB_USERNAME=root
DB_PASSWORD=
```

### 4️⃣ Generate Application Key

Setelah konfigurasi **`.env`**, jalankan:

```bash
php artisan key:generate
```

### 5️⃣ Migrasi dan Seeder Database

Buat / migrasi tabel:

```bash
php artisan migrate:fresh
```

Seeder / masukan data awal:

```bash
php artisan db:seed --class=DummyUsersSeeder
php artisan db:seed --class=DesaSeeder
php artisan db:seed --class=PekerjaanSeeder
```

### 6️⃣ Build Frontend

Wajib dijalankan untuk styiling aplikasi:

```bash
npm run dev
```

### 7️⃣ Jalankan Server Lokal

Jalankan aplikasi (Buka terminal baru yang berbeda dengan pada saat **`Build Frontend (npm run dev)`**):

```bash
php artisan serve
```

Akses di browser:

```bash
http://127.0.0.1:8000
```

Selesai.

### Akun Admin Bawaan Aplikasi

Role **`Administrator`** (super admin)

```bash
username: administrator1@gmail.com
password: password
```

Role **`Staff`** (admin biasa)

```bash
username: staff1@gmail.com
password: password
```
