<?php

namespace Routing;

use \Parable\Http\Request;

class App extends \Parable\Framework\Routing\AbstractRouting
{
    public function load()
    {
        $this->app->get(
            '/',
            [\Controller\Home::class, 'index'],
            'index'
        );
        $this->app->get(
            '/player/{playerId}',
            [\Controller\Home::class, 'player'],
            'player'
        );
        $this->app->get(
            '/player/{playerId}/{tallyId}',
            [\Controller\Home::class, 'playerTally'],
            'player-tally'
        );

        $this->app->multiple(
            ['GET', 'POST'],
            '/mutate/{playerTallyId}/{amount}',
            [\Controller\Home::class, 'mutate'],
            'mutate'
        );
        $this->app->multiple(
            ['GET', 'POST'],
            '/add-player',
            [\Controller\Home::class, 'addPlayer'],
            'add-player'
        );
        $this->app->multiple(
            ['GET', 'POST'],
            '/add-tally',
            [\Controller\Home::class, 'addTally'],
            'add-tally'
        );
        $this->app->multiple(
            ['GET', 'POST'],
            '/add-player-tally/{playerId}',
            [\Controller\Home::class, 'addPlayerTally'],
            'add-player-tally'
        );
        $this->app->multiple(
            ['GET', 'POST'],
            '/add-tally-to-player/{playerId}/{tallyId}',
            [\Controller\Home::class, 'addTallyToPlayer'],
            'add-tally-to-player'
        );
        $this->app->multiple(
            ['GET', 'POST'],
            '/remove-tally-from-player/{playerId}/{tallyId}',
            [\Controller\Home::class, 'removeTallyFromPlayer'],
            'remove-tally-from-player'
        );

        /* Exports */
        $this->app->get(
            '/exports',
            [\Controller\Export::class, 'index'],
            'exports'
        );
        $this->app->get(
            '/export-latest-mutation',
            [\Controller\Export::class, 'latestMutation'],
            'export-latest-mutation'
        );
    }
}
