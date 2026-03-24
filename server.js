// node server.js

const express = require('express');
const mysql = require('mysql');
const cors = require('cors');

const app = express();
const port = 3000;

app.use(cors());
app.use(express.json());

const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'currency-app'
});

db.connect((err) => {
    if (err) {
        console.error('Gagal koneksi ke MySQL:', err);
        return;
    }
    console.log('Terhubung ke database MySQL!');
});

app.get('/api/currencies', (req, res) => {
    const sql = "SELECT * FROM currencydb";
    
    db.query(sql, (err, results) => {
        if (err) return res.status(500).json({ error: err.message });
        res.json(results);
    });
});

app.listen(port, () => {
    console.log(`Server berjalan di http://localhost:${port}`);
});