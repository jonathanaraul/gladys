<?php

namespace Proyecto\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proyecto\PrincipalBundle\Entity\D100tDesRepDiario
 *
 * @ORM\Table(name="d100t_des_rep_diario")
 * @ORM\Entity
 */
class D100tDesRepDiario
{
    /**
     * @var integer $d100pkDesRepDiario
     *
     * @ORM\Column(name="d100pk_des_rep_diario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $d100pkDesRepDiario;

    /**
     * @var datetime $feFechadelreporte
     *
     * @ORM\Column(name="fe_fechadelreporte", type="datetime", nullable=false)
     */
    private $feFechadelreporte;

    /**
     * @var integer $nuUnidad
     *
     * @ORM\Column(name="nu_unidad", type="integer", nullable=false)
     */
    private $nuUnidad;

    /**
     * @var integer $nuTipodeproducto
     *
     * @ORM\Column(name="nu_tipodeproducto", type="integer", nullable=false)
     */
    private $nuTipodeproducto;

    /**
     * @var integer $nuNdeguia
     *
     * @ORM\Column(name="nu_ndeguia", type="integer", nullable=false)
     */
    private $nuNdeguia;

    /**
     * @var integer $nuOrddesNdeorden
     *
     * @ORM\Column(name="nu_orddes_ndeorden", type="integer", nullable=false)
     */
    private $nuOrddesNdeorden;

    /**
     * @var datetime $feOrddesFecha
     *
     * @ORM\Column(name="fe_orddes_fecha", type="datetime", nullable=false)
     */
    private $feOrddesFecha;

    /**
     * @var integer $nuDestonSacos
     *
     * @ORM\Column(name="nu_deston_sacos", type="integer", nullable=false)
     */
    private $nuDestonSacos;

    /**
     * @var integer $nuDestonReal
     *
     * @ORM\Column(name="nu_deston_real", type="integer", nullable=false)
     */
    private $nuDestonReal;

    /**
     * @var integer $nuDestonTeor
     *
     * @ORM\Column(name="nu_deston_teor", type="integer", nullable=false)
     */
    private $nuDestonTeor;

    /**
     * @var integer $nuVarTon
     *
     * @ORM\Column(name="nu_var_ton", type="integer", nullable=false)
     */
    private $nuVarTon;

    /**
     * @var integer $nuSacTeor
     *
     * @ORM\Column(name="nu_sac_teor", type="integer", nullable=false)
     */
    private $nuSacTeor;

    /**
     * @var integer $nuSacPromedio
     *
     * @ORM\Column(name="nu_sac_promedio", type="integer", nullable=false)
     */
    private $nuSacPromedio;

    /**
     * @var integer $nuTdSacos
     *
     * @ORM\Column(name="nu_td_sacos", type="integer", nullable=false)
     */
    private $nuTdSacos;

