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

    });

    Joomla.submitbutton = function (task) {
        if (task == 'room.cancel') {
            Joomla.submitform(task, document.getElementById('room-form'));
        } else {

            if (js('#jform_image_room').val() == '' && js('#jform_image_room_hidden').val() == '') {
                alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
                return;
            }
            if (task != 'room.cancel' && document.formvalidator.isValid(document.id('room-form'))) {

                Joomla.submitform(task, document.getElementById('room-form'));
            } else {
                alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
            }
        }
    }
</script>

<form
    action="<?php echo JRoute::_('index.php?option=com_booking&layout=edit&id=' . (int) $this->item->id); ?>"
    method="post" enctype="multipart/form-data" name="adminForm" id="room-form" class="form-validate">

    <div class="">
        <?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>

        <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general', JText::_('COM_BOOKING_TITLE_ROOM', true)); ?>
        <div class="row-fluid">
            <div class="span10 ">
                <fieldset class="adminform">

                    <input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>" />
                    <input type="hidden" name="jform[ordering]" value="<?php echo $this->item->ordering; ?>" />
                    <input type="hidden" name="jform[state]" value="<?php echo $this->item->state; ?>" />
                    <input type="hidden" name="jform[checked_out]" value="<?php echo $this->item->checked_out; ?>" />
                    <input type="hidden" name="jform[checked_out_time]" value="<?php echo $this->item->checked_out_time; ?>" />

                    <?php echo $this->form->renderField('created_by'); ?>
                    <?php echo $this->form->renderField('modified_by'); ?>				
                    <?php echo $this->form->renderField('image_room'); ?>

                    <?php 
                    $imageRoom = array();
                    if (!empty($this->item->image_room)) : ?>
                        <?php foreach ((array) $this->item->image_room as $fileSingle) : ?>
                            <?php if (!is_array($fileSingle)) :
                                $imageRoom[] = $fileSingle;
                                ?>
                                <a href="<?php echo JRoute::_(JUri::root() . '' . DIRECTORY_SEPARATOR . $fileSingle, false); ?>">
                                    <img src="<?php echo JRoute::_(JUri::root() . 'images/bookingrooms' . DIRECTORY_SEPARATOR . $fileSingle, false); ?>" width="100px"/>
                                </a> |
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <input type="hidden" name="jform[image_room_hidden]" id="jform_image_room_hidden" value="<?php echo implode(',', $imageRoom); ?>" />		
                    <div class="form-inline form-inline-header">
                        <?php echo $this->form->renderField('room_name'); ?>
                        <?php echo $this->form->renderField('alias'); ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-inline form-inline-header">
                        <?php echo $this->form->renderField('number_room'); ?>
                        <?php echo $this->form->renderField('language'); ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-inline form-inline-header">
                        <?php echo $this->form->renderField('price'); ?>
                        <?php echo $this->form->renderField('area'); ?>
                    </div>
                    <div class="clearfix"></div>
                    <?php echo $this->form->renderField('desc'); ?>
                    <?php echo $this->form->renderField('beds'); ?>
                    <?php echo $this->form->renderField('is_extra_bed'); ?>
                    <?php echo $this->form->renderField('utilities'); ?>


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
<style>
    .form-inline-header label{
        min-width: 130px;
    }
</style>