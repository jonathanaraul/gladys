<?php

namespace Proyecto\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proyecto\PrincipalBundle\Entity\D102tProdU1rd
 *
 * @ORM\Table(name="d102t_prod_u1rd")
 * @ORM\Entity
 */
class D102tProdU1rd
{
    /**
     * @var integer $d102pkProdU1rd
     *
     * @ORM\Column(name="d102pk_prod_u1rd", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $d102pkProdU1rd;

    /**
     * @var text $txAdlHorainiciodetrabajo
     *
     * @ORM\Column(name="tx_adl_horainiciodetrabajo", type="text", nullable=true)
     */
    private $txAdlHorainiciodetrabajo;

    /**
     * @var text $txAdlHorafinaldelaparada
     *
     * @ORM\Column(name="tx_adl_horafinaldelaparada", type="text", nullable=true)
     */
    private $txAdlHorafinaldelaparada;

    /**
     * @var text $txAdlTotalhorasparada
     *
     * @ORM\Column(name="tx_adl_totalhorasparada", type="text", nullable=true)
     */
    private $txAdlTotalhorasparada;

    /**
     * @var text $txAdlHorainicialdelaparada
     *
     * @ORM\Column(name="tx_adl_horainicialdelaparada", type="text", nullable=true)
     */
    private $txAdlHorainicialdelaparada;

    /**
     * @var text $txAdlArranco
     *
     * @ORM\Column(name="tx_adl_arranco", type="text", nullable=true)
     */
    private $txAdlArranco;

    /**
     * @var text $txAdlHorasefectivas
     *
     * @ORM\Column(name="tx_adl_horasefectivas", type="text", nullable=true)
     */
    private $txAdlHorasefectivas;

    /**
     * @var text $txAdlCausasdelaparada
     *
     * @ORM\Column(name="tx_adl_causasdelaparada", type="text", nullable=true)
     */
    private $txAdlCausasdelaparada;

    /**
     * @var D100tProdU1rd
     *
     * @ORM\ManyToOne(targetEntity="D100tProdU1rd")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="d100fk_prod_u1rd", referencedColumnName="d100pk_prod_u1rd")
     * })
     */
    private $d100fkProdU1rd;

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
     * Get d102pkProdU1rd
     *
     * @return integer 
     */
    public function getD102pkProdU1rd()
    {
        return $this->d102pkProdU1rd;
    }

    /**
     * Set txAdlHorainiciodetrabajo
     *
     * @param text $txAdlHorainiciodetrabajo
     */
    public function setTxAdlHorainiciodetrabajo($txAdlHorainiciodetrabajo)
    {
        $this->txAdlHorainiciodetrabajo = $txAdlHorainiciodetrabajo;
    }

    /**
     * Get txAdlHorainiciodetrabajo
     *
     * @return text 
     */
    public function getTxAdlHorainiciodetrabajo()
    {
        return $this->txAdlHorainiciodetrabajo;
    }

    /**
     * Set txAdlHorafinaldelaparada
     *
     * @param text $txAdlHorafinaldelaparada
     */
    public function setTxAdlHorafinaldelaparada($txAdlHorafinaldelaparada)
    {
        $this->txAdlHorafinaldelaparada = $txAdlHorafinaldelaparada;
    }

    /**
     * Get txAdlHorafinaldelaparada
     *
     * @return text 
     */
    public function getTxAdlHorafinaldelaparada()
    {
        return $this->txAdlHorafinaldelaparada;
    }

    /**
     * Set txAdlTotalhorasparada
     *
     * @param text $txAdlTotalhorasparada
     */
    public function setTxAdlTotalhorasparada($txAdlTotalhorasparada)
    {
        $this->txAdlTotalhorasparada = $txAdlTotalhorasparada;
    }

    /**
     * Get txAdlTotalhorasparada
     *
     * @return text 
     */
    public function getTxAdlTotalhorasparada()
    {
        return $this->txAdlTotalhorasparada;
    }

    /**
     * Set txAdlHorainicialdelaparada
     *
     * @param text $txAdlHorainicialdelaparada
     */
    public function setTxAdlHorainicialdelaparada($txAdlHorainicialdelaparada)
    {
        $this->txAdlHorainicialdelaparada = $txAdlHorainicialdelaparada;
    }

    /**
     * Get txAdlHorainicialdelaparada
     *
     * @return text 
     */
    public function getTxAdlHorainicialdelaparada()
    {
        return $this->txAdlHorainicialdelaparada;
    }

    /**
     * Set txAdlArranco
     *
     * @param text $txAdlArranco
     */
    public function setTxAdlArranco($txAdlArranco)
    {
        $this->txAdlArranco = $txAdlArranco;
    }

    /**
     * Get txAdlArranco
     *
     * @return text 
     */
    public function getTxAdlArranco()
    {
        return $this->txAdlArranco;
    }

    /**
     * Set txAdlHorasefectivas
     *
     * @param text $txAdlHorasefectivas
     */
    public function setTxAdlHorasefectivas($txAdlHorasefectivas)
    {
        $this->txAdlHorasefectivas = $txAdlHorasefectivas;
    }

    /**
     * Get txAdlHorasefectivas
     *
     * @return text 
     */
    public function getTxAdlHorasefectivas()
    {
        return $this->txAdlHorasefectivas;
    }

    /**
     * Set txAdlCausasdelaparada
     *
     * @param text $txAdlCausasdelaparada
     */
    public function setTxAdlCausasdelaparada($txAdlCausasdelaparada)
    {
        $this->txAdlCausasdelaparada = $txAdlCausasdelaparada;
    }

    /**
     * Get txAdlCausasdelaparada
     *
     * @return text 
     */
    public function getTxAdlCausasdelaparada()
    {
        return $this->txAdlCausasdelaparada;
    }

    /**
     * Set d100fkProdU1rd
     *
     * @param Proyecto\PrincipalBundle\Entity\D100tProdU1rd $d100fkProdU1rd
     */
    public function setD100fkProdU1rd(\Proyecto\PrincipalBundle\Entity\D100tProdU1rd $d100fkProdU1rd)
    {
        $this->d100fkProdU1rd = $d100fkProdU1rd;
    }

    /**
     * Get d100fkProdU1rd
     *
     * @return Proyecto\PrincipalBundle\Entity\D100tProdU1rd 
     */
    public function getD100fkProdU1rd()
    {
        return $this->d100fkProdU1rd;
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