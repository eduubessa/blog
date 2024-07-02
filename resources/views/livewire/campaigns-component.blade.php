@php
    use App\Helpers\Interfaces\CampaignInterface
@endphp
<div>
    <div class="row mb-4" x-data="customers">
        <div class="col-md-5 offset-2">
            <h1 class="mt-3 mb-3">Campanhas</h1>
        </div>
        <div class="col-md-3 text-right pt-3">
            <button class="btn btn-filter" wire:click="importClickEventHandler">Importar</button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 offset-2 font-bold row-border-radius">
            <section id="app-tasks-header">
                <div>Nome</div>
                <div>Assunto</div>
                <div>Estado</div>
                <div>Ações</div>
            </section>
        </div>
        <div class="col-md-8 offset-2">
            @forelse($campaigns as $index => $campaign)
                <article class="app-task" wire:key="{{ $index }}">
                    <div>
                        <div class="text-bold">{{ $campaign->name }}</div>
                    </div>
                    <div>
                        <p class="text-left">{{ $campaign->subject }}</p>
                    </div>
                    <div>
                        @switch($campaign->status)
                            @case(CampaignInterface::STATUS_ACTIVE)
                                <span class="badge badge-success bg-success">Campanha</span>
                                @break
                            @case(CampaignInterface::STATUS_DRAFT)
                                <span class="badge badge-warning bg-warning">Racunho</span>
                                @break
                            @case(CampaignInterface::STATUS_DEACTIVATED)
                            @case(CampaignInterface::STATUS_EXPIRED)
                                <span class="badge badge-warning bg-warning">Expirada</span>
                                @break
                        @endswitch
                    </div>
                    <div>
                        <a class="btn btn-transparent" href="{{ route('campaigns.edit', rawurlencode($campaign->code)) }}">
                            <i class="ri ri-pencil-line"></i>
                        </a>
                        <button class="btn btn-transparent text-danger" wire:click="deleteClickEventHandler({{ $campaign->id }})" wire:confirm="Deseja mesmo apagar esta campanha?">
                            <i class="ri ri-delete-bin-line"></i>
                        </button>
                    </div>
                </article>
            @empty
            @endforelse
        </div>
    </div>
</div>
