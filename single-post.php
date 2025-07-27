<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>

<script>
  let page = 1;
  const totalPage = <?= $total_page ?>;

  $(document).ready(function() {
    if (parseInt(totalPage) == page || parseInt(totalPage) == 0) {
      $('.more-comments').remove();
    }
  });

  function get_post_comments() {
    page++;
    const data = {
      page_number: page,
      comment_post_id: <?= $this->uri->segment(2) ?>
    };
    if ( page <= parseInt(totalPage) ) {
      $.post( _BASE_URL + 'public/post_comments/get_post_comments', data, function( response ) {
        const res = _H.StrToObject( response );
        const rows = res.comments;
        let html = '';
        for (const z in rows) {
          const row = rows[ z ];
          html = `<div class="bg-white px-5 py-4 shadow space-y-2 border comment">
              <blockquote class="italic">"${row.comment_content}"</blockquote>
              <div class="text-xs space-x-3">
                <span><i class="fa fa-calendar-o fa-sm mr-1 text-secondary"></i> ${row.created_at.substr(8, 2)} ${row.created_at.substr(5, 2)} ${row.created_at.substr(0, 4)}</span>
                <span><i class="fa fa-user fa-sm mr-1 text-secondary"></i> ${row.comment_author}</span>
              </div>
            </div>`;
        }
        const elementId = $(".comment:last");
        $( html ).insertAfter( elementId );
        if ( page == parseInt(totalPage) ) $('.more-comments').remove();
      });
    }
  }
</script>

