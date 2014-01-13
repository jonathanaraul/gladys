<?php

namespace Proyecto\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proyecto\PrincipalBundle\Entity\D100tInventario
 *
 * @ORM\Table(name="d100t_inventario")
 * @ORM\Entity
 */
class D100tInventario
{
    /**
     * @var integer $d100pkInventario
     *
     * @ORM\Column(name="d100pk_inventario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $d100pkInventario;

    /**
     * @var integer $nuTipodeinventario
     *
     * @ORM\Column(name="nu_tipodeinventario", type="integer", nullable=false)
     */
    private $nuTipodeinventario;

    /**
     * @var text $txNombre
     *
     * @ORM\Column(name="tx_nombre", type="text", nullable=false)
     */
    private $txNombre;

    /**
     * @var datetime $feFecha
     *
     * @ORM\Column(name="fe_fecha", type="datetime", nullable=false)
     */
    private $feFecha;

    /**
     * @var float $nuSrmInicial
     *
     * @ORM\Column(name="nu_srm_inicial", type="float", nullable=true)
     */
    private $nuSrmInicial;

    /**
     * @var float $nuSrmProduccion
     *
     * @ORM\Column(name="nu_srm_produccion", type="float", nullable=true)
     */
    private $nuSrmProduccion;

    /**
     * @var float $nuSrmRecuperado
     *
     * @ORM\Column(name="nu_srm_recuperado", type="float", nullable=true)
     */
    private $nuSrmRecuperado;

    /**
     * @var float $nuSrmDespachado
     *
     * @ORM\Column(name="nu_srm_despachado", type="float", nullable=true)
     */
    private $nuSrmDespachado;

    /**
     * @var float $nuSrmDaniado
     *
     * @ORM\Column(name="nu_srm_daniado", type="float", nullable=true)
     */
    private $nuSrmDaniado;

    /**
     * @var float $nuSrmDonado
     *
     * @ORM\Column(name="nu_srm_donado", type="float", nullable=true)
     */
    private $nuSrmDonado;

    /**
     * @var float $nuSrmPdesp
     *
     * @ORM\Column(name="nu_srm_pdesp", type="float", nullable=true)
     */
    private $nuSrmPdesp;

    /**
     * @var text $txSrmObservacion
     *
     * @ORM\Column(name="tx_srm_observacion", type="text", nullable=true)
     */
    private $txSrmObservacion;

    /**
     * @var float $nuSrfInicial
     *
     * @ORM\Column(name="nu_srf_inicial", type="float", nullable=true)
     */
    private $nuSrfInicial;

    /**
     * @var float $nuSrfProduccion
     *
     * @ORM\Column(name="nu_srf_produccion", type="float", nullable=true)
     */
    private $nuSrfProduccion;

    /**
     * @var float $nuSrfRecuperado
     *
     * @ORM\Column(name="nu_srf_recuperado", type="float", nullable=true)
     */
    private $nuSrfRecuperado;

    /**
     * @var float $nuSrfDespachado
     *
     * @ORM\Column(name="nu_srf_despachado", type="float", nullable=true)
     */
    private $nuSrfDespachado;

    /**
     * @var float $nuSrfDaniado
     *
     * @ORM\Column(name="nu_srf_daniado", type="float", nullable=true)
     */
    private $nuSrfDaniado;

    /**
     * @var float $nuSrfDonado
     *
     * @ORM\Column(name="nu_srf_donado", type="float", nullable=true)
     */
    private $nuSrfDonado;

    /**
     * @var float $nuSrfPdesp
     *
     * @ORM\Column(name="nu_srf_pdesp", type="float", nullable=true)
     */
    private $nuSrfPdesp;

    /**
     * @var text $txSrfObservacion
     *
     * @ORM\Column(name="tx_srf_observacion", type="text", nullable=true)
     */
    private $txSrfObservacion;

    /**
     * @var float $nuSrgInicial
     *
     * @ORM\Column(name="nu_srg_inicial", type="float", nullable=true)
     */
    private $nuSrgInicial;

    /**
     * @var float $nuSrgProduccion
     *
     * @ORM\Column(name="nu_srg_produccion", type="float", nullable=true)
     */
    private $nuSrgProduccion;

    /**
     * @var float $nuSrgRecuperado
     *
     * @ORM\Column(name="nu_srg_recuperado", type="float", nullable=true)
     */
    private $nuSrgRecuperado;

    /**
     * @var float $nuSrgDespachado
     *
     * @ORM\Column(name="nu_srg_despachado", type="float", nullable=true)
     */
    private $nuSrgDespachado;

    /**
     * @var float $nuSrgDaniado
     *
     * @ORM\Column(name="nu_srg_daniado", type="float", nullable=true)
     */
    private $nuSrgDaniado;

    /**
     * @var float $nuSrgDonado
     *
     * @ORM\Column(name="nu_srg_donado", type="float", nullable=true)
     */
    private $nuSrgDonado;

    /**
     * @var float $nuSrgPdesp
     *
     * @ORM\Column(name="nu_srg_pdesp", type="float", nullable=true)
     */
    private $nuSrgPdesp;

    /**
     * @var text $txSrgObservacion
     *
     * @ORM\Column(name="tx_srg_observacion", type="text", nullable=true)
     */
    private $txSrgObservacion;

    /**
     * @var float $nuSreInicial
     *
     * @ORM\Column(name="nu_sre_inicial", type="float", nullable=true)
     */
    private $nuSreInicial;

    /**
     * @var float $nuSreProduccion
     *
     * @ORM\Column(name="nu_sre_produccion", type="float", nullable=true)
     */
    private $nuSreProduccion;

    /**
     * @var float $nuSreRecuperado
     *
     * @ORM\Column(name="nu_sre_recuperado", type="float", nullable=true)
     */
    private $nuSreRecuperado;

    /**
     * @var float $nuSreDespachado
     *
     * @ORM\Column(name="nu_sre_despachado", type="float", nullable=true)
     */
    private $nuSreDespachado;

    /**
     * @var float $nuSreDaniado
     *
     * @ORM\Column(name="nu_sre_daniado", type="float", nullable=true)
     */
    private $nuSreDaniado;

