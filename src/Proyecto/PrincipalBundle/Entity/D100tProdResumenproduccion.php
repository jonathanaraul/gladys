<?php

namespace Proyecto\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proyecto\PrincipalBundle\Entity\D100tProdResumenproduccion
 *
 * @ORM\Table(name="d100t_prod_resumenproduccion")
 * @ORM\Entity
 */
class D100tProdResumenproduccion
{
    /**
     * @var integer $d100pkProdResumenproduccion
     *
     * @ORM\Column(name="d100pk_prod_resumenproduccion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $d100pkProdResumenproduccion;

    /**
     * @var datetime $feU1Mesyanio
     *
     * @ORM\Column(name="fe_u1_mesyanio", type="datetime", nullable=false)
     */
    private $feU1Mesyanio;

    /**
     * @var float $nuU1Cantsalbajadapuntilla
     *
     * @ORM\Column(name="nu_u1_cantsalbajadapuntilla", type="float", nullable=false)
     */
    private $nuU1Cantsalbajadapuntilla;

    /**
     * @var float $nuU1Cantsallavada
     *
     * @ORM\Column(name="nu_u1_cantsallavada", type="float", nullable=false)
     */
    private $nuU1Cantsallavada;

    /**
     * @var float $nuU1Cantsalnetalavada
     *
     * @ORM\Column(name="nu_u1_cantsalnetalavada", type="float", nullable=false)
     */
    private $nuU1Cantsalnetalavada;

    /**
     * @var float $nuU1Cantdespachosclientes
     *
     * @ORM\Column(name="nu_u1_cantdespachosclientes", type="float", nullable=false)
     */
    private $nuU1Cantdespachosclientes;

    /**
     * @var float $nuU1Canttrasladadosunidades
     *
     * @ORM\Column(name="nu_u1_canttrasladadosunidades", type="float", nullable=false)
     */
    private $nuU1Canttrasladadosunidades;

    /**
     * @var datetime $feU2Mesyanio
     *
     * @ORM\Column(name="fe_u2_mesyanio", type="datetime", nullable=false)
     */
    private $feU2Mesyanio;

    /**
     * @var float $nuU2Cantsalbajadapuntilla
     *
     * @ORM\Column(name="nu_u2_cantsalbajadapuntilla", type="float", nullable=false)
     */
    private $nuU2Cantsalbajadapuntilla;

    /**
     * @var float $nuU2Cantsalnolavadaenpatio
     *
     * @ORM\Column(name="nu_u2_cantsalnolavadaenpatio", type="float", nullable=false)
     */
    private $nuU2Cantsalnolavadaenpatio;

    /**
     * @var float $nuU2Totaldesalnolavada
     *
     * @ORM\Column(name="nu_u2_totaldesalnolavada", type="float", nullable=false)
     */
    private $nuU2Totaldesalnolavada;

    /**
     * @var datetime $feU3Mesyanio
     *
     * @ORM\Column(name="fe_u3_mesyanio", type="datetime", nullable=false)
     */
    private $feU3Mesyanio;

    /**
     * @var float $nuU3srmesaSacos
     *
     * @ORM\Column(name="nu_u3srmesa_sacos", type="float", nullable=false)
     */
    private $nuU3srmesaSacos;

    /**
     * @var float $nuU3srmesaToneladas
     *
     * @ORM\Column(name="nu_u3srmesa_toneladas", type="float", nullable=false)
     */
    private $nuU3srmesaToneladas;

    /**
     * @var float $nuU3srextrafinaSacos
     *
     * @ORM\Column(name="nu_u3srextrafina_sacos", type="float", nullable=false)
     */
    private $nuU3srextrafinaSacos;

    /**
     * @var float $nuU3srextrafinaToneladas
     *
     * @ORM\Column(name="nu_u3srextrafina_toneladas", type="float", nullable=false)
     */
    private $nuU3srextrafinaToneladas;

    /**
     * @var float $nuU3srfinaSacos
     *
     * @ORM\Column(name="nu_u3srfina_sacos", type="float", nullable=false)
     */
    private $nuU3srfinaSacos;

