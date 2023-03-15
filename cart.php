<?php
  // Daftar barang beserta harganya
  $items = array(
    "semen" => array("nama" => "Semen", "harga" => 2000),
    "batu_krikil" => array("nama" => "Batu Krikil", "harga" => 3000),
    "pasir" => array("nama" => "Pasir", "harga" => 4000)
  );

  // Menghitung total harga
  $total = 0;
  $pesanans = array();
  foreach ($items as $key => $item) {
    if ($_POST[$key] > 0) {
      $total += $item["harga"] * $_POST[$key];
      $pesanans[] = array("id" => $key, "nama" => $item["nama"], "harga" => $item["harga"], "qty" => $_POST[$key]);
    }
  }

  // Proses penghapusan pesanan
  if (isset($_POST['hapus'])) {
    $hapus_id = $_POST['hapus'];
    foreach ($pesanans as $key => $pesanan) {
      if ($pesanan['id'] == $hapus_id) {
        unset($pesanans[$key]);
        $total -= $pesanan['harga'] * $pesanan['qty'];
      }
    }
    $pesanans = array_values($pesanans); // Mengatur ulang indeks array
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
  <div class="container mt-5">
    <h2 class="mb-4">Detail Pesanan</h2>
    <a href="index.php">back to Belanja lagi</a>

    <form method="post">
      <table class="table">
        <thead>
          <tr>
            <th>Barang</th>
            <th>Harga</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pesanans as $pesanan) { ?>
            <tr>
              <td><?php echo $pesanan["nama"]; ?></td>
              <td>Rp. <?php echo number_format($pesanan["harga"]); ?></td>
              <td>
                <select name="<?php echo $pesanan['id']; ?>" onchange="this.form.submit()">
                  <?php for ($i=1; $i<=10; $i++) { ?>
                                   <option value="<?php echo $i; ?>" <?php if ($i==$pesanan['qty']) echo 'selected'; ?>><?php echo $i; ?></option>
              <?php } ?>
            </select>
          </td>
          <td>Rp. <?php echo number_format($pesanan["harga"] * $pesanan["qty"]); ?></td>
          <td>
            <button type="submit" class="btn btn-danger btn-sm" name="hapus" value="<?php echo $pesanan['id']; ?>">Hapus</button>
          </td>
        </tr>
      <?php } ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="3" class="text-right"><strong>Total:</strong></td>
        <td colspan="2">Rp. <?php echo number_format($total); ?></td>
      </tr>
    </tfoot>
  </table>
</form>


  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0
