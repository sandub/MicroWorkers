<?php
class Pager
{
/***********************************************************************************
* int findStart (int limit)
* Returns the start offset based on $_GET['page'] and $limit
***********************************************************************************/
function findStart($limit)
{
if ((!isset($_GET['page'])) || ($_GET['page'] == "1"))
{
$start = 0;
$_GET['page'] = 1;
}
else
{
$start = ($_GET['page']-1) * $limit;
}

return $start;
}
/***********************************************************************************
* int findPages (int count, int limit)
* Returns the number of pages needed based on a count and a limit
***********************************************************************************/
function findPages($count, $limit)
{
$pages = (($count % $limit) == 0) ? $count / $limit : floor($count / $limit) + 1;

return $pages;
}
/***********************************************************************************
* string pageList (int curpage, int pages)
* Returns a list of pages in the format of "« < [pages] > »"
***********************************************************************************/
function pageList($curpage, $pages)
{
$page_list = "";

/* Print the first and previous page links if necessary */
if (($curpage != 1) && ($curpage))
{
if(isset($_GET["order"])) {
$page_list .= " <a href=\"".$_SERVER['PHP_SELF']."?page=1&order=".$_GET["order"]."\" title=\"First Page\">&laquo;</a> ";
}
else {
$page_list .= " <a href=\"".$_SERVER['PHP_SELF']."?page=1\" title=\"First Page\">&laquo;</a> ";
}
}

if (($curpage-1) > 0)
{
if(isset($_GET["order"])) {
$page_list .= "<a href=\"".$_SERVER['PHP_SELF']."?page=".($curpage-1)."&order=".$_GET["order"]."\" title=\"Previous Page\">&lt;</a> ";
}
else {
$page_list .= "<a href=\"".$_SERVER['PHP_SELF']."?page=".($curpage-1)."\" title=\"Previous Page\">&lt;</a> ";
}
}

/* Print the numeric page list; make the current page unlinked and bold */
for ($i=1; $i<=$pages; $i++)
{
if ($i == $curpage)
{
$page_list .= "<b>".$i."</b>";
}
else
{
if(isset($_GET["order"])) {
$page_list .= "<a href=\"".$_SERVER['PHP_SELF']."?page=".$i."&order=".$_GET["order"]."\" title=\"Page ".$i."\">".$i."</a>";
}
else {
$page_list .= "<a href=\"".$_SERVER['PHP_SELF']."?page=".$i."\" title=\"Page ".$i."\">".$i."</a>";
}
}
$page_list .= " ";
}

/* Print the Next and Last page links if necessary */
if (($curpage+1) <= $pages)
{
if(isset($_GET["order"])) {
$page_list .= "<a href=\"".$_SERVER['PHP_SELF']."?page=".($curpage+1)."&order=".$_GET["order"]."\" title=\"Next Page\">&gt;</a> ";
}
else {
$page_list .= "<a href=\"".$_SERVER['PHP_SELF']."?page=".($curpage+1)."\" title=\"Next Page\">&gt;</a> ";
}
}

if (($curpage != $pages) && ($pages != 0))
{
if(isset($_GET["order"])) {
$page_list .= "<a href=\"".$_SERVER['PHP_SELF']."?page=".$pages."&order=".$_GET["order"]."\" title=\"Last Page\">&raquo;</a> ";
}
else {
$page_list .= "<a href=\"".$_SERVER['PHP_SELF']."?page=".$pages."\" title=\"Last Page\">&raquo;</a> ";
}
}
$page_list .= " ";

return $page_list;
}
/***********************************************************************************
* string nextPrev (int curpage, int pages)
* Returns "Previous | Next" string for individual pagination (it's a word!)
***********************************************************************************/
function nextPrev($curpage, $pages)
{
$next_prev = "";

if (($curpage-1) <= 0)
{
$next_prev .= "Previous";
}
else
{
if(isset($_GET["order"])) {
$next_prev .= "<a href=\"".$_SERVER['PHP_SELF']."?page=".($curpage-1)."&order=".$_GET["order"]."\">Previous</a>";
}
else {
$next_prev .= "<a href=\"".$_SERVER['PHP_SELF']."?page=".($curpage-1)."\">Previous</a>";
}
}

$next_prev .= " | ";

if (($curpage+1) > $pages)
{
$next_prev .= "Next";
}
else
{
if(isset($_GET["order"])) {
$next_prev .= "<a href=\"".$_SERVER['PHP_SELF']."?page=".($curpage+1)."&order=".$_GET["order"]."\">Next</a>";
}
else {
$next_prev .= "<a href=\"".$_SERVER['PHP_SELF']."?page=".($curpage+1)."\">Next</a>";
}
}

return $next_prev;
}
}
?>