    /**
     * @var float $nuSreDonado
     *
     * @ORM\Column(name="nu_sre_donado", type="float", nullable=true)
     */
    private $nuSreDonado;

    /**
     * @var float $nuSrePdesp
     *
     * @ORM\Column(name="nu_sre_pdesp", type="float", nullable=true)
     */
    private $nuSrePdesp;

    /**
     * @var text $txSreObservacion
     *
     * @ORM\Column(name="tx_sre_observacion", type="text", nullable=true)
     */
    private $txSreObservacion;

    /**
     * @var float $nuSbbfInicial
     *
     * @ORM\Column(name="nu_sbbf_inicial", type="float", nullable=true)
     */
    private $nuSbbfInicial;

    /**
     * @var float $nuSbbfProduccion
     *
     * @ORM\Column(name="nu_sbbf_produccion", type="float", nullable=true)
     */
    private $nuSbbfProduccion;

    /**
     * @var float $nuSbbfRecuperado
     *
     * @ORM\Column(name="nu_sbbf_recuperado", type="float", nullable=true)
     */
    private $nuSbbfRecuperado;

    /**
     * @var float $nuSbbfDespachado
     *
     * @ORM\Column(name="nu_sbbf_despachado", type="float", nullable=true)
     */
    private $nuSbbfDespachado;

    /**
     * @var float $nuSbbfDaniado
     *
     * @ORM\Column(name="nu_sbbf_daniado", type="float", nullable=true)
     */
    private $nuSbbfDaniado;

    /**
     * @var float $nuSbbfDonado
     *
     * @ORM\Column(name="nu_sbbf_donado", type="float", nullable=true)
     */
    private $nuSbbfDonado;

    /**
     * @var float $nuSbbfPdesp
     *
     * @ORM\Column(name="nu_sbbf_pdesp", type="float", nullable=true)
     */
    private $nuSbbfPdesp;

    /**
     * @var text $txSbbfObservacion
     *
     * @ORM\Column(name="tx_sbbf_observacion", type="text", nullable=true)
     */
    private $txSbbfObservacion;

    /**
     * @var float $nuSbbeInicial
     *
     * @ORM\Column(name="nu_sbbe_inicial", type="float", nullable=true)
     */
    private $nuSbbeInicial;

    /**
     * @var float $nuSbbeProduccion
     *
     * @ORM\Column(name="nu_sbbe_produccion", type="float", nullable=true)
     */
    private $nuSbbeProduccion;

    /**
     * @var float $nuSbbeRecuperado
     *
     * @ORM\Column(name="nu_sbbe_recuperado", type="float", nullable=true)
     */
    private $nuSbbeRecuperado;

    /**
     * @var float $nuSbbeDespachado
     *
     * @ORM\Column(name="nu_sbbe_despachado", type="float", nullable=true)
     */
    private $nuSbbeDespachado;

    /**
     * @var float $nuSbbeDaniado
     *
     * @ORM\Column(name="nu_sbbe_daniado", type="float", nullable=true)
     */
    private $nuSbbeDaniado;

    /**
     * @var float $nuSbbeDonado
     *
     * @ORM\Column(name="nu_sbbe_donado", type="float", nullable=true)
     */
    private $nuSbbeDonado;

    /**
     * @var float $nuSbbePdesp
     *
     * @ORM\Column(name="nu_sbbe_pdesp", type="float", nullable=true)
     */
    private $nuSbbePdesp;

    /**
     * @var text $txSbbeObservacion
     *
     * @ORM\Column(name="tx_sbbe_observacion", type="text", nullable=true)
     */
    private $txSbbeObservacion;

    /**
     * @var float $nuSiggInicial
     *
     * @ORM\Column(name="nu_sigg_inicial", type="float", nullable=true)
     */
    private $nuSiggInicial;

    /**
     * @var float $nuSiggProduccion
     *
     * @ORM\Column(name="nu_sigg_produccion", type="float", nullable=true)
     */
    private $nuSiggProduccion;

    /**
     * @var float $nuSiggRecuperado
     *
     * @ORM\Column(name="nu_sigg_recuperado", type="float", nullable=true)
     */
    private $nuSiggRecuperado;

    /**
     * @var float $nuSiggDespachado
     *
     * @ORM\Column(name="nu_sigg_despachado", type="float", nullable=true)
     */
    private $nuSiggDespachado;

    /**
     * @var float $nuSiggDaniado
     *
     * @ORM\Column(name="nu_sigg_daniado", type="float", nullable=true)
     */
    private $nuSiggDaniado;

    /**
     * @var float $nuSiggDonado
     *
     * @ORM\Column(name="nu_sigg_donado", type="float", nullable=true)
     */
    private $nuSiggDonado;

    /**
     * @var float $nuSiggPdesp
     *
     * @ORM\Column(name="nu_sigg_pdesp", type="float", nullable=true)
     */
    private $nuSiggPdesp;

    /**
     * @var text $txSiggObservacion
     *
     * @ORM\Column(name="tx_sigg_observacion", type="text", nullable=true)
     */
    private $txSiggObservacion;

    /**
     * @var float $nuSicInicial
     *
     * @ORM\Column(name="nu_sic_inicial", type="float", nullable=true)
     */
    private $nuSicInicial;

    /**
     * @var float $nuSicProduccion
     *
     * @ORM\Column(name="nu_sic_produccion", type="float", nullable=true)
     */
    private $nuSicProduccion;

    /**
     * @var float $nuSicRecuperado
     *
     * @ORM\Column(name="nu_sic_recuperado", type="float", nullable=true)
     */
    private $nuSicRecuperado;

    /**
     * @var float $nuSicDespachado
     *
     * @ORM\Column(name="nu_sic_despachado", type="float", nullable=true)
     */
    private $nuSicDespachado;

    /**
     * @var float $nuSicDaniado
     *
     * @ORM\Column(name="nu_sic_daniado", type="float", nullable=true)
     */
    private $nuSicDaniado;

    /**
     * @var float $nuSicDonado
     *
     * @ORM\Column(name="nu_sic_donado", type="float", nullable=true)
     */
    private $nuSicDonado;

