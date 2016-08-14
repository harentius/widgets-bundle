<?php

namespace Harentius\WidgetsBundle\Twig;

use Harentius\WidgetsBundle\Entity\WidgetRepository;
use Symfony\Component\HttpFoundation\RequestStack;

class WidgetsExtension extends \Twig_Extension
{
    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @var WidgetRepository
     */
    private $widgetRepository;

    /**
     * @param RequestStack $requestStack
     * @param WidgetRepository $widgetRepository
     */
    public function __construct(RequestStack $requestStack, WidgetRepository $widgetRepository)
    {
        $this->requestStack = $requestStack;
        $this->widgetRepository = $widgetRepository;
    }

    /**
     * @inheritdoc
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('harentius_widget', [$this, 'harentiusWidget'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * @param string $position
     * @return string
     */
    public function harentiusWidget($position)
    {
        $request = $this->requestStack->getMasterRequest();
        $requestAttributes = $request->attributes;
        $page = (int) $request->query->get('page', 1);

        $parameters = $requestAttributes->get('_route_params');
        ksort($parameters);
        $route = [
            'name' => $requestAttributes->get('_route'),
            'parameters' => $parameters
        ];
        $widgets = $this->widgetRepository->findByRouteOrNullRouteAndPositionAndPageOrderedByPriority($route, $page, $position);
        $result = '';

        foreach ($widgets as $widget) {
            $result .= $widget->getContent();
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'harentius_widgets_extension';
    }
}
