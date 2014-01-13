<?php

namespace Proyecto\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proyecto\PrincipalBundle\Entity\E100tTurno
 *
 * @ORM\Table(name="e100t_turno")
 * @ORM\Entity
 */
class E100tTurno
{
    /**
     * @var integer $e100pkTurno
     *
     * @ORM\Column(name="e100pk_turno", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $e100pkTurno;

    /**
     * @var string $inTurno
     *
     * @ORM\Column(name="in_turno", type="string", length=30, nullable=false)
     */
    private $inTurno;



    /**
     * Get e100pkTurno
     *
     * @return integer 
     */
    public function getE100pkTurno()
    {
        return $this->e100pkTurno;
    }

    /**
     * Set inTurno
     *
     * @param string $inTurno
     */
    public function setInTurno($inTurno)
    {
        $this->inTurno = $inTurno;
    }

    /**
     * Get inTurno
     *
     * @return string 
     */
    public function getInTurno()
    {
        return $this->inTurno;
    }
}