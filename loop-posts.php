<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>

<script type="text/javascript">
  async function isUrlFound(url) {
    try {
      const response = await fetch(url, {
        method: 'HEAD',
        cache: 'no-cache'
      });

      return response.status === 200;

    } catch(error) {
      // console.log(error);
      return false;
    }
  }

  function remove_tags(input) {
    return input.replace(/(<([^>]+)>)/ig,"");
  }

  let page = 1;
  const total_page = "<?= $total_page ?>";
  $(document).ready(function() {
    if (parseInt(total_page) == page || parseInt(total_page) == 0) {
      $('button.load-more').remove();
    }
  });

  function get_posts() {
    page++;
    const segment_1 = '<?= $this->uri->segment(1) ?>';
    const segment_2 = '<?= $this->uri->segment(2) ?>';
    const segment_3 = '<?= $this->uri->segment(3) ?>';
    let url = '';
    const data = {
      'page_number': page
    };
    if (segment_1 == 'kategori') {
      data['category_slug'] = segment_2;
      url = _BASE_URL + 'public/post_categories/get_posts';
    } else if (segment_1 == 'tag') {
      data['tag'] = segment_2;
      url = _BASE_URL + 'public/post_tags/get_posts';
    } else if (segment_1 == 'arsip') {
      data['year'] = segment_2;
      data['month'] = segment_3;
      url = _BASE_URL + 'public/archives/get_posts';
    }
    _H.Loading(true);
    if ( page <= parseInt(total_page) ) {
      $.post( url, data, function( response ) {
        _H.Loading(false)
        const res = response;
        const rows = res.rows;
        const total_rows = res.total_rows;
        let html = '';
        for (const z in rows) {
          const row = rows[ z ];
          let image = `${_BASE_URL}media_library/posts/medium/${row.post_image}`;
          const isImageExist = isUrlFound(image);
          image = isImageExist ? image : '<?= base_url('media_library/images/'. __session('logo')) ?>';
          const classImage = isImageExist ? 'w-full h-48 object-cover object-center transition-transform duration-300 group-hover:scale-105' : 'w-16 h-16 mx-auto my-16';
          const date = new Date(row.created_at);
          const monthNameInID = ['Jan', 'Peb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nop', 'Des'];
          const dateVal = date.getDate();
          const monthVal = date.getMonth();
          const link = `${_BASE_URL}read/${row.id}/${row.post_slug}`;
          const template = `
          <article class="card post group animate-fade-in" data-aos="fade-up">
            <div class="flex flex-col lg:flex-row gap-6">
              <div class="w-full lg:w-5/12 flex-shrink-0 relative overflow-hidden rounded-lg">
                <img src="${image}" alt="${row.post_title}" class="${classImage}" loading="lazy">
                
                <div class="absolute top-4 left-4 bg-gradient-to-r from-primary-color to-accent-color text-white text-center rounded-lg p-3 shadow-lg">
                  <span class="block text-2xl font-bold">${dateVal}</span>
                  <span class="block text-xs uppercase tracking-wide">${monthNameInID[monthVal]}</span>
                </div>
              </div>
              
              <div class="w-full lg:w-7/12 flex flex-col justify-between space-y-4">
                <div class="space-y-3">
                  <a href="${link}" class="group-hover:text-primary-color transition-colors duration-300">
                    <h2 class="font-bold text-xl lg:text-2xl font-heading leading-tight">${row.post_title}</h2>
                  </a>
                  <p class="text-muted leading-relaxed">
                    ${remove_tags(row.post_content, '').substr(0, 165)}...
                  </p>
                </div>
                <a href="${link}" class="inline-flex items-center text-primary-color font-semibold hover:text-accent-color transition-colors duration-300">
                  Baca selengkapnya 
                  <i class="fa fa-chevron-right text-xs ml-2"></i>
                </a>
              </div>
            </div>
          </article>`;
          html += template;
        }
        const el = $(".post:last");
        $( html ).insertAfter(el);
        if (page == parseInt(total_page)) {
          $('button.load-more').remove();
        }
      });
    }
  }
</script>
<main class="container space-y-5 my-5 flex-1">
  <?php $this->load->view(THEME_PATH . 'components/newsticker') ?>

  <div class="flex flex-col lg:flex-row items-start gap-x-6 relative space-y-5 lg:space-y-0">
    <div class="w-full lg:w-2/3 space-y-4">
      <h3 class="font-heading text-2xl capitalize font-black text-title"><span class="fa fa-newspaper-o"></span> <?= ucwords($page_title) ?></h3>
      <div class="grid grid-cols-1 gap-5">
        <?php if($query->num_rows() > 0) : ?>
          <?php foreach($query->result() as $post) : ?>
            <article class="card post group animate-fade-in" data-aos="fade-up">
              <div class="flex flex-col lg:flex-row gap-6">
                <div class="w-full lg:w-5/12 flex-shrink-0 relative overflow-hidden rounded-lg">
                  <?php $post_image = 'media_library/posts/medium/'.$post->post_image; ?>
                  <?php $poster = is_file('./'.$post_image) ? base_url($post_image) : base_url('media_library/images/'. __session('logo')) ?>
                  <?php $poster_class = is_file('./'.$post_image) ? 'w-full h-48 object-cover object-center transition-transform duration-300 group-hover:scale-105' : 'w-16 h-16 mx-auto my-16' ?>
                  <?php $link = site_url('read/'.$post->id.'/'.$post->post_slug) ?>
                  <img src="<?= $poster ?>" alt="<?= $post->post_title ?>" class="<?= $poster_class ?>" loading="lazy">
                  
                  <div class="absolute top-4 left-4 bg-gradient-to-r from-primary-color to-accent-color text-white text-center rounded-lg p-3 shadow-lg">
                    <?php $date = explode('-', date('Y-m-d', strtotime($post->created_at))) ?>
                    <span class="block text-2xl font-bold"><?= $date[2] ?></span>
                    <span class="block text-xs uppercase tracking-wide"><?= substr(bulan($date[1]), 0, 3) ?></span>
                  </div>
                </div>
                
                <div class="w-full lg:w-7/12 flex flex-col justify-between space-y-4">
                  <div class="space-y-3">
                    <a href="<?= $link ?>" class="group-hover:text-primary-color transition-colors duration-300">
                      <h2 class="font-bold text-xl lg:text-2xl font-heading leading-tight"><?= $post->post_title ?></h2>
                    </a>
                    <p class="text-muted leading-relaxed">
                      <?= substr(strip_tags($post->post_content), 0, 165) ?>...
                    </p>
                  </div>
                  <a href="<?= $link ?>" class="inline-flex items-center text-primary-color font-semibold hover:text-accent-color transition-colors duration-300">
                    Baca selengkapnya 
                    <i class="fa fa-chevron-right text-xs ml-2"></i>
                  </a>
                </div>
              </div>
            </article>
          <?php endforeach ?>
        <?php endif ?>
      </div>
      <div class="text-center">
        <button class="btn load-more" data-aos="fade-up" onclick="get_posts()">
          <i class="fa fa-refresh"></i> 
          <span>Muat Artikel Selanjutnya</span>
        </button>
      </div>
    </div>

    <div class="w-full lg:w-1/3 space-y-5 ">
      <?php $this->load->view(THEME_PATH . 'components/sidebar') ?>
    </div>
  </div>
</main>
