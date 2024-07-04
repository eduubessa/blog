<div>
    <div class="row mb-4">
        <div class="col-md-5 offset-2">
            <h1 class="mt-3 mb-3">Clientes</h1>
        </div>
        <div class="col-md-3 text-right pt-3">
            <a class="btn btn-filter inverter" href="{{ route('clients.create') }}">Adicionar Cliente</a>
            <button class="btn btn-filter" wire:click="$set('modal', true)">Importar</button>
        </div>
    </div>
    @if(session()->has('its.message.body'))
        <div class="row">
            <div class="col-12">
                <div
                    class="alert text-center @if(session('message.type') == 'warning') alert-warning @elseif('its.message.type' == 'danger') alert-danger @else alert-success @endif">{{ session('its.message.body') }}</div>
            </div>
        </div>
    @endif
    <div class="row mb-3">
        <div class="col-md-8 offset-2">
            <div class="row">
                <div class="col-md-10">
                </div>
                <div class="col-md-2 text-right pt-3">
                    {{ $clients_counter }} Encontrados
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 offset-2 font-bold row-border-radius">
            <section id="app-list-header">
                <div>Cliente</div>
                <div>Tags</div>
                <div>Estado</div>
                <div>Ações</div>
            </section>
        </div>
        <div class="col-md-8 offset-2">
            @forelse($clients as $index => $client)
                <article class="app-customer">
                    <div><img class="app-customer-avatar" src="{{ $client->user->avatar->image }}"/></div>
                    <div>
                        <div class="text-bold">{{ decrypt_data($client->user->firstname) }}</div>
                        <div><small>{{ decrypt_data($client->user->email) }}</small></div>
                    </div>
                    {{ $client->tags->count() }}
                    <div>
                        {{ decrypt_data($client->user->city) }}
                    </div>
                    <div>
                        <a class="btn btn-transparent" href="{{ route('clients.show', $client->user->username) }}">
                            <i class="ri ri-eye-line"></i>
                        </a>
                        <a class="btn btn-transparent" href="{{ route('clients.edit', $client->user->username) }}">
                            <i class="ri ri-pencil-line"></i>
                        </a>
                        <button class="btn btn-transparent text-danger" wire:click="delete('{{ $client->user->username }}')">
                            <i class="ri ri-delete-bin-line"></i>
                        </button>
                    </div>
                    <div></div>
                    <div></div>
                </article>
            @empty
                <article id="app-list-nocustomers">
                    Não há clientes registados, <a href="{{ route('clients.create') }}">adicione</a> o primeiro.
                </article>
            @endforelse
        </div>
    </div>
</div>
