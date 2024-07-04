@extends('layouts.dashboard', ['title' => 'Criar cliente'])

@section('content')
    <div class="row mb-4">
        <div class="col-md-5 offset-2">
            <h1 class="mt-3 mb-3">Criar cliente</h1>
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
                        <label for="customer-username">Nome</label>
                        <input class="form-control" type="text" placeholder="Nome do cliente" id="customer-name" name="name" form="customer-save" autocomplete="off" />
                    </div>
                    <div class="form-group">
                        <label for="customer-email">E-mail</label>
                        <input class="form-control" type="email" placeholder="E-mail" id="customer-email" name="email" form="customer-save" autocomplete="off" />
                    </div>
                    <div class="form-group">
                        <label for="customer-username">Data de nascimento</label>
                        <input class="form-control" type="date" id="customer-birthday" name="birthday" form="customer-save" autocomplete="off" />
                    </div>
                    <div class="form-group">
                        <label for="customer-username">Morada</label>
                        <input class="form-control" tcype="text" placeholder="Rua, Avenida" id="customer-address-line-1" name="address-line-1" form="customer-save" autocomplete="off" />
                    </div>
                    <div class="form-group">
                        <label for="customer-username">Porta, Andar, Letra</label>
                        <input class="form-control" type="text" placeholder="Porta, Andar, Letra" id="customer-address-line-2" name="address-line-2" form="customer-save" autocomplete="off"  />
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="customer-username">Código Postal</label>
                                <input x-model="customer.postcode" x-mask="9999-999" @change="setPostcodeEventHandler" class="form-control" type="text" placeholder="Código Postal" id="customer-postcode" name="postcode" form="customer-save" autocomplete="off" />
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="customer-username">Localidade</label>
                                <input x-model="customer.location" class="form-control" type="text" placeholder="Localidade" id="customer-location" name="location" form="customer-save" autocomplete="off"  />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="customer-mobile">Telemóvel</label>
                        <input x-mask="999 999 999" class="form-control" type="text" placeholder="Telemóvel" id="customer-mobile" name="mobile" form="customer-save"  />
                    </div>
                </div>
{{--                <livewire:backoffice.components.customers.tags-component />--}}
            </div>
        </div>
    </div>
    <div class="row mb-4" x-data="customers">
        <div class="col-md-8 offset-2 text-right pt-3">
            <form id="customer-save" action="{{ route('clients.store') }}" method="post" autocomplete="off">
                {{ csrf_field() }}
                <button form="customer-save" type="submit" class="btn btn-filter inverter pull-right">Guardar</button>
            </form>
        </div>
    </div>
@endsection
