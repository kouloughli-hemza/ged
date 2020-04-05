@foreach (\Kouloughli\Plugins\Kouloughli::availablePlugins() as $plugin)
    @include('partials.theme.menu.items', ['item' => $plugin->sidebar()])
@endforeach