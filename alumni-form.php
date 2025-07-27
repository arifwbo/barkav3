<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>

<script>
  $(document).ready(function () {
    $('[data-toggle="datepicker"]').datepicker({
      format: 'yyyy-mm-dd'
    });
  })
</script>
<main class="container space-y-8 my-8">
  <div class="card">
    <h1 class="text-title text-3xl font-bold font-heading mb-2"><?= ucwords($page_title) ?></h1>
    <p class="text-muted mb-6">Daftarkan diri Anda sebagai alumni untuk tetap terhubung dengan sekolah</p>
    
    <form class="space-y-6">
      <div class="bg-gradient-to-r from-primary-color to-accent-color text-white p-6 rounded-xl mb-8">
        <h2 class="text-xl font-bold mb-2">
          <i class="fa fa-graduation-cap mr-2"></i>
          Formulir Pendaftaran Alumni
        </h2>
        <p class="text-blue-100">Lengkapi data berikut untuk mendaftar sebagai alumni</p>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="form-group">
          <input type="text" class="form-input w-full" id="full_name" name="full_name" placeholder=" " required>
          <label for="full_name">Nama Lengkap <span class="text-red-500">*</span></label>
        </div>

        <div class="form-group">
          <?= form_dropdown('gender', ['' => 'Pilih jenis kelamin', 'M' => 'Laki-laki', 'F' => 'Perempuan'], '', 'class="form-select w-full" id="gender" required') ?>
          <label for="gender">Jenis Kelamin <span class="text-red-500">*</span></label>
        </div>
      </div>

      <div class="form-group">
        <input type="text" readonly class="form-input w-full date" id="birth_date" name="birth_date" data-toggle="datepicker" placeholder=" " required>
        <label for="birth_date">Tanggal Lahir <span class="text-red-500">*</span></label>
      </div>
          <div class="absolute top-1/2 right-0 mr-3 transform -translate-y-1/2">
            <span class="btn btn-sm btn-outline-secondary rounded-0"><i class="fa fa-calendar text-dark"></i></span>
          </div>
        </div>
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="end_date" class="lg:w-1/4 pt-1">Tahun Lulus <span style="color: red">*</span></label>
      <div class="lg:w-3/4">
        <input type="text" class="form-input w-full" id="end_date" name="end_date">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="identity_number" class="lg:w-1/4 pt-1"><?= __session('_identity_number') ?></label>
      <div class="lg:w-3/4">
        <input type="text" class="form-input w-full" id="identity_number" name="identity_number">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="street_address" class="lg:w-1/4 pt-1">Alamat <span style="color: red">*</span></label>
      <div class="lg:w-3/4">
        <textarea rows="5" class="form-textarea w-full" id="street_address" name="street_address"></textarea>
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="email" class="lg:w-1/4 pt-1">Email <span style="color: red">*</span></label>
      <div class="lg:w-3/4">
        <input type="text" class="form-input w-full" id="email" name="email">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="phone" class="lg:w-1/4 pt-1">Telepon</label>
      <div class="lg:w-3/4">
        <input type="text" class="form-input w-full" id="phone" name="phone">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="mobile_phone" class="lg:w-1/4 pt-1">Handphone</label>
      <div class="lg:w-3/4">
        <input type="text" class="form-input w-full" id="mobile_phone" name="mobile_phone">
      </div>
    </div>
    <div class="flex flex-col lg:flex-row">
      <label for="file" class="lg:w-1/4 pt-1">Foto</label>
      <div class="lg:w-3/4">
        <input type="file" id="photo" name="photo">
        <small class="form-text text-muted">Foto harus JPG dan ukuran file maksimal 1 Mb</small>
      </div>
    </div>
    <?php if (NULL !== __session('recaptcha_status') && __session('recaptcha_status') == 'enable') : ?>
    <div class="flex flex-col lg:flex-row">
      <label class="lg:w-1/4 pt-1"></label>
      <div class="lg:w-3/4">
        <div class="g-recaptcha" data-sitekey="<?= $recaptcha_site_key ?>"></div>
      </div>
    </div>
    <?php endif ?>
    <div class="flex flex-col lg:flex-row pt-3">
      <span class="lg:w-1/4"></span>
      <button type="button" onclick="alumni_registration(); return false;" class="bg-secondary opacity-80 transition duration-100 hover:opacity-100 text-white rounded py-2 px-5"><i class="fa fa-send"></i> Kirim</button>
    </div>
  </form>
</main>