    /**
     * @var integer $nuTdTon
     *
     * @ORM\Column(name="nu_td_ton", type="integer", nullable=false)
     */
    private $nuTdTon;

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
     *   @ORM\JoinColumn(name="nu_cliente", referencedColumnName="d100pk_ven_infocliente")
     * })
     */
    private $nuCliente;



    /**
     * Get d100pkDesRepDiario
     *
     * @return integer 
     */
    public function getD100pkDesRepDiario()
    {
        return $this->d100pkDesRepDiario;
    }

    /**
     * Set feFechadelreporte
     *
     * @param datetime $feFechadelreporte
     */
    public function setFeFechadelreporte($feFechadelreporte)
    {
        $this->feFechadelreporte = $feFechadelreporte;
    }

    /**
     * Get feFechadelreporte
     *
     * @return datetime 
     */
    public function getFeFechadelreporte()
    {
        return $this->feFechadelreporte;
    }

    /**
     * Set nuUnidad
     *
     * @param integer $nuUnidad
     */
    public function setNuUnidad($nuUnidad)
    {
        $this->nuUnidad = $nuUnidad;
    }

    /**
     * Get nuUnidad
     *
     * @return integer 
     */
    public function getNuUnidad()
    {
        return $this->nuUnidad;
    }

    /**
     * Set nuTipodeproducto
     *
     * @param integer $nuTipodeproducto
     */
    public function setNuTipodeproducto($nuTipodeproducto)
    {
        $this->nuTipodeproducto = $nuTipodeproducto;
    }

    /**
     * Get nuTipodeproducto
     *
     * @return integer 
     */
    public function getNuTipodeproducto()
    {
        return $this->nuTipodeproducto;
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
     * Set nuOrddesNdeorden
     *
     * @param integer $nuOrddesNdeorden
     */
    public function setNuOrddesNdeorden($nuOrddesNdeorden)
    {
        $this->nuOrddesNdeorden = $nuOrddesNdeorden;
    }

    /**
     * Get nuOrddesNdeorden
     *
     * @return integer 
     */
    public function getNuOrddesNdeorden()
    {
        return $this->nuOrddesNdeorden;
    }

    /**
     * Set feOrddesFecha
     *
     * @param datetime $feOrddesFecha
     */
    public function setFeOrddesFecha($feOrddesFecha)
    {
        $this->feOrddesFecha = $feOrddesFecha;
    }

    /**
     * Get feOrddesFecha
     *
     * @return datetime 
     */
    public function getFeOrddesFecha()
    {
        return $this->feOrddesFecha;
    }

    /**
     * Set nuDestonSacos
     *
     * @param integer $nuDestonSacos
     */
    public function setNuDestonSacos($nuDestonSacos)
    {
        $this->nuDestonSacos = $nuDestonSacos;
    }

    /**
     * Get nuDestonSacos
     *
     * @return integer 
     */
    public function getNuDestonSacos()
    {
        return $this->nuDestonSacos;
    }

    /**
     * Set nuDestonReal
     *
     * @param integer $nuDestonReal
     */
    public function setNuDestonReal($nuDestonReal)
    {
        $this->nuDestonReal = $nuDestonReal;
    }

    /**
     * Get nuDestonReal
     *
     * @return integer 
     */
    public function getNuDestonReal()
    {
        return $this->nuDestonReal;
    }

    /**
     * Set nuDestonTeor
     *
     * @param integer $nuDestonTeor
     */
    public function setNuDestonTeor($nuDestonTeor)
    {
        $this->nuDestonTeor = $nuDestonTeor;
    }

    /**
     * Get nuDestonTeor
     *
     * @return integer 
     */
    public function getNuDestonTeor()
    {
        return $this->nuDestonTeor;
    }

    /**
     * Set nuVarTon
     *
     * @param integer $nuVarTon
     */
    public function setNuVarTon($nuVarTon)
    {
        $this->nuVarTon = $nuVarTon;
    }

    /**
     * Get nuVarTon
     *
     * @return integer 
     */
    public function getNuVarTon()
    {
        return $this->nuVarTon;
    }

    /**
     * Set nuSacTeor
     *
     * @param integer $nuSacTeor
     */
    public function setNuSacTeor($nuSacTeor)
    {
        $this->nuSacTeor = $nuSacTeor;
    }

    /**
     * Get nuSacTeor
     *
     * @return integer 
     */
    public function getNuSacTeor()
    {
        return $this->nuSacTeor;
    }

    /**
     * Set nuSacPromedio
     *
     * @param integer $nuSacPromedio
     */
    public function setNuSacPromedio($nuSacPromedio)
    {
        $this->nuSacPromedio = $nuSacPromedio;
    }

    /**
     * Get nuSacPromedio
     *
     * @return integer 
     */
    public function getNuSacPromedio()
    {
        return $this->nuSacPromedio;
    }

    /**
     * Set nuTdSacos
     *
     * @param integer $nuTdSacos
     */
    public function setNuTdSacos($nuTdSacos)
    {
        $this->nuTdSacos = $nuTdSacos;
    }

    /**
     * Get nuTdSacos
     *
     * @return integer 
     */
    public function getNuTdSacos()
    {
        return $this->nuTdSacos;
    }

    /**
     * Set nuTdTon
     *
     * @param integer $nuTdTon
     */
    public function setNuTdTon($nuTdTon)
    {
        $this->nuTdTon = $nuTdTon;
    }

    /**
     * Get nuTdTon
     *
     * @return integer 
     */
    public function getNuTdTon()
    {
        return $this->nuTdTon;
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
     * Set nuCliente
     *
     * @param Proyecto\PrincipalBundle\Entity\D100tVenInfocliente $nuCliente
     */
    public function setNuCliente(\Proyecto\PrincipalBundle\Entity\D100tVenInfocliente $nuCliente)
    {
        $this->nuCliente = $nuCliente;
    }

    /**
     * Get nuCliente
     *
     * @return Proyecto\PrincipalBundle\Entity\D100tVenInfocliente 
     */
    public function getNuCliente()
    {
        return $this->nuCliente;
    }
}