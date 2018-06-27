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
                                                <input type="text" class="form-control" value="<?php echo get_option('bbilas_associate'); ?>" id="associate">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="button" id="amazonCredentialsBtn" name="next" class="next action-button" value="Next >"/>
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
                                        <?php $rootCats = Helper::rootCategories();
                                        if ($rootCats) {
                                            echo '<div class="categoriesPanel" categoriespaneldata="">';
                                                echo '<div class="form-group">';
                                                    echo '<label>Choose Categories<span class="error"> *</span></label>';
                                                    echo '<select class="form-control category">';
                                                    foreach ($rootCats as $catName => $catID) {
	                                                    $value = '"'. $catName .'":'.$catID;
	                                                    echo '<option value=\''. $value .'\'>'. $catName .'</option>';
                                                    }
                                                    echo '</select>';
                                                echo '</div>';
	                                        echo '</div>';
	                                        echo '<div class="categoriesError text-danger"></div>';
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="button" name="previous" class="previous action-button-previous" value="< Previous"/>
                        <input type="button" name="next" class="next action-button" value="Next >" id="amazonPreferencesBtn"/>
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
        var current_fs, next_fs, previous_fs; //fieldsets
        var left, opacity, scale; //fieldset properties which we will animate
        var animating; //flag to prevent quick multi-click glitches
        var nextElement;

        var error = [];
        var ajaxLink = "<?php echo admin_url('admin-ajax.php'); ?>";

        function nextWizard(element) {
            if(animating) return false;
            animating = true;

            current_fs = element.parent();
            next_fs = element.parent().next();

            //activate next step on progressbar using the index of next_fs
            $("#progressbar li").removeClass("active");
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
                step: function(now, mx) {
                    //as the opacity of current_fs reduces to 0 - stored in "now"
                    //1. scale current_fs down to 80%
                    scale = 1 - (1 - now) * 0.2;
                    //2. bring next_fs from the right(50%)
                    left = (now * 50)+"%";
                    //3. increase opacity of next_fs to 1 as it moves in
                    opacity = 1 - now;
                    current_fs.css({
                        'transform': 'scale('+scale+')',
                        'position': 'absolute'
                    });
                    next_fs.css({'left': left, 'opacity': opacity});
                },
                duration: 800,
                complete: function(){
                    current_fs.hide();
                    animating = false;
                },
                //this comes from the custom easing plugin
                easing: 'jswing' //easeInQuad
            });
        }
        function previousWizard(element) {
            if(animating) return false;
            animating = true;

            current_fs = element.parent();
            previous_fs = element.parent().prev();

            //de-activate current step on progressbar
            $("#progressbar li").removeClass("active");
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
            $("#progressbar li").eq($("fieldset").index(previous_fs)).addClass("active");

            //show the previous fieldset
            previous_fs.show();
            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
                step: function(now, mx) {
                    //as the opacity of current_fs reduces to 0 - stored in "now"
                    //1. scale previous_fs from 80% to 100%
                    scale = 0.8 + (1 - now) * 0.2;
                    //2. take current_fs to the right(50%) - from 0%
                    left = ((1-now) * 50)+"%";
                    //3. increase opacity of previous_fs to 1 as it moves in
                    opacity = 1 - now;
                    current_fs.css({'left': left});
                    previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
                },
                duration: 800,
                complete: function(){
                    current_fs.hide();
                    animating = false;
                },
                //this comes from the custom easing plugin
                easing: 'jswing'
            });
        }
        function addCategoryPanelData(container, parentCat) {
            var categoryPanelData = container.parents('.categoriesPanel').attr('categoriespaneldata');
            if (categoryPanelData) {
                categoryPanelData = categoryPanelData.slice(1, categoryPanelData.length-1);
                categoryPanelData = categoryPanelData.split(',');
            }
            else categoryPanelData = [];
            selectIndex = container.parents('.panel-body').find('.form-group').index(container.parent('.form-group'));
            categoryPanelData = categoryPanelData.slice(0, selectIndex); // remove rest of the elements form array
            categoryPanelData.push(parentCat);
            container.parents('.categoriesPanel').attr('categoriespaneldata', '{'+ categoryPanelData.toString() +'}');

            // remove rest select elements
            container.parent('.form-group').nextAll().remove();
        }
        function subCategoryList(container, parentCat='') {
            var optionVals = '';
            var errorContainer = $('.categoriesError');
            $.ajax({
                url: ajaxLink,
                method:'POST',
                data:{
                    action : 'bbilas_loadSubCategories',
                    parent: parentCat
                },
                dataType:'text',
                success:function(response){
                    response = JSON.parse(response);
                    if (response.status == 200 && response.value != 'null' && response.value != 'false') {
                        errorContainer.html('');
                        data = JSON.parse(response.value);
                        optionVals += '<div class="form-group" id="parentID_'+ parentCat +'">';
                        optionVals += '<select class="form-control category">';
                        console.log(data);
                        $.each(data, function (key, val) {
                            var optionValue = '"'+ val.Name +'":'+ val.BrowseNodeId;
                            optionVals += '<option value=\''+ optionValue +'\'>'+ val.Name +'</option>';
                        });
                        optionVals += '</select>';
                        optionVals += '</div>';

                        container.parents('.categoriesPanel').append(optionVals);
                    } else { errorContainer.html('No Child Category found'); }
                },
                error:function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
            });
        }
        function storeData(ajaxPost, button, isLastStep=false) {
            $.ajax({
                url: ajaxLink,
                method: 'post',
                data: ajaxPost,
                beforeSend : function () {
                    button.attr('disabled', true);
                },
                success: function (responce) {
                    //alert(responce);
                    responce = JSON.parse(responce);
                    if (responce.status == 200) {
                        if (isLastStep) location.reload();
                        else nextWizard(button);
                        button.attr('disabled', false);
                    } else {
                        $('.savedMessage').html('<span class="text-danger"><strong>'+ responce.message +'</strong></span>');
                        button.attr('disabled', false);
                        setTimeout(function () {
                            $('.savedMessage').html("");
                        }, 2000)
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    button.attr('disabled', false).val('Finish');
                    console.log(thrownError);
                }
            });
        }

        // step 1 ( store credentials )
        $(document).on('click', '#amazonCredentialsBtn', function (e) {
            var button = $(this);
            // access all values
            var accessKey       = $('#accessKey').val().trim();
            var secretKey       = $('#secretKey').val().trim();
            var associate       = $('#associate').val().trim();

            // validation
            if (error.length < 1){
                // submit via ajax
                var ajaxPost = {
                    action   : 'bbilas_setup',
                    step     : 1,
                    accessKey: accessKey,
                    secretKey: secretKey,
                    associate: associate
                };

                // store data via ajax
                storeData(ajaxPost, button);
            }
        });

        // step 2 ( store preferences )
        $(document).on('click', '#amazonPreferencesBtn', function (e) {
            var button = $(this);
            // access all values
            var storeKeyword    = $('#storeKeyword').val().trim();
            var defaultDiscount = $('#defaultDiscount').val().trim();
            var category        = $('.categoriesPanel').attr('categoriespaneldata');
            //var theme           = $('#seletedTheme').val().trim();

            // validation
            if (error.length < 1){
                // submit via ajax
                var ajaxPost = {
                    action      : 'bbilas_setup',
                    step        : 2,
                    storeKeyword: storeKeyword,
                    defaultDiscount: defaultDiscount,
                    category: category,
                };
                storeData(ajaxPost, button);
            }
        });

        // step 3 ( store theme and finish )
        $(document).on('click', '#setupFinish', function (e) {
            var button = $(this);
            // access all values
            var theme           = $('#seletedTheme').val().trim();
            // validation
            if (error.length < 1){
                // submit via ajax
                var ajaxPost = {
                    action      : 'bbilas_setup',
                    step        : 3,
                    theme       : theme
                };
                storeData(ajaxPost, button, true);
            }
        });

        // load sub categories
        $(document).on('change', '.category', function () {
            var parentCat = $(this).val().trim();
            var selectElement = $(this);
            addCategoryPanelData(selectElement, parentCat);

            parentCat = parentCat.split(':');
            subCategoryList(selectElement, parentCat[1]);
        });
    }(jQuery))
</script>