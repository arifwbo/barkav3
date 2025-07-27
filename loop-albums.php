<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>

<script type="text/javascript">
  let page = 1;
  const total_page = "<?= $total_page ?>";
  $(document).ready(function() {
    if (parseInt(total_page) == page || parseInt(total_page) == 0) {
      $('.more-albums').remove();
    }
  });
  function get_albums() {
    page++;
    const data = {
      page_number: page
    };
    if ( page <= parseInt(total_page) ) {
      _H.Loading( true );
      $.post( _BASE_URL + 'public/gallery_photos/get_albums', data, function( response ) {
        _H.Loading( false );
        const res = response;
        const rows = res.rows;
        let html = '';
        for (var z in rows) {
          const row = rows[ z ];
          const template = `
          <figure class="card album animate-fade-in group cursor-pointer" onclick="photo_preview(${row.id})">
            <div class="relative overflow-hidden rounded-lg mb-4">
              <img src="${_BASE_URL}media_library/albums/${row.album_cover}" 
                   alt="${row.album_title}" 
                   class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-110"
                   loading="lazy">
              <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
              <div class="absolute bottom-4 left-4 right-4 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <i class="fa fa-search text-2xl"></i>
              </div>
            </div>
            <figcaption class="text-center">
              <h3 class="font-semibold text-lg text-gray-800 group-hover:text-primary-color transition-colors duration-300">
                ${row.album_title}
              </h3>
            </figcaption>
          </figure>
          `;
          html += template;
        }
        var elementId = $(".album:last");
        $( html ).insertAfter( elementId );
        if (page == parseInt(total_page)) $('.more-albums').remove();
      });
    }
  }
</script>

<main class="container space-y-5 my-5 flex-1">
  <h1 class="text-title text-2xl font-bold font-heading"><?= $page_title ?></h1>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    <?php foreach($query->result() as $album) : ?>
      <figure class="card album animate-fade-in group cursor-pointer" onclick="photo_preview(<?= $album->id ?>)">
        <div class="relative overflow-hidden rounded-lg mb-4">
          <img src="<?= base_url('media_library/albums/'.$album->album_cover) ?>" 
               alt="<?= $album->album_title ?>" 
               class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-110"
               loading="lazy">
          <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          <div class="absolute bottom-4 left-4 right-4 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            <i class="fa fa-search text-2xl"></i>
          </div>
        </div>
        <figcaption class="text-center">
          <h3 class="font-semibold text-lg text-gray-800 group-hover:text-primary-color transition-colors duration-300">
            <?= $album->album_title ?>
          </h3>
        </figcaption>
      </figure>
    <?php endforeach ?>
  </div>
  <div class="text-center mt-8">
    <button type="button" onclick="get_albums(); return false;" class="btn more-albums">
      <i class="fa fa-refresh"></i> 
      <span>Tampilkan Lebih Banyak</span>
    </button>
  </div>
</main>