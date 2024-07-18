@php
    use App\Helpers\Interfaces\CampaignInterface
@endphp
<div>
    <div class="row mb-4" x-data="customers">
        <div class="col-md-5 offset-2">
            <h1 class="mt-3 mb-3">E-mails</h1>
        </div>
        <div class="col-md-3 text-right pt-3"></div>
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
            @forelse($mails as $index => $mail)
                <article class="app-task" wire:key="{{ $index }}">
                    <div>
                        <div class="text-bold">{{ $mail->name }}</div>
                    </div>
                    <div>
                        <p class="text-left">{{ $mail->subject }}</p>
                    </div>
                    <div>
                        @switch($mail->status)
                            @case(\App\Helpers\Interfaces\MailInterface::STATUS_ACTIVE)
                                <p class="badge badge-success bg-success">Campanha</p>
                                @break
                            @case(\App\Helpers\Interfaces\MailInterface::STATUS_DRAFT)
                                <p class="badge badge-warning bg-warning">Racunho</p>
                                @break
                            @case(\App\Helpers\Interfaces\MailInterface::STATUS_DEACTIVATED)
                            @case(\App\Helpers\Interfaces\MailInterface::STATUS_EXPIRED)
                                <p class="badge badge-warning bg-warning">Expirada</p>
                                @break
                        @endswitch
                    </div>
                    <div>
                        {{--                        <a class="btn btn-transparent" href="{{ route('mails.edit', $mail->id) }}">--}}
                        {{--                            <i class="ri ri-pencil-line"></i>--}}
                        {{--                        </a>--}}
                        <button class="btn btn-transparent text-danger" wire:click="deleteClickEventHandler({{ $mail->id }})" wire:confirm="Deseja mesmo apagar esta campanha?">
                            <i class="ri ri-delete-bin-line"></i>
                        </button>
                    </div>
                </article>
            @empty
            @endforelse
        </div>
    </div>
</div>