<main class="container space-y-5 my-5 flex-1">
  <div class="flex flex-col lg:flex-row items-start gap-x-6 relative space-y-5 lg:space-y-0">
    <article class="w-full lg:w-2/3 space-y-6">
      <header class="card">
        <h1 class="text-title text-3xl lg:text-4xl font-bold font-heading leading-tight mb-4"><?= $query->post_title ?></h1>
        
        <div class="flex flex-wrap gap-4 text-sm text-muted border-b border-gray-200 pb-4">
          <div class="flex items-center space-x-2">
            <div class="w-8 h-8 bg-gradient-to-r from-primary-color to-accent-color rounded-full flex items-center justify-center">
              <i class="fa fa-calendar text-white text-xs"></i>
            </div>
            <span><?=day_name(date('N', strtotime($query->created_at))) ?>, <?=indo_date(substr($query->created_at, 0, 10)) ?></span>
          </div>
          
          <div class="flex items-center space-x-2">
            <div class="w-8 h-8 bg-gradient-to-r from-primary-color to-accent-color rounded-full flex items-center justify-center">
              <i class="fa fa-user text-white text-xs"></i>
            </div>
            <span><?= $post_author ?></span>
          </div>
          
          <div class="flex items-center space-x-2">
            <div class="w-8 h-8 bg-gradient-to-r from-primary-color to-accent-color rounded-full flex items-center justify-center">
              <i class="fa fa-comments text-white text-xs"></i>
            </div>
            <span><?= $post_comments->num_rows() ?> komentar</span>
          </div>
        </div>

        <?php if($tag = $query->post_tags) : ?>
        <div class="flex flex-wrap gap-2 mt-4">
          <?php $post_tags = explode(',', $tag) ?>
          <?php foreach($post_tags as $tag) : ?>
            <a href="<?= site_url('tag/'.url_title(strtolower(trim($tag)))) ?>" 
               class="inline-block px-3 py-1 bg-gray-100 hover:bg-primary-color hover:text-white rounded-full text-sm transition-colors duration-300">
              #<?= ucwords(trim($tag)) ?>
            </a>
          <?php endforeach ?>
        </div>
        <?php endif ?>
      </header>

      <?php if($post_type == 'post' && is_file('./media_library/posts/large/'.$query->post_image)) : ?>
        <div class="card">
          <img src="<?= base_url('media_library/posts/large/'.$query->post_image) ?>" 
               alt="<?= $query->post_title ?>" 
               class="w-full h-auto rounded-lg shadow-lg">
        </div>
      <?php endif ?>

      <div class="card">
        <div class="content prose prose-lg max-w-none">
          <?= $query->post_content ?>
        </div>
      </div>


      <div class="card">
        <h3 class="font-bold text-lg mb-4 flex items-center">
          <i class="fa fa-share-alt mr-2 text-primary-color"></i>
          Bagikan artikel ini
        </h3>
        <div class="flex space-x-3">
          <a href="http://www.facebook.com/sharer.php?u=<?= site_url('read/'.$query->id.'/'.$query->post_slug) ?>" 
             target="_blank" rel="noopener" 
             class="social-icon bg-blue-600 hover:bg-blue-700">
            <i class="fa fa-facebook text-white"></i>
          </a>
          <a href="http://twitter.com/share?url=<?= site_url('read/'.$query->id.'/'.$query->post_slug) ?>" 
             target="_blank" rel="noopener" 
             class="social-icon bg-blue-400 hover:bg-blue-500">
            <i class="fa fa-twitter text-white"></i>
          </a>
          <a href="https://telegram.me/share/url?url=<?= site_url('read/'.$query->id.'/'.$query->post_slug) ?>" 
             target="_blank" rel="noopener" 
             class="social-icon bg-blue-500 hover:bg-blue-600">
            <i class="fa fa-telegram text-white"></i>
          </a>
          <a href="https://api.whatsapp.com/send?text=<?= site_url('read/'.$query->id.'/'.$query->post_slug) ?>" 
             target="_blank" rel="noopener" 
             class="social-icon bg-green-500 hover:bg-green-600">
            <i class="fa fa-whatsapp text-white"></i>
          </a>
        </div>
      </div>

      <?php if($post_comments->num_rows() > 0) : ?>
        <section class="card">
          <h4 class="text-xl font-bold font-heading mb-6 flex items-center">
            <i class="fa fa-comments mr-2 text-primary-color"></i>
            <?= $post_comments->num_rows() ?> Komentar
          </h4>
          <div class="space-y-4">
            <?php foreach($post_comments->result() as $comment) : ?>  
              <div class="bg-gray-50 p-4 rounded-lg comment group">
                <blockquote class="text-gray-700 italic mb-3 leading-relaxed">
                  "<?=strip_tags($comment->comment_content) ?>"
                </blockquote>
                <div class="flex items-center space-x-4 text-sm text-muted">
                  <div class="flex items-center space-x-2">
                    <i class="fa fa-calendar-o text-primary-color"></i>
                    <span><?=date('d M Y H:i', strtotime($comment->created_at)) ?></span>
                  </div>
                  <div class="flex items-center space-x-2">
                    <i class="fa fa-user text-primary-color"></i>
                    <span class="font-medium"><?= $comment->comment_author ?></span>
                  </div>
                </div>
                
                <?php if(! empty($comment->comment_reply)) : ?>
                  <div class="mt-4 ml-6 p-3 bg-blue-50 border-l-4 border-primary-color rounded">
                    <div class="text-sm text-gray-600 mb-1">
                      <i class="fa fa-reply text-primary-color mr-1"></i>
                      <span class="font-medium">Balasan:</span>
                    </div>
                    <blockquote class="text-gray-700 italic">
                      "<?=strip_tags($comment->comment_reply) ?>"
                    </blockquote>
                  </div>
                <?php endif ?>
              </div>
            <?php endforeach ?>
          </div>
          <div class="text-center mt-6">
            <button type="button" onclick="get_post_comments()" class="btn more-comments">
              <i class="fa fa-refresh"></i> 
              <span>Komentar Lainnya</span>
            </button>
          </div>
        </section>
      <?php endif ?>

      <?php if((
            $query->post_comment_status == 'open' &&
            __session('comment_registration') == 'true' &&
            $this->auth->hasLogin()
          ) ||
          (
            $query->post_comment_status == 'open' &&
            __session('comment_registration') == 'false'
          )) : ?>

        <form action="" class="space-y-2 py-5" method="POST">
          <h4 class="text-lg font-bold font-heading">Beri Komentar</h4>
          <div class="flex flex-col lg:flex-row">
            <label for="comment_author" class="lg:w-1/4 pt-1">Nama Lengkap <span style="color: red">*</span></label>
            <div class="lg:w-3/4">
              <input type="text" class="form-input w-full" id="comment_author" name="comment_author">
            </div>
          </div>
          <div class="flex flex-col lg:flex-row">
            <label for="comment_email" class="lg:w-1/4 pt-1">Email <span style="color: red">*</span></label>
            <div class="lg:w-3/4">
              <input type="text" class="form-input w-full" id="comment_email" name="comment_email">
            </div>
          </div>
          <div class="flex flex-col lg:flex-row">
            <label for="comment_url" class="lg:w-1/4 pt-1">URL</label>
            <div class="lg:w-3/4">
              <input type="text" class="form-input w-full" id="comment_url" name="comment_url">
            </div>
          </div>
          <div class="flex flex-col lg:flex-row">
            <label for="comment_content" class="lg:w-1/4 pt-1">Komentar <span style="color: red">*</span></label>
            <div class="lg:w-3/4">
              <textarea class="form-textarea w-full" id="comment_content" name="comment_content" rows="4"></textarea>
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
          <input type="hidden" name="comment_post_id" id="comment_post_id" value="<?= $this->uri->segment(2) ?>" class="hidden w-0">
          <div class="flex flex-col lg:flex-row pt-3">
            <span class="lg:w-1/4">
            </span>
            <button type="submit" onclick="post_comments(); return false;" class="bg-secondary opacity-80 transition duration-100 hover:opacity-100 text-white rounded py-2 px-5"><i class="fa fa-send mr-2"></i> Kirim</button>
          </div>
        </form>
      <?php endif ?>

      <?php if($query->post_type == 'post') : ?>
        <?php $posts = get_related_posts($query->post_categories, $this->uri->segment(2), 5) ?>
        <?php if($posts->num_rows() > 0) : ?>
          <div class="py-5">
            <h3 class="font-heading text-lg lg:text-xl font-bold py-2">Artikel Terkait</h3>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
              <?php foreach($posts->result() as $post) : ?>
                <div class="space-y-2">
                  <a href="<?= site_url('read/'.$post->id.'/'.$post->post_slug) ?>" class="block h-48 max-w-full flex-shrink-0 bg-gray-300 flex items-center justify-center">
                    <?php $post_image = 'media_library/posts/medium/'.$post->post_image; ?>
                    <?php $poster = is_file('./'.$post_image) ? base_url($post_image) : base_url('media_library/images/'. __session('logo')) ?>
                    <?php $poster_class = is_file('./'.$post_image) ? 'w-full object-cover object-center h-inherit' : 'w-16' ?>
                    <img src="<?= $poster ?>" alt="<?= $post->post_title ?>" class="<?= $poster_class ?>">
                  </a>
                  <a href="<?= site_url('read/'.$post->id.'/'.$post->post_slug) ?>" class="block hover:text-secondary">
                    <h4 class="lg:text-lg font-heading font-bold"><?= $post->post_title ?></h4>
                    <p class="text-sm"><?=day_name(date('N', strtotime($post->created_at))) ?>, <?=indo_date(date('Y-m-d', strtotime($post->created_at))) ?></p>
                  </a>
                </div>
              <?php endforeach ?>
            </div>
          </div>
        <?php endif ?>
      <?php endif ?>
    </article>
    <div class="w-full lg:w-1/3 space-y-5">
      <?php $this->load->view(THEME_PATH . 'components/sidebar') ?>
    </div>
  </div>
</main>