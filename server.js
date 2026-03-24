const express = require('express');
const mysql = require('mysql');
const cors = require('cors');

const app = express();
const port = 3000;

// 2. Middleware
app.use(cors()); // Mengizinkan browser mengakses server ini
app.use(express.json()); // Agar server bisa membaca data format JSON

// 3. Konfigurasi Koneksi MySQL
const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',      // Username default XAMPP
    password: '',      // Password default XAMPP (kosong)
    database: 'currency-app' // GANTI dengan nama database Anda
});

// Koneksi ke Database
db.connect((err) => {
    if (err) {
        console.error('Gagal koneksi ke MySQL:', err);
        return;
    }
    console.log('Terhubung ke database MySQL!');
});

// 4. Membuat "Route" atau Alamat API
// Ketika browser memanggil http://localhost:3000/api/currencies
app.get('/api/currencies', (req, res) => {
    const sql = "SELECT * FROM currencydb"; // GANTI dengan nama tabel Anda
    
    db.query(sql, (err, results) => {
        if (err) return res.status(500).json({ error: err.message });
        res.json(results); // Kirim data hasil query ke browser
    });
});

// 5. Jalankan Server
app.listen(port, () => {
    console.log(`Server berjalan di http://localhost:${port}`);
});