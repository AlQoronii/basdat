<?php


class Tanggapan
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    // Create a new tanggapan
    public function createTanggapan($id_pengaduan, $tanggal,$tanggapan, $id_petugas)
    {
        $query = "INSERT INTO tanggapan VALUES ('$id_pengaduan', '$tanggal', '$tanggapan','$id_petugas')";
        $result = odbc_exec($this->connection, $query);

        return $result;
    }

    // Read all tanggapan
    public function readAllTanggapan()
    {
        $query = "SELECT t.*, p.laporan, m.nama AS nama_masyarakat, petugas.nama_petugas
                  FROM tanggapan t
                  INNER JOIN pengaduan p ON t.id_pengaduan = p.id_pengaduan
                  INNER JOIN masyarakat m ON p.nik = m.nik
                  INNER JOIN petugas ON t.id_petugas = petugas.id_petugas
                  ORDER BY t.tgl_tanggapan DESC";

        $result = odbc_exec($this->connection, $query);

        return $result;
    }

    // Update an existing tanggapan
    public function updateTanggapan($id_tanggapan, $tanggapan)
    {
        $query = "UPDATE tanggapan SET tanggapan = '$tanggapan' WHERE id_tanggapan = '$id_tanggapan'";
        $result = odbc_exec($this->connection, $query);

        return $result;
    }

    // Delete an existing tanggapan
    public function deleteTanggapan($id_tanggapan)
    {
        $query = "DELETE FROM tanggapan WHERE id_tanggapan = '$id_tanggapan'";
        $result = odbc_exec($this->connection, $query);

        return $result;
    }

    public function addTanggapan(){
        if(isset($_POST['submit'])){
            $id_pengaduan = $_POST['id_pengaduan'];
            $id_petugas = $_POST['id_petugas'];
            $tanggal = $_POST['tanggal'];
            $tanggapan = $_POST['tanggapan'];


            $result = $this->createTanggapan($id_pengaduan, $tanggal,$tanggapan, $id_petugas);
            if($result){
                header("Location: index.php?page=aduan");
                exit();
            }
        }
    }
}
