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

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');

// Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_booking', JPATH_SITE);
$doc = JFactory::getDocument();
$doc->addScript(JUri::base() . '/media/com_booking/js/form.js');

$user    = JFactory::getUser();
$canEdit = BookingHelpersBooking::canUserEdit($this->item, $user);


?>

<div class="room-edit front-end-edit">
	<?php if (!$canEdit) : ?>
		<h3>
			<?php throw new Exception(JText::_('COM_BOOKING_ERROR_MESSAGE_NOT_AUTHORISED'), 403); ?>
		</h3>
	<?php else : ?>
		<?php if (!empty($this->item->id)): ?>
			<h1><?php echo JText::sprintf('COM_BOOKING_EDIT_ITEM_TITLE', $this->item->id); ?></h1>
		<?php else: ?>
			<h1><?php echo JText::_('COM_BOOKING_ADD_ITEM_TITLE'); ?></h1>
		<?php endif; ?>

		<form id="form-room"
			  action="<?php echo JRoute::_('index.php?option=com_booking&task=room.save'); ?>"
			  method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
			
	<input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>" />

	<input type="hidden" name="jform[ordering]" value="<?php echo $this->item->ordering; ?>" />

	<input type="hidden" name="jform[state]" value="<?php echo $this->item->state; ?>" />

	<input type="hidden" name="jform[checked_out]" value="<?php echo $this->item->checked_out; ?>" />

	<input type="hidden" name="jform[checked_out_time]" value="<?php echo $this->item->checked_out_time; ?>" />

				<?php echo $this->form->getInput('created_by'); ?>
				<?php echo $this->form->getInput('modified_by'); ?>
	<?php echo $this->form->renderField('image_room'); ?>

	<?php echo $this->form->renderField('room_name'); ?>

	<?php echo $this->form->renderField('number_room'); ?>

	<?php echo $this->form->renderField('desc'); ?>

	<?php echo $this->form->renderField('price'); ?>

	<?php echo $this->form->renderField('area'); ?>

	<?php echo $this->form->renderField('beds'); ?>

	<?php echo $this->form->renderField('is_extra_bed'); ?>

	<?php echo $this->form->renderField('utilities'); ?>

	<?php echo $this->form->renderField('language'); ?>

	<?php echo $this->form->renderField('alias'); ?>

			<div class="control-group">
				<div class="controls">

					<?php if ($this->canSave): ?>
						<button type="submit" class="validate btn btn-primary">
							<?php echo JText::_('JSUBMIT'); ?>
						</button>
					<?php endif; ?>
					<a class="btn"
					   href="<?php echo JRoute::_('index.php?option=com_booking&task=roomform.cancel'); ?>"
					   title="<?php echo JText::_('JCANCEL'); ?>">
						<?php echo JText::_('JCANCEL'); ?>
					</a>
				</div>
			</div>

			<input type="hidden" name="option" value="com_booking"/>
			<input type="hidden" name="task"
				   value="roomform.save"/>
			<?php echo JHtml::_('form.token'); ?>
		</form>
	<?php endif; ?>
</div>
