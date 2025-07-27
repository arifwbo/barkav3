<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>

<?php 
// Get current URI segments for breadcrumb
$uri_segments = $this->uri->segment_array();
$breadcrumbs = array();

// Always add home
$breadcrumbs[] = array('title' => 'Beranda', 'url' => site_url());

// If not on home page, add current page info
if (!empty($uri_segments)) {
    $current_segment = end($uri_segments);
    
    // Generate breadcrumb based on current page
    if (isset($page_title) && $page_title) {
        $breadcrumbs[] = array('title' => $page_title, 'url' => '');
    } else {
        // Fallback to generate from URI
        $title = ucwords(str_replace('-', ' ', $current_segment));
        $breadcrumbs[] = array('title' => $title, 'url' => '');
    }
}
?>

<?php if (count($breadcrumbs) > 1): ?>
<nav class="container my-4" aria-label="Breadcrumb">
    <ol class="flex items-center space-x-2 text-sm font-medium text-gray-600 bg-white rounded-lg shadow-sm px-4 py-3">
        <?php foreach ($breadcrumbs as $index => $breadcrumb): ?>
            <li class="flex items-center">
                <?php if ($index > 0): ?>
                    <svg class="w-4 h-4 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                <?php endif; ?>
                
                <?php if ($breadcrumb['url']): ?>
                    <a href="<?= $breadcrumb['url'] ?>" 
                       class="text-primary hover:text-primary-dark focus:text-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 rounded transition duration-200">
                        <?= $breadcrumb['title'] ?>
                    </a>
                <?php else: ?>
                    <span class="text-gray-800 font-semibold" aria-current="page">
                        <?= $breadcrumb['title'] ?>
                    </span>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ol>
</nav>
<?php endif; ?>