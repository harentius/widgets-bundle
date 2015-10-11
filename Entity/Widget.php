<?php

namespace Harentius\WidgetsBundle\Entity;

use Harentius\BlogBundle\Entity\Base\IdentifiableEntityTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as SymfonyConstraints;

/**
 * @ORM\Entity(repositoryClass="Harentius\WidgetsBundle\Entity\WidgetRepository")
 */
class Widget
{
    use IdentifiableEntityTrait;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     * @SymfonyConstraints\Type(type="string")
     * @SymfonyConstraints\NotBlank()
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     * @SymfonyConstraints\Type(type="string")
     * @SymfonyConstraints\NotBlank()
     */
    private $content;

    /**
     * @var array
     *
     * @ORM\Column(type="array", nullable=true)
     * @SymfonyConstraints\Type(type="array")
     */
    private $route;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     * @SymfonyConstraints\Type(type="string")
     * @SymfonyConstraints\NotBlank()
     */
    private $position;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @SymfonyConstraints\Type(type="integer")
     * @SymfonyConstraints\NotBlank()
     */
    private $priority;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     * @SymfonyConstraints\Type(type="string")
     */
    private $backLink;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     * @SymfonyConstraints\Type(type="string")
     */
    private $showOnPages;

    /**
     *
     */
    public function __construct()
    {
        $this->priority = 0;
        $this->showOnPages = [];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setName($value)
    {
        $this->name = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setContent($value)
    {
        $this->content = $value;

        return $this;
    }

    /**
     * @return array
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param array $value
     * @return $this
     */
    public function setRoute($value)
    {
        $this->route = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setPosition($value)
    {
        $this->position = $value;

        return $this;
    }

    /**
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setPriority($value)
    {
        $this->priority = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getBackLink()
    {
        return $this->backLink;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setBackLink($value)
    {
        $this->backLink = $value;

        return $this;
    }

    /**
     * @return array
     */
    public function getShowOnPages()
    {
        return $this->showOnPages;
    }

    /**
     * @param array $value
     * @return $this
     */
    public function setShowOnPages($value)
    {
        $this->showOnPages = $value;

        return $this;
    }
}
