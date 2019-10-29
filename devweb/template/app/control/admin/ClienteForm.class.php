<?php
/**
 * ClienteForm
 *
 * @version    1.0
 * @package    control
 * @subpackage admin
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
class ClienteForm extends TStandardForm
{
    protected $form; // form
    
    /**
     * Class constructor
     * Creates the page and the registration form
     */
    function __construct()
    {
        parent::__construct();
        
        $this->setDatabase('adianti');              // defines the database
        $this->setActiveRecord('Cliente');     // defines the active record
        
        // creates the form
        $this->form = new BootstrapFormBuilder('form_Cliente');
        $this->form->setFormTitle(_t('Cliente'));
        
        // create the form fields
        $id = new TEntry('id');
        $nome = new TEntry('nome');
        $dtnascimento = new TDate('datanascimento');
        
        // add the fields
        $this->form->addFields( [new TLabel('Id')], [$id] );
        $this->form->addFields( [new TLabel(_t('Name'))], [$nome] );
        $this->form->addFields( [new TLabel('dt Nascimento')], [$dtnascimento] );
        $id->setEditable(FALSE);
        $id->setSize('30%');
        $nome->setSize('70%');
        $nome->addValidation( _t('Name'), new TRequiredValidator );
        $dtnascimento->addValidation('dt Nascimento', new TRequiredValidator );
        
        // create the form actions
        $btn = $this->form->addAction(_t('Save'), new TAction(array($this, 'onSave')), 'fa:floppy-o');
        $btn->class = 'btn btn-sm btn-primary';
        $this->form->addAction(_t('Clear'),  new TAction(array($this, 'onEdit')), 'fa:eraser red');
        $this->form->addAction(_t('Back'),new TAction(array('ClienteList','onReload')),'fa:arrow-circle-o-left blue');
        
        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 90%';
        $container->add(new TXMLBreadCrumb('menu.xml', 'SystemUnitList'));
        $container->add($this->form);
        
        parent::add($container);
    }
}
