<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Booking
 * @author     Thang Tran Trong <trantrongthang1207@gmail.com>
 * @copyright  2017  Thang Tran Trong
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.keepalive');

// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet(JUri::root() . 'media/com_booking/css/form.css');
?>
<script type="text/javascript">
	js = jQuery.noConflict();
	js(document).ready(function () {
		
	js('input:hidden.idroom').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('idroomhidden')){
			js('#jform_idroom option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_idroom").trigger("liszt:updated");
	js('input:hidden.parentroom').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('parentroomhidden')){
			js('#jform_parentroom option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_parentroom").trigger("liszt:updated");
	});

	Joomla.submitbutton = function (task) {
		if (task == 'order.cancel') {
			Joomla.submitform(task, document.getElementById('order-form'));
		}
		else {
			
			if (task != 'order.cancel' && document.formvalidator.isValid(document.id('order-form'))) {
				
				Joomla.submitform(task, document.getElementById('order-form'));
			}
			else {
				alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
			}
		}
	}
</script>

<form
	action="<?php echo JRoute::_('index.php?option=com_booking&layout=edit&id=' . (int) $this->item->id); ?>"
	method="post" enctype="multipart/form-data" name="adminForm" id="order-form" class="form-validate">

	<div class="form-horizontal">
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general', JText::_('COM_BOOKING_TITLE_ORDER', true)); ?>
		<div class="row-fluid">
			<div class="span10 form-horizontal">
				<fieldset class="adminform">

									<input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>" />
				<input type="hidden" name="jform[ordering]" value="<?php echo $this->item->ordering; ?>" />
				<input type="hidden" name="jform[state]" value="<?php echo $this->item->state; ?>" />
				<input type="hidden" name="jform[checked_out]" value="<?php echo $this->item->checked_out; ?>" />
				<input type="hidden" name="jform[checked_out_time]" value="<?php echo $this->item->checked_out_time; ?>" />

				<?php echo $this->form->renderField('created_by'); ?>
				<?php echo $this->form->renderField('modified_by'); ?>				<?php echo $this->form->renderField('start_date'); ?>
				<?php echo $this->form->renderField('end_date'); ?>
				<?php echo $this->form->renderField('number_room'); ?>
				<?php echo $this->form->renderField('number_persons'); ?>
				<?php echo $this->form->renderField('number_children'); ?>
				<?php echo $this->form->renderField('order_note'); ?>
				<?php echo $this->form->renderField('name_customer'); ?>
				<?php echo $this->form->renderField('phome'); ?>
				<?php echo $this->form->renderField('email'); ?>
				<?php echo $this->form->renderField('idroom'); ?>

			<?php
				foreach((array)$this->item->idroom as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="idroom" name="jform[idroomhidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>				<?php echo $this->form->renderField('total'); ?>
				<?php echo $this->form->renderField('parentroom'); ?>

			<?php
				foreach((array)$this->item->parentroom as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="parentroom" name="jform[parentroomhidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>

					<?php if ($this->state->params->get('save_history', 1)) : ?>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('version_note'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('version_note'); ?></div>
					</div>
					<?php endif; ?>
				</fieldset>
			</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>

		

		<?php echo JHtml::_('bootstrap.endTabSet'); ?>

		<input type="hidden" name="task" value=""/>
		<?php echo JHtml::_('form.token'); ?>

	</div>
</form>
