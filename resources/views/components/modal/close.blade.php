<div {{ $attributes }}
    x-on:click.stop="isModalOpen = !isModalOpen" data-modal-close>
    {{ $slot }}
</div>
