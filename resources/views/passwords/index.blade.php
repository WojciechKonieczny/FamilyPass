{{-- szablon bedziie wykorzystywal app.blade.php --}}
@extends('layouts.app')

<style>
    #password {
        display: none;
    }

    .btn {
        height: 30px;
        padding: 5px;
    }

</style>

@section('content')
    <div class="container">
        <h1>Passwords</h1>

        <div class="d-flex flex-row-reverse mb-4">
            <div class="btn-group" role="group" aria-label="action buttons">
                <a href=" {{ route('passwords.create') }} " type="button" class="btn btn-primary" role="button">
                    Add password
                </a>
            </div>
        </div>

        <div class="table-container table-responsive">

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>URL</th>
                    <th>Login</th>
                    <th>Password</th>
                    <th>Comment</th>
                    <th class="always-visible"></th>
                </tr>
                </thead>

                <tbody>
                @foreach($pass as $p)
                    <tr>
                        <td> {{ $p->id }} </td>
                        <td> {{ $p->name? $p->name : '' }} </td>
                        <td> {{ $p->url? $p->url : '' }} </td>
                        <td> {{ $p->username? $p->username  : '' }} </td>
                        <td class="main">
                            <p class="password" name="password" class="password">{{Crypt::decrypt($p->password)}}</p>

                        </td>
                        <td> {{ $p->comment? $p->comment : '' }} </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="action buttons">
                                <x-datatables.action-link class="btn btn-primary"
                                                          url="{{ route('passwords.edit', $p) }}" {{-- atrybut url przekazywany do komponentu --}}
                                                          title="Edit">
                                    <i class="bi-pencil"></i>
                                    </x-action-link>

                                @if( $p->deleted_at == null )
                                    <x-datatables.confirm
                                        :action="route('passwords.destroy', $p)" method="DELETE"
                                        :confirm-text="__('translations.buttons.yes')" confirm-class="btn btn-danger me-2"
                                        :cancel-text="__('translations.buttons.no')" cancel-class="btn btn-secondary ms-2"
                                        icon="question"
                                        button-class="btn btn-danger" :button-title="__('translations.items.labels.destroy')">
                                        <i class="bi bi-trash"></i>
                                        </x-confirm>
                                        @else
                                            <x-datatables.confirm
                                                :action="route('passwords.restore', $p)" method="PUT"
                                                :confirm-text="__('translations.buttons.yes')" confirm-class="btn btn-success me-2"
                                                :cancel-text="__('translations.buttons.yes')" cancel-class="btn btn-secondary ms-2"
                                                icon="question"
                                                button-class="btn btn-success" :button-title="__('translations.items.labels.restore')">
                                                <i class="bi bi-trash"></i>
                                                </x-confirm>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
