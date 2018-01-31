<?php

namespace App\Repository;

use App\Entity\Equipamento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class EquipamentoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Equipamento::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('e')
            ->where('e.something = :value')->setParameter('value', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
    public function ativos()
    {
        $now = new \DateTime();
        return $this->createQueryBuilder('e')
        ->where('e.vencimento >= :now')->setParameter('now', $now)
        ->getQuery()
        ->getResult();
    }

    public function ativosSql()
    {
        $now_obj = new \DateTime();
        $now = $now_obj->format('Y-m-d H:i:s');
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT * FROM equipamento e WHERE e.vencimento >= :now';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['now' => $now]);
        return $stmt->fetchAll();
    }
}
