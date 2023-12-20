<?php
class Produk
{
    private $dbh;

    // Konstruktor menerima koneksi database dan menyimpannya dalam properti $dbh
    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }

    // Mengambil semua data dari tabel 'produk' dalam database
    public function getAllProduk()
    {
        $sql = "SELECT * FROM produk";
        $rs = $this->dbh->query($sql);
        return $rs;
    }

    // Mengambil semua data dari tabel 'jenis_produk' dalam database
    public function getAllJenisProduk()
    {
        $sql = "SELECT * FROM jenis_produk";
        $rs = $this->dbh->query($sql);
        return $rs;
    }

    // Mengambil data produk beserta jenis produk dengan melakukan JOIN antara tabel 'produk' dan 'jenis_produk'
    public function getProdukAndJenis()
    {
        $sql = "SELECT p.*, j.nama AS nama_jenis FROM produk p JOIN jenis_produk j ON p.jenis_produk_id = j.id";
        $rs = $this->dbh->query($sql);
        return $rs;
    }

    // Menyimpan data produk baru ke dalam tabel 'produk' dengan menggunakan parameter yang diterima
    public function saveProduk($nama, $qty, $harga, $jenis_produk_id)
    {
        $sql = "INSERT INTO produk (nama, qty, harga, jenis_produk_id) VALUES (:nama, :qty, :harga, :jenis_produk_id)";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':qty', $qty);
        $stmt->bindParam(':harga', $harga);
        $stmt->bindParam(':jenis_produk_id', $jenis_produk_id);

        return $stmt->execute();
    }

    // Menghapus data produk dari tabel 'produk' berdasarkan ID yang diberikan
    public function deleteProduk($id)
    {
        $sql = "DELETE FROM produk WHERE id = :id";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    // Mengambil data produk dari tabel 'produk' berdasarkan ID yang diberikan
    public function getProdukById($id)
    {
        $sql = "SELECT * FROM produk WHERE id = :id";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Memperbarui data produk dalam tabel 'produk' berdasarkan ID dengan menggunakan parameter yang diterima
    public function updateProduk($id, $nama, $qty, $harga, $jenis_produk_id)
    {
        $sql = "UPDATE produk SET nama = :nama, qty = :qty, harga = :harga, jenis_produk_id = :jenis_produk_id WHERE id = :id";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':qty', $qty);
        $stmt->bindParam(':harga', $harga);
        $stmt->bindParam(':jenis_produk_id', $jenis_produk_id);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}
