<div>
    <div class="row mb-4" x-data="customers">
        <div class="col-md-5 offset-2">
            <h1 class="mt-3 mb-3">Tags</h1>
        </div>
        <div class="col-md-3 text-right pt-3"></div>
    </div>
    <div class="row">
        <div class="col-md-8 offset-2 font-bold row-border-radius">
            <section id="app-tasks-header">
                <div class="text-center">Tag</div>
                <div class="text-center">Clientes</div>
                <div class="text-center">Campanhas</div>
                <div class="text-center">E-mails</div>
            </section>
        </div>
        <div class="col-md-8 offset-2">
            @forelse($tags as $index => $tag)
                <article class="app-task" wire:key="{{ $index }}">
                    <div>
                        <div class="text-bold">{{ $tag->name }}</div>
                    </div>
                    <div>
                        <p class="text-center"> {{ $tag->clients->count() }}</p>
                    </div>
                    <div>
                        <p class="text-center"> {{ $tag->campaigns->count() }}</p>
                    </div>
                    <div>
                        <p class="text-center"> {{ $tag->mails->count() }}</p>
                    </div>
                </article>
            @empty
            @endforelse
        </div>
    </div>
</div>
