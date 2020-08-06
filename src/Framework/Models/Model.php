<?php

namespace Framework\Models;

use Framework\Contracts\ModelContract;

abstract class Model implements ModelContract
{
    /** @var array $rows */
    public $rows;

    /** @var array $fields */
    public $fields;

    /** @var array $errors */
    public $errors;

    /**
     * Model constructor.
     * @param $payload
     * @throws \Exception
     */
    public function __construct($payload)
    {
        $rows = [];
        $no = 0;
        foreach ($payload as $row) {
            if ($this->validateRow($row, $no)) {
                $rows[] = $row;
            }
            $no++;
        }
        $this->rows = $rows;
    }

    /**
     * @param $row
     * @param $no
     * @return mixed
     */
    public function validateRow($row, $no)
    {
        foreach ($this->fields as $k => $v) {
            if (!isset($row[$k]) && $v === 'required') {
                $this->errors[] = "invalid column on row $no, field $k";
                return false;
            }
            if (isset($row[$k]) && !$this->fields[$k]) {
                $this->errors[] = "invalid column on row $no, field $k";
                return false;
            }
        }

        return true;
    }

    /**
     * @param $field
     * @param $operator
     * @param null $value
     * @return ModelContract
     * @throws \Exception
     */
    public function where($field, $operator, $value = null)
    {
        if($value === null){
            $value = $operator;
            $operator = '=';
        }

        $newRows = [];
        foreach($this->rows as $row)
        {
            if($this->compare($operator,$row[$field],$value)){
                $newRows[] = $row;
            }
        }

        $this->rows = $newRows;

        return $this;
    }

    /**
     * @param $operator
     * @param $var1
     * @param $var2
     * @return bool
     * @throws \Exception
     */
    private function compare($operator, $var1, $var2){
        switch ($operator) {
            case "=": return $var1 == $var2;
            case "!=": return $var1 != $var2;
            case ">=": return $var1 >= $var2;
            case "<=": return $var1 <= $var2;
            case ">":  return $var1 >  $var2;
            case "<":  return $var1 <  $var2;
        }

        throw new \Exception('unknown operator on model');
    }

    /**
     * @return array
     */
    public function get()
    {
        return $this->rows;
    }

}
