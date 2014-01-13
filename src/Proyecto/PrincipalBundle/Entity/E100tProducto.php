<?php

namespace Proyecto\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proyecto\PrincipalBundle\Entity\E100tProducto
 *
 * @ORM\Table(name="e100t_producto")
 * @ORM\Entity
 */
class E100tProducto
{
    /**
     * @var integer $e100pkProducto
     *
     * @ORM\Column(name="e100pk_producto", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $e100pkProducto;

    /**
     * @var string $inNombre
     *
     * @ORM\Column(name="in_nombre", type="string", length=30, nullable=false)
     */
    private $inNombre;

    /**
     * @var E100tUnidad
     *
     * @ORM\ManyToOne(targetEntity="E100tUnidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="e100fk_unidad", referencedColumnName="e100pk_unidad")
     * })
     */
    private $e100fkUnidad;



    /**
     * Get e100pkProducto
     *
     * @return integer 
     */
    public function getE100pkProducto()
    {
        return $this->e100pkProducto;
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

    /**
     * Set e100fkUnidad
     *
     * @param Proyecto\PrincipalBundle\Entity\E100tUnidad $e100fkUnidad
     */
    public function setE100fkUnidad(\Proyecto\PrincipalBundle\Entity\E100tUnidad $e100fkUnidad)
    {
        $this->e100fkUnidad = $e100fkUnidad;
    }

    /**
     * Get e100fkUnidad
     *
     * @return Proyecto\PrincipalBundle\Entity\E100tUnidad 
     */
    public function getE100fkUnidad()
    {
        return $this->e100fkUnidad;
    }
}