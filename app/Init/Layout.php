<?php

namespace Init;

class Layout
{
    public function __construct(
        \Parable\Event\Hook     $hook,
        \Parable\Framework\View $view,
        \Parable\Http\Response  $response
    ) {
        $hook->into("parable_dispatch_before", function () use ($response, $view) {
            $response->prependContent($view->partial("app/View/Layout/header.phtml"));
        });
        $hook->into('parable_dispatch_after', function () use ($response, $view) {
            $response->appendContent($view->partial("app/View/Layout/footer.phtml"));
        });
    }
}
