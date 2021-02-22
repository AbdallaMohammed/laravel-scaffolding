@extends('layouts.dashboard', ['title' => trans('settings.actions.create')])
@section('content')
    @component('Template::components.page')
        @slot('title', trans('settings.plural'))
        @slot('breadcrumbs', ['dashboard.settings.index'])

        {{ BsForm::resource('settings')->put(route('dashboard.settings.update')) }}
        @component('Template::components.box')
            @slot('title', trans('settings.actions.create'))

            {{ BsForm::image('logo')->collection('logo')->files(optional(Settings::instance('logo'))->getMediaResource('logo')) }}
            {{ BsForm::text('title')->value(Settings::get('title', config('app.name'))) }}
            {{ BsForm::text('copyright')->value(Settings::get('copyright', trans('frontend.copyright'))) }}
            {{ BsForm::text('description')->value(Settings::get('description', trans('frontend.description'))) }}

            @slot('footer')
                {{ BsForm::submit()->label(trans('settings.actions.save')) }}
            @endslot
        @endcomponent
        {{ BsForm::close() }}

    @endcomponent
@endsection
