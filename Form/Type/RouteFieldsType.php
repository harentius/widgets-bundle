<?php

namespace Harentius\WidgetsBundle\Form\Type;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccess;

class RouteFieldsType extends AbstractType
{
    /**
     * @var array
     */
    private $routes;

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->routes = [];
        $this->em = $em;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($options['route'] === null) {
            return;
        }

        if (!isset($this->routes[$options['route']])) {
            throw new \InvalidArgumentException(sprintf('Unknown route "%s"', $options['route']));
        }

        $propertyAccessor = PropertyAccess::createPropertyAccessor();
        $routeParameters = $this->routes[$options['route']]['parameters'];
        ksort($routeParameters);

        foreach ($routeParameters as $key => $parameter) {
            // TODO: Allow use other than 'findAll' query
            $entities = $this->em->getRepository($parameter['source']['class'])->findAll();
            $choices = [];

            foreach ($entities as $entity) {
                $choices[$propertyAccessor->getValue($entity, $parameter['source']['field'])] = $propertyAccessor->getValue($entity, $parameter['source']['identity']);
            }

            $builder->add($key, 'choice', [
                'choices' => $choices,
                'placeholder' => 'Select',
                'required' => false,
            ]);
        }
    }

    /**
     * @inheritdoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'route' => null,
            'csrf_protection' => false,
            'label' => false,
        ]);
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
        return 'harentius_widget_route_fields';
    }
}
