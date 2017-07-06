<?php

namespace Routing;

class App implements
    \Parable\Framework\Interfaces\Routing
{
    public function get()
    {
        return [
            'index' => [
                'methods' => ['GET'],
                'url' => '/',
                'controller' => \Controller\Home::class,
                'action' => 'index',
            ],
            'player' => [
                'methods' => ['GET'],
                'url' => '/player/{playerId}',
                'controller' => \Controller\Home::class,
                'action' => 'player',
            ],
            'mutate' => [
                'methods' => ['GET', 'POST'],
                'url' => '/mutate/{playerTallyId}/{amount}',
                'controller' => \Controller\Home::class,
                'action' => 'mutate',
            ],
            'add-player' => [
                'methods' => ['GET', 'POST'],
                'url' => '/add-player',
                'controller' => \Controller\Home::class,
                'action' => 'addPlayer',
            ],
            'add-tally' => [
                'methods' => ['GET', 'POST'],
                'url' => '/add-tally',
                'controller' => \Controller\Home::class,
                'action' => 'addTally',
            ],
            'add-player-tally' => [
                'methods' => ['GET', 'POST'],
                'url' => '/add-player-tally/{playerId}',
                'controller' => \Controller\Home::class,
                'action' => 'addPlayerTally',
            ],
            'add-tally-to-player' => [
                'methods' => ['GET', 'POST'],
                'url' => '/add-tally-to-player/{playerId}/{tallyId}',
                'controller' => \Controller\Home::class,
                'action' => 'addTallyToPlayer',
            ],
            'remove-tally-from-player' => [
                'methods' => ['GET', 'POST'],
                'url' => '/remove-tally-from-player/{playerId}/{tallyId}',
                'controller' => \Controller\Home::class,
                'action' => 'removeTallyFromPlayer',
            ],
        ];
    }
}
