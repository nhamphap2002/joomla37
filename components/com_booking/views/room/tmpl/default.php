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

$canEdit = JFactory::getUser()->authorise('core.edit', 'com_booking');

if (!$canEdit && JFactory::getUser()->authorise('core.edit.own', 'com_booking'))
{
	$canEdit = JFactory::getUser()->id == $this->item->created_by;
}
?>

<div class="item_fields">

	<table class="table">
		

		<tr>
			<th><?php echo JText::_('COM_BOOKING_FORM_LBL_ROOM_IMAGE_ROOM'); ?></th>
			<td><?php echo $this->item->image_room; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_BOOKING_FORM_LBL_ROOM_ROOM_NAME'); ?></th>
			<td><?php echo $this->item->room_name; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_BOOKING_FORM_LBL_ROOM_NUMBER_ROOM'); ?></th>
			<td><?php echo $this->item->number_room; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_BOOKING_FORM_LBL_ROOM_DESC'); ?></th>
			<td><?php echo $this->item->desc; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_BOOKING_FORM_LBL_ROOM_PRICE'); ?></th>
			<td><?php echo $this->item->price; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_BOOKING_FORM_LBL_ROOM_AREA'); ?></th>
			<td><?php echo $this->item->area; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_BOOKING_FORM_LBL_ROOM_BEDS'); ?></th>
			<td><?php echo $this->item->beds; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_BOOKING_FORM_LBL_ROOM_IS_EXTRA_BED'); ?></th>
			<td><?php echo $this->item->is_extra_bed; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_BOOKING_FORM_LBL_ROOM_UTILITIES'); ?></th>
			<td><?php echo $this->item->utilities; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_BOOKING_FORM_LBL_ROOM_LANGUAGE'); ?></th>
			<td><?php echo $this->item->language; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_BOOKING_FORM_LBL_ROOM_ALIAS'); ?></th>
			<td><?php echo $this->item->alias; ?></td>
		</tr>

	</table>

</div>

<?php if($canEdit && $this->item->checked_out == 0): ?>

	<a class="btn" href="<?php echo JRoute::_('index.php?option=com_booking&task=room.edit&id='.$this->item->id); ?>"><?php echo JText::_("COM_BOOKING_EDIT_ITEM"); ?></a>

<?php endif; ?>

<?php if (JFactory::getUser()->authorise('core.delete','com_booking.room.'.$this->item->id)) : ?>

	<a class="btn btn-danger" href="#deleteModal" role="button" data-toggle="modal">
		<?php echo JText::_("COM_BOOKING_DELETE_ITEM"); ?>
	</a>

	<div id="deleteModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h3><?php echo JText::_('COM_BOOKING_DELETE_ITEM'); ?></h3>
		</div>
		<div class="modal-body">
			<p><?php echo JText::sprintf('COM_BOOKING_DELETE_CONFIRM', $this->item->id); ?></p>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">Close</button>
			<a href="<?php echo JRoute::_('index.php?option=com_booking&task=room.remove&id=' . $this->item->id, false, 2); ?>" class="btn btn-danger">
				<?php echo JText::_('COM_BOOKING_DELETE_ITEM'); ?>
			</a>
		</div>
	</div>

<?php endif; ?>