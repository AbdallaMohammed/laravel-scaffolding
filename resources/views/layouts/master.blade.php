<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ Locales::getDir() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ isset($title) ? $title .' | '. Settings::get('title', config('app.name')) : Settings::get('title', config('app.name')) }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css" type="text/css">
    </head>
    <body>
        <div id="app">
            <section class="hero-banner position-relative {{ ! isset($disable_description) ? 'custom-pb-1' : 'pb-0 pt-5' }} bg-pink z-index-1">
                <div class="overlay" data-bg-img="{{ asset('images/background.png') }}"></div>
                <div class="container z-index-2">
                    <div class="row justify-content-center text-center">
                        <div class="col-12 mb-7">
                            <div class="logo">
                                <a href="{{ route('home') }}">
                                    <img src="{{ optional(Settings::instance('logo'))->getFirstMediaUrl('logo') ?: asset('images/logo.png') }}" alt="{{ Settings::get('title', config('app.name')) }}" class="img-fluid" />
                                </a>
                            </div>
                        </div>
                        @if(! isset($disable_description))
                            <div class="col-12">
                                <div class="text-primary">
                                    @if(request()->routeIs('home'))
                                        {!! Settings::get('description', trans('frontend.description')) !!}
                                    @else
                                        <h4>{{ isset($description) ? $description : $title }}</h4>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="shape-1 bottom overflow-hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                        <path fill="#f9f9f9" d="M600,112.77C268.63,112.77,0,65.52,0,7.23V120H1200V7.23C1200,65.52,931.37,112.77,600,112.77Z" class="shape-fill"></path>
                    </svg>
                </div>
            </section>
            <div class="page-content">
                @if(! isset($disable_search))
                    <section class="p-0">
                        <div class="container">
                            <div class="row justify-content-center mt-n5 z-index-1">
                                <div class="col-md-6 col-12 m-auto">
                                    {{ BsForm::resource('books')->get(route('books.index')) }}
                                        <div class="form-group has-search mb-0">
                                            <input type="text" name="s" class="form-control shadow-primary text-start bg-light border-0 p-3" placeholder="@lang('frontend.search')" value="{{ request('s') }}">
                                            <button type="submit" class="form-control-feedback me-2 ms-2">
                                                <span class="la la-search position-relative top-25"></span>
                                            </button>
                                        </div>
                                    {{ BsForm::close() }}
                                </div>
                            </div>
                        </div>
                    </section>
                @endif
                <div class="container mt-7 mb-0">
                    @include('flash::message')
                </div>
                @yield('content')
            </div>
            <footer class="hero-banner footer-position position-relative bg-pink z-index-1">
                <div class="shape-1 rotate overflow-hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                        <path fill="#f9f9f9" d="M1200 120L0 16.48 0 0 1200 0 1200 120z" class="shape-fill"></path>
                    </svg>
                </div>
                <div class="container">
                    <div class="row justify-content-center text-center position-relative pt-3">
                        <div class="col-12">
                            <h3 class="title">
                                <span class="d-block">@lang('frontend.footer.title')</span>
                            </h3>
                        </div>
                    </div>
                    <div class="row pt-5">
                        <div class="col-12 col-md-4 mb-3 mb-md-0 text-md-start text-center">
                            <ul class="p-0">
                                @foreach(\App\Models\Page::take(2)->get() as $page)
                                    <li>
                                        <a href="{{ route('pages.show', $page) }}">{{ $page->title }}</a>
                                    </li>
                                @endforeach
                                <li>
                                    <a href="{{ route('books.create') }}">@lang('books.actions.create')</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 col-md-8 mb-3 mb-md-0">
                            <div class="row justify-content-center justify-content-md-start">
                                <div class="col-3 col-md-2">
                                    <div class="social-icon facebook">
                                        <a href="{{ Settings::get('facebook_link', '#') }}">
                                            <div class="f-icon text-center">
                                                <img src="{{ asset('images/facebook.png') }}" />
                                            </div>
                                            <div class="mt-3 text-center">
                                                <span>@lang('frontend.social.facebook')</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-3 col-md-2">
                                    <div class="social-icon telegram">
                                        <a href="{{ Settings::get('telegram_link', '#') }}">
                                            <div class="f-icon text-center">
                                                <img src="{{ asset('images/telegram.png') }}" />
                                            </div>
                                            <div class="mt-3 text-center">
                                                <span>@lang('frontend.social.telegram')</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-3 col-md-2">
                                    <div class="social-icon twitter">
                                        <a href="{{ Settings::get('twitter_link', '#') }}">
                                            <div class="f-icon text-center">
                                                <img src="{{ asset('images/twitter.png') }}" />
                                            </div>
                                            <div class="mt-3 text-center">
                                                <span>@lang('frontend.social.twitter')</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="copyright text-center p-3 mt-4">
                                <span data-text-color="#6fa8da">{{ Settings::get('copyright', trans('frontend.copyright')) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
