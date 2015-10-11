<?php

namespace Harentius\WidgetsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class WidgetAdminController extends Controller
{
    /**
     * @param string $route
     * @return Response
     */
    public function routeFieldsAction($route)
    {
        $form = $this->createForm('harentius_widget_route_fields', null, [
            'route' => $route,
        ]);

        return $this->render('HarentiusWidgetsBundle:Widget:route_fields_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
