<?php

namespace Harentius\WidgetsBundle\Entity;

use Doctrine\ORM\EntityRepository;

class WidgetRepository extends EntityRepository
{
    /**
     * @param array $route
     * @param int $page
     * @param string $position
     * @return Widget[]
     */
    public function findByRouteOrNullRouteAndPositionAndPageOrderedByPriority(array $route, $page, $position)
    {
        $qb = $this->createQueryBuilder('w');

        return $qb
            ->where($qb->expr()->in('w.route', [
                serialize($route),
                serialize(['name' => null, 'parameters' => []])
            ]))
            ->andWhere($qb->expr()->orX(
                'FIND_IN_SET(:page, w.showOnPages) > 0',
                $qb->expr()->isNull('w.showOnPages')
            ))
            ->andWhere('w.position = :position')
            ->setParameters([
                ':position' => $position,
                ':page' => $page,
            ])
            ->orderBy('w.priority', 'DESC')
            ->getQuery()
            ->execute()
        ;
    }
}
