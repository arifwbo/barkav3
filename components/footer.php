<footer class="bg-primary border-t-4 border-tertiary text-white shadow-xl" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);">
    <div class="container text-center pt-4 pb-5 flex flex-col lg:flex-row justify-between items-center gap-3 animate-fade-in">
    <span class="text-sm">
      Hak cipta &copy; <?= date('Y') ?> - <a href="<?= site_url() ?>" class="hover:text-yellow-300 transition duration-300"><?= __session('school_name') ?></a>.
      <a href="https://github.com/dikisiswanto/barka" target="_blank" rel="noopener" class="hover:text-yellow-300 transition duration-300">Tema Barka <?= THEME_VERSION ?></a>
      oleh <a href="https://silirdev.com" target="_blank" rel="noopener" class="hover:text-yellow-300 transition duration-300">silirdev</a>
    </span>
        <span class="text-xs opacity-80">Diberdayakan oleh <a href="https://sekolahku.web.id" target="_blank" rel="noopener" class="underline decoration-yellow-300 hover:text-yellow-300 transition duration-300">sekolahku.web.id</a></span>
    </div>
</footer>