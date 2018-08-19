<?php
@session_start();
if (isset($_GET['BrowseNode']) && !empty(trim($_GET['BrowseNode']))) {
	$_SESSION['bbil_Keywords'] = trim($_GET['BrowseNode']);
}
if (isset($_GET['keywords']) && !empty(trim($_GET['keywords']))) {
	$_SESSION['bbil_Keywords'] = trim($_GET['keywords']);
}
if (isset($_GET['offer']) && !empty(trim($_GET['offer']))) {
	$_SESSION['bbil_MinPercentageOff'] = trim($_GET['offer']);
}
if (isset($_GET['category']) && !empty(trim($_GET['category']))) {
	$_SESSION['bbil_SearchIndex'] = trim($_GET['category']);
}