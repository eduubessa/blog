@extends('layouts.dashboard', ['title' => 'Editar cliente'])

@section('content')
    <div class="row mb-4">
        <div class="col-md-5 offset-2">
            <h1 class="mt-3 mb-3">Editar cliente</h1>
        </div>
        <div class="col-md-3 text-right pt-3">
            <button form="customer-save" type="submit" class="btn btn-filter inverter pull-right">Guardar</button>
        </div>
    </div>
    @if(session()->has('message.body'))
        <div class="row">
            <div class="col-8 offset-2">
                <div class="alert text-center @if(session('message.type') == 'warning') alert-warning @elseif('message.type' == 'danger') alert-danger @else alert-success @endif">{{ session('message.body') }}</div>
            </div>
        </div>
    @endif
    @if($errors->any())
        <div class="row">
            <div class="col-8 offset-2">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-8 offset-2 bg-white row-border-radius bg-white py-2 mb-4">
            <div class="container">
                <div x-data="customers">
                    <div class="row mt-3">
                        <div class="col-md-9">
                            <h6 class="mt-2">Informações do cliente</h6>
                        </div>
                        <div class="col-md-3">
                            <button form="customer-save" type="submit" class="btn btn-filter btn-small pull-right">Guardar</button>
                        </div>
                    </div>
                    <hr />
                    <div class="form-group">
                        <label for="customer-firstname">Primeiro nome</label>
                        <input class="form-control" type="text" placeholder="Nome do cliente" id="customer-firstname" name="firstname" form="customer-save" autocomplete="off" value="{{ decrypt_data($user->firstname) }}" />
                    </div>
                    <div class="form-group">
                        <label for="customer-lastname">Apelido</label>
                        <input class="form-control" type="text" placeholder="Nome do cliente" id="customer-lastname" name="lastname" form="customer-save" autocomplete="off" value="{{ decrypt_data($user->lastname) }}" />
                    </div>
                    <div class="form-group">
                        <label for="customer-email">E-mail</label>
                        <input class="form-control" type="email" placeholder="E-mail" id="customer-email" name="email" form="customer-save" autocomplete="off" value="{{ $user->email }}" />
                    </div>
                    <div class="form-group">
                        <label for="customer-username">Data de nascimento</label>
                        <input class="form-control" type="date" id="customer-birthday" name="date-birth" form="customer-save" autocomplete="off" value="{{ $user->birth_date }}" />
                    </div>
                    <div class="form-group">
                        <label for="customer-username">Morada</label>
                        <input class="form-control" tcype="text" placeholder="Rua, Avenida" id="customer-address-line-1" name="address-line-1" form="customer-save" autocomplete="off" value="{{ decrypt_data($user->client->address_line_1) }}" />
                    </div>
                    <div class="form-group">
                        <label for="customer-username">Porta, Andar, Letra</label>
                        <input class="form-control" type="text" placeholder="Porta, Andar, Letra" id="customer-address-line-2" name="address-line-2" form="customer-save" autocomplete="off" value="{{ decrypt_data($user->client->address_line_2) }}"  />
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="customer-username">Código Postal</label>
                                <input class="form-control" type="text" placeholder="Código Postal" id="customer-postcode" name="postcode" form="customer-save" autocomplete="off" value="{{ decrypt_data($user->client->postcode) }}" />
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="customer-username">Localidade</label>
                                <input class="form-control" type="text" placeholder="Localidade" id="customer-location" name="city" form="customer-save" autocomplete="off" value="{{ decrypt_data($user->client->city) }}"  />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="customer-mobile">Telemóvel</label>
                        <input class="form-control" type="text" placeholder="Telemóvel" id="customer-mobile" name="mobile-phone" form="customer-save" value="{{ $user->mobile_phone }}"  />
                    </div>
                </div>
                <!-- Tags -->
                <livewire:app.clients.tag-component type="update" username="{{ $user->username }}" />
            </div>
        </div>
    </div>
    <div class="row mb-4" x-data="customers">
        <div class="col-md-8 offset-2 text-right pt-3">
            <form id="customer-save" action="{{ route('clients.update', $user->username) }}" method="post" autocomplete="off">
                {{ csrf_field() }}
                <button form="customer-save" type="submit" class="btn btn-filter inverter pull-right">Guardar</button>
            </form>
        </div>
    </div>
@endsection
