<?php

/*
 * This file is part of Sulu.
 *
 * (c) MASSIVE ART WebServices GmbH
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Sulu\Bundle\RedirectBundle\Controller;

use Sulu\Bundle\RedirectBundle\Model\RedirectRouteInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Handles redirects.
 */
class RedirectController
{
    /**
     * Handles redirect for given redirect-route.
     *
     * @param Request $request
     * @param RedirectRouteInterface $redirectRoute
     *
     * @return RedirectResponse
     */
    public function redirect(Request $request, RedirectRouteInterface $redirectRoute)
    {
        $queryString = http_build_query($request->query->all());
        $url = [
            $request->getSchemeAndHttpHost(),
            $redirectRoute->getTarget(),
            (!empty($queryString) ? '?' : ''),
            $queryString,
        ];

        return new RedirectResponse(implode($url), $redirectRoute->getStatusCode());
    }
}