<?php

/**
 * ClienteForm
 *
 * @version    1.0
 * @package    cadastro
 * @author     Eu e o aluno
 * @copyright  Copyright (c) 2006 UnP (http://www.unp.br)
 * @license    http://www.unp.br
 */
class ClienteForm extends TPage {

    private $form; // form

    /**
     * Class constructor
     * Creates the page and the registration form
     */

    function __construct() {
        parent::__construct();

        // creates the form
        $this->form = new BootstrapFormBuilder('form_Cliente');
        $this->form->setFormTitle('Cliente');

        // create the form fields
        $code = new TEntry('id');
        $name = new TEntry('nomecliente');

        $tipocliente_id = new TDBCombo('tipocliente_id', 'nossobanco', 'TipoCliente', 'id', 'nometipo');
        $dtnasc = new TDate('dtnasc');
        $cpf = new TEntry('cpf');
        $endereco = new TEntry('endereco');
        $bairro = new TEntry('bairro');
        $cidade = new TEntry('cidade');
        $tel = new TEntry('tel');
        $cep = new TEntry('cep');
        $cel = new TEntry('cel');
        $email = new TEntry('email');
        $sexo = new TCombo('sexo');
        $limite = new TEntry('limite');

        $dtnasc->setMask('dd/mm/yyyy');
        $dtnasc->setOption('startDate', '01/01/2019');
        $dtnasc->setOption('autoclose', TRUE);
        //$dtnasc->setOption('daysOfWeekDisabled');



        $cpf->setMask('999.999.999-99');

        $itemsexo = ['Masculino' => 'Masculino', 'Feminino' => 'Feminino'];
        $sexo->addItems($itemsexo);

        $sexo->setDefaultOption(FALSE);
        // $sexo->setValue('Feminino');
        // define some properties for the form fields
        $code->setEditable(FALSE);
        $code->setSize('30%');

        $this->form->appendPage('Dados');
        $this->form->addFields([new TLabel('Code')], [$code]);
        $this->form->addFields([new TLabel('Nome')], [$name]);

        $this->form->addFields([new TLabel('Tipo Cliente')], [$tipocliente_id]);
        $this->form->addFields([new TLabel('Dt Nasc')], [$dtnasc]);
        $this->form->addFields([new TLabel('CPF')], [$cpf]);
        $this->form->addFields([new TLabel('Endereço')], [$endereco]);
        $this->form->addFields([new TLabel('Bairro')], [$bairro]);
        $this->form->addFields([new TLabel('Cidade')], [$cidade]);
        $this->form->addFields([new TLabel('CEP')], [$cep]);
        $this->form->addFields([new TLabel('Tel')], [$tel]);
        $this->form->addFields([new TLabel('Cel')], [$cel]);
        $this->form->addFields([new TLabel('E-Mail')], [$email]);
        $this->form->addFields([new TLabel('Sexo')], [$sexo]);
        $this->form->addFields([new TLabel('Limite')], [$limite]);


        $this->form->addAction('Salvar', new TAction([$this, 'onSave']), 'fa:save green');
        $this->form->addAction('Limpar', new TAction([$this, 'onClear']), 'fa:eraser red');
        $this->form->addActionLink('Listar', new TAction(['ClienteList', 'onReload']), 'fa:table blue');

        // wrap the page content
        $vbox = new TVBox;
        $vbox->style = 'width: 100%';
        $vbox->add(new TXMLBreadCrumb('menu.xml', 'ClienteList'));
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

            if (empty($param['nomecliente'])) {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', 'Nome'));
            }

            // read the form data and instantiates an Active Record
            $cadastro = new Cliente;
            $cadastro->fromArray($param);

            // stores the object in the database
            $cadastro->store();

            $data = new stdClass;
            $data->id = $cadastro->id;
            TForm::sendData('form_Cliente', $data);

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
                $cadastro = new Cliente($param['id']);

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
