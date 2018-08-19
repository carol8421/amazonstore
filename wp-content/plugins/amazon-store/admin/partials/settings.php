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
<?php
// Test data
//echo '<br>theme : '. get_option('bbilas_theme');
//echo '<br>detailsOpenStyle : '. get_option('bbilas_detailsOpenStyle');
//echo '<br>bannerImage : '. get_option('bbilas_bannerImage', '');
//echo '<br>bannerVisibility : '. get_option('bbilas_bannerVisibility');
?>
<?php
$placeholderImg = 'http://via.placeholder.com/150x100';
if (get_option('bbilas_detailsOpenStyle', '') == 'popup') {
    $popup = ' checked';
	$newtab = '';
} else {
	$popup = '';
	$newtab = ' checked';
}
if (get_option('bbilas_bannerVisibility') == 'enabled') {
	$bannerVisibility = ' checked';
} else {
	$bannerVisibility = '';
}
$bannerImage = get_option('bbilas_bannerImage', $placeholderImg);
if ($bannerImage == $placeholderImg) $removeBtnClass = ' hidden';
else $removeBtnClass = '';
$AllTemplates = TH::getDirectoryFiles();
$themes = '';
if ($AllTemplates) {
	foreach ($AllTemplates as $template) {
		$activeClass = AS_THEME_NAME == $template ? ' active' : '';
		$themes .= '<div class="col-sm-4 col-xs-12">';
            $themes .= '<div class="panel panel-default templatePanel '. $activeClass .'">';
                $themes .= '<div class="panel-heading theme-header">'. TH::templateName($template, false) .'</div>';
                $themes .= '<div class="panel-body">';
		            if (TH::isValidTemplate($template)) {
		                $themes .= '<a href="javascript:;" class="template-list-item '. $template .'" theme="'. $template .'">';
	                        $themes .= TH::templateAvatar($template, false);
                            if ($activeClass) $themes .= '<div class="active-theme-btn load-temp-btn">Activated</div>';
	                        else $themes .= '<div class="active-theme-btn load-temp-btn">Load Template</div>';
			            $themes .= '</a>';
		            } else {
			            $themes .= '<a href="javascript:;" class="template-list-item" theme="default">';
			            $themes .= '<img class="img-responsive" src="http://via.placeholder.com/223x166/CCCCCC/f20c0c?text=INVALID THEME">';
			            $themes .= '</a>';
		            }
                $themes .= '</div>';
            $themes .= '</div>';
		$themes .= '</div>';
	}
}
?>
<div class="setup_form">
	<div class="container m-t-30">
		<div class="row">
			<div class="col-md-12">
				<div class="savedMessage"></div>
				<form id="msform" method="POST" action="">
                    <input type="hidden" id="seletedTheme" value="<?php echo AS_THEME_NAME; ?>" class="">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2">
                            <div class="panel panel-default">
                                <div class="panel-heading">Template</div>
                                <div class="panel-body">
                                    <div class="row"><?php echo $themes; ?></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Product details page open style</div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="detailsOpenStyle" value="popup" <?php echo $popup; ?>>As a pop up
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="detailsOpenStyle" value="newtab" <?php echo $newtab; ?>> Open in new tab
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel panel-default">
                                        <div class="panel-heading">Page Banner Image</div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="imageContainer m-b-15">
                                                            <span id="remove" class="removeBtn <?php echo $removeBtnClass; ?>">X</span>
                                                            <img id="bg_img" class="imagePreview img-responsive" src="<?php echo $bannerImage; ?>">
                                                        </div>
                                                        <label for="bannerImage">
                                                            <input id="bannerImage" type="text" size="36" value="<?php echo $bannerImage; ?>" readonly />
                                                            <input id="upload_image_button" class="button" type="button" value="Upload Image" />
                                                        </label>
                                                        <div class="checkbox">
                                                            <label> <input id="bannerVisibility" type="checkbox" name="bannerVisibility" value="enabled" <?php echo $bannerVisibility ? ' checked': ''; ?>>Visible </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 text-center">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </form>
			</div>
		</div>
	</div>
</div>
<div class="loaderWrapper"> <div class="loader"></div> </div>
<?php wp_enqueue_media(); ?>
<script>
    jQuery(function ($) {
        var formError = {};
        var ajaxLink = "<?php echo admin_url('admin-ajax.php'); ?>";

        $(document).on('submit', 'form', function (event) {
            event.preventDefault();
            var button = $(this);
            // access all values
            var theme               = $('#seletedTheme').val().trim();
            var detailsOpenStyle    = $('input[name=detailsOpenStyle]:checked').val();
            var bannerImage         = $('#bannerImage').val();
            var bannerVisibility    = $('input[name=bannerVisibility]:checked').val();
            if (!bannerVisibility) bannerVisibility = 'disabled';

            // submit via ajax
            var ajaxPost = {
                action              : 'saveSettings',
                theme               : theme,
                detailsOpenStyle    : detailsOpenStyle,
                bannerImage         : bannerImage,
                bannerVisibility    : bannerVisibility
            };
            storeData(ajaxPost, button);
        });

        function storeData(ajaxPost, button) {
            $.ajax({
                url: ajaxLink,
                method: 'post',
                data: ajaxPost,
                beforeSend : function () {
                    loader();
                    button.attr('disabled', true);
                },
                success: function (responce) {
                    responce = JSON.parse(responce);
                    if (responce.status == 200) {
                        $('.'+ ajaxPost.theme).find('.load-temp-btn').html('Activated');
                        $('.savedMessage').html('<span class="text-success"><strong>'+ responce.message +'</strong></span>');
                    } else {
                        $('.savedMessage').html('<span class="text-danger"><strong>'+ responce.message +'</strong></span>');
                    }
                    button.attr('disabled', false);
                    loader(false);
                    setTimeout(function () {
                        $('.savedMessage').html("");
                    }, 2000)
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    button.attr('disabled', false).val('Finish');
                    console.log(thrownError);
                    loader(false);
                }
            });
        }
        function loader(isActive=true) {
            var loader = $('.loaderWrapper');
            if (isActive) loader.addClass('open');
            else loader.removeClass('open');
        }
    });
</script>
<script>
    jQuery(document).ready(function($){
        var custom_uploader;
        $('#upload_image_button').click(function(e) {
            e.preventDefault();
            //If the uploader object has already been created, reopen the dialog
            if (custom_uploader) {
                custom_uploader.open();
                return;
            }

            //Extend the wp.media object
            custom_uploader = wp.media.frames.file_frame = wp.media({
                title: 'Choose Image',
                button: {
                    text: 'Choose Image'
                },
                multiple: true
            });

            //When a file is selected, grab the URL and set it as the text field's value
            custom_uploader.on('select', function() {
                console.log(custom_uploader.state().get('selection').toJSON());
                attachment = custom_uploader.state().get('selection').first().toJSON();
                $('#bannerImage').val(attachment.url);
                $('#bg_img').attr('src', attachment.url);
                $('#bannerVisibility').attr('disabled', false);
                $('#remove').removeClass('hidden');
            });
            //Open the uploader dialog
            custom_uploader.open();
        });

        $(document).on('click', '#remove', function (event) {
           event.preventDefault();
           var placeHolder = 'http://via.placeholder.com/150x100';
           $(this).addClass('hidden');
           $('#bannerImage').val(placeHolder);
           $('#bg_img').attr('src', placeHolder);
            $('#bannerVisibility').attr('disabled', true);
        });
    });
</script>