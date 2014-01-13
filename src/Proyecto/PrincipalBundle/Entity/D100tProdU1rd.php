<?php

namespace Proyecto\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proyecto\PrincipalBundle\Entity\D100tProdU1rd
 *
 * @ORM\Table(name="d100t_prod_u1rd")
 * @ORM\Entity
 */
class D100tProdU1rd
{
    /**
     * @var integer $d100pkProdU1rd
     *
     * @ORM\Column(name="d100pk_prod_u1rd", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $d100pkProdU1rd;

    /**
     * @var datetime $feFecha
     *
     * @ORM\Column(name="fe_fecha", type="datetime", nullable=false)
     */
    private $feFecha;

    /**
     * @var float $nuExistenciainiciallavada
     *
     * @ORM\Column(name="nu_existenciainiciallavada", type="float", nullable=false)
     */
    private $nuExistenciainiciallavada;

    /**
     * @var float $nuExistenciainicialnolavada
     *
     * @ORM\Column(name="nu_existenciainicialnolavada", type="float", nullable=false)
     */
    private $nuExistenciainicialnolavada;

    /**
     * @var float $nuExistenciainicialapiladaenlaguna
     *
     * @ORM\Column(name="nu_existenciainicialapiladaenlaguna", type="float", nullable=false)
     */
    private $nuExistenciainicialapiladaenlaguna;

    /**
     * @var text $txObservacion
     *
     * @ORM\Column(name="tx_observacion", type="text", nullable=true)
     */
    private $txObservacion;

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
     * Get d100pkProdU1rd
     *
     * @return integer 
     */
    public function getD100pkProdU1rd()
    {
        return $this->d100pkProdU1rd;
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
     * Set nuExistenciainiciallavada
     *
     * @param float $nuExistenciainiciallavada
     */
    public function setNuExistenciainiciallavada($nuExistenciainiciallavada)
    {
        $this->nuExistenciainiciallavada = $nuExistenciainiciallavada;
    }

    /**
     * Get nuExistenciainiciallavada
     *
     * @return float 
     */
    public function getNuExistenciainiciallavada()
    {
        return $this->nuExistenciainiciallavada;
    }

    /**
     * Set nuExistenciainicialnolavada
     *
     * @param float $nuExistenciainicialnolavada
     */
    public function setNuExistenciainicialnolavada($nuExistenciainicialnolavada)
    {
        $this->nuExistenciainicialnolavada = $nuExistenciainicialnolavada;
    }

    /**
     * Get nuExistenciainicialnolavada
     *
     * @return float 
     */
    public function getNuExistenciainicialnolavada()
    {
        return $this->nuExistenciainicialnolavada;
    }

    /**
     * Set nuExistenciainicialapiladaenlaguna
     *
     * @param float $nuExistenciainicialapiladaenlaguna
     */
    public function setNuExistenciainicialapiladaenlaguna($nuExistenciainicialapiladaenlaguna)
    {
        $this->nuExistenciainicialapiladaenlaguna = $nuExistenciainicialapiladaenlaguna;
    }

    /**
     * Get nuExistenciainicialapiladaenlaguna
     *
     * @return float 
     */
    public function getNuExistenciainicialapiladaenlaguna()
    {
        return $this->nuExistenciainicialapiladaenlaguna;
    }

    /**
     * Set txObservacion
     *
     * @param text $txObservacion
     */
    public function setTxObservacion($txObservacion)
    {
        $this->txObservacion = $txObservacion;
    }

    /**
     * Get txObservacion
     *
     * @return text 
     */
    public function getTxObservacion()
    {
        return $this->txObservacion;
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