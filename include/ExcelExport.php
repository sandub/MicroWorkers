<?php
/*
Usage
****************************************************************************************
require_once "ExcelExport.php";
 
$xls = new ExcelExport();
 
$xls->addRow(Array("First Name","Last Name","Website","ID"));
$xls->addRow(Array("james","lin","www.chumby.net",0));
$xls->addRow(Array("bhaven","mistry","www.mygumballs.com",1));
$xls->addRow(Array("erica","truex","www.wholegrainfilms.com",2));
$xls->addRow(Array("eliot","gann","www.dissolvedfish.com",3));
$xls->addRow(Array("trevor","powell","gradius.classicgaming.gamespy.com",4));
$xls->download("websites.xls");
*******************************************************************************************
*/

class ExcelExport {
   var $file;
   var $row;

   function ExcelExport() {
      $this->file = $this->__BOF();
      $row = 0;
   }

   function __BOF() {
       return pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
   }

   function __EOF() {
       return pack("ss", 0x0A, 0x00);
   }

   function __writeNum($row, $col, $value) {
       $this->file .= pack("sssss", 0x203, 14, $row, $col, 0x0);
       $this->file .= pack("d", $value);
   }

   function __writeString($row, $col, $value ) {
       $L = strlen($value);
       $this->file .= pack("ssssss", 0x204, 8 + $L, $row, $col, 0x0, $L);
       $this->file .= $value;
   }
   
   function writeCell($value,$row,$col) {
      if(is_numeric($value)) {
         $this->__writeNum($row,$col,$value);
      }elseif(is_string($value)) {
         $this->__writeString($row,$col,$value);
      }
   }
   
   function addRow($data,$row=null) {
      //If the user doesn't specify a row, use the internal counter.
      if(!isset($row)) {
         $row = $this->row;
         $this->row++;
      }
      for($i = 0; $i<count($data); $i++) {
         $cell = $data[$i];
         $this->writeCell($cell,$row,$i);
      }
   }

   function download($filename) {
      header("Pragma: public");
      header("Expires: 0");
      header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
      header("Content-Type: application/force-download");
      header("Content-Type: application/octet-stream");
      header("Content-Type: application/download");;
      header("Content-Disposition: attachment;filename=$filename ");
      header("Content-Transfer-Encoding: binary ");
      $this->write();
   }
   
   function write() {
      echo $file = $this->file.$this->__EOF();
   }
}