<?php

namespace Proyecto\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proyecto\PrincipalBundle\Entity\E100tUnidad
 *
 * @ORM\Table(name="e100t_unidad")
 * @ORM\Entity
 */
class E100tUnidad
{
    /**
     * @var integer $e100pkUnidad
     *
     * @ORM\Column(name="e100pk_unidad", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $e100pkUnidad;

    /**
     * @var integer $nuNumero
     *
     * @ORM\Column(name="nu_numero", type="integer", nullable=false)
     */
    private $nuNumero;

    /**
     * @var string $inNombre
     *
     * @ORM\Column(name="in_nombre", type="string", length=30, nullable=false)
     */
    private $inNombre;



    /**
     * Get e100pkUnidad
     *
     * @return integer 
     */
    public function getE100pkUnidad()
    {
        return $this->e100pkUnidad;
    }

    /**
     * Set nuNumero
     *
     * @param integer $nuNumero
     */
    public function setNuNumero($nuNumero)
    {
        $this->nuNumero = $nuNumero;
    }

    /**
     * Get nuNumero
     *
     * @return integer 
     */
    public function getNuNumero()
    {
        return $this->nuNumero;
    }

    /**
     * Set inNombre
     *
     * @param string $inNombre
     */
    public function setInNombre($inNombre)
    {
        $this->inNombre = $inNombre;
    }

    /**
     * Get inNombre
     *
     * @return string 
     */
    public function getInNombre()
    {
        return $this->inNombre;
    }
}