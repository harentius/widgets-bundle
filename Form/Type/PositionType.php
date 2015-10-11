<?php

namespace Harentius\WidgetsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PositionType extends AbstractType
{
    /**
     * @var array
     */
    private $positions;

    /**
     *
     */
    public function __construct()
    {
        $this->positions = [];
    }

    /**
     * @param string $blockName
     * @param string $title
     */
    public function registerPosition($blockName, $title)
    {
        $this->positions[$blockName] = $title;
    }

    /**
     * @inheritdoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('choices', $this->positions);
    }

    /**
     * @inheritdoc
     */
    public function getParent()
    {
        return 'choice';
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'harentius_widget_position';
    }
}
