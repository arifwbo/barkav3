<footer class="bg-primary bg-gradient-to-r from-primary-color to-primary-dark border-t-4 border-tertiary text-white shadow-xl" role="contentinfo">
    <div class="container text-center pt-4 pb-5 flex flex-col lg:flex-row justify-between items-center gap-3 animate-fade-in">
    <span class="text-sm">
      Hak cipta &copy; <?= date('Y') ?> - <a href="<?= site_url() ?>" class="hover:text-accent-color focus:text-accent-color focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-primary rounded transition">
        <?= __session('school_name') ?>
      </a>.
      <a href="https://github.com/dikisiswanto/barka" target="_blank" rel="noopener" class="hover:text-accent-color focus:text-accent-color focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-primary rounded transition">
        Tema Barka <?= THEME_VERSION ?>
      </a>
      oleh <a href="https://silirdev.com" target="_blank" rel="noopener" class="hover:text-accent-color focus:text-accent-color focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-primary rounded transition">
        silirdev
      </a>
    </span>
        <span class="text-xs opacity-80">Diberdayakan oleh <a href="https://sekolahku.web.id" target="_blank" rel="noopener" class="underline decoration-accent-color hover:text-accent-color focus:text-accent-color focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-primary rounded transition">sekolahku.web.id</a></span>
    </div>
</footer>