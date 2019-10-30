<?php

/**
 * ProdutoForm
 *
 * @version    1.0
 * @package    cadastro
 * @author     Eu e o aluno
 * @copyright  Copyright (c) 2006 UnP (http://www.unp.br)
 * @license    http://www.unp.br
 */
class ProdutoForm extends TPage {

    private $form; // form

    /**
     * Class constructor
     * Creates the page and the registration form
     */

    function __construct() {
        parent::__construct();

        // creates the form
        $this->form = new BootstrapFormBuilder('form_Produto');
        $this->form->setFormTitle('Produto');

        // create the form fields
        $code = new TEntry('id');
        $name = new TEntry('nomeproduto');
        $qtdestoque = new TEntry('qtdestoque');
        $valorvenda = new TEntry('valorvenda');

        // define some properties for the form fields
        $code->setEditable(FALSE);
        $code->setSize('30%');

        $this->form->appendPage('Dados');
        $this->form->addFields([new TLabel('Code')], [$code]);
        $this->form->addFields([new TLabel('Nome')], [$name]);

        $this->form->addFields([new TLabel('Qtd Estoque')], [$qtdestoque]);
        $this->form->addFields([new TLabel('Valor Venda')], [$valorvenda]);


        $this->form->addAction('Salvar', new TAction([$this, 'onSave']), 'fa:save green');
        $this->form->addAction('Limpar', new TAction([$this, 'onClear']), 'fa:eraser red');
        $this->form->addActionLink('Listar', new TAction(['ProdutoList', 'onReload']), 'fa:table blue');

        // wrap the page content
        $vbox = new TVBox;
        $vbox->style = 'width: 100%';
        $vbox->add(new TXMLBreadCrumb('menu.xml', 'ProdutoList'));
        $vbox->add($this->form);

        // add the form inside the page
        parent::add($vbox);
    }

    /**
     * method onSave
     * Executed whenever the user clicks at the save button
     */
    public static function onSave($param) {
        try {
            // open a transaction with database 'nossobanco'
            TTransaction::open('nossobanco');

            if (empty($param['nomeproduto'])) {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', 'Nome Produto'));
            }

            // read the form data and instantiates an Active Record
            $cadastro = new Produto;
            $cadastro->fromArray($param);

            // stores the object in the database
            $cadastro->store();

            $data = new stdClass;
            $data->id = $cadastro->id;
            TForm::sendData('form_Produto', $data);

            // shows the success message
            new TMessage('info', 'Record saved');

            TTransaction::close(); // close the transaction
        } catch (Exception $e) {
            new TMessage('error', $e->getMessage());
            TTransaction::rollback();
        }
    }

    /**
     * method onEdit
     * Edit a record data
     */
    function onEdit($param) {
        try {
            if (isset($param['id'])) {
                // open a transaction with database 'samples'
                TTransaction::open('nossobanco');

                // load the Active Record according to its ID
                $cadastro = new Produto($param['id']);

                // fill the form with the active record data
                $this->form->setData($cadastro);

                // close the transaction
                TTransaction::close();
            } else {
                $this->onClear($param);
            }
        } catch (Exception $e) { // in case of exception
            // shows the exception error message
            new TMessage('error', $e->getMessage());

            // undo all pending operations
            TTransaction::rollback();
        }
    }

    /**
     * Clear form
     */
    public function onClear($param) {
        $this->form->clear();
    }

}
