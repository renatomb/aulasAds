<?php
/**
 * TipoClienteList
 *
 * @version    1.0
 * @package    cadastro
 * @author     Eu e o aluno
 * @copyright  Copyright (c) 2006 UnP (http://www.unp.br)
 * @license    http://www.unp.br
 */
class TipoClienteList extends TPage
{
    private $form;      // search form
    private $datagrid;  // listing
    private $pageNavigation;
    private $loaded;
    
    /**
     * Class constructor
     * Creates the page, the search form and the listing
     */
    public function __construct()
    {
        parent::__construct();
        
        // creates the form
        $this->form = new BootstrapFormBuilder('form_search_tipocliente');
        $this->form->setFormTitle('Lista Tipos de Cliente');
        
        // create the form fields
        $name      = new TEntry('nometipo');
        
        $this->form->addFields( [new TLabel('Nome Tipo Cliente')], [$name] );
        
        $name->setValue(TSession::getValue('tipocliente_nome'));
        
        $this->form->addAction( 'Buscar', new TAction([$this, 'onSearch']), 'fa:search blue' );
        $this->form->addAction( 'CSV',  new TAction([$this, 'onExportCSV']), 'fa:table' );
        $this->form->addActionLink( 'Novo',  new TAction(['TipoClienteForm', 'onEdit']), 'fa:plus green' );
        
        // creates a DataGrid
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
        
        // creates the datagrid columns
        $col_id      = new TDataGridColumn('id', 'Id', 'center', '10%');
        $col_name    = new TDataGridColumn('nometipo', 'Nome', 'left', '80%');
        
        $col_id->setAction(new TAction([$this, 'onReload']), ['order' => 'id']);
        $col_name->setAction(new TAction([$this, 'onReload']), ['order' => 'nometipo']);
        
        $this->datagrid->addColumn($col_id);
        $this->datagrid->addColumn($col_name);
        
        // creates two datagrid actions
        $action1 = new TDataGridAction(['TipoClienteForm', 'onEdit']);
        $action1->setLabel('Alterar');
        $action1->setImage('fa:edit blue');
        $action1->setField('id');
        
        $action2 = new TDataGridAction([$this, 'onDelete']);
        $action2->setLabel('Delete');
        $action2->setImage('fa:trash red');
        $action2->setField('id');
        
        // add the actions to the datagrid
        $this->datagrid->addAction($action1);
        $this->datagrid->addAction($action2);
        
        // create the datagrid model
        $this->datagrid->createModel();
        
        // creates the page navigation
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->setAction(new TAction([$this, 'onReload']));
        $this->pageNavigation->setWidth($this->datagrid->getWidth());
        
        // creates the page structure using a vertical box
        $vbox = new TVBox;
        $vbox->style = 'width: 100%';
        $vbox->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $vbox->add($this->form);
        $vbox->add(TPanelGroup::pack('', $this->datagrid, $this->pageNavigation));
        
        // add the box inside the page
        parent::add($vbox);
    }
    
    /**
     * method onSearch()
     * Register the filter in the session when the user performs a search
     */
    function onSearch()
    {
        // get the search form data
        $data = $this->form->getData();
        
        // check if the user has filled the form
        if (isset($data->nometipo) AND ($data->nometipo))
        {
            // creates a filter using what the user has typed
            $filter = new TFilter('nometipo', 'like', "{$data->name}%");
            
            // stores the filter in the session
            TSession::setValue('tipocliente_filter1', $filter);
            TSession::setValue('tipocliente_nome',   $data->name);
        }
        else
        {
            TSession::setValue('tipocliente_filter1', NULL);
            TSession::setValue('tipocliente_nome',   '');
        }
        
        // fill the form with data again
        $this->form->setData($data);
        
        $param = [];
        $param['offset']    =0;
        $param['first_page']=1;
        $this->onReload($param);
    }
    
