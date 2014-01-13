<?php

namespace Proyecto\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proyecto\PrincipalBundle\Entity\D101tProdU1rd
 *
 * @ORM\Table(name="d101t_prod_u1rd")
 * @ORM\Entity
 */
class D101tProdU1rd
{
    /**
     * @var integer $d101pkProdU1rd
     *
     * @ORM\Column(name="d101pk_prod_u1rd", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $d101pkProdU1rd;

    /**
     * @var float $nuSalapiladaenlaguna
     *
     * @ORM\Column(name="nu_salapiladaenlaguna", type="float", nullable=false)
     */
    private $nuSalapiladaenlaguna;

    /**
     * @var float $nuSalbajadaallavadero
     *
     * @ORM\Column(name="nu_salbajadaallavadero", type="float", nullable=false)
     */
    private $nuSalbajadaallavadero;

    /**
     * @var float $nuSallavada
     *
     * @ORM\Column(name="nu_sallavada", type="float", nullable=false)
     */
    private $nuSallavada;

    /**
     * @var float $nuSaldepositadaenpatiolavadero
     *
     * @ORM\Column(name="nu_saldepositadaenpatiolavadero", type="float", nullable=false)
     */
    private $nuSaldepositadaenpatiolavadero;

    /**
     * @var float $nuSallavadadelpatio
     *
     * @ORM\Column(name="nu_sallavadadelpatio", type="float", nullable=false)
     */
    private $nuSallavadadelpatio;

    /**
     * @var float $nuSalnetalavada
     *
     * @ORM\Column(name="nu_salnetalavada", type="float", nullable=false)
     */
    private $nuSalnetalavada;

    /**
     * @var float $nuAcumuladaenpatiolavada
     *
     * @ORM\Column(name="nu_acumuladaenpatiolavada", type="float", nullable=false)
     */
    private $nuAcumuladaenpatiolavada;

    /**
     * @var float $nuAcumuladaenpationolavada
     *
     * @ORM\Column(name="nu_acumuladaenpationolavada", type="float", nullable=false)
     */
    private $nuAcumuladaenpationolavada;

    /**
     * @var text $txUnidades
     *
     * @ORM\Column(name="tx_unidades", type="text", nullable=false)
     */
    private $txUnidades;

    /**
     * @var text $txClientes
     *
     * @ORM\Column(name="tx_clientes", type="text", nullable=false)
     */
    private $txClientes;

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
     * Get d101pkProdU1rd
     *
     * @return integer 
     */
    public function getD101pkProdU1rd()
    {
        return $this->d101pkProdU1rd;
    }

    /**
     * Set nuSalapiladaenlaguna
     *
     * @param float $nuSalapiladaenlaguna
     */
    public function setNuSalapiladaenlaguna($nuSalapiladaenlaguna)
    {
        $this->nuSalapiladaenlaguna = $nuSalapiladaenlaguna;
    }

    /**
     * Get nuSalapiladaenlaguna
     *
     * @return float 
     */
    public function getNuSalapiladaenlaguna()
    {
        return $this->nuSalapiladaenlaguna;
    }

    /**
     * Set nuSalbajadaallavadero
     *
     * @param float $nuSalbajadaallavadero
     */
    public function setNuSalbajadaallavadero($nuSalbajadaallavadero)
    {
        $this->nuSalbajadaallavadero = $nuSalbajadaallavadero;
    }

    /**
     * Get nuSalbajadaallavadero
     *
     * @return float 
     */
    public function getNuSalbajadaallavadero()
    {
        return $this->nuSalbajadaallavadero;
    }

    /**
     * Set nuSallavada
     *
     * @param float $nuSallavada
     */
    public function setNuSallavada($nuSallavada)
    {
        $this->nuSallavada = $nuSallavada;
    }

    /**
     * Get nuSallavada
     *
     * @return float 
     */
    public function getNuSallavada()
    {
        return $this->nuSallavada;
    }

    /**
     * Set nuSaldepositadaenpatiolavadero
     *
     * @param float $nuSaldepositadaenpatiolavadero
     */
    public function setNuSaldepositadaenpatiolavadero($nuSaldepositadaenpatiolavadero)
    {
        $this->nuSaldepositadaenpatiolavadero = $nuSaldepositadaenpatiolavadero;
    }

    /**
     * Get nuSaldepositadaenpatiolavadero
     *
     * @return float 
     */
    public function getNuSaldepositadaenpatiolavadero()
    {
        return $this->nuSaldepositadaenpatiolavadero;
    }

    /**
     * Set nuSallavadadelpatio
     *
     * @param float $nuSallavadadelpatio
     */
    public function setNuSallavadadelpatio($nuSallavadadelpatio)
    {
        $this->nuSallavadadelpatio = $nuSallavadadelpatio;
    }

    /**
     * Get nuSallavadadelpatio
     *
     * @return float 
     */
    public function getNuSallavadadelpatio()
    {
        return $this->nuSallavadadelpatio;
    }

    /**
     * Set nuSalnetalavada
     *
     * @param float $nuSalnetalavada
     */
    public function setNuSalnetalavada($nuSalnetalavada)
    {
        $this->nuSalnetalavada = $nuSalnetalavada;
    }

    /**
     * Get nuSalnetalavada
     *
     * @return float 
     */
    public function getNuSalnetalavada()
    {
        return $this->nuSalnetalavada;
    }

    /**
     * Set nuAcumuladaenpatiolavada
     *
     * @param float $nuAcumuladaenpatiolavada
     */
    public function setNuAcumuladaenpatiolavada($nuAcumuladaenpatiolavada)
    {
        $this->nuAcumuladaenpatiolavada = $nuAcumuladaenpatiolavada;
    }

    /**
     * Get nuAcumuladaenpatiolavada
     *
     * @return float 
     */
    public function getNuAcumuladaenpatiolavada()
    {
        return $this->nuAcumuladaenpatiolavada;
    }

    /**
     * Set nuAcumuladaenpationolavada
     *
     * @param float $nuAcumuladaenpationolavada
     */
    public function setNuAcumuladaenpationolavada($nuAcumuladaenpationolavada)
    {
        $this->nuAcumuladaenpationolavada = $nuAcumuladaenpationolavada;
    }

    /**
     * Get nuAcumuladaenpationolavada
     *
     * @return float 
     */
    public function getNuAcumuladaenpationolavada()
    {
        return $this->nuAcumuladaenpationolavada;
    }

    /**
     * Set txUnidades
     *
     * @param text $txUnidades
     */
    public function setTxUnidades($txUnidades)
    {
        $this->txUnidades = $txUnidades;
    }

    /**
     * Get txUnidades
     *
     * @return text 
     */
    public function getTxUnidades()
    {
        return $this->txUnidades;
    }

    /**
     * Set txClientes
     *
     * @param text $txClientes
     */
    public function setTxClientes($txClientes)
    {
        $this->txClientes = $txClientes;
    }

    /**
     * Get txClientes
     *
     * @return text 
     */
    public function getTxClientes()
    {
        return $this->txClientes;
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