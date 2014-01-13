<?php

namespace Proyecto\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proyecto\PrincipalBundle\Entity\D100tProdU4rpf
 *
 * @ORM\Table(name="d100t_prod_u4rpf")
 * @ORM\Entity
 */
class D100tProdU4rpf
{
    /**
     * @var integer $d100pkProdU4rpf
     *
     * @ORM\Column(name="d100pk_prod_u4rpf", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $d100pkProdU4rpf;

    /**
     * @var datetime $feFecha
     *
     * @ORM\Column(name="fe_fecha", type="datetime", nullable=false)
     */
    private $feFecha;

    /**
     * @var text $txObservacion
     *
     * @ORM\Column(name="tx_observacion", type="text", nullable=true)
     */
    private $txObservacion;

    /**
     * @var I100tUsuario
     *
     * @ORM\ManyToOne(targetEntity="I100tUsuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="i100fk_usuario", referencedColumnName="i100pk_usuario")
     * })
     */
    private $i100fkUsuario;



    /**
     * Get d100pkProdU4rpf
     *
     * @return integer 
     */
    public function getD100pkProdU4rpf()
    {
        return $this->d100pkProdU4rpf;
    }

    /**
     * Set feFecha
     *
     * @param datetime $feFecha
     */
    public function setFeFecha($feFecha)
    {
        $this->feFecha = $feFecha;
    }

    /**
     * Get feFecha
     *
     * @return datetime 
     */
    public function getFeFecha()
    {
        return $this->feFecha;
    }

    /**
     * Set txObservacion
     *
     * @param text $txObservacion
     */
    public function setTxObservacion($txObservacion)
    {
        $this->txObservacion = $txObservacion;
    }

    /**
     * Get txObservacion
     *
     * @return text 
     */
    public function getTxObservacion()
    {
        return $this->txObservacion;
    }

    /**
     * Set i100fkUsuario
     *
     * @param Proyecto\PrincipalBundle\Entity\I100tUsuario $i100fkUsuario
     */
    public function setI100fkUsuario(\Proyecto\PrincipalBundle\Entity\I100tUsuario $i100fkUsuario)
    {
        $this->i100fkUsuario = $i100fkUsuario;
    }

    /**
     * Get i100fkUsuario
     *
     * @return Proyecto\PrincipalBundle\Entity\I100tUsuario 
     */
    public function getI100fkUsuario()
    {
        return $this->i100fkUsuario;
    }
}