    /**
     * @var float $nuSicPdesp
     *
     * @ORM\Column(name="nu_sic_pdesp", type="float", nullable=true)
     */
    private $nuSicPdesp;

    /**
     * @var text $txSicObservacion
     *
     * @ORM\Column(name="tx_sic_observacion", type="text", nullable=true)
     */
    private $txSicObservacion;

    /**
     * @var float $nuSrInicial
     *
     * @ORM\Column(name="nu_sr_inicial", type="float", nullable=true)
     */
    private $nuSrInicial;

    /**
     * @var float $nuSrProduccion
     *
     * @ORM\Column(name="nu_sr_produccion", type="float", nullable=true)
     */
    private $nuSrProduccion;

    /**
     * @var float $nuSrRecuperado
     *
     * @ORM\Column(name="nu_sr_recuperado", type="float", nullable=true)
     */
    private $nuSrRecuperado;

    /**
     * @var float $nuSrDespachado
     *
     * @ORM\Column(name="nu_sr_despachado", type="float", nullable=true)
     */
    private $nuSrDespachado;

    /**
     * @var float $nuSrDaniado
     *
     * @ORM\Column(name="nu_sr_daniado", type="float", nullable=true)
     */
    private $nuSrDaniado;

    /**
     * @var float $nuSrDonado
     *
     * @ORM\Column(name="nu_sr_donado", type="float", nullable=true)
     */
    private $nuSrDonado;

    /**
     * @var float $nuSrPdesp
     *
     * @ORM\Column(name="nu_sr_pdesp", type="float", nullable=true)
     */
    private $nuSrPdesp;

    /**
     * @var text $txSrObservacion
     *
     * @ORM\Column(name="tx_sr_observacion", type="text", nullable=true)
     */
    private $txSrObservacion;

    /**
     * @var float $nuBbggInicial
     *
     * @ORM\Column(name="nu_bbgg_inicial", type="float", nullable=true)
     */
    private $nuBbggInicial;

    /**
     * @var float $nuBbggProduccion
     *
     * @ORM\Column(name="nu_bbgg_produccion", type="float", nullable=true)
     */
    private $nuBbggProduccion;

    /**
     * @var float $nuBbggRecuperado
     *
     * @ORM\Column(name="nu_bbgg_recuperado", type="float", nullable=true)
     */
    private $nuBbggRecuperado;

    /**
     * @var float $nuBbggDespachado
     *
     * @ORM\Column(name="nu_bbgg_despachado", type="float", nullable=true)
     */
    private $nuBbggDespachado;

    /**
     * @var float $nuBbggDaniado
     *
     * @ORM\Column(name="nu_bbgg_daniado", type="float", nullable=true)
     */
    private $nuBbggDaniado;

    /**
     * @var float $nuBbggDonado
     *
     * @ORM\Column(name="nu_bbgg_donado", type="float", nullable=true)
     */
    private $nuBbggDonado;

    /**
     * @var float $nuBbggPdesp
     *
     * @ORM\Column(name="nu_bbgg_pdesp", type="float", nullable=true)
     */
    private $nuBbggPdesp;

    /**
     * @var text $txBbggObservacion
     *
     * @ORM\Column(name="tx_bbgg_observacion", type="text", nullable=true)
     */
    private $txBbggObservacion;

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
     * Get d100pkInventario
     *
     * @return integer 
     */
    public function getD100pkInventario()
    {
        return $this->d100pkInventario;
    }

    /**
     * Set nuTipodeinventario
     *
     * @param integer $nuTipodeinventario
     */
    public function setNuTipodeinventario($nuTipodeinventario)
    {
        $this->nuTipodeinventario = $nuTipodeinventario;
    }

    /**
     * Get nuTipodeinventario
     *
     * @return integer 
     */
    public function getNuTipodeinventario()
    {
        return $this->nuTipodeinventario;
    }

    /**
     * Set txNombre
     *
     * @param text $txNombre
     */
    public function setTxNombre($txNombre)
    {
        $this->txNombre = $txNombre;
    }

