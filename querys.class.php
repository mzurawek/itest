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
*  Plik zawiera definicje wszystkich najpotrzebniejszych zapytan
*  @author Vengeance <vengeance@strefaphp.net>
*  @link http://strefaphp.net
*  @copyright Copyright (c) Vengeance 2005
*  @package txtDB
*  @version 1.1
*/

   class txtdb_Query
   {
      function execute()
      {

      }
   }

   class txtdb_SelectQuery extends txtdb_Query
   {
      var $what;
      var $from;
      var $where = '';
      var $order = array('collumn' => null, 'type' => null);
      var $limit = array('offset' => null, 'length' => null);

      function txtdb_SelectQuery($what, $from, $where='', $order='', $limit='')
      {
         if(is_array($what))
            $this->what  = $what;
         else
            $this->what = array();

         $this->from  = $from;

         if(!empty($where))
         {
            $this->where = preg_replace('/\$(\w+)/', '$inputRecordArray[\'\\1\']', $where);
         }

         if(!empty($order))
         {
            list($this->order['collumn'], $this->order['type']) = explode(' ', $order);
         }
         else
         {
            $this->order = false;
         }

         if(strpos($limit, ','))
            list($this->limit['offset'], $this->limit['length']) = explode(',', $limit);
         elseif(!empty($limit))
            list($this->limit['offset'], $this->limit['length']) = array(0, $limit);
         else
            $this->limit = false;
      }

      function execute(&$txtdb)
      {
         $tableData =& $txtdb->getTable($this->from);
         $resultData = $tableData->getRecordsArray();
         if(!empty($this->where))
            $resultData = array_filter($resultData, array(&$this, '_where'));

         if($this->order)
         {
            if(in_array($this->order['collumn'], $tableData->getStructArray()))
            {
               $this->_order($resultData);
            }
            else
            {
               $txtdb->error("[txtDB] <b>Ostrze¿enie</b>: Kolumny tabeli ($this->from) nie zgadzaj¹ siê z podanymi przez u¿ytkownika.");
               return false;
            }
         }

         if($this->limit)
            $resultData = $this->_limit($resultData);

         if(count($this->what) <> 0)
         {
            $this->difference = array_diff($tableData->getStructArray(), $this->what);
            $resultData = array_map(array(&$this, '_what'), $resultData);
         }

         return $resultData;
      }

      function _what($inputRecordArray)
      {
         foreach($this->difference as $key)
         {
            unset($inputRecordArray[$key]);
         }
         return $inputRecordArray;
      }

      function _where($inputRecordArray)
      {
         return eval('if('.$this->where.') return true; else return false;');
      }

      function _order(&$inputRecordArray)
      {
            switch(strtoupper($this->order['type']))
            {
               case 'ASC':
                  usort($inputRecordArray, array(&$this, '_order_asc'));
                  break;
               case 'DESC':
                  usort($inputRecordArray, array(&$this, '_order_desc'));
                  break;
            }
      }

      function _limit($inputDataArray)
      {
         return array_slice($inputDataArray, $this->limit['offset'], $this->limit['length']);
      }

      function _order_asc($a, $b)
      {
         return strnatcasecmp($a[$this->order['collumn']], $b[$this->order['collumn']]);
      }

      function _order_desc($a, $b)
      {
         $ret = strnatcasecmp($a[$this->order['collumn']], $b[$this->order['collumn']]);
         switch($ret)
         {
            case $ret < 0:
               return 1;
               break;
            case $ret > 0:
               return -1;
               break;
            case $ret == 0:
               return 0;
               break;
         }
      }
   }

   class txtdb_DeleteQuery extends txtdb_Query
   {
      var $tableName;
      var $tableWhere='';

      function txtdb_DeleteQuery($tableName, $where='')
      {
         $this->tableName = $tableName;
         if(!empty($where))
         {
            $this->tableWhere = preg_replace('/\$(\w+)/', '$inputRecordArray[\'\\1\']', $where);
         }
      }

      function execute(&$txtdb)
      {
         $tableData =& $txtdb->getTable($this->tableName);
         $tableData->records = array_filter($tableData->getRecordsArray(), array(&$this, '_where'));
         if($tableData->save())
            return true;
         else
         {
            $txtdb->error("[txtDB] <b>Ostrze¿enie</b>: Dane nie mog³by byæ zapisane do tabeli ($this->tableName) z nieznanej przyczyny.");
            return false;
         }
      }

      function _where($inputRecordArray)
      {
         return eval('if('.$this->tableWhere.') return false; else return true;');
      }
   }

   class txtdb_InsertQuery extends txtdb_Query
   {
      var $tableName;
      var $tableArray;

      function txtdb_InsertQuery($tableName, $tableArray)
      {
         $this->tableName = $tableName;
         $this->tableArray = $tableArray;
      }

      function execute(&$txtdb)
      {
         $tableData =& $txtdb->getTable($this->tableName);
         if(array_compare($tableData->getStructArray(), $this->tableArray))
         {
            $tableData->records[] = $this->tableArray;
            $tableData->save();
            return true;
         }
         else
         {
            $txtdb->error("[txtDB] <b>Ostrze¿enie</b>: Kolumny tabeli ($this->tableName) nie zgadzaj¹ siê z podanymi przez u¿ytkownika.");
            return false;
         }
      }
   }

   class txtdb_UpdateQuery extends txtdb_Query
   {
      var $tableName;
      var $replaceArray=array();
      var $tableWhere='';

      function txtdb_UpdateQuery($tableName, $replaceArray, $where='')
      {
         $this->tableName = $tableName;
         if(is_array($replaceArray))
            $this->replaceArray = $replaceArray;

         if(!empty($where))
         {
            $this->tableWhere = preg_replace('/\$(\w+)/', '$inputRecordArray[\'\\1\']', $where);
         }
      }

      function execute(&$txtdb)
      {
         $tableData =& $txtdb->getTable($this->tableName);
         $tableData->records = array_map(array(&$this, '_where'), $tableData->getRecordsArray());
         if($tableData->save())
            return true;
         else
         {
            $txtdb->error("[txtDB] <b>Ostrze¿enie</b>: Dane nie mog³by byæ zapisane do tabeli ($this->tableName) z nieznanej przyczyny.");
            return false;
         }
      }

      function _where($inputRecordArray)
      {
         $check = eval('if('.$this->tableWhere.') return true; else return false;');
         if($check)
         {
            foreach($this->replaceArray as $key => $value)
            {
               $inputRecordArray[$key] = $value;
            }

         }
         return $inputRecordArray;
      }
   }

   /** Tworzy nowa tabele o ustalonych kolumnach */
   class txtdb_CreateQuery extends txtdb_Query
   {
      var $tableName;
      var $structFile;
      var $tableFile;
      var $tableArray;

      function txtdb_CreateQuery($tableName, $tableArray)
      {
         $this->tableName = $tableName;
         $this->tableArray = $tableArray;
      }

      function execute(&$txtdb)
      {
         $this->structFile = DATABASE_DIR.$txtdb->baseName.'/'.$this->tableName.STRUCT_FILE_EXT;
         $this->tableFile = DATABASE_DIR.$txtdb->baseName.'/'.$this->tableName.TABLE_FILE_EXT;
         if(file_exists($this->structFile) AND file_exists($this->tableFile))
         {
            $txtdb->error("[txtDB] <b>Ostrze¿enie</b>: Tabela ($this->tableName) ju¿ istnieje.");
            return;
         }
         if(!is_array($this->tableArray))
         {
            $txtdb->error("[txtDB] <b>Ostrze¿enie</b>: Niepoprawna sk³adnia struktury tabeli.");
            return;
         }
         if($fp = fopen($this->structFile, 'w+') AND $fp2 = fopen($this->tableFile, 'w+'))
         {
            flock($fp, LOCK_EX);
            fwrite($fp, serialize($this->tableArray));
            flock($fp, LOCK_UN);
            fclose($fp);

            $a = array();
            flock($fp2, LOCK_EX);
            fwrite($fp2, serialize($a));
            flock($fp2, LOCK_UN);
            fclose($fp2);
            return true;
         }
         else
            return false;
      }
   }

   /** Usuwa wskazana poprzez nazwe tabele */
   class txtdb_DropQuery extends txtdb_Query
   {
      var $tableName;
      var $structFile;
      var $tableFile;

      function txtdb_DropQuery($tableName)
      {
         $this->tableName = $tableName;
      }

      function execute(&$txtdb)
      {
         $this->structFile = DATABASE_DIR.$txtdb->baseName.'/'.$this->tableName.STRUCT_FILE_EXT;
         $this->tableFile = DATABASE_DIR.$txtdb->baseName.'/'.$this->tableName.TABLE_FILE_EXT;
         if(!file_exists($this->structFile))
         {
            $txtdb->error("[txtDB] <b>Ostrze¿enie</b>: Plik struktury tabeli ($this->structFile) nie istnieje.");
            return;
         }
         if(!file_exists($this->tableFile))
         {
            $txtdb->error("[txtDB] <b>Ostrze¿enie</b>: Plik danych tabeli ($this->tableFile) nie istnieje.");
            return;
         }
         if(@unlink($this->structFile) AND @unlink($this->tableFile))
            return true;
         else
            return false;
      }
   }
?>
