<?php
  //  ------------------------------------------------------------------------ //
  //                                 txtDB                                     //
  //            Copyright (c) 2005 Vengeance, http://strefaphp.net             //
  //  ------------------------------------------------------------------------ //
  //                                                                           //
  //    This library is free software; you can redistribute it and/or          //
  //    modify it under the terms of the GNU Lesser General Public             //
  //    License as published by the Free Software Foundation; either           //
  //    version 2.1 of the License, or (at your option) any later version.     //
  //                                                                           //
  //    This library is distributed in the hope that it will be useful,        //
  //    but WITHOUT ANY WARRANTY; without even the implied warranty of         //
  //    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU      //
  //    Lesser General Public License for more details.                        //
  //                                                                           //
  //    You should have received a copy of the GNU Lesser General Public       //
  //    License along with this library; if not, write to the Free Software    //
  //    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA//
  //  ------------------------------------------------------------------------ //
/**
*  Glowna klasa obslugujaca tekstowa baze danych.
*  @author Vengeance <vengeance@strefaphp.net>
*  @link http://strefaphp.net
*  @copyright Copyright (c) Vengeance 2005
*  @package txtDB
*  @version 1.1
*/

define('TXTDB_DIR', dirname(__FILE__));
define('DATABASE_DIR', dirname(__FILE__) . '/data/');
define('STRUCT_FILE_EXT', '.struct');
define('TABLE_FILE_EXT', '.table');
require TXTDB_DIR . '/querys.class.php';

   class txtDB
   {
      var $baseName;
      var $basePassword;
      var $tables;
      var $errorLog = array();

      function connect($baseName, $basePassword)
      {
         if(!is_dir(DATABASE_DIR.$baseName))
            die("[txtDB] <b>Krytyczny</b>: Katalog bazy danuch ($baseName) nie istnieje.");
         $this->baseName = $baseName;
         $this->basePassword = $basePassword;
         return true;
      }

      function &query($queryObject)
      {
         if(!is_object($queryObject))
            die("[txtDB] <b>Krytyczny</b>: Niepoprawna konstrukcja zapytania.");
         switch(strtolower(get_class($queryObject)))
         {
            case 'txtdb_selectquery':
               return new txtdb_Result($queryObject->execute($this));
               break;
            case 'txtdb_insertquery':
               return $queryObject->execute($this);
               break;
            case 'txtdb_updatequery':
               return $queryObject->execute($this);
               break;
            case 'txtdb_deletequery':
               return $queryObject->execute($this);
               break;
            case 'txtdb_createquery':
               return $queryObject->execute($this);
               break;
            case 'txtdb_dropquery':
               return $queryObject->execute($this);
               break;
            default:
               return $queryObject->execute($this);
               break;
         }
      }

      function createBase($baseName)
      {
         if(file_exists(DATABASE_DIR . '/' . $baseName))
         {
            $this->error("[txtDB] <b>Ostrze¿enie</b>: Baza ($baseName) ju¿ istnieje i nie mo¿e zostaæ nadpisana.");
            return false;
         }
         if(!mkdir(DATABASE_DIR . '/' . $baseName))
         {
            $this->error("[txtDB] <b>Ostrze¿enie</b>: Utworzenie bazy ($baseName) nie powiod³o siê.");
            return false;
         }
         else
            return true;
      }

      function dropBase($baseName)
      {
         if(!file_exists(DATABASE_DIR . '/' . $baseName))
         {
            $this->error("[txtDB] <b>Ostrze¿enie</b>: Baza ($baseName) nie istnieje.");
            return false;
         }
         if(!rmdir(DATABASE_DIR . '/' . $baseName))
         {
            $this->error("[txtDB] <b>Ostrze¿enie</b>: Usuniêcie bazy ($baseName) nie powiod³o siê.");
            return false;
         }
         else
            return true;
      }

      function error($errorString)
      {
         $this->errorLog[] = $errorString;
      }

      function getErrorLog()
      {
         return $this->errorLog;
      }

      function getLastError()
      {
         return $this->errorLog[count($this->errorLog)];
      }

      function &getTable($tableName)
      {
         if(!isset($this->tables[$tableName]))
         {
            return $this->tables[$tableName] = new txtdb_Table($tableName, $this->baseName);
         }
         else
         {
            if(is_object($this->tables[$tableName]))
               return $this->tables[$tableName];
            else
               return $this->tables[$tableName] = new txtdb_Table($tableName, $this->baseName);
         }
      }
   }

   class txtdb_Table
   {
      var $tableName;
      var $structFile;
      var $tableFile;

      var $struct;
      var $records;

      function txtdb_Table($tableName, $baseName)
      {
         /** ustawienie potrzebnych sciezek */
         $this->tableName = $tableName;
         $this->structFile = $structFile = DATABASE_DIR.$baseName.'/'.$tableName.STRUCT_FILE_EXT;
         $this->tableFile = $tableFile = DATABASE_DIR.$baseName.'/'.$tableName.TABLE_FILE_EXT;

         /** czy pliki istnieja ? */
         if(!file_exists($structFile))
            die("[txtDB] <b>Krytyczny</b>: Plik struktury tabeli ($structFile) nie istnieje.");
         if(!file_exists($tableFile))
            die("[txtDB] <b>Krytyczny</b>: Plik danych tabeli ($tableFile) nie istnieje.");

         /** pobranie danych z plikow > zserializowanych tablic */
         $structFileContent = @unserialize(file_get_contents($structFile));
         $tableFileContent = @unserialize(file_get_contents($tableFile));

         /** sprawdzenie czy dane z plikow nie sa uszkodzone */
         if(!is_array($structFileContent))
            die("[txtDB] <b>Krytyczny</b>: Plik struktury tabeli ($structFile) uszkodzony.");
         if(!is_array($tableFileContent))
            die("[txtDB] <b>Krytyczny</b>: Plik danych tabeli ($tableFile) uszkodzony.");

         /** zapisanie pobranych danych tabeli */
         $this->struct = $structFileContent;
         $this->records = $tableFileContent;
      }

      function save()
      {
         if($fp = fopen($this->tableFile, 'w'))
         {
            flock($fp, LOCK_EX);
            fwrite($fp, serialize($this->records));
            flock($fp, LOCK_UN);
            fclose($fp);
            return true;
         }
         else
            return false;
      }

      function getStructArray()
      {
         return $this->struct;
      }

      function getRecordsArray()
      {
         return $this->records;
      }
   }

   class txtdb_Result
   {
      var $data = array();
      var $iterator = 0;

      function txtdb_Result($dataArray)
      {
         if(is_array($dataArray))
         {
            $this->data = $dataArray;
         }
      }

      function fetch()
      {
         list($k, $v) = each($this->data);
         return $v;
      }

      function reset()
      {
         reset($this->data);
         return true;
      }

      function count()
      {
         return count($this->data);
      }
   }

   function array_compare($patternArray, $sampleArray)
   {
      $patternValues = array_values($patternArray);
      $sampleKeys = array_keys($sampleArray);

      sort($patternValues);
      sort($sampleKeys);

      $patternString = join(' ', $patternValues);
      $sampleString = join(' ', $sampleKeys);

      if($patternString == $sampleString)
         return true;
      else
         return false;
   }
?>