    /**
     * @var float $nuU3srfinaToneladas
     *
     * @ORM\Column(name="nu_u3srfina_toneladas", type="float", nullable=false)
     */
    private $nuU3srfinaToneladas;

    /**
     * @var float $nuU3bbfinaSacos
     *
     * @ORM\Column(name="nu_u3bbfina_sacos", type="float", nullable=false)
     */
    private $nuU3bbfinaSacos;

    /**
     * @var float $nuU3bbfinaToneladas
     *
     * @ORM\Column(name="nu_u3bbfina_toneladas", type="float", nullable=false)
     */
    private $nuU3bbfinaToneladas;

    /**
     * @var float $nuU3srgruesaSacos
     *
     * @ORM\Column(name="nu_u3srgruesa_sacos", type="float", nullable=false)
     */
    private $nuU3srgruesaSacos;

    /**
     * @var float $nuU3srgruesaToneladas
     *
     * @ORM\Column(name="nu_u3srgruesa_toneladas", type="float", nullable=false)
     */
    private $nuU3srgruesaToneladas;

    /**
     * @var float $nuU3bbextrafinaSacos
     *
     * @ORM\Column(name="nu_u3bbextrafina_sacos", type="float", nullable=false)
     */
    private $nuU3bbextrafinaSacos;

    /**
     * @var float $nuU3bbextrafinaToneladas
     *
     * @ORM\Column(name="nu_u3bbextrafina_toneladas", type="float", nullable=false)
     */
    private $nuU3bbextrafinaToneladas;

    /**
     * @var float $nuU3Totalsalesrefinadastm
     *
     * @ORM\Column(name="nu_u3_totalsalesrefinadastm", type="float", nullable=false)
     */
    private $nuU3Totalsalesrefinadastm;

    /**
     * @var datetime $feU4Mesyanio
     *
     * @ORM\Column(name="fe_u4_mesyanio", type="datetime", nullable=false)
     */
    private $feU4Mesyanio;

    /**
     * @var float $nuU4srSacos
     *
     * @ORM\Column(name="nu_u4sr_sacos", type="float", nullable=false)
     */
    private $nuU4srSacos;

    /**
     * @var float $nuU4srToneladas
     *
     * @ORM\Column(name="nu_u4sr_toneladas", type="float", nullable=false)
     */
    private $nuU4srToneladas;

    /**
     * @var float $nuU4siggSacos
     *
     * @ORM\Column(name="nu_u4sigg_sacos", type="float", nullable=false)
     */
    private $nuU4siggSacos;

    /**
     * @var float $nuU4siggToneladas
     *
     * @ORM\Column(name="nu_u4sigg_toneladas", type="float", nullable=false)
     */
    private $nuU4siggToneladas;

    /**
     * @var float $nuU4bbggSacos
     *
     * @ORM\Column(name="nu_u4bbgg_sacos", type="float", nullable=false)
     */
    private $nuU4bbggSacos;

    /**
     * @var float $nuU4bbggToneladas
     *
     * @ORM\Column(name="nu_u4bbgg_toneladas", type="float", nullable=false)
     */
    private $nuU4bbggToneladas;

    /**
     * @var float $nuU4sicSacos
     *
     * @ORM\Column(name="nu_u4sic_sacos", type="float", nullable=false)
     */
    private $nuU4sicSacos;

    /**
     * @var float $nuU4sicToneladas
     *
     * @ORM\Column(name="nu_u4sic_toneladas", type="float", nullable=false)
     */
    private $nuU4sicToneladas;

    /**
     * @var float $nuU4Totalsalesindustrialestm
     *
     * @ORM\Column(name="nu_u4_totalsalesindustrialestm", type="float", nullable=false)
     */
    private $nuU4Totalsalesindustrialestm;

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
     * Get d100pkProdResumenproduccion
     *
     * @return integer 
     */
    public function getD100pkProdResumenproduccion()
    {
        return $this->d100pkProdResumenproduccion;
    }

    /**
     * Set feU1Mesyanio
     *
     * @param datetime $feU1Mesyanio
     */
    public function setFeU1Mesyanio($feU1Mesyanio)
    {
        $this->feU1Mesyanio = $feU1Mesyanio;
    }

