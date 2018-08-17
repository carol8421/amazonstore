<!--sidebar START -->
<div class="col-lg-3 col-sm-6 sidebar z-2">
    <div class="panel panel-default">
        <div class="panel-body">
            <?php 
            $sidebardiscounttext = get_option('bbil_sidebardiscounttext'); 
            $sidebardiscounttext = $sidebardiscounttext ? $sidebardiscounttext : 'Discount'; 
            echo '<div id="sidebar-discount-rate">'. $sidebardiscounttext .': <span>'.AS_OFFER.'</span>%</div>';
            ?>
            <!-- jquery ui slider START-->
            <div id="sidebar-slider">
                <div id="custom-handle" class="ui-slider-handle"></div>
            </div>
            <!-- jquery ui slider END-->

            <div class="input-group m-t-40 clearfix">
                <form action="" method="POST" role="form">
                    <input style="width: 192px;" id="sidebarSearchKeywords" type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button id="sidebarSearchForm" class="btn btn-default" type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </span>
                </form>
            </div><!-- /input-group -->
        </div>
    </div>
    
    <?php if ($categories) {
        //echo '<pre>'. print_r($categories, true) .'</pre>';
        echo '<div class="panel panel-default m-t-15">';
            echo '<div class="panel-body sidebar-categories">';
                echo '<h4>Amazon Categories</h4>';
                    echo '<ul id="sidebarCategories">';
                        foreach ($categories as $key => $category) {
                            echo '<li> <a href="'. trim($key) .'">'. trim($key) .'</a></li>';
                        }
                    echo '</ul>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    } ?>
</div>
<!--sidebar END-->