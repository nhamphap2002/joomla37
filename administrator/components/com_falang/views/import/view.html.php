<?php
/**
 * @package     Joomla.administrator
 * @subpackage  Component.falang
 *
 * @copyright   Copyright (C) 2016 Faboba. All rights reserved.
 * @license     GNU General Public License http://www.gnu.org/copyleft/gpl.html
 * @author     Stéphane Bouey <stephane.bouey@faboba.com>
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');
JLoader::import( 'views.default.view',FALANG_ADMINPATH);

class ImportViewImport extends FalangViewDefault
{
    protected $form;


    function display($tpl = null)
    {
        $document = JFactory::getDocument();
        $document->setTitle(JText::_('COM_FALANG_TITLE') . ' :: ' . JText::_('COM_FALANG_TITLE_IMPORT'));

        $this->addToolbar();

        $this->form = $this->get('Form');

        parent::display($tpl);
    }

    protected function addToolbar()
    {
        JFactory::getApplication()->input->set('hidemainmenu', true);

        // set page title
        JToolBarHelper::title( JText::_( 'COM_FALANG_TITLE_IMPORT' ), 'falang-import');


        //add toolbar actions
        JToolBarHelper::cancel('import.cancel','JTOOLBAR_CANCEL');

    }
}