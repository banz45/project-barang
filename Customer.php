<?php
$username = 'root';
$password = '';
$db_name = 'customer';

$conn = mysqli_connect($host, $username, $password, $db_name);

if (!$conn) {
  die('Koneksi gagal: ' . mysqli_connect_error());
}
?>

<?php
require_once 'index.php';

// Fungsi untuk menampilkan data customer
function tampilkan_data_customer() {
  $query = "SELECT * FROM customers";
  $result = mysqli_query($conn, $query);

  while ($row = mysqli_fetch_assoc($result)) {
    echo "
      <tr>
        <td>{$row['id']}</td>
        <td>{$row['nama']}</td>
        <td>{$row['email']}</td>
        <td>{$row['alamat']}</td>
        <td>{$row['no_telp']}</td>
      </tr>
    ";
  }
}

// Fungsi untuk tambah data customer
function tambah_data_customer($nama, $email, $alamat, $no_telp) {
  $query = "INSERT INTO customers (nama, email, alamat, no_telp) VALUES ('$nama', '$email', '$alamat', '$no_telp')";
  mysqli_query($conn, $query);
}

// Fungsi untuk edit data customer
function edit_data_customer($id, $nama, $email, $alamat, $no_telp) {
  $query = "UPDATE customers SET nama = '$nama', email = '$email', alamat = '$alamat', no_telp = '$no_telp' WHERE id = '$id'";
  mysqli_query($conn, $query);
}

// Fungsi untuk hapus data customer
function hapus_data_customer($id) {
  $query = "DELETE FROM customers WHERE id = '$id'";
  mysqli_query($conn, $query);
}
?>

// index.php
<?php
require_once 'customer.php';

// Tampilkan data customer
echo "<h1>Data Customer</h1>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Nama</th><th>Email</th><th>Alamat</th><th>No. Telp</th></tr>";
tampilkan_data_customer();
echo "</table>";

// Form tambah data customer
echo "<h2>Tambah Data Customer</h2>";
echo "<form action='' method='post'>";
echo "<label>Nama:</label><input type='text' name='nama'><br>";
echo "<label>Email:</label><input type='email' name='email'><br>";
echo "<label>Alamat:</label><textarea name='alamat'></textarea><br>";
echo "<label>No. Telp:</label><input type='text' name='no_telp'><br>";
echo "<input type='submit' name='tambah' value='Tambah'>";
echo "</form>";

// Proses tambah data customer
if (isset($_POST['tambah'])) {
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $alamat = $_POST['alamat'];
  $no_telp = $_POST['no_telp'];
  tambah_data_customer($nama, $email, $alamat, $no_telp);
  header('Location: index.php');
}
?>