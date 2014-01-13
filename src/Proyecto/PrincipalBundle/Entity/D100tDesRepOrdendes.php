<?php

namespace Proyecto\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proyecto\PrincipalBundle\Entity\D100tDesRepOrdendes
 *
 * @ORM\Table(name="d100t_des_rep_ordendes")
 * @ORM\Entity
 */
class D100tDesRepOrdendes
{
    /**
     * @var integer $d100pkDesRepOrdendes
     *
     * @ORM\Column(name="d100pk_des_rep_ordendes", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $d100pkDesRepOrdendes;

    /**
     * @var datetime $feFecha
     *
     * @ORM\Column(name="fe_fecha", type="datetime", nullable=false)
     */
    private $feFecha;

    /**
     * @var integer $nuMonto
     *
     * @ORM\Column(name="nu_monto", type="integer", nullable=false)
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
     * @var D100tVenInfocliente
     *
     * @ORM\ManyToOne(targetEntity="D100tVenInfocliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="d100fk_ven_infocliente", referencedColumnName="d100pk_ven_infocliente")
     * })
     */
    private $d100fkVenInfocliente;



    /**
     * Get d100pkDesRepOrdendes
     *
     * @return integer 
     */
    public function getD100pkDesRepOrdendes()
    {
        return $this->d100pkDesRepOrdendes;
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
     * @param integer $nuMonto
     */
    public function setNuMonto($nuMonto)
    {
        $this->nuMonto = $nuMonto;
    }

    /**
     * Get nuMonto
     *
     * @return integer 
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
     * Set d100fkVenInfocliente
     *
     * @param Proyecto\PrincipalBundle\Entity\D100tVenInfocliente $d100fkVenInfocliente
     */
    public function setD100fkVenInfocliente(\Proyecto\PrincipalBundle\Entity\D100tVenInfocliente $d100fkVenInfocliente)
    {
        $this->d100fkVenInfocliente = $d100fkVenInfocliente;
    }

    /**
     * Get d100fkVenInfocliente
     *
     * @return Proyecto\PrincipalBundle\Entity\D100tVenInfocliente 
     */
    public function getD100fkVenInfocliente()
    {
        return $this->d100fkVenInfocliente;
    }
}