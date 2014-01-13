<?php

namespace Proyecto\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proyecto\PrincipalBundle\Entity\D101tVenEmitirorden
 *
 * @ORM\Table(name="d101t_ven_emitirorden")
 * @ORM\Entity
 */
class D101tVenEmitirorden
{
    /**
     * @var integer $d101pkVenEmitirorden
     *
     * @ORM\Column(name="d101pk_ven_emitirorden", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $d101pkVenEmitirorden;

    /**
     * @var text $txDpTipodeproducto
     *
     * @ORM\Column(name="tx_dp_tipodeproducto", type="text", nullable=false)
     */
    private $txDpTipodeproducto;

    /**
     * @var float $nuDpSacos
     *
     * @ORM\Column(name="nu_dp_sacos", type="float", nullable=false)
     */
    private $nuDpSacos;

    /**
     * @var float $nuDpTm
     *
     * @ORM\Column(name="nu_dp_tm", type="float", nullable=false)
     */
    private $nuDpTm;

    /**
     * @var D100tVenEmitirorden
     *
     * @ORM\ManyToOne(targetEntity="D100tVenEmitirorden")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="d100fk_ven_emitirorden", referencedColumnName="d100pk_ven_emitirorden")
     * })
     */
    private $d100fkVenEmitirorden;



    /**
     * Get d101pkVenEmitirorden
     *
     * @return integer 
     */
    public function getD101pkVenEmitirorden()
    {
        return $this->d101pkVenEmitirorden;
    }

    /**
     * Set txDpTipodeproducto
     *
     * @param text $txDpTipodeproducto
     */
    public function setTxDpTipodeproducto($txDpTipodeproducto)
    {
        $this->txDpTipodeproducto = $txDpTipodeproducto;
    }

    /**
     * Get txDpTipodeproducto
     *
     * @return text 
     */
    public function getTxDpTipodeproducto()
    {
        return $this->txDpTipodeproducto;
    }

    /**
     * Set nuDpSacos
     *
     * @param float $nuDpSacos
     */
    public function setNuDpSacos($nuDpSacos)
    {
        $this->nuDpSacos = $nuDpSacos;
    }

    /**
     * Get nuDpSacos
     *
     * @return float 
     */
    public function getNuDpSacos()
    {
        return $this->nuDpSacos;
    }

    /**
     * Set nuDpTm
     *
     * @param float $nuDpTm
     */
    public function setNuDpTm($nuDpTm)
    {
        $this->nuDpTm = $nuDpTm;
    }

    /**
     * Get nuDpTm
     *
     * @return float 
     */
    public function getNuDpTm()
    {
        return $this->nuDpTm;
    }

    /**
     * Set d100fkVenEmitirorden
     *
     * @param Proyecto\PrincipalBundle\Entity\D100tVenEmitirorden $d100fkVenEmitirorden
     */
    public function setD100fkVenEmitirorden(\Proyecto\PrincipalBundle\Entity\D100tVenEmitirorden $d100fkVenEmitirorden)
    {
        $this->d100fkVenEmitirorden = $d100fkVenEmitirorden;
    }

    /**
     * Get d100fkVenEmitirorden
     *
     * @return Proyecto\PrincipalBundle\Entity\D100tVenEmitirorden 
     */
    public function getD100fkVenEmitirorden()
    {
        return $this->d100fkVenEmitirorden;
    }
}