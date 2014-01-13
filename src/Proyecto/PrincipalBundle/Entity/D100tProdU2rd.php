<?php

namespace Proyecto\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proyecto\PrincipalBundle\Entity\D100tProdU2rd
 *
 * @ORM\Table(name="d100t_prod_u2rd")
 * @ORM\Entity
 */
class D100tProdU2rd
{
    /**
     * @var integer $d100pkProdU2rd
     *
     * @ORM\Column(name="d100pk_prod_u2rd", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $d100pkProdU2rd;

    /**
     * @var datetime $feFecha
     *
     * @ORM\Column(name="fe_fecha", type="datetime", nullable=false)
     */
    private $feFecha;

    /**
     * @var text $txTipodesal
     *
     * @ORM\Column(name="tx_tipodesal", type="text", nullable=false)
     */
    private $txTipodesal;

    /**
     * @var text $txPresentacion
     *
     * @ORM\Column(name="tx_presentacion", type="text", nullable=false)
     */
    private $txPresentacion;

    /**
     * @var text $txUso
     *
     * @ORM\Column(name="tx_uso", type="text", nullable=false)
     */
    private $txUso;

    /**
     * @var float $nuCantsalnolavadaenpatio
     *
     * @ORM\Column(name="nu_cantsalnolavadaenpatio", type="float", nullable=false)
     */
    private $nuCantsalnolavadaenpatio;

    /**
     * @var float $nuTotaldesalnolavada
     *
     * @ORM\Column(name="nu_totaldesalnolavada", type="float", nullable=false)
     */
    private $nuTotaldesalnolavada;

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
     * Get d100pkProdU2rd
     *
     * @return integer 
     */
    public function getD100pkProdU2rd()
    {
        return $this->d100pkProdU2rd;
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
     * Set txTipodesal
     *
     * @param text $txTipodesal
     */
    public function setTxTipodesal($txTipodesal)
    {
        $this->txTipodesal = $txTipodesal;
    }

    /**
     * Get txTipodesal
     *
     * @return text 
     */
    public function getTxTipodesal()
    {
        return $this->txTipodesal;
    }

    /**
     * Set txPresentacion
     *
     * @param text $txPresentacion
     */
    public function setTxPresentacion($txPresentacion)
    {
        $this->txPresentacion = $txPresentacion;
    }

    /**
     * Get txPresentacion
     *
     * @return text 
     */
    public function getTxPresentacion()
    {
        return $this->txPresentacion;
    }

    /**
     * Set txUso
     *
     * @param text $txUso
     */
    public function setTxUso($txUso)
    {
        $this->txUso = $txUso;
    }

    /**
     * Get txUso
     *
     * @return text 
     */
    public function getTxUso()
    {
        return $this->txUso;
    }

    /**
     * Set nuCantsalnolavadaenpatio
     *
     * @param float $nuCantsalnolavadaenpatio
     */
    public function setNuCantsalnolavadaenpatio($nuCantsalnolavadaenpatio)
    {
        $this->nuCantsalnolavadaenpatio = $nuCantsalnolavadaenpatio;
    }

    /**
     * Get nuCantsalnolavadaenpatio
     *
     * @return float 
     */
    public function getNuCantsalnolavadaenpatio()
    {
        return $this->nuCantsalnolavadaenpatio;
    }

    /**
     * Set nuTotaldesalnolavada
     *
     * @param float $nuTotaldesalnolavada
     */
    public function setNuTotaldesalnolavada($nuTotaldesalnolavada)
    {
        $this->nuTotaldesalnolavada = $nuTotaldesalnolavada;
    }

    /**
     * Get nuTotaldesalnolavada
     *
     * @return float 
     */
    public function getNuTotaldesalnolavada()
    {
        return $this->nuTotaldesalnolavada;
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