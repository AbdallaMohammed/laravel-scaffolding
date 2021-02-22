@component('Template::components.sidebarItem')
    @slot('can', ['ability' => 'viewAny', 'model' => \Laraeast\LaravelSettings\Models\Setting::class])
    @slot('url', route('dashboard.settings.index'))
    @slot('name', trans('settings.plural'))
    @slot('routeActive', '*settings*')
    @slot('icon', 'fas fa-cog')
    @slot('tree', [
        [
            'name' => trans('settings.actions.list'),
            'url' => route('dashboard.settings.index'),
            'can' => ['ability' => 'viewAny', 'model' => \Laraeast\LaravelSettings\Models\Setting::class],
            'routeActive' => '*settings.index',
        ],
    ])
@endcomponent
