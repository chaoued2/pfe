<?php echo javascript_include_tag(plugin_web_path('orangehrmIndicatorsPlugin', 'js/testSuccess')); ?>

<div class="box">

    <?php if (isset($credentialMessage)) { ?>

        <div class="message warning">
            <?php echo __(CommonMessages::CREDENTIALS_REQUIRED) ?>
        </div>

    <?php } else { ?>

        <div class="head">
            <h1><?php echo __('Add Indicators'); ?></h1>
        </div>

        <div class="inner" id="addEmployeeTbl">
            <?php include_partial('global/flash_messages'); ?>
            <form id="frmAddEmp" method="post" action="<?php echo url_for('indicators/indicators'); ?>"
                  enctype="multipart/form-data">
                <fieldset>
                    <ol><?php echo $form['_csrf_token']->render() ?>
                        <?php echo $form->render(); ?>

                        <li class="required">
                            <em>*</em> <?php echo __(CommonMessages::REQUIRED_FIELD); ?>
                        </li>

                        <?php $showExtra = ($form->getValue('type') == Indicators::FIELD_TYPE_SELECT) ? 'block' : 'none'; ?>
                        <li style="display:<?php echo $showExtra; ?>;" id="typeval" class="fieldHelpContainer">
                            <?php echo $form['typeval']->renderLabel(__('typeval') . ' <em>*</em>'); ?>
                            <?php echo $form['typeval']->render(); ?>
                        </li>
                    </ol>
                    <p>
                        <input type="submit" class="" id="btnSave" value="<?php echo __("Save"); ?>"  />
                        <input type="reset" class="reset" id="btnRst" value="<?php echo __("Reset") ?>" name="btnRst" />


                    </p>
                </fieldset>

            </form>
            //list
        </div>

        <div id="recordsListDiv" class="box miniList">
            <div class="head">
                <h1><?php echo __('List Indicators'); ?></h1>
            </div>

            <div class="inner">

                <?php include_partial('global/flash_messages'); ?>

                <form name="frmList" id="frmList" method="post" action="<?php echo url_for('indicators/deleteIndicators'); ?>">
                    <?php echo $listForm ?>
                    <p id="listActions">
                        <input type="button" class="addbutton" id="btnAdd" value="<?php echo __('Add'); ?>"/>
                        <input type="button" class="delete" id="btnDel" value="<?php echo __('Delete'); ?>"/>
                    </p>

                    <table class="table hover" id="recordsListTable">
                        <thead>
                        <tr>
                            <th class="check" style="width:2%"><input type="checkbox" id="checkAll" class="checkboxAtch" /></td>
                            <th style="width:25%"><?php echo __('Name'); ?></td>
                            <th style="width:25%"><?php echo __('Type'); ?></td>
                            <th style="width:25%"><?php echo __('Frequence'); ?></td>
                            <th style="width:25%"><?php echo __('Actif'); ?></td>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        $row = 0;
                        foreach($records as $record) :
                            $cssClass = ($row%2) ? 'even' : 'odd';
                            ?>

                            <tr class="<?php echo $cssClass;?>">
                                <td class="check">
                                    <input type="checkbox" class="checkboxAtch" name="chkListRecord[]" value="<?php echo $record->getId(); ?>" />
                                </td>
                                <td class="tdName tdValue">
                                    <a href="#"><?php echo $record->getNom(); ?></a>
                                </td>
                                <td class="tdValue">
                                    <?php echo $record->getFrequence(); ?>
                                </td>
                            </tr>

                            <?php
                            $row++;
                        endforeach;
                        ?>

                        <?php if (count($records) == 0) : ?>
                            <tr class="<?php echo 'even';?>">
                                <td>
                                    <?php echo __(TopLevelMessages::NO_RECORDS_FOUND); ?>
                                </td>
                                <td>
                                </td>
                            </tr>
                        <?php endif; ?>

                        </tbody>
                    </table>
                </form>
            </div>
        </div> <!-- recordsListDiv -->

               <!-- Confirmation box HTML: Begins -->
        <div class="modal hide" id="deleteConfModal">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h3><?php echo __('OrangeHRM - Confirmation Required'); ?></h3>
            </div>
            <div class="modal-body">
                <p><?php echo __(CommonMessages::DELETE_CONFIRMATION); ?></p>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn" data-dismiss="modal" id="dialogDeleteBtn" value="<?php echo __('Ok'); ?>" />
                <input type="button" class="btn reset" data-dismiss="modal" value="<?php echo __('Cancel'); ?>" />
            </div>
        </div>
        <script type="text/javascript" >
            $(document).ready(function() {
                hideextra();

                function hideextra() {
                    if ($('type').val() == <?php echo Indicators::FIELD_TYPE_SELECT; ?>) {
                        $('typeval').show();
                    } else {
                        $('typeval').hide();
                    }
                }
            }
            var recordsCount = <?php echo count($records);?>;

            var recordKeyId = "indicator_id";

            var saveFormFieldIds = new Array();
            saveFormFieldIds[0] = "nom";
            saveFormFieldIds[1] = "indicator_description";
            

            var urlForExistingNameCheck = '<?php echo url_for('indicators/checkIndicatorNameExistence'); ?>';

            var lang_addFormHeading = "<?php echo __('Add Indicator'); ?>";
            var lang_editFormHeading = "<?php echo __('Edit Indicator'); ?>";

            var lang_nameIsRequired = '<?php echo __(ValidationMessages::REQUIRED); ?>';
            var lang_descLengthExceeded = '<?php echo __(ValidationMessages::TEXT_LENGTH_EXCEEDS, array('%amount%' => 250)); ?>';
            var lang_nameExists = '<?php echo __(ValidationMessages::ALREADY_EXISTS); ?>';
            var indicator = <?php echo str_replace('&#039;', "'", $form->getIndicatorListAsJson()) ?> ;
            var indicatorList = eval(indicator);
        </script>


    <?php } ?>

</div> <!-- Box -->


