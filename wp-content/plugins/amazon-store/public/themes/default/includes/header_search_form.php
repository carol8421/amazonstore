<form class="navbar-form pull-right">
    <?php
        // Header form
        echo '<div class="input-group searchBarEnableTopSearch">';
        echo '<input id="headerSearchKeywords" type="text" class="form-control" placeholder="Search">';
        echo '<span class="input-group-btn">';
        echo '<button id="headerSearchSubmit" discount="'. AS_OFFER .'" class="btn btn-default" type="submit">';
        echo '<i class="fa fa-search" aria-hidden="true"></i>';
        echo '</button>';
        echo '</span>';
        echo '</div>';

    // Header discount button
    echo '<button type="button" id="searchbar_top_discount" class="btn primary-btn">Disc %'. AS_OFFER .'</button>';
    ?>
</form>
