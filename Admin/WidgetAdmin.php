<?php

namespace Harentius\WidgetsBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class WidgetAdmin extends Admin
{
    /**
     * {@inheritDoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name')
            ->add('position')
            ->add('showOnPages')
            ->add('priority')
            ->add('backLink')
            ->add('_action', 'actions', [
                'actions' => [
                    'edit' => [],
                    'delete' => [],
                ]
            ])
        ;
    }

    /**
     * {@inheritDoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text')
            ->add('route', 'harentius_widget_route', [
                'label' => false,
                'required' => false,
            ])
            ->add('position', 'harentius_widget_position')
            ->add('priority')
            ->add('showOnPages')
            ->add('content', 'textarea', [
                'attr' => ['class' => 'widget-content']
            ])
            ->add('backLink', 'text', [
                'label' => 'Backlink',
                'required' => false,
            ])
        ;
    }
}
