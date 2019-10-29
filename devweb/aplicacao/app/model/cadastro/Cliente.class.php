<?php
/**
 * Cliente
 *
 * @version    1.0
 * @package    model
 * @subpackage admin
 * @author     Eu o Aluno
 * @copyright  Copyright (c) 2019 UnP. (http://www.unp.br)
 * @license    http://www.unp.br/
 */
class Cliente extends TRecord
{
    const TABLENAME = 'cliente';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'serial'; // {max, serial}
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nomecliente');
        parent::addAttribute('tipocliente_id');
        parent::addAttribute('dtnasc');
        parent::addAttribute('cpf');
        parent::addAttribute('endereco');
        parent::addAttribute('bairro');
        parent::addAttribute('cidade');
        parent::addAttribute('cep');
        parent::addAttribute('tel');
        parent::addAttribute('cel');
        parent::addAttribute('email');
        parent::addAttribute('sexo');
        parent::addAttribute('limite');
    }
}
