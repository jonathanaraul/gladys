<?php

namespace Proyecto\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proyecto\PrincipalBundle\Entity\D100tDesRepGuiades
 *
 * @ORM\Table(name="d100t_des_rep_guiades")
 * @ORM\Entity
 */
class D100tDesRepGuiades
{
    /**
     * @var integer $d100pkDesRepGuiades
     *
     * @ORM\Column(name="d100pk_des_rep_guiades", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $d100pkDesRepGuiades;

    /**
     * @var integer $nuNdeguia
     *
     * @ORM\Column(name="nu_ndeguia", type="integer", nullable=false)
     */
    private $nuNdeguia;

    /**
     * @var datetime $feFecha
     *
     * @ORM\Column(name="fe_fecha", type="datetime", nullable=false)
     */
    private $feFecha;

    /**
     * @var float $nuMonto
     *
     * @ORM\Column(name="nu_monto", type="float", nullable=false)
     */
    private $nuMonto;

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
     * @var D101tVenEmitirorden
     *
     * @ORM\ManyToOne(targetEntity="D101tVenEmitirorden")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="d101fk_ven_emitirorden", referencedColumnName="d101pk_ven_emitirorden")
     * })
     */
    private $d101fkVenEmitirorden;

	public function getFeFechaString()
    {
        return $this->feFecha->format('d-m-Y');
    }

    /**
     * Get d100pkDesRepGuiades
     *
     * @return integer 
     */
    public function getD100pkDesRepGuiades()
    {
        return $this->d100pkDesRepGuiades;
    }

    /**
     * Set nuNdeguia
     *
     * @param integer $nuNdeguia
     */
    public function setNuNdeguia($nuNdeguia)
    {
        $this->nuNdeguia = $nuNdeguia;
    }

    /**
     * Get nuNdeguia
     *
     * @return integer 
     */
    public function getNuNdeguia()
    {
        return $this->nuNdeguia;
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
     * Set nuMonto
     *
     * @param float $nuMonto
     */
    public function setNuMonto($nuMonto)
    {
        $this->nuMonto = $nuMonto;
    }

    /**
     * Get nuMonto
     *
     * @return float 
     */
    public function getNuMonto()
    {
        return $this->nuMonto;
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

    /**
     * Set d101fkVenEmitirorden
     *
     * @param Proyecto\PrincipalBundle\Entity\D101tVenEmitirorden $d101fkVenEmitirorden
     */
    public function setD101fkVenEmitirorden(\Proyecto\PrincipalBundle\Entity\D101tVenEmitirorden $d101fkVenEmitirorden)
    {
        $this->d101fkVenEmitirorden = $d101fkVenEmitirorden;
    }

    /**
     * Get d101fkVenEmitirorden
     *
     * @return Proyecto\PrincipalBundle\Entity\D101tVenEmitirorden 
     */
    public function getD101fkVenEmitirorden()
    {
        return $this->d101fkVenEmitirorden;
    }
}