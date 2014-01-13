<?php

namespace Proyecto\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proyecto\PrincipalBundle\Entity\D101tProdU4rpf
 *
 * @ORM\Table(name="d101t_prod_u4rpf")
 * @ORM\Entity
 */
class D101tProdU4rpf
{
    /**
     * @var integer $d101pkProdU4rpf
     *
     * @ORM\Column(name="d101pk_prod_u4rpf", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $d101pkProdU4rpf;

    /**
     * @var text $txTipodesal
     *
     * @ORM\Column(name="tx_tipodesal", type="text", nullable=false)
     */
    private $txTipodesal;

    /**
     * @var float $nuPmCa
     *
     * @ORM\Column(name="nu_pm_ca", type="float", nullable=false)
     */
    private $nuPmCa;

    /**
     * @var float $nuPmMg
     *
     * @ORM\Column(name="nu_pm_mg", type="float", nullable=false)
     */
    private $nuPmMg;

    /**
     * @var float $nuPmCo
     *
     * @ORM\Column(name="nu_pm_co", type="float", nullable=false)
     */
    private $nuPmCo;

    /**
     * @var float $nuPmSo
     *
     * @ORM\Column(name="nu_pm_so", type="float", nullable=false)
     */
    private $nuPmSo;

    /**
     * @var float $nuPmNaci
     *
     * @ORM\Column(name="nu_pm_naci", type="float", nullable=false)
     */
    private $nuPmNaci;

    /**
     * @var float $nuPmInsolubles
     *
     * @ORM\Column(name="nu_pm_insolubles", type="float", nullable=false)
     */
    private $nuPmInsolubles;

    /**
     * @var float $nuPmHumedad
     *
     * @ORM\Column(name="nu_pm_humedad", type="float", nullable=false)
     */
    private $nuPmHumedad;

    /**
     * @var D100tProdU4rpf
     *
     * @ORM\ManyToOne(targetEntity="D100tProdU4rpf")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="d100fk_prod_u4rpf", referencedColumnName="d100pk_prod_u4rpf")
     * })
     */
    private $d100fkProdU4rpf;



    /**
     * Get d101pkProdU4rpf
     *
     * @return integer 
     */
    public function getD101pkProdU4rpf()
    {
        return $this->d101pkProdU4rpf;
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
     * Set nuPmCa
     *
     * @param float $nuPmCa
     */
    public function setNuPmCa($nuPmCa)
    {
        $this->nuPmCa = $nuPmCa;
    }

    /**
     * Get nuPmCa
     *
     * @return float 
     */
    public function getNuPmCa()
    {
        return $this->nuPmCa;
    }

    /**
     * Set nuPmMg
     *
     * @param float $nuPmMg
     */
    public function setNuPmMg($nuPmMg)
    {
        $this->nuPmMg = $nuPmMg;
    }

    /**
     * Get nuPmMg
     *
     * @return float 
     */
    public function getNuPmMg()
    {
        return $this->nuPmMg;
    }

    /**
     * Set nuPmCo
     *
     * @param float $nuPmCo
     */
    public function setNuPmCo($nuPmCo)
    {
        $this->nuPmCo = $nuPmCo;
    }

    /**
     * Get nuPmCo
     *
     * @return float 
     */
    public function getNuPmCo()
    {
        return $this->nuPmCo;
    }

    /**
     * Set nuPmSo
     *
     * @param float $nuPmSo
     */
    public function setNuPmSo($nuPmSo)
    {
        $this->nuPmSo = $nuPmSo;
    }

    /**
     * Get nuPmSo
     *
     * @return float 
     */
    public function getNuPmSo()
    {
        return $this->nuPmSo;
    }

    /**
     * Set nuPmNaci
     *
     * @param float $nuPmNaci
     */
    public function setNuPmNaci($nuPmNaci)
    {
        $this->nuPmNaci = $nuPmNaci;
    }

    /**
     * Get nuPmNaci
     *
     * @return float 
     */
    public function getNuPmNaci()
    {
        return $this->nuPmNaci;
    }

    /**
     * Set nuPmInsolubles
     *
     * @param float $nuPmInsolubles
     */
    public function setNuPmInsolubles($nuPmInsolubles)
    {
        $this->nuPmInsolubles = $nuPmInsolubles;
    }

    /**
     * Get nuPmInsolubles
     *
     * @return float 
     */
    public function getNuPmInsolubles()
    {
        return $this->nuPmInsolubles;
    }

    /**
     * Set nuPmHumedad
     *
     * @param float $nuPmHumedad
     */
    public function setNuPmHumedad($nuPmHumedad)
    {
        $this->nuPmHumedad = $nuPmHumedad;
    }

    /**
     * Get nuPmHumedad
     *
     * @return float 
     */
    public function getNuPmHumedad()
    {
        return $this->nuPmHumedad;
    }

    /**
     * Set d100fkProdU4rpf
     *
     * @param Proyecto\PrincipalBundle\Entity\D100tProdU4rpf $d100fkProdU4rpf
     */
    public function setD100fkProdU4rpf(\Proyecto\PrincipalBundle\Entity\D100tProdU4rpf $d100fkProdU4rpf)
    {
        $this->d100fkProdU4rpf = $d100fkProdU4rpf;
    }

    /**
     * Get d100fkProdU4rpf
     *
     * @return Proyecto\PrincipalBundle\Entity\D100tProdU4rpf 
     */
    public function getD100fkProdU4rpf()
    {
        return $this->d100fkProdU4rpf;
    }
}