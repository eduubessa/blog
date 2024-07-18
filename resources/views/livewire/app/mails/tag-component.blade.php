<div>
    <div class="row">
        <div class="col-md-12">
            <div id="tags" class="form-group"></div>
            <div class="form-group">
                <label for="tag">Tags</label>
                @if($tags)
                    <section id="tags-list">
                        <ul>
                            @foreach($tags as $key => $tag)
                                <li wire:click.prevent="findAndRemoveClickEventHandler('{{ $tag }}', '{{ $key }}')">{{ $tag }} <span><i class="ri-close-line"></i></span></li>
                            @endforeach
                        </ul>
                        <input type="hidden" name="tags" value="{{ implode(';', $tags) }}" form="customer-save" autocomplete="off" name="tags" />
                    </section>
                @endif
                <section id="tag-input" class="mt-4">
                    <input type="text" class="form-control" name="tag" wire:model="name" wire:keyup="findAndUpdateSuggestionsEventHandler" wire:keydown.enter="addOrCreateEventHandler" />
                    @if($suggestions)
                        <nav id="tags-suggestions">
                            <ul>
                                @foreach($suggestions as $key => $suggestion)
                                    <li wire:key="{{ $suggestion->id }}" wire:click.prevent="addSuggestionClickEventHandler('{{ $suggestion->name }}', '{{ $key }}')">{{ $suggestion->name }}</li>
                                @endforeach
                            </ul>
                        </nav>
                    @endif
                </section>
            </div>
        </div>
    </div>
</div>
