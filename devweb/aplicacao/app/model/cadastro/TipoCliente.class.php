<?php
/**
 * TipoCliente
 *
 * @version    1.0
 * @package    model
 * @subpackage admin
 * @author     Eu o Aluno
 * @copyright  Copyright (c) 2019 UnP. (http://www.unp.br)
 * @license    http://www.unp.br/
 */
class TipoCliente extends TRecord
{
    const TABLENAME = 'tipocliente';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'serial'; // {max, serial}
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nometipo');
    }
}
