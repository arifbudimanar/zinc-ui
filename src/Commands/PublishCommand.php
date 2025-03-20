<?php

namespace ArifBudimanAr\ZincUi\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Symfony\Component\Console\Attribute\AsCommand;

use function Laravel\Prompts\info;
use function Laravel\Prompts\multisearch;
use function Laravel\Prompts\search;
use function Laravel\Prompts\warning;

#[AsCommand(name: 'zinc:publish')]
class PublishCommand extends Command
{
    public $signature = 'zinc:publish {components?*} {--multiple} {--all} {--force}';

    public $description = 'Publish Zinc UI components';

    protected array $zincComponents = [
        'Accordion' => ['accordion'],
        'Aside' => ['aside'],
        'Avatar' => ['avatar'],
        'Badge' => ['badge'],
        'Brand' => ['brand'],
        'Breadcrumbs' => ['breadcrumbs'],
        'Button' => ['button'],
        'Card' => ['card'],
        'Checkbox' => ['checkbox'],
        'Dropdown' => ['dropdown', 'menu', 'navmenu'],
        'Field' => ['fieldset', 'legend', 'field', 'label', 'description', 'error', 'errors'],
        'Heading' => ['heading', 'subheading', 'text', 'link', 'code', 'kbd'],
        'Input' => ['input'],
        'Layout' => ['header', 'sidebar', 'aside', 'main', 'footer', 'container', 'brand', 'profile', 'spacer', 'page'],
        'Logo' => ['logo'],
        'Modal' => ['modal', 'overlay'],
        'Navbar' => ['navbar', 'navlist'],
        'Radio' => ['radio'],
        'Separator' => ['separator'],
        'Select' => ['select', 'option'],
        'Switch' => ['switch'],
        'Tabs' => ['tab', 'tabs'],
        'Table' => ['table', 'columns', 'column', 'rows', 'row', 'cell'],
        'Textarea' => ['textarea'],
        'Tooltip' => ['tooltip'],
        'Toaster' => ['toaster'],
        'Typography' => ['heading', 'subheading', 'text', 'link', 'code', 'kbd'],
    ];

    public function handle(): void
    {
        if ($this->option('all')) {
            $componentNames = $this->zincComponents()->keys()->all();
        } elseif (count($this->argument('components')) > 0) {
            $componentNames = $this->zincComponents()
                ->keys()
                ->filter(fn (string $component) => in_array(str($component)->lower(), array_map('strtolower', $this->argument('components'))))
                ->values()
                ->all();
        } elseif ($this->option('multiple')) {
            $componentNames = multisearch(
                label: 'Which components would you like to publish?',
                options: fn (?string $value = null) => $this->searchOptions($value ?? ''),
            );
        } else {
            $componentNames = (array) search(
                label: 'Which component would you like to publish?',
                options: fn (?string $value = null) => $this->searchOptions($value ?? ''),
            );
        }

        (new Filesystem)->ensureDirectoryExists(resource_path('views/components'));

        $components = $this->zincComponents()->intersectByKeys(array_flip($componentNames))->values()->flatten()->unique()->all();

        foreach ($components as $component) {
            $this->publishComponent($component);
        }

        if (count($components) > 0) {
            $this->info('Zinc UI components published successfully.');
            $this->line('Navigate to the following directory to view the components:');
            $this->line('<info>'.resource_path('views/components').'</info>');
        } else {
            $this->warn('No components were published.');
        }
    }

    protected function zincComponents(): Collection
    {
        return collect($this->zincComponents)->sortKeys();
    }

    protected function searchOptions(string $value): array
    {
        if ($value === '') {
            return $this->zincComponents()->keys()->toArray();
        }

        return $this->zincComponents()
            ->keys()
            ->filter(fn (string $component) => str($component)->lower()->contains(str($value)->lower()))
            ->values()
            ->all();
    }

    protected function publishComponent(string $component): void
    {
        $filesystem = new Filesystem;

        // Support for both directory-based and file-based components
        if (str_contains($component, '.')) {
            // Handle nested components like 'tab.index', 'breadcrumb.item'
            [$category, $item] = explode('.', $component, 2);

            $source = __DIR__."/../../resources/views/components/{$category}/{$item}.blade.php";
            $destinationDir = resource_path("views/components/{$category}");
            $destination = "{$destinationDir}/{$item}.blade.php";

            // Make sure the directory exists
            $filesystem->ensureDirectoryExists($destinationDir);

            if ($filesystem->isFile($source)) {
                $this->publishFile($component, $source, $destination);
            } else {
                warning("Source file not found: {$source}");
            }
        } else {
            // Handle main component directories like 'tab', 'breadcrumb'
            $sourceDir = __DIR__."/../../resources/views/components/{$component}";
            $destinationDir = resource_path("views/components/{$component}");

            // Check if it's a directory
            if ($filesystem->isDirectory($sourceDir)) {
                $this->publishDirectory($component, $sourceDir, $destinationDir);
            } else {
                // Check if it's a single file
                $source = __DIR__."/../../resources/views/components/{$component}.blade.php";
                $destination = resource_path("views/components/{$component}.blade.php");

                if ($filesystem->isFile($source)) {
                    $this->publishFile($component, $source, $destination);
                } else {
                    warning("Component not found: {$component}");
                }
            }
        }
    }

    protected function publishDirectory($component, $source, $destination): void
    {
        $filesystem = new Filesystem;

        if ($filesystem->isDirectory($destination) && ! $this->option('force')) {
            warning("Skipping [{$component}]. Directory already exists: {$destination}");

            return;
        }

        $filesystem->ensureDirectoryExists($destination);
        $filesystem->copyDirectory($source, $destination);

        info("Published directory: {$destination}");
    }

    protected function publishFile($component, $source, $destination): void
    {
        $filesystem = new Filesystem;

        if ($filesystem->exists($destination) && ! $this->option('force')) {
            warning("Skipping [{$component}]. File already exists: {$destination}");

            return;
        }

        $filesystem->ensureDirectoryExists(dirname($destination));
        $filesystem->copy($source, $destination);

        info("Published: {$destination}");
    }
}