    /**
     * Get feU1Mesyanio
     *
     * @return datetime 
     */
    public function getFeU1Mesyanio()
    {
        return $this->feU1Mesyanio;
    }

    /**
     * Set nuU1Cantsalbajadapuntilla
     *
     * @param float $nuU1Cantsalbajadapuntilla
     */
    public function setNuU1Cantsalbajadapuntilla($nuU1Cantsalbajadapuntilla)
    {
        $this->nuU1Cantsalbajadapuntilla = $nuU1Cantsalbajadapuntilla;
    }

    /**
     * Get nuU1Cantsalbajadapuntilla
     *
     * @return float 
     */
    public function getNuU1Cantsalbajadapuntilla()
    {
        return $this->nuU1Cantsalbajadapuntilla;
    }

    /**
     * Set nuU1Cantsallavada
     *
     * @param float $nuU1Cantsallavada
     */
    public function setNuU1Cantsallavada($nuU1Cantsallavada)
    {
        $this->nuU1Cantsallavada = $nuU1Cantsallavada;
    }

    /**
     * Get nuU1Cantsallavada
     *
     * @return float 
     */
    public function getNuU1Cantsallavada()
    {
        return $this->nuU1Cantsallavada;
    }

    /**
     * Set nuU1Cantsalnetalavada
     *
     * @param float $nuU1Cantsalnetalavada
     */
    public function setNuU1Cantsalnetalavada($nuU1Cantsalnetalavada)
    {
        $this->nuU1Cantsalnetalavada = $nuU1Cantsalnetalavada;
    }

    /**
     * Get nuU1Cantsalnetalavada
     *
     * @return float 
     */
    public function getNuU1Cantsalnetalavada()
    {
        return $this->nuU1Cantsalnetalavada;
    }

    /**
     * Set nuU1Cantdespachosclientes
     *
     * @param float $nuU1Cantdespachosclientes
     */
    public function setNuU1Cantdespachosclientes($nuU1Cantdespachosclientes)
    {
        $this->nuU1Cantdespachosclientes = $nuU1Cantdespachosclientes;
    }

    /**
     * Get nuU1Cantdespachosclientes
     *
     * @return float 
     */
    public function getNuU1Cantdespachosclientes()
    {
        return $this->nuU1Cantdespachosclientes;
    }

    /**
     * Set nuU1Canttrasladadosunidades
     *
     * @param float $nuU1Canttrasladadosunidades
     */
    public function setNuU1Canttrasladadosunidades($nuU1Canttrasladadosunidades)
    {
        $this->nuU1Canttrasladadosunidades = $nuU1Canttrasladadosunidades;
    }

    /**
     * Get nuU1Canttrasladadosunidades
     *
     * @return float 
     */
    public function getNuU1Canttrasladadosunidades()
    {
        return $this->nuU1Canttrasladadosunidades;
    }

    /**
     * Set feU2Mesyanio
     *
     * @param datetime $feU2Mesyanio
     */
    public function setFeU2Mesyanio($feU2Mesyanio)
    {
        $this->feU2Mesyanio = $feU2Mesyanio;
    }

    /**
     * Get feU2Mesyanio
     *
     * @return datetime 
     */
    public function getFeU2Mesyanio()
    {
        return $this->feU2Mesyanio;
    }

    /**
     * Set nuU2Cantsalbajadapuntilla
     *
     * @param float $nuU2Cantsalbajadapuntilla
     */
    public function setNuU2Cantsalbajadapuntilla($nuU2Cantsalbajadapuntilla)
    {
        $this->nuU2Cantsalbajadapuntilla = $nuU2Cantsalbajadapuntilla;
    }

    /**
     * Get nuU2Cantsalbajadapuntilla
     *
     * @return float 
     */
    public function getNuU2Cantsalbajadapuntilla()
    {
        return $this->nuU2Cantsalbajadapuntilla;
    }

    /**
     * Set nuU2Cantsalnolavadaenpatio
     *
     * @param float $nuU2Cantsalnolavadaenpatio
     */
    public function setNuU2Cantsalnolavadaenpatio($nuU2Cantsalnolavadaenpatio)
    {
        $this->nuU2Cantsalnolavadaenpatio = $nuU2Cantsalnolavadaenpatio;
    }

