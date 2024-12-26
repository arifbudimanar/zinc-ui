<?php

namespace ArifBudimanAr\ZincUi\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use RuntimeException;
use Symfony\Component\Process\Process;

class InstallCommand extends Command
{
    public $signature = 'zinc:install {--composer=global : Absolute path to the Composer binary which should be used to install packages}';

    public $description = 'Install the Zinc UI components';

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

    public function handle(): int
    {
        $this->comment('Installing Zinc UI ...');

        $this->comment('Install Livewire and Livewire Toaster ...');
        if (! $this->requireComposerPackages(['livewire/livewire:^3.5', 'masmerise/livewire-toaster:^2.6'])) {
            return 1;
        }

        $this->comment('Publish Livewire config and Livewire Toaster config ...');
        $this->runCommands(['php artisan livewire:publish --config']);
        $this->runCommands(['php artisan vendor:publish --tag=toaster-config']);
        // $this->runCommands(['php artisan vendor:publish --tag=toaster-views']);

        $this->comment('Copying Zinc UI component ...');
        (new Filesystem)->ensureDirectoryExists(resource_path('views'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../resources/views', resource_path('views'));

        $this->comment('Update NPM Package ...');
        $this->updateNodePackages(function ($packages) {
            return [
                '@tailwindcss/forms' => '^0.5.2',
                'autoprefixer' => '^10.4.2',
                'postcss' => '^8.4.31',
                'tailwindcss' => '^3.1.0',
                '@marcreichel/alpine-autosize' => '^1.3.3',
            ] + $packages;
        });

        $this->comment('Installing and building Node dependencies.');
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

        $this->replaceInFile(
            <<<'EOT'
            import "./bootstrap";
            EOT,
            <<<'EOT'
            import "./bootstrap";
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
            EOT,
            resource_path('js/app.js')
        );
        $this->replaceInFile(
            <<<'EOT'
            import defaultTheme from 'tailwindcss/defaultTheme';

            /** @type {import('tailwindcss').Config} */
            export default {
                content: [
                    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
                    './storage/framework/views/*.php',
                    './resources/**/*.blade.php',
                    './resources/**/*.js',
                    './resources/**/*.vue',
                ],
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                        },
                    },
                },
                plugins: [],
            };

            EOT,
            <<<'EOT'
            import defaultTheme from "tailwindcss/defaultTheme";

            /** @type {import('tailwindcss').Config} */
            export default {
                darkMode: "selector",
                content: [
                    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
                    "./storage/framework/views/*.php",
                    "./resources/**/*.blade.php",
                    "./resources/**/*.js",
                    "./resources/**/*.vue",
                ],
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ["Inter", ...defaultTheme.fontFamily.sans],
                            mono: ["JetBrains Mono", ...defaultTheme.fontFamily.mono],
                        },
                    },
                },
                plugins: [],
            };
            EOT,
            base_path('tailwind.config.js')
        );
        $this->replaceInFile(
            <<<'EOT'
            @tailwind base;
            @tailwind components;
            @tailwind utilities;
            EOT,
            <<<'EOT'
            @tailwind base;
            @tailwind components;
            @tailwind utilities;

            @layer utilities {
                /* Hide scrollbar for Chrome, Safari and Opera */
                .no-scrollbar::-webkit-scrollbar {
                    display: none;
                }
                /* Hide scrollbar for IE, Edge and Firefox */
                .no-scrollbar {
                    -ms-overflow-style: none; /* IE and Edge */
                    scrollbar-width: none; /* Firefox */
                }
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

            /* Light mode color scheme */
            .light {
                color-scheme: light;
            }

            /* Dark mode color scheme */
            .dark {
                color-scheme: dark;
            }

            /* Hide element and prevent the blip on screen */
            [x-cloak] {
                display: none !important;
            }

            /* Dark theme scrollbar styles */
            .dark ::-webkit-scrollbar {
                width: 10px;
                height: 10px;
                background-color: #3f3f46;
            }

            .dark ::-webkit-scrollbar-thumb {
                background-color: #ffffff;
                border-radius: 5px;
            }

            .dark ::-webkit-scrollbar-thumb:hover {
                background-color: #ffffff;
            }

            /* Light theme scrollbar styles */
            .light ::-webkit-scrollbar {
                width: 10px;
                height: 10px;
                background-color: #f4f4f5;
            }

            .light ::-webkit-scrollbar-thumb {
                background-color: #27272a;
                border-radius: 5px;
            }

            .light ::-webkit-scrollbar-thumb:hover {
                background-color: #27272a;
            }

            /* System preference scrollbar styles */
            @media (prefers-color-scheme: dark) {
                :root:not(.light):not(.dark) ::-webkit-scrollbar {
                    width: 10px;
                    height: 10px;
                    background-color: #3f3f46;
                }

                :root:not(.light):not(.dark) ::-webkit-scrollbar-thumb {
                    background-color: #ffffff;
                    border-radius: 5px;
                }

                :root:not(.light):not(.dark) ::-webkit-scrollbar-thumb:hover {
                    background-color: #ffffff;
                }
            }

            @media (prefers-color-scheme: light) {
                :root:not(.light):not(.dark) ::-webkit-scrollbar {
                    width: 10px;
                    height: 10px;
                    background-color: #f4f4f5;
                }

                :root:not(.light):not(.dark) ::-webkit-scrollbar-thumb {
                    background-color: #27272a;
                    border-radius: 5px;
                }

                :root:not(.light):not(.dark) ::-webkit-scrollbar-thumb:hover {
                    background-color: #27272a;
                }
            }
            EOT,
            resource_path('css/app.css')
        );

        $this->replaceInFile(
            <<<'EOT'
            <?php

            namespace App\Models;

            // use Illuminate\Contracts\Auth\MustVerifyEmail;
            use Illuminate\Database\Eloquent\Factories\HasFactory;
            use Illuminate\Foundation\Auth\User as Authenticatable;
            use Illuminate\Notifications\Notifiable;

            class User extends Authenticatable
            {
                /** @use HasFactory<\Database\Factories\UserFactory> */
                use HasFactory, Notifiable;

                /**
                 * The attributes that are mass assignable.
                 *
                 * @var list<string>
                 */
                protected $fillable = [
                    'name',
                    'email',
                    'password',
                ];

                /**
                 * The attributes that should be hidden for serialization.
                 *
                 * @var list<string>
                 */
                protected $hidden = [
                    'password',
                    'remember_token',
                ];

                /**
                 * Get the attributes that should be cast.
                 *
                 * @return array<string, string>
                 */
                protected function casts(): array
                {
                    return [
                        'email_verified_at' => 'datetime',
                        'password' => 'hashed',
                    ];
                }
            }

            EOT,
            <<<'EOT'
            <?php

            namespace App\Models;

            // use Illuminate\Contracts\Auth\MustVerifyEmail;
            use Illuminate\Database\Eloquent\Factories\HasFactory;
            use Illuminate\Foundation\Auth\User as Authenticatable;
            use Illuminate\Notifications\Notifiable;

            class User extends Authenticatable
            {
                /** @use HasFactory<\Database\Factories\UserFactory> */
                use HasFactory, Notifiable;

                /**
                 * The attributes that are mass assignable.
                 *
                 * @var list<string>
                 */
                protected $fillable = [
                    'name',
                    'email',
                    'password',
                ];

                /**
                 * The attributes that should be hidden for serialization.
                 *
                 * @var list<string>
                 */
                protected $hidden = [
                    'password',
                    'remember_token',
                ];

                /**
                 * Get the attributes that should be cast.
                 *
                 * @return array<string, string>
                 */
                protected function casts(): array
                {
                    return [
                        'email_verified_at' => 'datetime',
                        'password' => 'hashed',
                    ];
                }

                public function getAvatarUrlAttribute()
                {
                    return 'https://ui-avatars.com/api/?name='.urlencode($this->name).'&color=27272a&background=00000000&format=svg';
                }

                public function getFirstNameAttribute()
                {
                    return explode(' ', $this->name)[0];
                }
            }
            EOT,
            app_path('Models/User.php')
        );

        $this->comment('Zinc UI is installed! Make something awesome!');

        return self::SUCCESS;
    }
}
