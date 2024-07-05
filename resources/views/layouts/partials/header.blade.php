
<header id="app-main-header">
    <section id="app-main-search">
        <label for="app-main-search">
            <i class="ri ri-search-line"></i>
        </label>
        <input id="app-main-search" name="app-main-search" type="text" placeholder="Pesquise por qualquer coisa" />
    </section>
    <!-- Real datetime -->
    <section id="app-main-datetime">
        <label><i class="ri ri-calendar-2-line"></i></label>
        Hoje, <strong>{{ date_format_trans('M d') }}</strong>
    </section>
{{--        <div id="app-main-logged-avatar">--}}
{{--            <img src="{{ auth()->user()->avatar->image }}" />--}}
{{--        </div>--}}
    </section>
</header>
