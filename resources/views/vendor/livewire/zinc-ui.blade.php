@php
if (! isset($scrollTo)) {
    $scrollTo = 'body';
}

$scrollIntoViewJsSnippet = ($scrollTo !== false)
    ? <<<JS
       (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
    JS
    : '';
@endphp

<div class="flex items-center justify-between max-sm:flex-col max-sm:gap-3 max-sm:items-end" data-pagination>
    @if ($paginator->hasPages())
        <div class="flex items-center w-full lg:hidden">
            @if ($paginator->onFirstPage())
                <x-button disabled>
                    {!! __('pagination.previous') !!}
                </x-button>
            @else
                <x-button wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled">
                    {!! __('pagination.previous') !!}
                </x-button>
            @endif

            <x-spacer/>
            <span class="flex text-sm shrink-0 text-zinc-500 dark:text-zinc-300">
                {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}
            </span>
            <x-spacer/>

            @if ($paginator->hasMorePages())
                <x-button wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled">
                    {!! __('pagination.next') !!}
                </x-button>
            @else
                <x-button disabled>
                    {!! __('pagination.next') !!}
                </x-button>
            @endif
        </div>
        <div class="hidden text-xs font-medium text-zinc-500 dark:text-zinc-400 whitespace-nowrap lg:block">
            <p >
                <span>{!! __('Showing') !!}</span>
                <span class="font-medium">{{ $paginator->firstItem() }}</span>
                <span>{!! __('to') !!}</span>
                <span class="font-medium">{{ $paginator->lastItem() }}</span>
                <span>{!! __('of') !!}</span>
                <span class="font-medium">{{ $paginator->total() }}</span>
                <span>{!! __('results') !!}</span>
            </p>
        </div>
        <div class="hidden lg:flex items-center bg-white border border-zinc-200 rounded-[8px] p-[1px] dark:bg-white/10 dark:border-white/10">
            @if ($paginator->onFirstPage())
                <x-button variant="subtle" size="sm" icon="o-chevron-left" disabled></x-button>
            @else
                <x-button variant="subtle" size="sm" icon="o-chevron-left" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}"></x-button>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <x-button variant="subtle" size="sm" icon="o-ellipsis-horizontal" disabled></x-button>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <span wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}">
                            @if ($page == $paginator->currentPage())
                                <x-button variant="filled" size="sm" disabled> {{ $page }}</x-button>
                            @else
                                <x-button variant="subtle" size="sm" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}"> {{ $page }}</x-button>
                            @endif
                        </span>
                    @endforeach
                @endif
            @endforeach

            <span>
                @if ($paginator->hasMorePages())
                    <x-button variant="subtle" size="sm" icon="o-chevron-right" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}"></x-button>
                @else
                    <x-button variant="subtle" size="sm" icon="o-chevron-right" disabled></x-button>
                @endif
            </span>
        </div>
    @endif
</div>