    /**
     * method onReload()
     * Load the datagrid with the database objects
     */
    function onReload($param = NULL)
    {
        try
        {
            // open a transaction with database 'nossobanco'
            TTransaction::open('nossobanco');
            
            // creates a repository for TipoCliente
            $repository = new TRepository('TipoCliente');
            $limit = 10;
            
            // creates a criteria
            $criteria = new TCriteria;
            
            $newparam = $param; // define new parameters
            
            // default order
            if (empty($newparam['order']))
            {
                $newparam['order'] = 'id';
                $newparam['direction'] = 'asc';
            }
            
            $criteria->setProperties($newparam); // order, offset
            $criteria->setProperty('limit', $limit);
            
            if (TSession::getValue('tipocliente_filter1'))
            {
                // add the filter stored in the session to the criteria
                $criteria->add(TSession::getValue('tipocliente_filter1'));
            }
            
            // load the objects according to criteria
            $dados = $repository->load($criteria, FALSE);
            $this->datagrid->clear();
            if ($dados)
            {
                foreach ($dados as $dado)
                {
                    // add the object inside the datagrid
                    $this->datagrid->addItem($dado);
                }
            }
            
            // reset the criteria for record count
            $criteria->resetProperties();
            $count= $repository->count($criteria);
            
            $this->pageNavigation->setCount($count); // count of records
            $this->pageNavigation->setProperties($param); // order, page
            $this->pageNavigation->setLimit($limit); // limit
            $this->pageNavigation->enableCounters();
            
            // close the transaction
            TTransaction::close();
            $this->loaded = true;
        }
        catch (Exception $e) // in case of exception
        {
            // shows the exception error message
            new TMessage('error', $e->getMessage());
            
            // undo all pending operations
            TTransaction::rollback();
        }
    }
    
    /**
     * Export to CSV
     */
    function onExportCSV()
    {
        $this->onSearch();

        try
        {
            // open a transaction with database 'samples'
            TTransaction::open('nossobanco');
            
            // creates a repository for TipoCliente
            $repository = new TRepository('TipoCliente');
            
            // creates a criteria
            $criteria = new TCriteria;
            
            if (TSession::getValue('tipocliente_filter1'))
            {
                // add the filter stored in the session to the criteria
                $criteria->add(TSession::getValue('customer_filter1'));
            }
            
            $csv = '';
            $csv .= 'id;nometipo'."\n";
            // load the objects according to criteria
            $dados = $repository->load($criteria, false);
            if ($dados)
            {
                foreach ($dados as $dado)
                {
                    $csv .= $dado->id.';'.
                            $dado->nometipo."\n";
                }
                file_put_contents('app/output/tipocliente.csv', $csv);
                TPage::openFile('app/output/tipocliente.csv');
            }
            // close the transaction
            TTransaction::close();
        }
        catch (Exception $e) // in case of exception
        {
            // shows the exception error message
            new TMessage('error', $e->getMessage());
            
            // undo all pending operations
            TTransaction::rollback();
        }

    }
    
    /**
     * Ask before deletion
     */
    public static function onDelete($param)
    {
        // define the delete action
        $action = new TAction([__CLASS__, 'Delete']);
        $action->setParameters($param); // pass the key parameter ahead
        
        // shows a dialog to the user
        new TQuestion(AdiantiCoreTranslator::translate('Do you really want to delete ?'), $action);
    }
    
    /**
     * Delete a record
     */
    public static function Delete($param)
    {
        try
        {
            $key=$param['key']; // get the parameter $key
            TTransaction::open('nossobanco'); // open a transaction with database
            $object = new TipoCliente($key, FALSE); // instantiates the Active Record
            $object->delete(); // deletes the object from the database
            TTransaction::close(); // close the transaction
            
            $pos_action = new TAction([__CLASS__, 'onReload']);
            new TMessage('info', AdiantiCoreTranslator::translate('Record deleted'), $pos_action); // success message
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }
    
    
    /**
     * method show()
     * Shows the page
     */
    function show()
    {
        // check if the datagrid is already loaded
        if (!$this->loaded)
        {
            $this->onReload( func_get_arg(0) );
        }
        parent::show();
    }
}