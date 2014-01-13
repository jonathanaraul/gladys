<?php

namespace Proyecto\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proyecto\PrincipalBundle\Entity\D101tProdU4rgp
 *
 * @ORM\Table(name="d101t_prod_u4rgp")
 * @ORM\Entity
 */
class D101tProdU4rgp
{
    /**
     * @var integer $d101pkProdU4rgp
     *
     * @ORM\Column(name="d101pk_prod_u4rgp", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $d101pkProdU4rgp;

    /**
     * @var text $txTipodesal
     *
     * @ORM\Column(name="tx_tipodesal", type="text", nullable=false)
     */
    private $txTipodesal;

    /**
     * @var float $nuNdematiz
     *
     * @ORM\Column(name="nu_ndematiz", type="float", nullable=false)
     */
    private $nuNdematiz;

    /**
     * @var float $nuPorcentaje
     *
     * @ORM\Column(name="nu_porcentaje", type="float", nullable=false)
     */
    private $nuPorcentaje;

    /**
     * @var float $nuPan
     *
     * @ORM\Column(name="nu_pan", type="float", nullable=false)
     */
    private $nuPan;

    /**
     * @var float $nuTotal
     *
     * @ORM\Column(name="nu_total", type="float", nullable=false)
     */
    private $nuTotal;

    /**
     * @var D100tProdU4rgp
     *
     * @ORM\ManyToOne(targetEntity="D100tProdU4rgp")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="d100fk_prod_u4rgp", referencedColumnName="d100pk_prod_u4rgp")
     * })
     */
    private $d100fkProdU4rgp;



    /**
     * Get d101pkProdU4rgp
     *
     * @return integer 
     */
    public function getD101pkProdU4rgp()
    {
        return $this->d101pkProdU4rgp;
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
     * Set nuNdematiz
     *
     * @param float $nuNdematiz
     */
    public function setNuNdematiz($nuNdematiz)
    {
        $this->nuNdematiz = $nuNdematiz;
    }

    /**
     * Get nuNdematiz
     *
     * @return float 
     */
    public function getNuNdematiz()
    {
        return $this->nuNdematiz;
    }

    /**
     * Set nuPorcentaje
     *
     * @param float $nuPorcentaje
     */
    public function setNuPorcentaje($nuPorcentaje)
    {
        $this->nuPorcentaje = $nuPorcentaje;
    }

    /**
     * Get nuPorcentaje
     *
     * @return float 
     */
    public function getNuPorcentaje()
    {
        return $this->nuPorcentaje;
    }

    /**
     * Set nuPan
     *
     * @param float $nuPan
     */
    public function setNuPan($nuPan)
    {
        $this->nuPan = $nuPan;
    }

    /**
     * Get nuPan
     *
     * @return float 
     */
    public function getNuPan()
    {
        return $this->nuPan;
    }

    /**
     * Set nuTotal
     *
     * @param float $nuTotal
     */
    public function setNuTotal($nuTotal)
    {
        $this->nuTotal = $nuTotal;
    }

    /**
     * Get nuTotal
     *
     * @return float 
     */
    public function getNuTotal()
    {
        return $this->nuTotal;
    }

    /**
     * Set d100fkProdU4rgp
     *
     * @param Proyecto\PrincipalBundle\Entity\D100tProdU4rgp $d100fkProdU4rgp
     */
    public function setD100fkProdU4rgp(\Proyecto\PrincipalBundle\Entity\D100tProdU4rgp $d100fkProdU4rgp)
    {
        $this->d100fkProdU4rgp = $d100fkProdU4rgp;
    }

    /**
     * Get d100fkProdU4rgp
     *
     * @return Proyecto\PrincipalBundle\Entity\D100tProdU4rgp 
     */
    public function getD100fkProdU4rgp()
    {
        return $this->d100fkProdU4rgp;
    }
}