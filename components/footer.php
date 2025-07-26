<!-- CUSTOMIZABLE SECTION: Footer branding and credits -->
<footer class="bg-gradient-to-r from-primary-blue to-primary-dark border-t-4 border-status-warning text-white shadow-xl">
    <div class="container text-center pt-6 pb-6 flex flex-col lg:flex-row justify-between items-center gap-4 animate-fade-in">
        <div class="flex flex-col lg:flex-row items-center gap-4">
            <span class="text-sm font-medium">
                Hak cipta &copy; <?= date('Y') ?> - 
                <a href="<?= site_url() ?>" class="hover:text-status-warning transition-colors duration-300 font-semibold">
                    <?= __session('school_name') ?>
                </a>
            </span>
            <div class="flex items-center gap-2 text-xs opacity-90">
                <span class="fa fa-code"></span>
                <span>
                    <a href="https://github.com/dikisiswanto/barka" target="_blank" rel="noopener" 
                       class="hover:text-status-warning transition-colors duration-300">
                        Tema Barka <?= THEME_VERSION ?>
                    </a>
                    oleh 
                    <a href="https://silirdev.com" target="_blank" rel="noopener" 
                       class="hover:text-status-warning transition-colors duration-300 underline">
                        silirdev
                    </a>
                </span>
            </div>
        </div>
        
        <div class="flex flex-col items-center gap-2">
            <span class="text-xs opacity-80 flex items-center gap-2">
                <span class="fa fa-rocket"></span>
                Diberdayakan oleh 
                <a href="https://sekolahku.web.id" target="_blank" rel="noopener" 
                   class="underline decoration-status-warning hover:text-status-warning transition-colors duration-300 font-medium">
                    sekolahku.web.id
                </a>
            </span>
            <div class="flex items-center gap-2 text-xs">
                <span class="fa fa-palette"></span>
                <span class="opacity-70">Modern Dark Blue Theme</span>
            </div>
        </div>
    </div>
</footer>