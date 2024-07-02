<header id="app-sidebar-header">
    <div id="app-brand">
        <a href="{{  route('static.home') }}">
            <img src="https://media.istockphoto.com/id/1348342862/pt/vetorial/gorilla-logo-design-template-inspiration-idea-concept.jpg?s=612x612&w=0&k=20&c=1ecwGVO8LRR9JfS4UoK0xCfZAeUxf_IkhZSHgG8TeLE=" />
        </a>
    </div>
</header>

<nav id="app-sidebar-nav">
    <ul>
        <li class="nav-item">
            <a href="{{ route('static.home') }}">
                <i class="ri ri-home-line"></i>
                <p>Inicio</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('clients.index') }}">
                <i class="ri ri-user-line"></i>
                <p>Clientes</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('campaigns.index') }}">
                <i class="ri ri-mail-line"></i>
                <p>Campanhas</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('tags.index') }}">
                <i class="ri ri-price-tag-2-line"></i>
                <p>Tags</p>
            </a>
        </li>
    </ul>
</nav>
