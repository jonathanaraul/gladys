<?php

namespace Proyecto\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proyecto\PrincipalBundle\Entity\D101tProdU4rp
 *
 * @ORM\Table(name="d101t_prod_u4rp")
 * @ORM\Entity
 */
class D101tProdU4rp
{
    /**
     * @var integer $d101pkProdU4rp
     *
     * @ORM\Column(name="d101pk_prod_u4rp", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $d101pkProdU4rp;

    /**
     * @var text $txInicio
     *
     * @ORM\Column(name="tx_inicio", type="text", nullable=false)
     */
    private $txInicio;

    /**
     * @var text $txFin
     *
     * @ORM\Column(name="tx_fin", type="text", nullable=false)
     */
    private $txFin;

    /**
     * @var text $txDescripcion
     *
     * @ORM\Column(name="tx_descripcion", type="text", nullable=false)
     */
    private $txDescripcion;

    /**
     * @var text $txInsumos
     *
     * @ORM\Column(name="tx_insumos", type="text", nullable=false)
     */
    private $txInsumos;

    /**
     * @var float $nuCantdeinsumos
     *
     * @ORM\Column(name="nu_cantdeinsumos", type="float", nullable=false)
     */
    private $nuCantdeinsumos;

    /**
     * @var text $txObservaciones
     *
     * @ORM\Column(name="tx_observaciones", type="text", nullable=false)
     */
    private $txObservaciones;

    /**
     * @var D100tProdU4rp
     *
     * @ORM\ManyToOne(targetEntity="D100tProdU4rp")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="d100fk_prod_u4rp", referencedColumnName="d100pk_prod_u4rp")
     * })
     */
    private $d100fkProdU4rp;

    /**
     * @var E100tTurno
     *
     * @ORM\ManyToOne(targetEntity="E100tTurno")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="e100fk_turno", referencedColumnName="e100pk_turno")
     * })
     */
    private $e100fkTurno;



    /**
     * Get d101pkProdU4rp
     *
     * @return integer 
     */
    public function getD101pkProdU4rp()
    {
        return $this->d101pkProdU4rp;
    }

    /**
     * Set txInicio
     *
     * @param text $txInicio
     */
    public function setTxInicio($txInicio)
    {
        $this->txInicio = $txInicio;
    }

    /**
     * Get txInicio
     *
     * @return text 
     */
    public function getTxInicio()
    {
        return $this->txInicio;
    }

    /**
     * Set txFin
     *
     * @param text $txFin
     */
    public function setTxFin($txFin)
    {
        $this->txFin = $txFin;
    }

    /**
     * Get txFin
     *
     * @return text 
     */
    public function getTxFin()
    {
        return $this->txFin;
    }

    /**
     * Set txDescripcion
     *
     * @param text $txDescripcion
     */
    public function setTxDescripcion($txDescripcion)
    {
        $this->txDescripcion = $txDescripcion;
    }

    /**
     * Get txDescripcion
     *
     * @return text 
     */
    public function getTxDescripcion()
    {
        return $this->txDescripcion;
    }

    /**
     * Set txInsumos
     *
     * @param text $txInsumos
     */
    public function setTxInsumos($txInsumos)
    {
        $this->txInsumos = $txInsumos;
    }

    /**
     * Get txInsumos
     *
     * @return text 
     */
    public function getTxInsumos()
    {
        return $this->txInsumos;
    }

    /**
     * Set nuCantdeinsumos
     *
     * @param float $nuCantdeinsumos
     */
    public function setNuCantdeinsumos($nuCantdeinsumos)
    {
        $this->nuCantdeinsumos = $nuCantdeinsumos;
    }

    /**
     * Get nuCantdeinsumos
     *
     * @return float 
     */
    public function getNuCantdeinsumos()
    {
        return $this->nuCantdeinsumos;
    }

    /**
     * Set txObservaciones
     *
     * @param text $txObservaciones
     */
    public function setTxObservaciones($txObservaciones)
    {
        $this->txObservaciones = $txObservaciones;
    }

    /**
     * Get txObservaciones
     *
     * @return text 
     */
    public function getTxObservaciones()
    {
        return $this->txObservaciones;
    }

    /**
     * Set d100fkProdU4rp
     *
     * @param Proyecto\PrincipalBundle\Entity\D100tProdU4rp $d100fkProdU4rp
     */
    public function setD100fkProdU4rp(\Proyecto\PrincipalBundle\Entity\D100tProdU4rp $d100fkProdU4rp)
    {
        $this->d100fkProdU4rp = $d100fkProdU4rp;
    }

    /**
     * Get d100fkProdU4rp
     *
     * @return Proyecto\PrincipalBundle\Entity\D100tProdU4rp 
     */
    public function getD100fkProdU4rp()
    {
        return $this->d100fkProdU4rp;
    }

    /**
     * Set e100fkTurno
     *
     * @param Proyecto\PrincipalBundle\Entity\E100tTurno $e100fkTurno
     */
    public function setE100fkTurno(\Proyecto\PrincipalBundle\Entity\E100tTurno $e100fkTurno)
    {
        $this->e100fkTurno = $e100fkTurno;
    }

    /**
     * Get e100fkTurno
     *
     * @return Proyecto\PrincipalBundle\Entity\E100tTurno 
     */
    public function getE100fkTurno()
    {
        return $this->e100fkTurno;
    }
}