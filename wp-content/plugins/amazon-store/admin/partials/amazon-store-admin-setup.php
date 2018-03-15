<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       blubirdinteractive.com
 * @since      1.0.0
 *
 * @package    Amazon_Store
 * @subpackage Amazon_Store/admin/partials
 */
?>

<div class="setup_form">
    <div class="container m-t-30">
        <div class="row">
            <div class="col-md-12">
                <div class="savedMessage text-info"></div>

                <form id="msform" method="POST" action="">
                    <!-- progressbar -->
                    <section>
                        <ul id="progressbar">
                            <li class="active">Credentials</li>
                            <li>Preferences</li>
                            <li>Templates</li>
                        </ul>
                    </section>
                    <!-- fieldsets -->
                    <br>
                    <!-- Step One -->
                    <fieldset>
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3 col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Amazon Credentials</div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label>Access Key ID <span class="error"> *</span></label>
                                            <input type="text" class="form-control" value="<?php echo get_option('bbilas_accessKey'); ?>" placeholder="Access Key ID" id="accessKey" />
                                        </div>
                                        <div class="form-group">
                                            <label>Secret Key<span class="error"> *</span></label>
                                            <input type="text" class="form-control" value="<?php echo get_option('bbilas_secretKey'); ?>" placeholder="Secret Key ID" id="secretKey"/>
                                        </div>

                                        <div class="form-group">
                                            <label>Amazon Associate ID<span class="error"> *</span></label>
                                            <div class="associate_items">
                                                <input type="text" class="form-control" value="apidevupwork-20" value="<?php echo get_option('bbilas_associate'); ?>" id="associate">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="button" name="next" class="next action-button" value="Next >"/>
                    </fieldset>

                    <!-- Step Two -->
                    <fieldset>
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Preferences</div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label>Search keyword by default<span class="error"> *</span></label>
                                            <textarea class="form-control no-margin" rows="2" id="storeKeyword"><?php echo get_option ('bbilas_storeKeyword') ?></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>Discount Percents <span class="error"> *</span></label>
                                            <div class="input-group<?php echo $offerGroupHide; ?>">
                                                <input type="number" class="form-control no-margin" max="100" min="0" id="defaultDiscount" value="<?php echo get_option ('bbilas_defaultDiscount') ?>" />
                                                <span class="input-group-addon">%</span>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" value="" id="free"<?php echo $freeSelected; ?>>Only Free</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-group">
                                                <label>Choose Categories<span class="error"> *</span></label>
                                                <select class="form-control category" data-country="usa" id="category">
                                                    <option selected="" value="All">All</option>
                                                    <option value="2619526011">Appliances</option>
                                                    <option value="2617942011">ArtsAndCrafts</option>
                                                    <option value="165797011">Baby</option>
                                                    <option value="11055981">Beauty</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="button" name="previous" class="previous action-button-previous" value="< Previous"/>
                        <input type="button" name="next" class="next action-button" value="Next >"/>
                    </fieldset>

                    <!-- Step Three -->
                    <fieldset>
                        <input type="text" id="seletedTheme" value="1" class="hidden">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <div class="row">
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="panel panel-default templatePanel active">
                                            <div class="panel-heading theme-header">Template 1</div>
                                            <div class="panel-body">
                                                <a href="javascript:;" class="template-list-item" theme="1">
                                                    <img class="img-responsive" src="<?php echo plugins_url('amazon-store/admin/images/template-1.JPG' ) ?>">
                                                    <div class="active-theme-btn load-temp-btn">Load Template</div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-xs-12">
                                        <div class="panel panel-default templatePanel">
                                            <div class="panel-heading theme-header">Template 2</div>
                                            <div class="panel-body">
                                                <a href="javascript:;" class="template-list-item" theme="2">
                                                    <img class="img-responsive" src="<?php echo plugins_url('amazon-store/admin/images/template-2.JPG' ) ?>">
                                                    <div class="active-theme-btn load-temp-btn">Load Template</div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-xs-12">
                                        <div class="panel panel-default templatePanel">
                                            <div class="panel-heading theme-header">Template 3</div>
                                            <div class="panel-body">
                                                <a href="javascript:;" class="template-list-item" theme="3">
                                                    <img class="img-responsive" src="<?php echo plugins_url('amazon-store/admin/images/template-3.JPG' ) ?>">
                                                    <div class="active-theme-btn load-temp-btn">Load Template</div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="button" name="previous" class="previous action-button-previous" value="< Previous"/>
                        <input type="button" name="submit" class="submit action-button pull-right" id="setupFinish" value="Finish"/>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    (function ($) {
        var error = [];
        var ajaxLink = "<?php echo admin_url('admin-ajax.php'); ?>";
        $(document).on('click', '#setupFinish', function (e) {
            var button = $(this);
            // access all values
            var accessKey       = $('#accessKey').val().trim();
            var secretKey       = $('#secretKey').val().trim();
            var associate       = $('#associate').val().trim();
            var storeKeyword    = $('#storeKeyword').val().trim();
            var defaultDiscount = $('#defaultDiscount').val().trim();
            var category        = $('#category').val().trim();
            var theme           = $('#seletedTheme').val().trim();

            // validation
            if (error.length < 1){
                // submit via ajax
                var ajaxPost = {
                    action: 'bbilas_setup',
                    accessKey: accessKey,
                    secretKey: secretKey,
                    associate: associate,
                    storeKeyword: storeKeyword,
                    defaultDiscount: defaultDiscount,
                    category: category,
                    theme: theme
                };
                $.ajax({
                    url: ajaxLink,
                    method: 'post',
                    data: ajaxPost,
                    beforeSend : function () {
                        button.attr('disabled', true).val('Saving ...');
                    },
                    success: function (responce) {
                        //alert(responce);
                        button.attr('disabled', false).val('Finish');
                        $('.savedMessage').html(responce);

                        setTimeout(function () {
                            $('.savedMessage').hide('slow');
                            location.reload();
                        },2000);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        button.attr('disabled', false).val('Finish');
                        console.log(thrownError);
                    }
                });
            }
        });
    }(jQuery))
</script>