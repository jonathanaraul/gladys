<?php

namespace Proyecto\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proyecto\PrincipalBundle\Entity\D100tVenInfocliente
 *
 * @ORM\Table(name="d100t_ven_infocliente")
 * @ORM\Entity
 */
class D100tVenInfocliente
{
    /**
     * @var integer $d100pkVenInfocliente
     *
     * @ORM\Column(name="d100pk_ven_infocliente", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $d100pkVenInfocliente;

    /**
     * @var text $txNombre
     *
     * @ORM\Column(name="tx_nombre", type="text", nullable=false)
     */
    private $txNombre;

    /**
     * @var text $txRepresentantelegaldelaempresa
     *
     * @ORM\Column(name="tx_representantelegaldelaempresa", type="text", nullable=false)
     */
    private $txRepresentantelegaldelaempresa;

    /**
     * @var text $txRif
     *
     * @ORM\Column(name="tx_rif", type="text", nullable=false)
     */
    private $txRif;

    /**
     * @var text $txDireccionfiscal
     *
     * @ORM\Column(name="tx_direccionfiscal", type="text", nullable=false)
     */
    private $txDireccionfiscal;

    /**
     * @var text $txTelefono
     *
     * @ORM\Column(name="tx_telefono", type="text", nullable=false)
     */
    private $txTelefono;

    /**
     * @var text $txCodigosada
     *
     * @ORM\Column(name="tx_codigosada", type="text", nullable=false)
     */
    private $txCodigosada;

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
     * Get d100pkVenInfocliente
     *
     * @return integer 
     */
    public function getD100pkVenInfocliente()
    {
        return $this->d100pkVenInfocliente;
    }

    /**
     * Set txNombre
     *
     * @param text $txNombre
     */
    public function setTxNombre($txNombre)
    {
        $this->txNombre = $txNombre;
    }

    /**
     * Get txNombre
     *
     * @return text 
     */
    public function getTxNombre()
    {
        return $this->txNombre;
    }

    /**
     * Set txRepresentantelegaldelaempresa
     *
     * @param text $txRepresentantelegaldelaempresa
     */
    public function setTxRepresentantelegaldelaempresa($txRepresentantelegaldelaempresa)
    {
        $this->txRepresentantelegaldelaempresa = $txRepresentantelegaldelaempresa;
    }

    /**
     * Get txRepresentantelegaldelaempresa
     *
     * @return text 
     */
    public function getTxRepresentantelegaldelaempresa()
    {
        return $this->txRepresentantelegaldelaempresa;
    }

    /**
     * Set txRif
     *
     * @param text $txRif
     */
    public function setTxRif($txRif)
    {
        $this->txRif = $txRif;
    }

    /**
     * Get txRif
     *
     * @return text 
     */
    public function getTxRif()
    {
        return $this->txRif;
    }

    /**
     * Set txDireccionfiscal
     *
     * @param text $txDireccionfiscal
     */
    public function setTxDireccionfiscal($txDireccionfiscal)
    {
        $this->txDireccionfiscal = $txDireccionfiscal;
    }

    /**
     * Get txDireccionfiscal
     *
     * @return text 
     */
    public function getTxDireccionfiscal()
    {
        return $this->txDireccionfiscal;
    }

    /**
     * Set txTelefono
     *
     * @param text $txTelefono
     */
    public function setTxTelefono($txTelefono)
    {
        $this->txTelefono = $txTelefono;
    }

    /**
     * Get txTelefono
     *
     * @return text 
     */
    public function getTxTelefono()
    {
        return $this->txTelefono;
    }

    /**
     * Set txCodigosada
     *
     * @param text $txCodigosada
     */
    public function setTxCodigosada($txCodigosada)
    {
        $this->txCodigosada = $txCodigosada;
    }

    /**
     * Get txCodigosada
     *
     * @return text 
     */
    public function getTxCodigosada()
    {
        return $this->txCodigosada;
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