    /**
     * Get nuU2Cantsalnolavadaenpatio
     *
     * @return float 
     */
    public function getNuU2Cantsalnolavadaenpatio()
    {
        return $this->nuU2Cantsalnolavadaenpatio;
    }

    /**
     * Set nuU2Totaldesalnolavada
     *
     * @param float $nuU2Totaldesalnolavada
     */
    public function setNuU2Totaldesalnolavada($nuU2Totaldesalnolavada)
    {
        $this->nuU2Totaldesalnolavada = $nuU2Totaldesalnolavada;
    }

    /**
     * Get nuU2Totaldesalnolavada
     *
     * @return float 
     */
    public function getNuU2Totaldesalnolavada()
    {
        return $this->nuU2Totaldesalnolavada;
    }

    /**
     * Set feU3Mesyanio
     *
     * @param datetime $feU3Mesyanio
     */
    public function setFeU3Mesyanio($feU3Mesyanio)
    {
        $this->feU3Mesyanio = $feU3Mesyanio;
    }

    /**
     * Get feU3Mesyanio
     *
     * @return datetime 
     */
    public function getFeU3Mesyanio()
    {
        return $this->feU3Mesyanio;
    }

    /**
     * Set nuU3srmesaSacos
     *
     * @param float $nuU3srmesaSacos
     */
    public function setNuU3srmesaSacos($nuU3srmesaSacos)
    {
        $this->nuU3srmesaSacos = $nuU3srmesaSacos;
    }

    /**
     * Get nuU3srmesaSacos
     *
     * @return float 
     */
    public function getNuU3srmesaSacos()
    {
        return $this->nuU3srmesaSacos;
    }

    /**
     * Set nuU3srmesaToneladas
     *
     * @param float $nuU3srmesaToneladas
     */
    public function setNuU3srmesaToneladas($nuU3srmesaToneladas)
    {
        $this->nuU3srmesaToneladas = $nuU3srmesaToneladas;
    }

    /**
     * Get nuU3srmesaToneladas
     *
     * @return float 
     */
    public function getNuU3srmesaToneladas()
    {
        return $this->nuU3srmesaToneladas;
    }

    /**
     * Set nuU3srextrafinaSacos
     *
     * @param float $nuU3srextrafinaSacos
     */
    public function setNuU3srextrafinaSacos($nuU3srextrafinaSacos)
    {
        $this->nuU3srextrafinaSacos = $nuU3srextrafinaSacos;
    }

    /**
     * Get nuU3srextrafinaSacos
     *
     * @return float 
     */
    public function getNuU3srextrafinaSacos()
    {
        return $this->nuU3srextrafinaSacos;
    }

    /**
     * Set nuU3srextrafinaToneladas
     *
     * @param float $nuU3srextrafinaToneladas
     */
    public function setNuU3srextrafinaToneladas($nuU3srextrafinaToneladas)
    {
        $this->nuU3srextrafinaToneladas = $nuU3srextrafinaToneladas;
    }

    /**
     * Get nuU3srextrafinaToneladas
     *
     * @return float 
     */
    public function getNuU3srextrafinaToneladas()
    {
        return $this->nuU3srextrafinaToneladas;
    }

    /**
     * Set nuU3srfinaSacos
     *
     * @param float $nuU3srfinaSacos
     */
    public function setNuU3srfinaSacos($nuU3srfinaSacos)
    {
        $this->nuU3srfinaSacos = $nuU3srfinaSacos;
    }

    /**
     * Get nuU3srfinaSacos
     *
     * @return float 
     */
    public function getNuU3srfinaSacos()
    {
        return $this->nuU3srfinaSacos;
    }

    /**
     * Set nuU3srfinaToneladas
     *
     * @param float $nuU3srfinaToneladas
     */
    public function setNuU3srfinaToneladas($nuU3srfinaToneladas)
    {
        $this->nuU3srfinaToneladas = $nuU3srfinaToneladas;
    }

