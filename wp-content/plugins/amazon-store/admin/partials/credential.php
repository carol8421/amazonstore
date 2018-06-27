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
                <div class="savedMessage"></div>
                <form id="msform" method="POST" action="">
                	<fieldset>
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3 col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Amazon Credentials</div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label>Access Key ID <span class="redText"> *</span></label>
                                            <input type="text" class="form-control" value="<?php echo get_option('bbilas_accessKey'); ?>" placeholder="Access Key ID" id="accessKey" />
                                            <span class="error hidden">This field is required.</span>
                                        </div>
                                        <div class="form-group">
                                            <label>Secret Key<span class="redText"> *</span></label>
                                            <input type="text" class="form-control" value="<?php echo get_option('bbilas_secretKey'); ?>" placeholder="Secret Key ID" id="secretKey"/>
                                            <span class="error hidden">This field is required.</span>
                                        </div>

                                        <div class="form-group">
                                            <label>Amazon Associate ID<span class="redText"> *</span></label>
                                            <input type="text" class="form-control" value="<?php echo get_option('bbilas_associate'); ?>" id="associate">
                                            <span class="error hidden">This field is required.</span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="form-group text-center">
                            <button class="btn btn-primary btn-md saveBtn">Save</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="loaderWrapper"> <div class="loader"></div> </div>
<script>
	jQuery(function ($) {
		var formError = {};
		var ajaxLink = "<?php echo admin_url('admin-ajax.php'); ?>";

        function formValidation(accessKey, secretKey, associate) {
            var error = {};

            if (!accessKey) { 
                error.accessKey = 'AccessKey value is reqired.';
                $('#accessKey').addClass('redBorder').parent('.form-group').find('.error').removeClass('hidden');
            } else {
                delete error.accessKey;
                $('#accessKey').removeClass('redBorder').parent('.form-group').find('.error').addClass('hidden');
            }

            if (!secretKey) { 
                error.secretKey = 'SecretKey value is reqired.';
                $('#secretKey').addClass('redBorder').parent('.form-group').find('.error').removeClass('hidden');
            } else {
                delete error.secretKey;
                $('#secretKey').removeClass('redBorder').parent('.form-group').find('.error').addClass('hidden');
            }

            if (!associate) { 
                error.associate = 'Associate value is reqired.';
                $('#associate').addClass('redBorder').parent('.form-group').find('.error').removeClass('hidden');
            } else {
                delete error.associate;
                $('#associate').removeClass('redBorder').parent('.form-group').find('.error').addClass('hidden');
            }
            return error;
        }

        // store data into database
        function storeDataViaAjax(ajaxPost, button) {
            $.ajax({
                url: ajaxLink,
                method: 'post',
                data: ajaxPost,
                beforeSend : function () {
                    button.attr('disabled', true);
                    $('.loaderWrapper').addClass('open');
                },
                success: function (responce) {
                    responce = JSON.parse(responce);
                    if (responce.status == 200) {
                        button.attr('disabled', false);
                        $('.savedMessage').html('<span class="text-success"><strong>'+ responce.message +'</strong></span>');
                    } else {
                        $('.savedMessage').html('<span class="text-danger"><strong>'+ responce.message +'</strong></span>');
                        button.attr('disabled', false);
                    }
                    $('.loaderWrapper').removeClass('open');
                    setTimeout(function () { $('.savedMessage').hide(500); }, 2000)
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    button.attr('disabled', false).val('Finish');
                    $('.loaderWrapper').removeClass('open');
                    console.log(thrownError);
                }
            });
        }

        $(document).on('change', 'form input', function (event) {
            var accessKey       = $('#accessKey').val().trim();
            var secretKey       = $('#secretKey').val().trim();
            var associate       = $('#associate').val().trim();

            formValidation(accessKey, secretKey, associate);
        });

		$(document).on('submit', 'form', function (event) {
			event.preventDefault();
            var button = $(this);
            // access all values
            var accessKey       = $('#accessKey').val().trim();
            var secretKey       = $('#secretKey').val().trim();
            var associate       = $('#associate').val().trim();

            // Validation 
            formError = formValidation(accessKey, secretKey, associate);
            console.log(formError.length);
            // validation
            if ($.isEmptyObject(formError)) {
                // submit via ajax
                var ajaxPost = {
                    action   : 'bbilas_setup',
                    step     : 1,
                    accessKey: accessKey,
                    secretKey: secretKey,
                    associate: associate
                };

                // store data via ajax
                storeDataViaAjax(ajaxPost, button);
            }
        });
	});
</script>