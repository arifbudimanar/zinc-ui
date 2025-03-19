<?php

namespace ArifBudimanAr\ZincUi\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use RuntimeException;
use Symfony\Component\Process\Process;

class InstallCommand extends Command
{
    public $signature = 'zinc:install {--composer=global : Absolute path to the Composer binary which should be used to install packages}';

    public $description = 'Install the Zinc UI components';

    public function handle(): int
    {
        $this->comment('Installing Zinc UI ...');

        $this->handleLivewire();
        $this->handleUserModel();
        $this->handleAppCss();
        $this->handleFont();
        $this->handleAppJs();
        $this->handleBrandLogo();
        $this->handleVite();
        $this->handleNodePackages();
        $this->handleErrorPage();

        $this->comment('Zinc UI is installed! Love it? Star us on GitHub: https://github.com/arifbudimanar/zinc-ui');

        return self::SUCCESS;
    }

    protected function requireComposerPackages(array $packages, $asDev = false)
    {
        $composer = $this->option('composer');

        if ($composer !== 'global') {
            $command = ['php', $composer, 'require'];
        }

        $command = array_merge(
            $command ?? ['composer', 'require'],
            $packages,
            $asDev ? ['--dev'] : [],
        );

        return (new Process($command, base_path(), ['COMPOSER_MEMORY_LIMIT' => '-1']))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            }) === 0;
    }

    protected static function updateNodePackages(callable $callback, $dev = true)
    {
        if (! file_exists(base_path('package.json'))) {
            return;
        }

        $configurationKey = $dev ? 'devDependencies' : 'dependencies';

        $packages = json_decode(file_get_contents(base_path('package.json')), true);

        $packages[$configurationKey] = $callback(
            array_key_exists($configurationKey, $packages) ? $packages[$configurationKey] : [],
            $configurationKey
        );

        ksort($packages[$configurationKey]);

        file_put_contents(
            base_path('package.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }

    protected function replaceInFile($search, $replace, $path)
    {
        file_put_contents($path, str_replace($search, $replace, file_get_contents($path)));
    }

    protected function runCommands($commands)
    {
        $process = Process::fromShellCommandline(implode(' && ', $commands), null, null, null, null);

        if ('\\' !== DIRECTORY_SEPARATOR && file_exists('/dev/tty') && is_readable('/dev/tty')) {
            try {
                $process->setTty(true);
            } catch (RuntimeException $e) {
                $this->output->writeln('  <bg=yellow;fg=black> WARN </> '.$e->getMessage().PHP_EOL);
            }
        }

        $process->run(function ($type, $line) {
            $this->output->write('    '.$line);
        });
    }

    public function handleLivewire()
    {
        $this->comment('Install Livewire and Livewire Toaster ...');
        if (! $this->requireComposerPackages(['livewire/livewire:^3.6.2', 'masmerise/livewire-toaster:^2.7.0'])) {
            return 1;
        }

        $this->comment('Publish Livewire config and Livewire Toaster config ...');
        $this->runCommands(['php artisan livewire:publish --config']);
        $this->runCommands(['php artisan vendor:publish --tag=toaster-config']);
        // $this->runCommands(['php artisan vendor:publish --tag=toaster-views']);

        // $this->comment('Copying Zinc UI component ...');
        // (new Filesystem)->ensureDirectoryExists(resource_path('views'));
        // (new Filesystem)->copyDirectory(__DIR__.'/../../resources/views', resource_path('views'));

        // Copy layouts files
        $this->comment('Publish layouts files ...');
        (new Filesystem)->ensureDirectoryExists(resource_path('views/components/layouts'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../resources/views/components/layouts', resource_path('views/components/layouts'));

        // Copy paginate files
        $this->comment('Publish layouts files ...');
        (new Filesystem)->ensureDirectoryExists(resource_path('views/vendor/livewire'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../resources/views/vendor/livewire', resource_path('views/vendor/livewire'));

        // Change livewire paginate config
        $this->comment('Change livewire paginate config ...');
        $this->replaceInFile(
            "'pagination_theme' => 'tailwind'",
            "'pagination_theme' => 'zinc-ui'",
            config_path('livewire.php')
        );

        // Copy toaster file
        $this->comment('Publish toaster files ...');
        (new Filesystem)->ensureDirectoryExists(resource_path('views/vendor/toaster'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../resources/views/vendor/toaster', resource_path('views/vendor/toaster'));
    }

    public function handleErrorPage()
    {
        // Copy errors files
        $this->comment('Publish errors files ...');
        (new Filesystem)->ensureDirectoryExists(resource_path('views/errors'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../resources/views/errors', resource_path('views/errors'));
    }

    public function handleNodePackages()
    {
        $this->comment('Update NPM Package ...');
        $this->updateNodePackages(function ($packages) {
            return [
                // 'tailwindcss' => '^4.0.14',
                '@tailwindcss/forms' => '^0.5.10',
                '@tailwindcss/typography' => '^0.5.16',
                '@marcreichel/alpine-autosize' => '^1.3.3',
            ] + $packages;
        });
        $this->comment('Installing and building Node dependencies ...');
        if (file_exists(base_path('pnpm-lock.yaml'))) {
            $this->runCommands(['pnpm install', 'pnpm run build']);
        } elseif (file_exists(base_path('yarn.lock'))) {
            $this->runCommands(['yarn install', 'yarn run build']);
        } elseif (file_exists(base_path('bun.lockb'))) {
            $this->runCommands(['bun install', 'bun run build']);
        } elseif (file_exists(base_path('deno.lock'))) {
            $this->runCommands(['deno install', 'deno task build']);
        } else {
            $this->runCommands(['npm install', 'npm run build']);
        }
    }

    public function handleFont()
    {
        $filePath = resource_path('css/app.css');

        if (! File::exists($filePath)) {
            return;
        }

        $fileContent = File::get($filePath);

        $pattern = '/@theme\s*{\s*--font-sans:.*?;\s*}/s';
        $replacement = "@theme {\n    --font-sans: \"Inter\", \"Instrument Sans\", ui-sans-serif, system-ui,\n        sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\",\n        \"Noto Color Emoji\";\n    --font-mono: \"JetBrains Mono\", ui-monospace, SFMono-Regular, Menlo, Monaco,\n        Consolas, \"Liberation Mono\", \"Courier New\", monospace;\n}\n";

        $updatedContent = preg_replace($pattern, $replacement, $fileContent);

        if ($updatedContent !== null && $updatedContent !== $fileContent) {
            File::put($filePath, $updatedContent);
        }
    }

    public function handleAppCss()
    {
        $filePath = resource_path('css/app.css');
        $newStyles = <<<'EOT'
        /* @custom-variant dark (&:where(.dark, .dark *)); */

        @source '../../vendor/arifbudimanar/zinc-ui/resources/views/**/*.blade.php';

        @plugin "@tailwindcss/typography";
        @plugin "@tailwindcss/forms";

        @layer utilities {
            /* Hide scrollbar for Chrome, Safari and Opera */
            .scrollbar-none::-webkit-scrollbar {
                display: none;
            }
            /* Hide scrollbar for IE, Edge and Firefox */
            .scrollbar-none {
                -ms-overflow-style: none; /* IE and Edge */
                scrollbar-width: none; /* Firefox */
            }
        }

        /* Hide element and prevent the blip on screen */
        [x-cloak] {
            display: none !important;
        }

        *:has(> [data-main]) {
            display: grid;
            grid-area: body;
            grid-template-rows: auto 1fr auto;
            grid-template-columns: min-content minmax(0, 1fr) min-content;
            grid-template-areas:
                "header  header  header"
                "sidebar main    aside"
                "sidebar footer  aside";
        }

        *:has(> [data-sidebar] + [data-header]) {
            grid-template-areas:
                "sidebar header  header"
                "sidebar main    aside"
                "sidebar footer  aside";
        }

        EOT;

        // Ensure the file exists
        if (File::exists($filePath)) {
            $fileContent = File::get($filePath);

            // Add new styles if not already present
            if (! Str::contains($fileContent, '.scrollbar-none')) {
                File::append($filePath, $newStyles);
            }
        }
    }

    public function handleAppJs()
    {
        $filePath = resource_path('js/app.js');
        $newStyles = <<<'EOT'
        import "../../vendor/masmerise/livewire-toaster/resources/js";
        import { Livewire } from "../../vendor/livewire/livewire/dist/livewire.esm";
        import { Alpine } from "../../vendor/livewire/livewire/dist/livewire.esm";
        import Autosize from "@marcreichel/alpine-autosize";

        Alpine.plugin(Autosize);

        document.addEventListener("livewire:navigated", () => {
            !/Mobi|Android/i.test(navigator.userAgent) &&
                document.querySelector("[autofocus]")?.focus();
        });

        document.addEventListener("alpine:init", () => {
            // Add any custom Alpine.js initialization code here
        });

        Livewire.start();

        EOT;

        // Ensure the file exists
        if (File::exists($filePath)) {
            $fileContent = File::get($filePath);

            // Add new styles if not already present
            if (! Str::contains($fileContent, 'livewire.esm')) {
                File::append($filePath, $newStyles);
            }
        }
    }

    public function handleUserModel()
    {
        $filePath = app_path('Models/User.php');
        $newMethods = <<<'EOT'

            /*
            * Get the avatar_url attribute.
            *
            * @return string
            */
            public function getAvatarUrlAttribute(): string
            {
                return 'https://ui-avatars.com/api/?name='.urlencode($this->name).'&color=27272a&background=00000000&format=svg';
            }

            /*
            * Get the first_name attribute.
            *
            * @return string
            */
            public function getFirstNameAttribute(): string
            {
                return explode(' ', $this->name)[0];
            }

        EOT;

        // Ensure the file exists
        if (File::exists($filePath)) {
            $fileContent = File::get($filePath);

            // Add the new methods just before the closing class brace
            if (! Str::contains($fileContent, 'getAvatarUrlAttribute')) {
                $updatedContent = preg_replace('/}\s*$/', $newMethods.'}', $fileContent);
                File::put($filePath, $updatedContent);
            }
        }

    }

    public function handleBrandLogo()
    {
        (new Filesystem)->ensureDirectoryExists(public_path('logos'));
        (new Filesystem)->copy(__DIR__.'/../../art/brand-dark.png', public_path('/logos/brand-dark.png'));
        (new Filesystem)->copy(__DIR__.'/../../art/brand-light.png', public_path('/logos/brand-light.png'));
    }

    public function handleVite()
    {
        $path = base_path('vite.config.js');
        $content = file_get_contents($path);

        // Check if the configuration already has cssMinify
        if (strpos($content, 'cssMinify') !== false) {
            return;
        }

        // Use a regex pattern to find the plugins section and add the build config after it
        $pattern = '/(\s*plugins\s*:\s*\[\s*laravel\s*\(\s*\{[^}]*\}\s*\)\s*,\s*tailwindcss\s*\(\s*\)\s*,?\s*\]\s*,?)/';
        $replacement = '$1'.PHP_EOL.'    build: {'.PHP_EOL.'        cssMinify: \'lightningcss\','.PHP_EOL.'    },';

        $updatedContent = preg_replace($pattern, $replacement, $content);

        // If the pattern wasn't found, try adding it at the end of the export default defineConfig section
        if ($updatedContent === $content) {
            $pattern = '/(export\s+default\s+defineConfig\s*\(\s*\{[^\}]*)\}\s*\)\s*;?\s*$/s';
            $replacement = '$1    build: {'.PHP_EOL.'        cssMinify: \'lightningcss\','.PHP_EOL.'    },'.PHP_EOL.'});';
            $updatedContent = preg_replace($pattern, $replacement, $content);
        }

        // Save the updated content
        file_put_contents($path, $updatedContent);
    }
}
