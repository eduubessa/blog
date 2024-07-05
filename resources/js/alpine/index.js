import Alpine from 'alpinejs';
import Axios from 'axios';

import tags from './components/tags';
import header from './components/header';
import clients from './components/clients.js'

window.axios = Axios.default;

window.tags = tags;
window.header = header;
window.clients = clients;

Alpine.data('tags', tags);
Alpine.data('header', header);
Alpine.data('clients', clients);

Alpine.start();
