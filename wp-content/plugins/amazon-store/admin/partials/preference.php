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
                            <div class="col-sm-6 col-sm-offset-3">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Preferences</div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label>Search keyword by default<span class="redText"> *</span></label>
                                            <textarea class="form-control no-margin" rows="2" id="storeKeyword"><?php echo get_option ('bbilas_storeKeyword') ?></textarea>
                                            <span class="error hidden">This field is required.</span>
                                        </div>

                                        <div class="form-group">
                                            <label>Discount Percents <span class="redText"> *</span></label>
                                            <div class="input-group<?php echo $offerGroupHide; ?>">
                                                <input type="number" class="form-control no-margin" max="100" min="0" id="defaultDiscount" value="<?php echo get_option ('bbilas_defaultDiscount') ?>" />
                                                <span class="input-group-addon">%</span>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" value="" id="free"<?php echo $freeSelected; ?>>Only Free</label>
                                            </div>
                                            <span class="error hidden">This field is required.</span>
                                        </div>
                                        <?php $rootCats = Helper::rootCategories();
                                        if ($rootCats) {
                                            echo '<div class="categoriesPanel" categoriespaneldata="'. get_option("bbilas_category") .'">';
                                                echo '<div class="form-group">';
                                                    echo '<label>Choose Categories<span class="redText"> *</span></label>';
                                                    echo '<select class="form-control category">';
                                                    foreach ($rootCats as $catName => $catID) {
                                                        $value = '"'. $catName .'":'.$catID;
                                                        echo '<option value=\''. $value .'\'>'. $catName .'</option>';
                                                    }
                                                    echo '</select>';
                                                    echo '<span class="error hidden">This field is required.</span>';
                                                echo '</div>';
                                            echo '</div>';
                                            echo '<div class="categoriesError text-danger"></div>';
                                        } ?>
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

        function formValidation(storeKeyword, defaultDiscount, category) {
            var error = {};

            if (!storeKeyword) { 
                error.storeKeyword = 'Keywords value is reqired.';
                $('#storeKeyword').addClass('redBorder').parent('.form-group').find('.error').removeClass('hidden');
            } else {
                delete error.storeKeyword;
                $('#storeKeyword').removeClass('redBorder').parent('.form-group').find('.error').addClass('hidden');
            }

            if (!defaultDiscount) { 
                error.defaultDiscount = 'Discount value is reqired.';
                $('#defaultDiscount').addClass('redBorder').parents('.form-group').find('.error').removeClass('hidden');
            } else {
                delete error.defaultDiscount;
                $('#defaultDiscount').removeClass('redBorder').parent('.form-group').find('.error').addClass('hidden');
            }

            if (!category) { 
                error.category = 'Category value is reqired.';
                $('.category').addClass('redBorder').parents('.form-group').find('.error').removeClass('hidden');
            } else {
                delete error.category;
                $('.category').removeClass('redBorder').parent('.form-group').find('.error').addClass('hidden');
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

        $(document).on('change', 'form input, form textarea, form checkbox', function (event) {
            var storeKeyword    = $('#storeKeyword').val().trim();
            var defaultDiscount = $('#defaultDiscount').val().trim();
            var category        = $('.categoriesPanel').attr('categoriespaneldata');

            formValidation(storeKeyword, defaultDiscount, category);
        });

		$(document).on('submit', 'form', function (event) {
			event.preventDefault();
            var button = $(this);
            // access all values
            var storeKeyword    = $('#storeKeyword').val().trim();
            var defaultDiscount = $('#defaultDiscount').val().trim();
            var category        = $('.categoriesPanel').attr('categoriespaneldata');

            // Validation 
            formError = formValidation(storeKeyword, defaultDiscount, category);
            // validation
            if ($.isEmptyObject(formError)) {
                // submit via ajax
                var ajaxPost = {
                    action   : 'bbilas_setup',
                    step     : 2,
                    storeKeyword: storeKeyword,
                    defaultDiscount: defaultDiscount,
                    category: category
                };

                // store data via ajax
                storeDataViaAjax(ajaxPost, button);
            }
        });
	});
</script>