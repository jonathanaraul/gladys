<?php

namespace Proyecto\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proyecto\PrincipalBundle\Entity\D100tVenEmitirorden
 *
 * @ORM\Table(name="d100t_ven_emitirorden")
 * @ORM\Entity
 */
class D100tVenEmitirorden
{
    /**
     * @var integer $d100pkVenEmitirorden
     *
     * @ORM\Column(name="d100pk_ven_emitirorden", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $d100pkVenEmitirorden;

    /**
     * @var integer $nuNdeorden
     *
     * @ORM\Column(name="nu_ndeorden", type="integer", nullable=false)
     */
    private $nuNdeorden;

    /**
     * @var integer $nuNdefactura
     *
     * @ORM\Column(name="nu_ndefactura", type="integer", nullable=true)
     */
    private $nuNdefactura;

    /**
     * @var datetime $feFecha
     *
     * @ORM\Column(name="fe_fecha", type="datetime", nullable=false)
     */
    private $feFecha;

    /**
     * @var text $txDireccion
     *
     * @ORM\Column(name="tx_direccion", type="text", nullable=false)
     */
    private $txDireccion;

    /**
     * @var text $txDpObservacion
     *
     * @ORM\Column(name="tx_dp_observacion", type="text", nullable=false)
     */
    private $txDpObservacion;

    /**
     * @var integer $nuAprobado
     *
     * @ORM\Column(name="nu_aprobado", type="integer", nullable=false)
     */
    private $nuAprobado;

    /**
     * @var integer $nuDespachado
     *
     * @ORM\Column(name="nu_despachado", type="integer", nullable=false)
     */
    private $nuDespachado;

    /**
     * @var integer $nuCerrado
     *
     * @ORM\Column(name="nu_cerrado", type="integer", nullable=false)
     */
    private $nuCerrado;

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


	public function getFeFechaString()
    {
        return $this->feFecha->format('d-m-Y');
    }
    /**
     * Get d100pkVenEmitirorden
     *
     * @return integer 
     */
    public function getD100pkVenEmitirorden()
    {
        return $this->d100pkVenEmitirorden;
    }

    /**
     * Set nuNdeorden
     *
     * @param integer $nuNdeorden
     */
    public function setNuNdeorden($nuNdeorden)
    {
        $this->nuNdeorden = $nuNdeorden;
    }

    /**
     * Get nuNdeorden
     *
     * @return integer 
     */
    public function getNuNdeorden()
    {
        return $this->nuNdeorden;
    }

    /**
     * Set nuNdefactura
     *
     * @param integer $nuNdefactura
     */
    public function setNuNdefactura($nuNdefactura)
    {
        $this->nuNdefactura = $nuNdefactura;
    }

    /**
     * Get nuNdefactura
     *
     * @return integer 
     */
    public function getNuNdefactura()
    {
        return $this->nuNdefactura;
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
     * Set txDireccion
     *
     * @param text $txDireccion
     */
    public function setTxDireccion($txDireccion)
    {
        $this->txDireccion = $txDireccion;
    }

    /**
     * Get txDireccion
     *
     * @return text 
     */
    public function getTxDireccion()
    {
        return $this->txDireccion;
    }

    /**
     * Set txDpObservacion
     *
     * @param text $txDpObservacion
     */
    public function setTxDpObservacion($txDpObservacion)
    {
        $this->txDpObservacion = $txDpObservacion;
    }

    /**
     * Get txDpObservacion
     *
     * @return text 
     */
    public function getTxDpObservacion()
    {
        return $this->txDpObservacion;
    }

    /**
     * Set nuAprobado
     *
     * @param integer $nuAprobado
     */
    public function setNuAprobado($nuAprobado)
    {
        $this->nuAprobado = $nuAprobado;
    }

    /**
     * Get nuAprobado
     *
     * @return integer 
     */
    public function getNuAprobado()
    {
        return $this->nuAprobado;
    }

    /**
     * Set nuDespachado
     *
     * @param integer $nuDespachado
     */
    public function setNuDespachado($nuDespachado)
    {
        $this->nuDespachado = $nuDespachado;
    }

    /**
     * Get nuDespachado
     *
     * @return integer 
     */
    public function getNuDespachado()
    {
        return $this->nuDespachado;
    }

    /**
     * Set nuCerrado
     *
     * @param integer $nuCerrado
     */
    public function setNuCerrado($nuCerrado)
    {
        $this->nuCerrado = $nuCerrado;
    }

    /**
     * Get nuCerrado
     *
     * @return integer 
     */
    public function getNuCerrado()
    {
        return $this->nuCerrado;
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