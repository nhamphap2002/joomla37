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
			<th><?php echo JText::_('COM_BOOKING_FORM_LBL_ORDER_START_DATE'); ?></th>
			<td><?php echo $this->item->start_date; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_BOOKING_FORM_LBL_ORDER_END_DATE'); ?></th>
			<td><?php echo $this->item->end_date; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_BOOKING_FORM_LBL_ORDER_NUMBER_ROOM'); ?></th>
			<td><?php echo $this->item->number_room; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_BOOKING_FORM_LBL_ORDER_NUMBER_PERSONS'); ?></th>
			<td><?php echo $this->item->number_persons; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_BOOKING_FORM_LBL_ORDER_NUMBER_CHILDREN'); ?></th>
			<td><?php echo $this->item->number_children; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_BOOKING_FORM_LBL_ORDER_ORDER_NOTE'); ?></th>
			<td><?php echo nl2br($this->item->order_note); ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_BOOKING_FORM_LBL_ORDER_NAME_CUSTOMER'); ?></th>
			<td><?php echo $this->item->name_customer; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_BOOKING_FORM_LBL_ORDER_PHOME'); ?></th>
			<td><?php echo $this->item->phome; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_BOOKING_FORM_LBL_ORDER_EMAIL'); ?></th>
			<td><?php echo $this->item->email; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_BOOKING_FORM_LBL_ORDER_IDROOM'); ?></th>
			<td><?php echo $this->item->idroom; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_BOOKING_FORM_LBL_ORDER_TOTAL'); ?></th>
			<td><?php echo $this->item->total; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_BOOKING_FORM_LBL_ORDER_PARENTROOM'); ?></th>
			<td><?php echo $this->item->parentroom; ?></td>
		</tr>

	</table>

</div>

<?php if($canEdit && $this->item->checked_out == 0): ?>

	<a class="btn" href="<?php echo JRoute::_('index.php?option=com_booking&task=order.edit&id='.$this->item->id); ?>"><?php echo JText::_("COM_BOOKING_EDIT_ITEM"); ?></a>

<?php endif; ?>

<?php if (JFactory::getUser()->authorise('core.delete','com_booking.order.'.$this->item->id)) : ?>

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
			<a href="<?php echo JRoute::_('index.php?option=com_booking&task=order.remove&id=' . $this->item->id, false, 2); ?>" class="btn btn-danger">
				<?php echo JText::_('COM_BOOKING_DELETE_ITEM'); ?>
			</a>
		</div>
	</div>

<?php endif; ?>