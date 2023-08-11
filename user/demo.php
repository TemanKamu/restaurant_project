<!-- Input tanggal -->
<input type="date" id="tanggal" name="tanggal">

<!-- Daftar jam -->

    <?php
    $dataJam = array("11:00-12:45", "13:00-14:45", "17:30-19:00", "19:15-20:45");

    foreach ($dataJam as $index => $jam) {
      $id = "radio" . ($index + 1);
      $label = $jam;
    ?>
    <div class="col-lg-6 col-6">
        <div class="card">
            <input type="radio" class="times time<?php echo $index + 1; ?>" id="<?php echo $id; ?>" name="radio" value="<?php echo $label; ?>" disabled>
            <label for="<?php echo $id; ?>">
                <h5 id="times-option<?php echo $index + 1; ?>"><?php echo $label; ?></h5>
            </label>
        </div>
    </div>
    <?php } ?>
  

<!-- Daftar meja -->
<div class="col-lg-6 col-6">
  <div class="card">
    <select id="meja" name="meja" disabled>
      <option value="">Choose seat</option>
    </select>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // Menonaktifkan input jam secara default
    $('input[name="radio"]').prop('disabled', true);

    // Ketika tanggal berubah
    $('#tanggal').change(function() {
      // Menghapus atribut disabled pada input jam
      $('input[name="radio"]').removeAttr('disabled');

      // Menonaktifkan daftar meja
      $('#meja').prop('disabled', true).html('<option value="">Choose seat</option>');
    });

    // Ketika jam berubah
    $('input[name="radio"]').change(function() {
      var jamSelect = $(this).val();
      var tanggalSelect = $('#tanggal').val();

      // Ajax request untuk mendapatkan daftar meja
      $.ajax({
        url: 'validasi-ajax.php',
        type: 'GET',
        data: {
          tanggal: tanggalSelect,
          jam: jamSelect
        },
        success: function(response) {
          var options = response.optionsMeja;
          $('#meja').html(options).prop('disabled', false);
          console.log(jamSelect);
          console.log(tanggalSelect);
          console.log(options);
        },
        error: function(xhr, status, error) {
          console.log(error); // Menampilkan pesan kesalahan ke konsol
          console.log(status);
          console.log(xhr);
        }
      });
    });
  });
</script>