    /**
     * Get nuU3srfinaToneladas
     *
     * @return float 
     */
    public function getNuU3srfinaToneladas()
    {
        return $this->nuU3srfinaToneladas;
    }

    /**
     * Set nuU3bbfinaSacos
     *
     * @param float $nuU3bbfinaSacos
     */
    public function setNuU3bbfinaSacos($nuU3bbfinaSacos)
    {
        $this->nuU3bbfinaSacos = $nuU3bbfinaSacos;
    }

    /**
     * Get nuU3bbfinaSacos
     *
     * @return float 
     */
    public function getNuU3bbfinaSacos()
    {
        return $this->nuU3bbfinaSacos;
    }

    /**
     * Set nuU3bbfinaToneladas
     *
     * @param float $nuU3bbfinaToneladas
     */
    public function setNuU3bbfinaToneladas($nuU3bbfinaToneladas)
    {
        $this->nuU3bbfinaToneladas = $nuU3bbfinaToneladas;
    }

    /**
     * Get nuU3bbfinaToneladas
     *
     * @return float 
     */
    public function getNuU3bbfinaToneladas()
    {
        return $this->nuU3bbfinaToneladas;
    }

    /**
     * Set nuU3srgruesaSacos
     *
     * @param float $nuU3srgruesaSacos
     */
    public function setNuU3srgruesaSacos($nuU3srgruesaSacos)
    {
        $this->nuU3srgruesaSacos = $nuU3srgruesaSacos;
    }

    /**
     * Get nuU3srgruesaSacos
     *
     * @return float 
     */
    public function getNuU3srgruesaSacos()
    {
        return $this->nuU3srgruesaSacos;
    }

    /**
     * Set nuU3srgruesaToneladas
     *
     * @param float $nuU3srgruesaToneladas
     */
    public function setNuU3srgruesaToneladas($nuU3srgruesaToneladas)
    {
        $this->nuU3srgruesaToneladas = $nuU3srgruesaToneladas;
    }

    /**
     * Get nuU3srgruesaToneladas
     *
     * @return float 
     */
    public function getNuU3srgruesaToneladas()
    {
        return $this->nuU3srgruesaToneladas;
    }

    /**
     * Set nuU3bbextrafinaSacos
     *
     * @param float $nuU3bbextrafinaSacos
     */
    public function setNuU3bbextrafinaSacos($nuU3bbextrafinaSacos)
    {
        $this->nuU3bbextrafinaSacos = $nuU3bbextrafinaSacos;
    }

    /**
     * Get nuU3bbextrafinaSacos
     *
     * @return float 
     */
    public function getNuU3bbextrafinaSacos()
    {
        return $this->nuU3bbextrafinaSacos;
    }

    /**
     * Set nuU3bbextrafinaToneladas
     *
     * @param float $nuU3bbextrafinaToneladas
     */
    public function setNuU3bbextrafinaToneladas($nuU3bbextrafinaToneladas)
    {
        $this->nuU3bbextrafinaToneladas = $nuU3bbextrafinaToneladas;
    }

    /**
     * Get nuU3bbextrafinaToneladas
     *
     * @return float 
     */
    public function getNuU3bbextrafinaToneladas()
    {
        return $this->nuU3bbextrafinaToneladas;
    }

    /**
     * Set nuU3Totalsalesrefinadastm
     *
     * @param float $nuU3Totalsalesrefinadastm
     */
    public function setNuU3Totalsalesrefinadastm($nuU3Totalsalesrefinadastm)
    {
        $this->nuU3Totalsalesrefinadastm = $nuU3Totalsalesrefinadastm;
    }

    /**
     * Get nuU3Totalsalesrefinadastm
     *
     * @return float 
     */
    public function getNuU3Totalsalesrefinadastm()
    {
        return $this->nuU3Totalsalesrefinadastm;
    }

    /**
     * Set feU4Mesyanio
     *
     * @param datetime $feU4Mesyanio
     */
    public function setFeU4Mesyanio($feU4Mesyanio)
    {
        $this->feU4Mesyanio = $feU4Mesyanio;
    }

