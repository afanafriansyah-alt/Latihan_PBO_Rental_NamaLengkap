<?php
/**
 * Kelas Database
 * Menangani koneksi ke database MySQL menggunakan PDO
 */

class Database {
    // Properti untuk konfigurasi koneksi database
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $db_name = 'DB_SIMULASI_PBO_KELAS_NamaLengkap';
    
    /**
     * Metode getConnection()
     * Membuat dan mengembalikan koneksi PDO ke database
     * Menangani error menggunakan try-catch dengan PDOException
     * 
     * @return PDO|null Mengembalikan objek koneksi PDO atau null jika gagal
     */
    public function getConnection() {
        try {
            // Membuat DSN (Data Source Name) untuk koneksi MySQL
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name . ';charset=utf8mb4';
            
            // Membuat koneksi PDO dengan error mode exception
            $connection = new PDO($dsn, $this->username, $this->password);
            
            // Mengatur error mode untuk menampilkan exception
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            return $connection;
        } 
        catch (PDOException $e) {
            // Menangani error koneksi database
            echo 'Error Koneksi Database: ' . $e->getMessage();
            return null;
        }
    }
}
?>
