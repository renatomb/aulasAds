<?php
/**
 * Produto
 *
 * @version    1.0
 * @package    model
 * @subpackage admin
 * @author     Eu o Aluno
 * @copyright  Copyright (c) 2019 UnP. (http://www.unp.br)
 * @license    http://www.unp.br/
 */
class Produto extends TRecord
{
    const TABLENAME = 'produto';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'serial'; // {max, serial}
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nomeproduto');
        parent::addAttribute('qtdestoque');
        parent::addAttribute('estoqueminimo');
        parent::addAttribute('valorvenda');
    }
}
