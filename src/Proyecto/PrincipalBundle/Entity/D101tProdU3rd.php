<?php

namespace Proyecto\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proyecto\PrincipalBundle\Entity\D101tProdU3rd
 *
 * @ORM\Table(name="d101t_prod_u3rd")
 * @ORM\Entity
 */
class D101tProdU3rd
{
    /**
     * @var integer $d101pkProdU3rd
     *
     * @ORM\Column(name="d101pk_prod_u3rd", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $d101pkProdU3rd;

    /**
     * @var text $txTipodeproducto
     *
     * @ORM\Column(name="tx_tipodeproducto", type="text", nullable=false)
     */
    private $txTipodeproducto;

    /**
     * @var float $nuCpoSacos
     *
     * @ORM\Column(name="nu_cpo_sacos", type="float", nullable=false)
     */
    private $nuCpoSacos;

    /**
     * @var float $nuCpoToneladas
     *
     * @ORM\Column(name="nu_cpo_toneladas", type="float", nullable=false)
     */
    private $nuCpoToneladas;

    /**
     * @var float $nuCprSacos
     *
     * @ORM\Column(name="nu_cpr_sacos", type="float", nullable=false)
     */
    private $nuCprSacos;

    /**
     * @var float $nuCprToneladas
     *
     * @ORM\Column(name="nu_cpr_toneladas", type="float", nullable=false)
     */
    private $nuCprToneladas;

    /**
     * @var float $nuCptSacos
     *
     * @ORM\Column(name="nu_cpt_sacos", type="float", nullable=false)
     */
    private $nuCptSacos;

    /**
     * @var float $nuCptToneladas
     *
     * @ORM\Column(name="nu_cpt_toneladas", type="float", nullable=false)
     */
    private $nuCptToneladas;

    /**
     * @var D100tProdU3rd
     *
     * @ORM\ManyToOne(targetEntity="D100tProdU3rd")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="d100fk_prod_u3rd", referencedColumnName="d100pk_prod_u3rd")
     * })
     */
    private $d100fkProdU3rd;

    /**
     * @var E100tTurno
     *
     * @ORM\ManyToOne(targetEntity="E100tTurno")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="e100fk_turno", referencedColumnName="e100pk_turno")
     * })
     */
    private $e100fkTurno;



    /**
     * Get d101pkProdU3rd
     *
     * @return integer 
     */
    public function getD101pkProdU3rd()
    {
        return $this->d101pkProdU3rd;
    }

    /**
     * Set txTipodeproducto
     *
     * @param text $txTipodeproducto
     */
    public function setTxTipodeproducto($txTipodeproducto)
    {
        $this->txTipodeproducto = $txTipodeproducto;
    }

    /**
     * Get txTipodeproducto
     *
     * @return text 
     */
    public function getTxTipodeproducto()
    {
        return $this->txTipodeproducto;
    }

    /**
     * Set nuCpoSacos
     *
     * @param float $nuCpoSacos
     */
    public function setNuCpoSacos($nuCpoSacos)
    {
        $this->nuCpoSacos = $nuCpoSacos;
    }

    /**
     * Get nuCpoSacos
     *
     * @return float 
     */
    public function getNuCpoSacos()
    {
        return $this->nuCpoSacos;
    }

    /**
     * Set nuCpoToneladas
     *
     * @param float $nuCpoToneladas
     */
    public function setNuCpoToneladas($nuCpoToneladas)
    {
        $this->nuCpoToneladas = $nuCpoToneladas;
    }

    /**
     * Get nuCpoToneladas
     *
     * @return float 
     */
    public function getNuCpoToneladas()
    {
        return $this->nuCpoToneladas;
    }

    /**
     * Set nuCprSacos
     *
     * @param float $nuCprSacos
     */
    public function setNuCprSacos($nuCprSacos)
    {
        $this->nuCprSacos = $nuCprSacos;
    }

    /**
     * Get nuCprSacos
     *
     * @return float 
     */
    public function getNuCprSacos()
    {
        return $this->nuCprSacos;
    }

    /**
     * Set nuCprToneladas
     *
     * @param float $nuCprToneladas
     */
    public function setNuCprToneladas($nuCprToneladas)
    {
        $this->nuCprToneladas = $nuCprToneladas;
    }

    /**
     * Get nuCprToneladas
     *
     * @return float 
     */
    public function getNuCprToneladas()
    {
        return $this->nuCprToneladas;
    }

    /**
     * Set nuCptSacos
     *
     * @param float $nuCptSacos
     */
    public function setNuCptSacos($nuCptSacos)
    {
        $this->nuCptSacos = $nuCptSacos;
    }

    /**
     * Get nuCptSacos
     *
     * @return float 
     */
    public function getNuCptSacos()
    {
        return $this->nuCptSacos;
    }

    /**
     * Set nuCptToneladas
     *
     * @param float $nuCptToneladas
     */
    public function setNuCptToneladas($nuCptToneladas)
    {
        $this->nuCptToneladas = $nuCptToneladas;
    }

    /**
     * Get nuCptToneladas
     *
     * @return float 
     */
    public function getNuCptToneladas()
    {
        return $this->nuCptToneladas;
    }

    /**
     * Set d100fkProdU3rd
     *
     * @param Proyecto\PrincipalBundle\Entity\D100tProdU3rd $d100fkProdU3rd
     */
    public function setD100fkProdU3rd(\Proyecto\PrincipalBundle\Entity\D100tProdU3rd $d100fkProdU3rd)
    {
        $this->d100fkProdU3rd = $d100fkProdU3rd;
    }

    /**
     * Get d100fkProdU3rd
     *
     * @return Proyecto\PrincipalBundle\Entity\D100tProdU3rd 
     */
    public function getD100fkProdU3rd()
    {
        return $this->d100fkProdU3rd;
    }

    /**
     * Set e100fkTurno
     *
     * @param Proyecto\PrincipalBundle\Entity\E100tTurno $e100fkTurno
     */
    public function setE100fkTurno(\Proyecto\PrincipalBundle\Entity\E100tTurno $e100fkTurno)
    {
        $this->e100fkTurno = $e100fkTurno;
    }

    /**
     * Get e100fkTurno
     *
     * @return Proyecto\PrincipalBundle\Entity\E100tTurno 
     */
    public function getE100fkTurno()
    {
        return $this->e100fkTurno;
    }
}