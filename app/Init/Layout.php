<?php

namespace Init;

class Layout
{
    public function __construct(
        \Parable\Event\Hook     $hook,
        \Parable\Framework\View $view,
        \Parable\Http\Response  $response
    ) {
        $response->setHeaderContent($view->partial("app/View/Layout/header.phtml"));
        $response->setFooterContent($view->partial("app/View/Layout/footer.phtml"));
    }
}
