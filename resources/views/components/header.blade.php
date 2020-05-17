<div class="app-page-title">
    <div class="page-title-wrapper">

        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="{{ $icon }} icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>{{ $title }}
                @isset($subtitle) <div class="page-title-subheading">{{ $subtitle }}</div> @endisset
            </div>
        </div>

        <div class="page-title-actions">

            {{ $slot }}

        </div>

    </div>
</div>