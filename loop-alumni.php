<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<script type="text/javascript">
let page = 1;
const total_page = "<?= $total_page ?>";
$(document).ready(function() {
  if (parseInt(total_page) == page || parseInt(total_page) == 0) {
    $('.more-alumni').remove();
  }
});

function get_alumni() {
  page++;
  var data = {
    page_number: page
  };
  if ( page <= parseInt(total_page) ) {
    _H.Loading( true );
    $.post( _BASE_URL + 'public/alumni_directory/get_alumni', data, function( response ) {
      _H.Loading( false );
      const res = response;
      const rows = res.rows;
      let html = '';
      let no = parseInt($('.number:last').text()) + 1;
      for (var z in rows) {
        const row = rows[ z ];
        const template = `
        <div class="profile-alumni group animate-fade-in">
          <div class="flex flex-col items-center text-center space-y-4">
            <div class="relative">
              <img src="${row.photo}" class="w-24 h-24 lg:w-32 lg:h-32 object-cover rounded-full border-4 border-white shadow-lg group-hover:scale-105 transition-transform duration-300" loading="lazy">
              <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-gradient-to-r from-primary-color to-accent-color rounded-full flex items-center justify-center">
                <i class="fa fa-graduation-cap text-white text-sm"></i>
              </div>
            </div>
            <div class="space-y-3 w-full">
              <h3 class="font-bold text-lg text-primary-color">${row.full_name}</h3>
              <dl class="grid grid-cols-1 gap-2 text-sm">
                <div class="bg-gray-50 p-3 rounded-lg">
                  <dt class="text-muted text-xs uppercase tracking-wide">${_IDENTITY_NUMBER}</dt>
                  <dd class="font-medium text-gray-800">${row.identity_number}</dd>
                </div>
                <div class="bg-gray-50 p-3 rounded-lg">
                  <dt class="text-muted text-xs uppercase tracking-wide">Jenis Kelamin</dt>
                  <dd class="font-medium text-gray-800">${row.gender}</dd>
                </div>
                <div class="bg-gray-50 p-3 rounded-lg">
                  <dt class="text-muted text-xs uppercase tracking-wide">Tempat, Tanggal Lahir</dt>
                  <dd class="font-medium text-gray-800">${row.birth_place}, ${row.birth_date}</dd>
                </div>
                <div class="bg-gray-50 p-3 rounded-lg">
                  <dt class="text-muted text-xs uppercase tracking-wide">Periode</dt>
                  <dd class="font-medium text-gray-800">${row.start_date} - ${row.end_date}</dd>
                </div>
              </dl>
            </div>
          </div>
        </div>
        `;
        html += template;
      }
      var elementId = $(".profile-alumni:last");
      $( html ).insertAfter( elementId );
      if ( page == parseInt(total_page) ) $('.more-alumni').remove();
    });
  }
}
</script>

<main class="container space-y-5 my-5 flex-1">
  <div class="space-y-4">
    <h1 class="font-heading text-2xl font-black text-title"><span class="fa fa-bar"></span> <?= ucwords($page_title) ?></h1>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
      <?php foreach($query->result() as $row) : ?>
        <div class="profile-alumni group animate-fade-in">
          <div class="flex flex-col items-center text-center space-y-4">
            <div class="relative">
              <?php
              $photo = 'no-image.png';
              if ($row->photo && is_file($_SERVER['DOCUMENT_ROOT'] . '/media_library/students/'.$row->photo)) {
                $photo = $row->photo;
              }
              echo '<img src="' . base_url('media_library/students/'.$photo).'" class="w-24 h-24 lg:w-32 lg:h-32 object-cover rounded-full border-4 border-white shadow-lg group-hover:scale-105 transition-transform duration-300" loading="lazy">';
              ?>
              <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-gradient-to-r from-primary-color to-accent-color rounded-full flex items-center justify-center">
                <i class="fa fa-graduation-cap text-white text-sm"></i>
              </div>
            </div>
            <div class="space-y-3 w-full">
              <h3 class="font-bold text-lg text-primary-color"><?= $row->full_name ?></h3>
              <dl class="grid grid-cols-1 gap-2 text-sm">
                <div class="bg-gray-50 p-3 rounded-lg">
                  <dt class="text-muted text-xs uppercase tracking-wide"><?= __session('_identity_number') ?></dt>
                  <dd class="font-medium text-gray-800"><?= $row->identity_number ?></dd>
                </div>

                <div class="bg-gray-50 p-3 rounded-lg">
                  <dt class="text-muted text-xs uppercase tracking-wide">Jenis Kelamin</dt>
                  <dd class="font-medium text-gray-800"><?= $row->gender ?></dd>
                </div>

                <div class="bg-gray-50 p-3 rounded-lg">
                  <dt class="text-muted text-xs uppercase tracking-wide">Tempat, Tanggal Lahir</dt>
                  <dd class="font-medium text-gray-800"><?= $row->birth_place ?>, <?= indo_date($row->birth_date) ?></dd>
                </div>

                <div class="bg-gray-50 p-3 rounded-lg">
                  <dt class="text-muted text-xs uppercase tracking-wide">Periode</dt>
                  <dd class="font-medium text-gray-800"><?= $row->start_date ?> - <?= $row->end_date ?></dd>
                </div>
              </dl>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach ?>
    </div>
    <div class="text-center">
      <button type="button" onclick="get_alumni()" class="btn more-alumni">
        <i class="fa fa-refresh"></i> 
        <span>Tampilkan Lebih Banyak</span>
      </button>
    </div>
  </div>
</main>
