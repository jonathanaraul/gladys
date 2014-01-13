<?php

namespace Proyecto\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proyecto\PrincipalBundle\Entity\D101tProdU3rp
 *
 * @ORM\Table(name="d101t_prod_u3rp")
 * @ORM\Entity
 */
class D101tProdU3rp
{
    /**
     * @var integer $d101pkProdU3rp
     *
     * @ORM\Column(name="d101pk_prod_u3rp", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $d101pkProdU3rp;

    /**
     * @var float $nuSalrefgruesakg
     *
     * @ORM\Column(name="nu_salrefgruesakg", type="float", nullable=false)
     */
    private $nuSalrefgruesakg;

    /**
     * @var float $nuSalextrafinakg
     *
     * @ORM\Column(name="nu_salextrafinakg", type="float", nullable=false)
     */
    private $nuSalextrafinakg;

    /**
     * @var float $nuSalrefmesakg
     *
     * @ORM\Column(name="nu_salrefmesakg", type="float", nullable=false)
     */
    private $nuSalrefmesakg;

    /**
     * @var float $nuSalreffinakg
     *
     * @ORM\Column(name="nu_salreffinakg", type="float", nullable=false)
     */
    private $nuSalreffinakg;

    /**
     * @var text $txObservaciones
     *
     * @ORM\Column(name="tx_observaciones", type="text", nullable=false)
     */
    private $txObservaciones;

    /**
     * @var D100tProdU3rp
     *
     * @ORM\ManyToOne(targetEntity="D100tProdU3rp")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="d100fk_prod_u3rp", referencedColumnName="d100pk_prod_u3rp")
     * })
     */
    private $d100fkProdU3rp;

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
     * Get d101pkProdU3rp
     *
     * @return integer 
     */
    public function getD101pkProdU3rp()
    {
        return $this->d101pkProdU3rp;
    }

    /**
     * Set nuSalrefgruesakg
     *
     * @param float $nuSalrefgruesakg
     */
    public function setNuSalrefgruesakg($nuSalrefgruesakg)
    {
        $this->nuSalrefgruesakg = $nuSalrefgruesakg;
    }

    /**
     * Get nuSalrefgruesakg
     *
     * @return float 
     */
    public function getNuSalrefgruesakg()
    {
        return $this->nuSalrefgruesakg;
    }

    /**
     * Set nuSalextrafinakg
     *
     * @param float $nuSalextrafinakg
     */
    public function setNuSalextrafinakg($nuSalextrafinakg)
    {
        $this->nuSalextrafinakg = $nuSalextrafinakg;
    }

    /**
     * Get nuSalextrafinakg
     *
     * @return float 
     */
    public function getNuSalextrafinakg()
    {
        return $this->nuSalextrafinakg;
    }

    /**
     * Set nuSalrefmesakg
     *
     * @param float $nuSalrefmesakg
     */
    public function setNuSalrefmesakg($nuSalrefmesakg)
    {
        $this->nuSalrefmesakg = $nuSalrefmesakg;
    }

    /**
     * Get nuSalrefmesakg
     *
     * @return float 
     */
    public function getNuSalrefmesakg()
    {
        return $this->nuSalrefmesakg;
    }

    /**
     * Set nuSalreffinakg
     *
     * @param float $nuSalreffinakg
     */
    public function setNuSalreffinakg($nuSalreffinakg)
    {
        $this->nuSalreffinakg = $nuSalreffinakg;
    }

    /**
     * Get nuSalreffinakg
     *
     * @return float 
     */
    public function getNuSalreffinakg()
    {
        return $this->nuSalreffinakg;
    }

    /**
     * Set txObservaciones
     *
     * @param text $txObservaciones
     */
    public function setTxObservaciones($txObservaciones)
    {
        $this->txObservaciones = $txObservaciones;
    }

    /**
     * Get txObservaciones
     *
     * @return text 
     */
    public function getTxObservaciones()
    {
        return $this->txObservaciones;
    }

    /**
     * Set d100fkProdU3rp
     *
     * @param Proyecto\PrincipalBundle\Entity\D100tProdU3rp $d100fkProdU3rp
     */
    public function setD100fkProdU3rp(\Proyecto\PrincipalBundle\Entity\D100tProdU3rp $d100fkProdU3rp)
    {
        $this->d100fkProdU3rp = $d100fkProdU3rp;
    }

    /**
     * Get d100fkProdU3rp
     *
     * @return Proyecto\PrincipalBundle\Entity\D100tProdU3rp 
     */
    public function getD100fkProdU3rp()
    {
        return $this->d100fkProdU3rp;
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