    /**
     * Get txNombre
     *
     * @return text 
     */
    public function getTxNombre()
    {
        return $this->txNombre;
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
     * Set nuSrmInicial
     *
     * @param float $nuSrmInicial
     */
    public function setNuSrmInicial($nuSrmInicial)
    {
        $this->nuSrmInicial = $nuSrmInicial;
    }

    /**
     * Get nuSrmInicial
     *
     * @return float 
     */
    public function getNuSrmInicial()
    {
        return $this->nuSrmInicial;
    }

    /**
     * Set nuSrmProduccion
     *
     * @param float $nuSrmProduccion
     */
    public function setNuSrmProduccion($nuSrmProduccion)
    {
        $this->nuSrmProduccion = $nuSrmProduccion;
    }

    /**
     * Get nuSrmProduccion
     *
     * @return float 
     */
    public function getNuSrmProduccion()
    {
        return $this->nuSrmProduccion;
    }

    /**
     * Set nuSrmRecuperado
     *
     * @param float $nuSrmRecuperado
     */
    public function setNuSrmRecuperado($nuSrmRecuperado)
    {
        $this->nuSrmRecuperado = $nuSrmRecuperado;
    }

    /**
     * Get nuSrmRecuperado
     *
     * @return float 
     */
    public function getNuSrmRecuperado()
    {
        return $this->nuSrmRecuperado;
    }

    /**
     * Set nuSrmDespachado
     *
     * @param float $nuSrmDespachado
     */
    public function setNuSrmDespachado($nuSrmDespachado)
    {
        $this->nuSrmDespachado = $nuSrmDespachado;
    }

    /**
     * Get nuSrmDespachado
     *
     * @return float 
     */
    public function getNuSrmDespachado()
    {
        return $this->nuSrmDespachado;
    }

    /**
     * Set nuSrmDaniado
     *
     * @param float $nuSrmDaniado
     */
    public function setNuSrmDaniado($nuSrmDaniado)
    {
        $this->nuSrmDaniado = $nuSrmDaniado;
    }

    /**
     * Get nuSrmDaniado
     *
     * @return float 
     */
    public function getNuSrmDaniado()
    {
        return $this->nuSrmDaniado;
    }

    /**
     * Set nuSrmDonado
     *
     * @param float $nuSrmDonado
     */
    public function setNuSrmDonado($nuSrmDonado)
    {
        $this->nuSrmDonado = $nuSrmDonado;
    }

    /**
     * Get nuSrmDonado
     *
     * @return float 
     */
    public function getNuSrmDonado()
    {
        return $this->nuSrmDonado;
    }

    /**
     * Set nuSrmPdesp
     *
     * @param float $nuSrmPdesp
     */
    public function setNuSrmPdesp($nuSrmPdesp)
    {
        $this->nuSrmPdesp = $nuSrmPdesp;
    }

    /**
     * Get nuSrmPdesp
     *
     * @return float 
     */
    public function getNuSrmPdesp()
    {
        return $this->nuSrmPdesp;
    }

    /**
     * Set txSrmObservacion
     *
     * @param text $txSrmObservacion
     */
    public function setTxSrmObservacion($txSrmObservacion)
    {
        $this->txSrmObservacion = $txSrmObservacion;
    }

    /**
     * Get txSrmObservacion
     *
     * @return text 
     */
    public function getTxSrmObservacion()
    {
        return $this->txSrmObservacion;
    }

    /**
     * Set nuSrfInicial
     *
     * @param float $nuSrfInicial
     */
    public function setNuSrfInicial($nuSrfInicial)
    {
        $this->nuSrfInicial = $nuSrfInicial;
    }

    /**
     * Get nuSrfInicial
     *
     * @return float 
     */
    public function getNuSrfInicial()
    {
        return $this->nuSrfInicial;
    }

    /**
     * Set nuSrfProduccion
     *
     * @param float $nuSrfProduccion
     */
    public function setNuSrfProduccion($nuSrfProduccion)
    {
        $this->nuSrfProduccion = $nuSrfProduccion;
    }

    /**
     * Get nuSrfProduccion
     *
     * @return float 
     */
    public function getNuSrfProduccion()
    {
        return $this->nuSrfProduccion;
    }

    /**
     * Set nuSrfRecuperado
     *
     * @param float $nuSrfRecuperado
     */
    public function setNuSrfRecuperado($nuSrfRecuperado)
    {
        $this->nuSrfRecuperado = $nuSrfRecuperado;
    }

    /**
     * Get nuSrfRecuperado
     *
     * @return float 
     */
    public function getNuSrfRecuperado()
    {
        return $this->nuSrfRecuperado;
    }

    /**
     * Set nuSrfDespachado
     *
     * @param float $nuSrfDespachado
     */
    public function setNuSrfDespachado($nuSrfDespachado)
    {
        $this->nuSrfDespachado = $nuSrfDespachado;
    }

    /**
     * Get nuSrfDespachado
     *
     * @return float 
     */
    public function getNuSrfDespachado()
    {
        return $this->nuSrfDespachado;
    }

    /**
     * Set nuSrfDaniado
     *
     * @param float $nuSrfDaniado
     */
    public function setNuSrfDaniado($nuSrfDaniado)
    {
        $this->nuSrfDaniado = $nuSrfDaniado;
    }

    /**
     * Get nuSrfDaniado
     *
     * @return float 
     */
    public function getNuSrfDaniado()
    {
        return $this->nuSrfDaniado;
    }

    /**
     * Set nuSrfDonado
     *
     * @param float $nuSrfDonado
     */
    public function setNuSrfDonado($nuSrfDonado)
    {
        $this->nuSrfDonado = $nuSrfDonado;
    }

    /**
     * Get nuSrfDonado
     *
     * @return float 
     */
    public function getNuSrfDonado()
    {
        return $this->nuSrfDonado;
    }

    /**
     * Set nuSrfPdesp
     *
     * @param float $nuSrfPdesp
     */
    public function setNuSrfPdesp($nuSrfPdesp)
    {
        $this->nuSrfPdesp = $nuSrfPdesp;
    }

    /**
     * Get nuSrfPdesp
     *
     * @return float 
     */
    public function getNuSrfPdesp()
    {
        return $this->nuSrfPdesp;
    }

    /**
     * Set txSrfObservacion
     *
     * @param text $txSrfObservacion
     */
    public function setTxSrfObservacion($txSrfObservacion)
    {
        $this->txSrfObservacion = $txSrfObservacion;
    }

    /**
     * Get txSrfObservacion
     *
     * @return text 
     */
    public function getTxSrfObservacion()
    {
        return $this->txSrfObservacion;
    }

    /**
     * Set nuSrgInicial
     *
     * @param float $nuSrgInicial
     */
    public function setNuSrgInicial($nuSrgInicial)
    {
        $this->nuSrgInicial = $nuSrgInicial;
    }

    /**
     * Get nuSrgInicial
     *
     * @return float 
     */
    public function getNuSrgInicial()
    {
        return $this->nuSrgInicial;
    }

    /**
     * Set nuSrgProduccion
     *
     * @param float $nuSrgProduccion
     */
    public function setNuSrgProduccion($nuSrgProduccion)
    {
        $this->nuSrgProduccion = $nuSrgProduccion;
    }

    /**
     * Get nuSrgProduccion
     *
     * @return float 
     */
    public function getNuSrgProduccion()
    {
        return $this->nuSrgProduccion;
    }

    /**
     * Set nuSrgRecuperado
     *
     * @param float $nuSrgRecuperado
     */
    public function setNuSrgRecuperado($nuSrgRecuperado)
    {
        $this->nuSrgRecuperado = $nuSrgRecuperado;
    }

    /**
     * Get nuSrgRecuperado
     *
     * @return float 
     */
    public function getNuSrgRecuperado()
    {
        return $this->nuSrgRecuperado;
    }

    /**
     * Set nuSrgDespachado
     *
     * @param float $nuSrgDespachado
     */
    public function setNuSrgDespachado($nuSrgDespachado)
    {
        $this->nuSrgDespachado = $nuSrgDespachado;
    }

    /**
     * Get nuSrgDespachado
     *
     * @return float 
     */
    public function getNuSrgDespachado()
    {
        return $this->nuSrgDespachado;
    }

    /**
     * Set nuSrgDaniado
     *
     * @param float $nuSrgDaniado
     */
    public function setNuSrgDaniado($nuSrgDaniado)
    {
        $this->nuSrgDaniado = $nuSrgDaniado;
    }

    /**
     * Get nuSrgDaniado
     *
     * @return float 
     */
    public function getNuSrgDaniado()
    {
        return $this->nuSrgDaniado;
    }

    /**
     * Set nuSrgDonado
     *
     * @param float $nuSrgDonado
     */
    public function setNuSrgDonado($nuSrgDonado)
    {
        $this->nuSrgDonado = $nuSrgDonado;
    }

    /**
     * Get nuSrgDonado
     *
     * @return float 
     */
    public function getNuSrgDonado()
    {
        return $this->nuSrgDonado;
    }

    /**
     * Set nuSrgPdesp
     *
     * @param float $nuSrgPdesp
     */
    public function setNuSrgPdesp($nuSrgPdesp)
    {
        $this->nuSrgPdesp = $nuSrgPdesp;
    }

    /**
     * Get nuSrgPdesp
     *
     * @return float 
     */
    public function getNuSrgPdesp()
    {
        return $this->nuSrgPdesp;
    }

    /**
     * Set txSrgObservacion
     *
     * @param text $txSrgObservacion
     */
    public function setTxSrgObservacion($txSrgObservacion)
    {
        $this->txSrgObservacion = $txSrgObservacion;
    }

    /**
     * Get txSrgObservacion
     *
     * @return text 
     */
    public function getTxSrgObservacion()
    {
        return $this->txSrgObservacion;
    }

    /**
     * Set nuSreInicial
     *
     * @param float $nuSreInicial
     */
    public function setNuSreInicial($nuSreInicial)
    {
        $this->nuSreInicial = $nuSreInicial;
    }

    /**
     * Get nuSreInicial
     *
     * @return float 
     */
    public function getNuSreInicial()
    {
        return $this->nuSreInicial;
    }

    /**
     * Set nuSreProduccion
     *
     * @param float $nuSreProduccion
     */
    public function setNuSreProduccion($nuSreProduccion)
    {
        $this->nuSreProduccion = $nuSreProduccion;
    }

    /**
     * Get nuSreProduccion
     *
     * @return float 
     */
    public function getNuSreProduccion()
    {
        return $this->nuSreProduccion;
    }

    /**
     * Set nuSreRecuperado
     *
     * @param float $nuSreRecuperado
     */
    public function setNuSreRecuperado($nuSreRecuperado)
    {
        $this->nuSreRecuperado = $nuSreRecuperado;
    }

    /**
     * Get nuSreRecuperado
     *
     * @return float 
     */
    public function getNuSreRecuperado()
    {
        return $this->nuSreRecuperado;
    }

    /**
     * Set nuSreDespachado
     *
     * @param float $nuSreDespachado
     */
    public function setNuSreDespachado($nuSreDespachado)
    {
        $this->nuSreDespachado = $nuSreDespachado;
    }

    /**
     * Get nuSreDespachado
     *
     * @return float 
     */
    public function getNuSreDespachado()
    {
        return $this->nuSreDespachado;
    }

    /**
     * Set nuSreDaniado
     *
     * @param float $nuSreDaniado
     */
    public function setNuSreDaniado($nuSreDaniado)
    {
        $this->nuSreDaniado = $nuSreDaniado;
    }

    /**
     * Get nuSreDaniado
     *
     * @return float 
     */
    public function getNuSreDaniado()
    {
        return $this->nuSreDaniado;
    }

    /**
     * Set nuSreDonado
     *
     * @param float $nuSreDonado
     */
    public function setNuSreDonado($nuSreDonado)
    {
        $this->nuSreDonado = $nuSreDonado;
    }

    /**
     * Get nuSreDonado
     *
     * @return float 
     */
    public function getNuSreDonado()
    {
        return $this->nuSreDonado;
    }

    /**
     * Set nuSrePdesp
     *
     * @param float $nuSrePdesp
     */
    public function setNuSrePdesp($nuSrePdesp)
    {
        $this->nuSrePdesp = $nuSrePdesp;
    }

    /**
     * Get nuSrePdesp
     *
     * @return float 
     */
    public function getNuSrePdesp()
    {
        return $this->nuSrePdesp;
    }

    /**
     * Set txSreObservacion
     *
     * @param text $txSreObservacion
     */
    public function setTxSreObservacion($txSreObservacion)
    {
        $this->txSreObservacion = $txSreObservacion;
    }

    /**
     * Get txSreObservacion
     *
     * @return text 
     */
    public function getTxSreObservacion()
    {
        return $this->txSreObservacion;
    }

    /**
     * Set nuSbbfInicial
     *
     * @param float $nuSbbfInicial
     */
    public function setNuSbbfInicial($nuSbbfInicial)
    {
        $this->nuSbbfInicial = $nuSbbfInicial;
    }

    /**
     * Get nuSbbfInicial
     *
     * @return float 
     */
    public function getNuSbbfInicial()
    {
        return $this->nuSbbfInicial;
    }

    /**
     * Set nuSbbfProduccion
     *
     * @param float $nuSbbfProduccion
     */
    public function setNuSbbfProduccion($nuSbbfProduccion)
    {
        $this->nuSbbfProduccion = $nuSbbfProduccion;
    }

    /**
     * Get nuSbbfProduccion
     *
     * @return float 
     */
    public function getNuSbbfProduccion()
    {
        return $this->nuSbbfProduccion;
    }

    /**
     * Set nuSbbfRecuperado
     *
     * @param float $nuSbbfRecuperado
     */
    public function setNuSbbfRecuperado($nuSbbfRecuperado)
    {
        $this->nuSbbfRecuperado = $nuSbbfRecuperado;
    }

    /**
     * Get nuSbbfRecuperado
     *
     * @return float 
     */
    public function getNuSbbfRecuperado()
    {
        return $this->nuSbbfRecuperado;
    }

    /**
     * Set nuSbbfDespachado
     *
     * @param float $nuSbbfDespachado
     */
    public function setNuSbbfDespachado($nuSbbfDespachado)
    {
        $this->nuSbbfDespachado = $nuSbbfDespachado;
    }

    /**
     * Get nuSbbfDespachado
     *
     * @return float 
     */
    public function getNuSbbfDespachado()
    {
        return $this->nuSbbfDespachado;
    }

    /**
     * Set nuSbbfDaniado
     *
     * @param float $nuSbbfDaniado
     */
    public function setNuSbbfDaniado($nuSbbfDaniado)
    {
        $this->nuSbbfDaniado = $nuSbbfDaniado;
    }

    /**
     * Get nuSbbfDaniado
     *
     * @return float 
     */
    public function getNuSbbfDaniado()
    {
        return $this->nuSbbfDaniado;
    }

    /**
     * Set nuSbbfDonado
     *
     * @param float $nuSbbfDonado
     */
    public function setNuSbbfDonado($nuSbbfDonado)
    {
        $this->nuSbbfDonado = $nuSbbfDonado;
    }

    /**
     * Get nuSbbfDonado
     *
     * @return float 
     */
    public function getNuSbbfDonado()
    {
        return $this->nuSbbfDonado;
    }

    /**
     * Set nuSbbfPdesp
     *
     * @param float $nuSbbfPdesp
     */
    public function setNuSbbfPdesp($nuSbbfPdesp)
    {
        $this->nuSbbfPdesp = $nuSbbfPdesp;
    }

    /**
     * Get nuSbbfPdesp
     *
     * @return float 
     */
    public function getNuSbbfPdesp()
    {
        return $this->nuSbbfPdesp;
    }

    /**
     * Set txSbbfObservacion
     *
     * @param text $txSbbfObservacion
     */
    public function setTxSbbfObservacion($txSbbfObservacion)
    {
        $this->txSbbfObservacion = $txSbbfObservacion;
    }

    /**
     * Get txSbbfObservacion
     *
     * @return text 
     */
    public function getTxSbbfObservacion()
    {
        return $this->txSbbfObservacion;
    }

    /**
     * Set nuSbbeInicial
     *
     * @param float $nuSbbeInicial
     */
    public function setNuSbbeInicial($nuSbbeInicial)
    {
        $this->nuSbbeInicial = $nuSbbeInicial;
    }

    /**
     * Get nuSbbeInicial
     *
     * @return float 
     */
    public function getNuSbbeInicial()
    {
        return $this->nuSbbeInicial;
    }

    /**
     * Set nuSbbeProduccion
     *
     * @param float $nuSbbeProduccion
     */
    public function setNuSbbeProduccion($nuSbbeProduccion)
    {
        $this->nuSbbeProduccion = $nuSbbeProduccion;
    }

    /**
     * Get nuSbbeProduccion
     *
     * @return float 
     */
    public function getNuSbbeProduccion()
    {
        return $this->nuSbbeProduccion;
    }

    /**
     * Set nuSbbeRecuperado
     *
     * @param float $nuSbbeRecuperado
     */
    public function setNuSbbeRecuperado($nuSbbeRecuperado)
    {
        $this->nuSbbeRecuperado = $nuSbbeRecuperado;
    }

    /**
     * Get nuSbbeRecuperado
     *
     * @return float 
     */
    public function getNuSbbeRecuperado()
    {
        return $this->nuSbbeRecuperado;
    }

    /**
     * Set nuSbbeDespachado
     *
     * @param float $nuSbbeDespachado
     */
    public function setNuSbbeDespachado($nuSbbeDespachado)
    {
        $this->nuSbbeDespachado = $nuSbbeDespachado;
    }

    /**
     * Get nuSbbeDespachado
     *
     * @return float 
     */
    public function getNuSbbeDespachado()
    {
        return $this->nuSbbeDespachado;
    }

    /**
     * Set nuSbbeDaniado
     *
     * @param float $nuSbbeDaniado
     */
    public function setNuSbbeDaniado($nuSbbeDaniado)
    {
        $this->nuSbbeDaniado = $nuSbbeDaniado;
    }

    /**
     * Get nuSbbeDaniado
     *
     * @return float 
     */
    public function getNuSbbeDaniado()
    {
        return $this->nuSbbeDaniado;
    }

    /**
     * Set nuSbbeDonado
     *
     * @param float $nuSbbeDonado
     */
    public function setNuSbbeDonado($nuSbbeDonado)
    {
        $this->nuSbbeDonado = $nuSbbeDonado;
    }

    /**
     * Get nuSbbeDonado
     *
     * @return float 
     */
    public function getNuSbbeDonado()
    {
        return $this->nuSbbeDonado;
    }

    /**
     * Set nuSbbePdesp
     *
     * @param float $nuSbbePdesp
     */
    public function setNuSbbePdesp($nuSbbePdesp)
    {
        $this->nuSbbePdesp = $nuSbbePdesp;
    }

    /**
     * Get nuSbbePdesp
     *
     * @return float 
     */
    public function getNuSbbePdesp()
    {
        return $this->nuSbbePdesp;
    }

    /**
     * Set txSbbeObservacion
     *
     * @param text $txSbbeObservacion
     */
    public function setTxSbbeObservacion($txSbbeObservacion)
    {
        $this->txSbbeObservacion = $txSbbeObservacion;
    }

    /**
     * Get txSbbeObservacion
     *
     * @return text 
     */
    public function getTxSbbeObservacion()
    {
        return $this->txSbbeObservacion;
    }

    /**
     * Set nuSiggInicial
     *
     * @param float $nuSiggInicial
     */
    public function setNuSiggInicial($nuSiggInicial)
    {
        $this->nuSiggInicial = $nuSiggInicial;
    }

    /**
     * Get nuSiggInicial
     *
     * @return float 
     */
    public function getNuSiggInicial()
    {
        return $this->nuSiggInicial;
    }

    /**
     * Set nuSiggProduccion
     *
     * @param float $nuSiggProduccion
     */
    public function setNuSiggProduccion($nuSiggProduccion)
    {
        $this->nuSiggProduccion = $nuSiggProduccion;
    }

    /**
     * Get nuSiggProduccion
     *
     * @return float 
     */
    public function getNuSiggProduccion()
    {
        return $this->nuSiggProduccion;
    }

    /**
     * Set nuSiggRecuperado
     *
     * @param float $nuSiggRecuperado
     */
    public function setNuSiggRecuperado($nuSiggRecuperado)
    {
        $this->nuSiggRecuperado = $nuSiggRecuperado;
    }

    /**
     * Get nuSiggRecuperado
     *
     * @return float 
     */
    public function getNuSiggRecuperado()
    {
        return $this->nuSiggRecuperado;
    }

    /**
     * Set nuSiggDespachado
     *
     * @param float $nuSiggDespachado
     */
    public function setNuSiggDespachado($nuSiggDespachado)
    {
        $this->nuSiggDespachado = $nuSiggDespachado;
    }

    /**
     * Get nuSiggDespachado
     *
     * @return float 
     */
    public function getNuSiggDespachado()
    {
        return $this->nuSiggDespachado;
    }

    /**
     * Set nuSiggDaniado
     *
     * @param float $nuSiggDaniado
     */
    public function setNuSiggDaniado($nuSiggDaniado)
    {
        $this->nuSiggDaniado = $nuSiggDaniado;
    }

    /**
     * Get nuSiggDaniado
     *
     * @return float 
     */
    public function getNuSiggDaniado()
    {
        return $this->nuSiggDaniado;
    }

    /**
     * Set nuSiggDonado
     *
     * @param float $nuSiggDonado
     */
    public function setNuSiggDonado($nuSiggDonado)
    {
        $this->nuSiggDonado = $nuSiggDonado;
    }

    /**
     * Get nuSiggDonado
     *
     * @return float 
     */
    public function getNuSiggDonado()
    {
        return $this->nuSiggDonado;
    }

    /**
     * Set nuSiggPdesp
     *
     * @param float $nuSiggPdesp
     */
    public function setNuSiggPdesp($nuSiggPdesp)
    {
        $this->nuSiggPdesp = $nuSiggPdesp;
    }

    /**
     * Get nuSiggPdesp
     *
     * @return float 
     */
    public function getNuSiggPdesp()
    {
        return $this->nuSiggPdesp;
    }

    /**
     * Set txSiggObservacion
     *
     * @param text $txSiggObservacion
     */
    public function setTxSiggObservacion($txSiggObservacion)
    {
        $this->txSiggObservacion = $txSiggObservacion;
    }

    /**
     * Get txSiggObservacion
     *
     * @return text 
     */
    public function getTxSiggObservacion()
    {
        return $this->txSiggObservacion;
    }

    /**
     * Set nuSicInicial
     *
     * @param float $nuSicInicial
     */
    public function setNuSicInicial($nuSicInicial)
    {
        $this->nuSicInicial = $nuSicInicial;
    }

    /**
     * Get nuSicInicial
     *
     * @return float 
     */
    public function getNuSicInicial()
    {
        return $this->nuSicInicial;
    }

    /**
     * Set nuSicProduccion
     *
     * @param float $nuSicProduccion
     */
    public function setNuSicProduccion($nuSicProduccion)
    {
        $this->nuSicProduccion = $nuSicProduccion;
    }

    /**
     * Get nuSicProduccion
     *
     * @return float 
     */
    public function getNuSicProduccion()
    {
        return $this->nuSicProduccion;
    }

    /**
     * Set nuSicRecuperado
     *
     * @param float $nuSicRecuperado
     */
    public function setNuSicRecuperado($nuSicRecuperado)
    {
        $this->nuSicRecuperado = $nuSicRecuperado;
    }

    /**
     * Get nuSicRecuperado
     *
     * @return float 
     */
    public function getNuSicRecuperado()
    {
        return $this->nuSicRecuperado;
    }

    /**
     * Set nuSicDespachado
     *
     * @param float $nuSicDespachado
     */
    public function setNuSicDespachado($nuSicDespachado)
    {
        $this->nuSicDespachado = $nuSicDespachado;
    }

    /**
     * Get nuSicDespachado
     *
     * @return float 
     */
    public function getNuSicDespachado()
    {
        return $this->nuSicDespachado;
    }

    /**
     * Set nuSicDaniado
     *
     * @param float $nuSicDaniado
     */
    public function setNuSicDaniado($nuSicDaniado)
    {
        $this->nuSicDaniado = $nuSicDaniado;
    }

    /**
     * Get nuSicDaniado
     *
     * @return float 
     */
    public function getNuSicDaniado()
    {
        return $this->nuSicDaniado;
    }

    /**
     * Set nuSicDonado
     *
     * @param float $nuSicDonado
     */
    public function setNuSicDonado($nuSicDonado)
    {
        $this->nuSicDonado = $nuSicDonado;
    }

    /**
     * Get nuSicDonado
     *
     * @return float 
     */
    public function getNuSicDonado()
    {
        return $this->nuSicDonado;
    }

    /**
     * Set nuSicPdesp
     *
     * @param float $nuSicPdesp
     */
    public function setNuSicPdesp($nuSicPdesp)
    {
        $this->nuSicPdesp = $nuSicPdesp;
    }

    /**
     * Get nuSicPdesp
     *
     * @return float 
     */
    public function getNuSicPdesp()
    {
        return $this->nuSicPdesp;
    }

    /**
     * Set txSicObservacion
     *
     * @param text $txSicObservacion
     */
    public function setTxSicObservacion($txSicObservacion)
    {
        $this->txSicObservacion = $txSicObservacion;
    }

    /**
     * Get txSicObservacion
     *
     * @return text 
     */
    public function getTxSicObservacion()
    {
        return $this->txSicObservacion;
    }

    /**
     * Set nuSrInicial
     *
     * @param float $nuSrInicial
     */
    public function setNuSrInicial($nuSrInicial)
    {
        $this->nuSrInicial = $nuSrInicial;
    }

    /**
     * Get nuSrInicial
     *
     * @return float 
     */
    public function getNuSrInicial()
    {
        return $this->nuSrInicial;
    }

    /**
     * Set nuSrProduccion
     *
     * @param float $nuSrProduccion
     */
    public function setNuSrProduccion($nuSrProduccion)
    {
        $this->nuSrProduccion = $nuSrProduccion;
    }

    /**
     * Get nuSrProduccion
     *
     * @return float 
     */
    public function getNuSrProduccion()
    {
        return $this->nuSrProduccion;
    }

    /**
     * Set nuSrRecuperado
     *
     * @param float $nuSrRecuperado
     */
    public function setNuSrRecuperado($nuSrRecuperado)
    {
        $this->nuSrRecuperado = $nuSrRecuperado;
    }

    /**
     * Get nuSrRecuperado
     *
     * @return float 
     */
    public function getNuSrRecuperado()
    {
        return $this->nuSrRecuperado;
    }

    /**
     * Set nuSrDespachado
     *
     * @param float $nuSrDespachado
     */
    public function setNuSrDespachado($nuSrDespachado)
    {
        $this->nuSrDespachado = $nuSrDespachado;
    }

    /**
     * Get nuSrDespachado
     *
     * @return float 
     */
    public function getNuSrDespachado()
    {
        return $this->nuSrDespachado;
    }

    /**
     * Set nuSrDaniado
     *
     * @param float $nuSrDaniado
     */
    public function setNuSrDaniado($nuSrDaniado)
    {
        $this->nuSrDaniado = $nuSrDaniado;
    }

    /**
     * Get nuSrDaniado
     *
     * @return float 
     */
    public function getNuSrDaniado()
    {
        return $this->nuSrDaniado;
    }

    /**
     * Set nuSrDonado
     *
     * @param float $nuSrDonado
     */
    public function setNuSrDonado($nuSrDonado)
    {
        $this->nuSrDonado = $nuSrDonado;
    }

    /**
     * Get nuSrDonado
     *
     * @return float 
     */
    public function getNuSrDonado()
    {
        return $this->nuSrDonado;
    }

    /**
     * Set nuSrPdesp
     *
     * @param float $nuSrPdesp
     */
    public function setNuSrPdesp($nuSrPdesp)
    {
        $this->nuSrPdesp = $nuSrPdesp;
    }

    /**
     * Get nuSrPdesp
     *
     * @return float 
     */
    public function getNuSrPdesp()
    {
        return $this->nuSrPdesp;
    }

    /**
     * Set txSrObservacion
     *
     * @param text $txSrObservacion
     */
    public function setTxSrObservacion($txSrObservacion)
    {
        $this->txSrObservacion = $txSrObservacion;
    }

    /**
     * Get txSrObservacion
     *
     * @return text 
     */
    public function getTxSrObservacion()
    {
        return $this->txSrObservacion;
    }

    /**
     * Set nuBbggInicial
     *
     * @param float $nuBbggInicial
     */
    public function setNuBbggInicial($nuBbggInicial)
    {
        $this->nuBbggInicial = $nuBbggInicial;
    }

    /**
     * Get nuBbggInicial
     *
     * @return float 
     */
    public function getNuBbggInicial()
    {
        return $this->nuBbggInicial;
    }

    /**
     * Set nuBbggProduccion
     *
     * @param float $nuBbggProduccion
     */
    public function setNuBbggProduccion($nuBbggProduccion)
    {
        $this->nuBbggProduccion = $nuBbggProduccion;
    }

    /**
     * Get nuBbggProduccion
     *
     * @return float 
     */
    public function getNuBbggProduccion()
    {
        return $this->nuBbggProduccion;
    }

    /**
     * Set nuBbggRecuperado
     *
     * @param float $nuBbggRecuperado
     */
    public function setNuBbggRecuperado($nuBbggRecuperado)
    {
        $this->nuBbggRecuperado = $nuBbggRecuperado;
    }

    /**
     * Get nuBbggRecuperado
     *
     * @return float 
     */
    public function getNuBbggRecuperado()
    {
        return $this->nuBbggRecuperado;
    }

    /**
     * Set nuBbggDespachado
     *
     * @param float $nuBbggDespachado
     */
    public function setNuBbggDespachado($nuBbggDespachado)
    {
        $this->nuBbggDespachado = $nuBbggDespachado;
    }

    /**
     * Get nuBbggDespachado
     *
     * @return float 
     */
    public function getNuBbggDespachado()
    {
        return $this->nuBbggDespachado;
    }

    /**
     * Set nuBbggDaniado
     *
     * @param float $nuBbggDaniado
     */
    public function setNuBbggDaniado($nuBbggDaniado)
    {
        $this->nuBbggDaniado = $nuBbggDaniado;
    }

    /**
     * Get nuBbggDaniado
     *
     * @return float 
     */
    public function getNuBbggDaniado()
    {
        return $this->nuBbggDaniado;
    }

    /**
     * Set nuBbggDonado
     *
     * @param float $nuBbggDonado
     */
    public function setNuBbggDonado($nuBbggDonado)
    {
        $this->nuBbggDonado = $nuBbggDonado;
    }

    /**
     * Get nuBbggDonado
     *
     * @return float 
     */
    public function getNuBbggDonado()
    {
        return $this->nuBbggDonado;
    }

    /**
     * Set nuBbggPdesp
     *
     * @param float $nuBbggPdesp
     */
    public function setNuBbggPdesp($nuBbggPdesp)
    {
        $this->nuBbggPdesp = $nuBbggPdesp;
    }

    /**
     * Get nuBbggPdesp
     *
     * @return float 
     */
    public function getNuBbggPdesp()
    {
        return $this->nuBbggPdesp;
    }

    /**
     * Set txBbggObservacion
     *
     * @param text $txBbggObservacion
     */
    public function setTxBbggObservacion($txBbggObservacion)
    {
        $this->txBbggObservacion = $txBbggObservacion;
    }

    /**
     * Get txBbggObservacion
     *
     * @return text 
     */
    public function getTxBbggObservacion()
    {
        return $this->txBbggObservacion;
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