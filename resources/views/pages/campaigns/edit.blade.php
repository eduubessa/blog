@extends('layouts.dashboard', ['title' => 'Editar campanha'])

@section('content')
    <div class="row mb-4">
        <div class="col-md-5 offset-2">
            <h1 class="mt-3 mb-3">Editar campanha</h1>
        </div>
        <div class="col-md-3 text-right pt-3">
            <button form="campaign-save" type="submit" class="btn btn-filter inverter pull-right">Guardar</button>
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
                <div class="form-group">
                    <label for="customer-username">Nome</label>
                    <input class="form-control" type="text" placeholder="Nome do cliente" id="customer-name" name="name" form="campaign-save" autocomplete="off" @if(!is_null($campaign)) value="{{ $campaign->name }}" @endif />
                </div>
                <div class="form-group">
                    <label for="customer-email">Assunto</label>
                    <input class="form-control" type="email" placeholder="Assunto" id="campaign-subject" name="email" form="campaign-save" autocomplete="off" @if(!is_null($campaign)) value="{{ $campaign->subject }}" @endif />
                </div>
                <div class="form-group">
                    <label for="campaign-bodytext">
                        Texto <br />
                        <small>Este texto aparece na mensagem, caso não esteja ativado o HTML no lado do recetor da campanha</small>
                    </label><br />
                    <textarea class="form-control txt-height-large" placeholder="Corpo" id="campaign-bodytext" name="body" form="campaign-save" autocomplete="off">@if(!is_null($campaign)) {{ $campaign->previewText }} @endif</textarea>
                </div>
                <div class="form-group">
                    <label for="campaign-body">Corpo</label>
                    <textarea class="form-control txt-height-large" placeholder="Corpo" id="campaign-body" name="body" form="campaign-save" autocomplete="off">@if(!is_null($campaign)) {{ $campaign->htmlContent }} @endif</textarea>
                </div>
            </div>
            <!-- Tags -->
            <livewire:app.tag-component id="{{ $campaign->code }}" />
        </div>
    </div>
    <div class="row mb-4" x-data="customers">
        <div class="col-md-8 offset-2 text-right pt-3">
            <form id="campaign-save" action="{{ route('campaigns.update', $campaign->code)   }}" method="post" autocomplete="off">
                {{ csrf_field() }}
                <button form="campaign-save" type="submit" class="btn btn-filter inverter pull-right">Guardar</button>
            </form>
        </div>
    </div>
@endsection


@push('scripts')
    <!-- Place the first <script> tag in your HTML's <head> -->
    <script src="https://cdn.tiny.cloud/1/349g0xw38zedeozsgai8uxjoypeybnnwrje5i7k0kgras11j/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
    <script>
        tinymce.init({
            language: 'pt_PT',
            selector: '#campaign-body',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [
                { value: 'First.Name', title: 'First Name' },
                { value: 'Email', title: 'Email' },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
        });
    </script>
@endpush