    /**
     * Get feU4Mesyanio
     *
     * @return datetime 
     */
    public function getFeU4Mesyanio()
    {
        return $this->feU4Mesyanio;
    }

    /**
     * Set nuU4srSacos
     *
     * @param float $nuU4srSacos
     */
    public function setNuU4srSacos($nuU4srSacos)
    {
        $this->nuU4srSacos = $nuU4srSacos;
    }

    /**
     * Get nuU4srSacos
     *
     * @return float 
     */
    public function getNuU4srSacos()
    {
        return $this->nuU4srSacos;
    }

    /**
     * Set nuU4srToneladas
     *
     * @param float $nuU4srToneladas
     */
    public function setNuU4srToneladas($nuU4srToneladas)
    {
        $this->nuU4srToneladas = $nuU4srToneladas;
    }

    /**
     * Get nuU4srToneladas
     *
     * @return float 
     */
    public function getNuU4srToneladas()
    {
        return $this->nuU4srToneladas;
    }

    /**
     * Set nuU4siggSacos
     *
     * @param float $nuU4siggSacos
     */
    public function setNuU4siggSacos($nuU4siggSacos)
    {
        $this->nuU4siggSacos = $nuU4siggSacos;
    }

    /**
     * Get nuU4siggSacos
     *
     * @return float 
     */
    public function getNuU4siggSacos()
    {
        return $this->nuU4siggSacos;
    }

    /**
     * Set nuU4siggToneladas
     *
     * @param float $nuU4siggToneladas
     */
    public function setNuU4siggToneladas($nuU4siggToneladas)
    {
        $this->nuU4siggToneladas = $nuU4siggToneladas;
    }

    /**
     * Get nuU4siggToneladas
     *
     * @return float 
     */
    public function getNuU4siggToneladas()
    {
        return $this->nuU4siggToneladas;
    }

    /**
     * Set nuU4bbggSacos
     *
     * @param float $nuU4bbggSacos
     */
    public function setNuU4bbggSacos($nuU4bbggSacos)
    {
        $this->nuU4bbggSacos = $nuU4bbggSacos;
    }

    /**
     * Get nuU4bbggSacos
     *
     * @return float 
     */
    public function getNuU4bbggSacos()
    {
        return $this->nuU4bbggSacos;
    }

    /**
     * Set nuU4bbggToneladas
     *
     * @param float $nuU4bbggToneladas
     */
    public function setNuU4bbggToneladas($nuU4bbggToneladas)
    {
        $this->nuU4bbggToneladas = $nuU4bbggToneladas;
    }

    /**
     * Get nuU4bbggToneladas
     *
     * @return float 
     */
    public function getNuU4bbggToneladas()
    {
        return $this->nuU4bbggToneladas;
    }

    /**
     * Set nuU4sicSacos
     *
     * @param float $nuU4sicSacos
     */
    public function setNuU4sicSacos($nuU4sicSacos)
    {
        $this->nuU4sicSacos = $nuU4sicSacos;
    }

    /**
     * Get nuU4sicSacos
     *
     * @return float 
     */
    public function getNuU4sicSacos()
    {
        return $this->nuU4sicSacos;
    }

    /**
     * Set nuU4sicToneladas
     *
     * @param float $nuU4sicToneladas
     */
    public function setNuU4sicToneladas($nuU4sicToneladas)
    {
        $this->nuU4sicToneladas = $nuU4sicToneladas;
    }

    /**
     * Get nuU4sicToneladas
     *
     * @return float 
     */
    public function getNuU4sicToneladas()
    {
        return $this->nuU4sicToneladas;
    }

    /**
     * Set nuU4Totalsalesindustrialestm
     *
     * @param float $nuU4Totalsalesindustrialestm
     */
    public function setNuU4Totalsalesindustrialestm($nuU4Totalsalesindustrialestm)
    {
        $this->nuU4Totalsalesindustrialestm = $nuU4Totalsalesindustrialestm;
    }

    /**
     * Get nuU4Totalsalesindustrialestm
     *
     * @return float 
     */
    public function getNuU4Totalsalesindustrialestm()
    {
        return $this->nuU4Totalsalesindustrialestm;
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