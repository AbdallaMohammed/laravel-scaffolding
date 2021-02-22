@extends('layouts.dashboard', ['title' => $user->name])
@section('content')
    @component('Template::components.page')
        @slot('title', $user->name)
        @slot('breadcrumbs', ['dashboard.users.show', $user])

        <div class="row">
            <div class="col-md-12">
                @component('Template::components.box')
                    @slot('bodyClass', 'p-0')

                    <table class="table table-striped">
                        <tr>
                            <th>@lang('users.attributes.name')</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('users.attributes.email')</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('users.attributes.type')</th>
                            <td>@include('dashboard.users.partials.flags.type')</td>
                        </tr>
                        <tr>
                            <th>@lang('users.attributes.avatar')</th>
                            <td>
                                <img src="{{ $user->getAvatar() }}" alt="{{ $user->name }}">
                            </td>
                        </tr>
                    </table>

                    @slot('footer')
                        @include('dashboard.users.partials.actions.edit')
                        @include('dashboard.users.partials.actions.delete')
                    @endslot
                @endcomponent
            </div>
            <div class="col-md-12">
                @component('Template::components.table-box')
                    @slot('title', trans('books.actions.list'))
                    @slot('tools')
                        @include('dashboard.books.partials.actions.filter')
                    @endslot

                    <thead>
                    <tr>
                        <th>@lang('books.attributes.name')</th>
                        <th>@lang('books.attributes.author')</th>
                        <th>@lang('books.attributes.user_id')</th>
                        <th>@lang('books.attributes.category_id')</th>
                        <th>@lang('books.attributes.reference_id')</th>
                        <th>@lang('books.attributes.downloads_number')</th>
                        <th>@lang('books.attributes.status')</th>
                        <th style="width: 160px">...</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($books as $book)
                        <tr>
                            <td>
                                <a href="{{ route('dashboard.books.show', $book) }}"
                                   class="text-decoration-none text-ellipsis">
                                    <img src="{{ optional($book->getFirstMedia('default'))->getFullUrl() }}"
                                         alt="Product 1"
                                         class="img-circle img-size-32 mr-2">
                                    {{ $book->name }}
                                </a>
                            </td>
                            <td>
                                {{ $book->author }}
                            </td>
                            <td>
                                @if($book->user)
                                    <a href="{{ route('dashboard.users.show', $book->user) }}">
                                        {{ $book->user->name }}
                                    </a>
                                @else
                                    {{ $book->uploader_name }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('dashboard.categories.show', $book->category) }}"
                                   class="text-decoration-none text-ellipsis">
                                    {{ $book->category->name }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('dashboard.categories.show', $book->reference) }}"
                                   class="text-decoration-none text-ellipsis">
                                    {{ $book->reference->name }}
                                </a>
                            </td>
                            <td>
                                {{ $book->downloads_number }}
                            </td>
                            <td>
                                @lang('books.statuses.'.$book->status)
                            </td>
                            <td style="width: 160px">
                                @include('dashboard.books.partials.actions.show')
                                @include('dashboard.books.partials.actions.edit')
                                @include('dashboard.books.partials.actions.delete')
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100" class="text-center">@lang('books.empty')</td>
                        </tr>
                    @endforelse

                    @if($books->hasPages())
                        @slot('footer')
                            {{ $books->links() }}
                        @endslot
                    @endif
                @endcomponent
            </div>
        </div>

    @endcomponent
@endsection
