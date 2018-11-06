<?php

use Joshbrw\RSS\Routing\Route;

return [
    new Route('/', 'GET', 'HomeController@index'),
    new Route('/feeds', 'GET', 'FeedController@index'),
    new Route('/feeds/create', 'GET', 'FeedController@create'),
    new Route('/feeds', 'POST', 'FeedController@store'),
    new Route('/feeds/{id}/edit', 'GET', 'FeedController@edit'),
    new Route('/feeds/{id}/delete', 'POST', 'FeedController@delete'),
    new Route('/feeds/{id}', 'GET', 'FeedController@view'),
    new Route('/feeds/{id}', 'POST', 'FeedController@update'),
];
