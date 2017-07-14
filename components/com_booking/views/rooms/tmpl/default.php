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
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$user = JFactory::getUser();
$userId = $user->get('id');
$listOrder = $this->state->get('list.ordering');
$listDirn = $this->state->get('list.direction');
$canCreate = $user->authorise('core.create', 'com_booking') && file_exists(JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR . 'roomform.xml');
$canEdit = $user->authorise('core.edit', 'com_booking') && file_exists(JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR . 'roomform.xml');
$canCheckin = $user->authorise('core.manage', 'com_booking');
$canChange = $user->authorise('core.edit.state', 'com_booking');
$canDelete = $user->authorise('core.delete', 'com_booking');
?>

<form action="<?php echo JRoute::_('index.php?option=com_booking&view=rooms'); ?>" method="post"
      name="adminForm" id="adminForm">


    <table class="table table-striped" id="roomList">
        <thead>
            <tr>
                <?php if (isset($this->items[0]->state)): ?>
                    <th width="5%">
                        <?php echo JHtml::_('grid.sort', 'JPUBLISHED', 'a.state', $listDirn, $listOrder); ?>
                    </th>
                <?php endif; ?>

                <th class=''>
                    <?php echo JHtml::_('grid.sort', 'COM_BOOKING_ROOMS_ID', 'a.id', $listDirn, $listOrder); ?>
                </th>
                <th class=''>
                    <?php echo JHtml::_('grid.sort', 'COM_BOOKING_ROOMS_IMAGE_ROOM', 'a.image_room', $listDirn, $listOrder); ?>
                </th>
                <th class=''>
                    <?php echo JHtml::_('grid.sort', 'COM_BOOKING_ROOMS_ROOM_NAME', 'a.room_name', $listDirn, $listOrder); ?>
                </th>
                <th class=''>
                    <?php echo JHtml::_('grid.sort', 'COM_BOOKING_ROOMS_NUMBER_ROOM', 'a.number_room', $listDirn, $listOrder); ?>
                </th>
                <th class=''>
                    <?php echo JHtml::_('grid.sort', 'COM_BOOKING_ROOMS_DESC', 'a.desc', $listDirn, $listOrder); ?>
                </th>
                <th class=''>
                    <?php echo JHtml::_('grid.sort', 'COM_BOOKING_ROOMS_PRICE', 'a.price', $listDirn, $listOrder); ?>
                </th>
                <th class=''>
                    <?php echo JHtml::_('grid.sort', 'COM_BOOKING_ROOMS_AREA', 'a.area', $listDirn, $listOrder); ?>
                </th>
                <th class=''>
                    <?php echo JHtml::_('grid.sort', 'COM_BOOKING_ROOMS_BEDS', 'a.beds', $listDirn, $listOrder); ?>
                </th>
                <th class=''>
                    <?php echo JHtml::_('grid.sort', 'COM_BOOKING_ROOMS_UTILITIES', 'a.utilities', $listDirn, $listOrder); ?>
                </th>


                <?php if ($canEdit || $canDelete): ?>
                    <th class="center">
                        <?php echo JText::_('COM_BOOKING_ROOMS_ACTIONS'); ?>
                    </th>
                <?php endif; ?>

            </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="<?php echo isset($this->items[0]) ? count(get_object_vars($this->items[0])) : 10; ?>">
                    <?php echo $this->pagination->getListFooter(); ?>
                </td>
            </tr>
        </tfoot>
        <tbody>
            <?php foreach ($this->items as $i => $item) : ?>
                <?php $canEdit = $user->authorise('core.edit', 'com_booking'); ?>

                <?php if (!$canEdit && $user->authorise('core.edit.own', 'com_booking')): ?>
                    <?php $canEdit = JFactory::getUser()->id == $item->created_by; ?>
                <?php endif; ?>

                <tr class="row<?php echo $i % 2; ?>">

                    <?php if (isset($this->items[0]->state)) : ?>
                        <?php $class = ($canChange) ? 'active' : 'disabled'; ?>
                        <td class="center">
                            <a class="btn btn-micro <?php echo $class; ?>" href="<?php echo ($canChange) ? JRoute::_('index.php?option=com_booking&task=room.publish&id=' . $item->id . '&state=' . (($item->state + 1) % 2), false, 2) : '#'; ?>">
                                <?php if ($item->state == 1): ?>
                                    <i class="icon-publish"></i>
                                <?php else: ?>
                                    <i class="icon-unpublish"></i>
                                <?php endif; ?>
                            </a>
                        </td>
                    <?php endif; ?>

                    <td>

                        <?php echo $item->id; ?>
                    </td>
                    <td>
                        <?php if (isset($item->checked_out) && $item->checked_out) : ?>
                            <?php echo JHtml::_('jgrid.checkedout', $i, $item->uEditor, $item->checked_out_time, 'rooms.', $canCheckin); ?>
                        <?php endif; ?>
                        <a href="<?php echo JRoute::_('index.php?option=com_booking&view=room&id=' . (int) $item->id); ?>">
                            <?php echo $this->escape($item->image_room); ?></a>
                    </td>
                    <td>

                        <?php echo $item->room_name; ?>
                    </td>
                    <td>

                        <?php echo $item->number_room; ?>
                    </td>
                    <td>

                        <?php echo $item->desc; ?>
                    </td>
                    <td>

                        <?php echo $item->price; ?>
                    </td>
                    <td>

                        <?php echo $item->area; ?>
                    </td>
                    <td>

                        <?php echo $item->beds; ?>
                    </td>
                    <td>

                        <?php echo $item->utilities; ?>
                    </td>


                    <?php if ($canEdit || $canDelete): ?>
                        <td class="center">
                            <?php if ($canEdit): ?>
                                <a href="<?php echo JRoute::_('index.php?option=com_booking&task=roomform.edit&id=' . $item->id, false, 2); ?>" class="btn btn-mini" type="button"><i class="icon-edit" ></i></a>
                            <?php endif; ?>
                            <?php if ($canDelete): ?>
                                <a href="<?php echo JRoute::_('index.php?option=com_booking&task=roomform.remove&id=' . $item->id, false, 2); ?>" class="btn btn-mini delete-button" type="button"><i class="icon-trash" ></i></a>
                            <?php endif; ?>
                        </td>
                    <?php endif; ?>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php if ($canCreate) : ?>
        <a href="<?php echo JRoute::_('index.php?option=com_booking&task=roomform.edit&id=0', false, 0); ?>"
           class="btn btn-success btn-small"><i
                class="icon-plus"></i>
            <?php echo JText::_('COM_BOOKING_ADD_ITEM'); ?></a>
        <?php endif; ?>

    <input type="hidden" name="task" value=""/>
    <input type="hidden" name="boxchecked" value="0"/>
    <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
    <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
    <?php echo JHtml::_('form.token'); ?>
</form>

<?php if ($canDelete) : ?>
    <script type="text/javascript">

        jQuery(document).ready(function () {
            jQuery('.delete-button').click(deleteItem);
        });

        function deleteItem() {

            if (!confirm("<?php echo JText::_('COM_BOOKING_DELETE_MESSAGE'); ?>")) {
                return false;
            }
        }
    </script>
<?php endif; ?>
