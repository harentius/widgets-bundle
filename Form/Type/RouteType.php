<?php

namespace Harentius\WidgetsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RouteType extends AbstractType
{
    /**
     * @var array
     */
    private $routes;

    /**
     *
     */
    public function __construct()
    {
        $this->routes = [];
    }

    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $routesChoice = [];

        foreach ($this->routes as $key => $route) {
            $routesChoice[$key] = $route['name'];
        }

        $builder->add('name', 'choice', [
            'label' => 'Route',
            'choices' => $routesChoice,
            'empty_data' => null,
            'placeholder' => 'All'
        ])->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) use ($options) {
            $formData = $event->getData();
            $this->formModifier($event->getForm(), isset($formData['name']) ? $formData['name'] : null);
        });

        $builder->get('name')->addEventListener(FormEvents::POST_SUBMIT, function(FormEvent $event) use ($options) {
            $this->formModifier($event->getForm()->getParent(), $event->getForm()->getData());
        });
    }

    /**
     * @param string $key
     * @param string $route
     */
    public function registerRoute($key, $route)
    {
        $this->routes[$key] = $route;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'harentius_widget_route';
    }

    /**
     * @param FormInterface $form
     * @param string $route
     */
    private function formModifier(FormInterface $form, $route)
    {
        $form->add('parameters', 'harentius_widget_route_fields', [
            'route' => $route,
            'label' => 'Parameters:',
            'attr' => [
                'class' => 'route-fields',
            ]
        ]);
    }
}
