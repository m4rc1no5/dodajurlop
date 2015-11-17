<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 17.11.15
 * Time: 21:24
 */

namespace AppBundle\Response;


use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class RefererRedirectResponse extends RedirectResponse
{
    public function __construct(Request $request, $status = 302, $headers = [])
    {
        parent::__construct($request->headers->get('referer'), $status, $headers);
    }
}