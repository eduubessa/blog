<div x-data="customers">
    <div class="row mt-3">
        <div class="col-md-9">
            <h6 class="mt-2">Informações do cliente</h6>
        </div>
        <div class="col-md-3">
            @if(!is_null($client))
                <button form="customer-save" type="submit" class="btn btn-filter btn-small pull-right">Guardar</button>
            @endif
        </div>
    </div>
    <hr />
    <div class="form-group">
        <label for="customer-username">Nome</label>
        <input class="form-control" type="text" placeholder="Nome do cliente" id="customer-name" name="name" form="customer-save" autocomplete="off" @if(!is_null($client)) value="{{ decrypt_data($client->user->firstname) }}" @endif />
    </div>
    <div class="form-group">
        <label for="customer-email">E-mail</label>
        <input class="form-control" type="email" placeholder="E-mail" id="customer-email" name="email" form="customer-save" autocomplete="off" @if(!is_null($client)) value="{{ decrypt_data($client->email) }}" @endif />
    </div>
    <div class="form-group">
        <label for="customer-username">Data de nascimento</label>
        <input class="form-control" type="date" id="customer-birthday" name="birthday" form="customer-save" autocomplete="off" @if(!is_null($client)) value="{{ $client->birthday }}" @endif />
    </div>
    <div class="form-group">
        <label for="customer-username">Morada</label>
        <input class="form-control" tcype="text" placeholder="Rua, Avenida" id="customer-address-line-1" name="address-line-1" form="customer-save" autocomplete="off" @if(!is_null($client)) value="{{ decrypt_data($client->address_line_1) }}" @endif />
    </div>
    <div class="form-group">
        <label for="customer-username">Porta, Andar, Letra</label>
        <input class="form-control" type="text" placeholder="Porta, Andar, Letra" id="customer-address-line-2" name="address-line-2" form="customer-save" autocomplete="off" @if(!is_null($client)) value="{{ decrypt_data($client->address_line_2) }}" @endif  />
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="customer-username">Código Postal</label>
                <input x-model="customer.postcode" x-mask="9999-999" @change="setPostcodeEventHandler" class="form-control" type="text" placeholder="Código Postal" id="customer-postcode" name="postcode" form="customer-save" autocomplete="off" @if($client) value="{{ decrypt_data($client->zip) }}" @endif  />
            </div>
        </div>
        <div class="col-md-7">
            <div class="form-group">
                <label for="customer-username">Localidade</label>
                <input x-model="customer.location" class="form-control" type="text" placeholder="Localidade" id="customer-location" name="location" form="customer-save" autocomplete="off" @if(!is_null($client)) value="{{ decrypt_data($client->location) }}" @endif  disabled />
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="customer-mobile">Telemóvel</label>
        <input x-mask="999 999 999" class="form-control" type="text" placeholder="Telemóvel" id="customer-mobile" name="mobile" form="customer-save" @if(!is_null($client)) value="{{ $client->phone }}" @endif  />
    </div>
</div>
