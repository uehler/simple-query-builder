<?php

namespace SimpleQueryBuilder;

class SimpleQueryBuilder
{
    protected $select;
    protected $from;
    protected $where = '';
    protected $join = '';
    protected $order = '';
    protected $limit;


    public function select($select)
    {
        $this->select = 'SELECT ' . $select;

        return $this;
    }


    public function addSelect($select)
    {
        $this->select .= ', ' . $select;

        return $this;
    }


    public function from($from)
    {
        $this->from = ' FROM ' . $from;

        return $this;
    }


    public function innerJoin($table, $cond)
    {
        $this->join('INNER', $table, $cond);

        return $this;
    }


    public function leftJoin($table, $cond)
    {
        $this->join('LEFT', $table, $cond);

        return $this;
    }


    public function join($type, $table, $cond)
    {
        $this->join .= ' ' . $type . ' JOIN ' . $table . ' ON ' . $cond;

        return $this;
    }


    public function where($where)
    {
        $this->where = ' WHERE ' . $where;

        return $this;
    }


    public function andWhere($where)
    {
        $this->addWhere($where, 'AND');

        return $this;
    }


    public function orWhere($where)
    {
        $this->addWhere($where, 'OR');

        return $this;
    }


    protected function addWhere($where, $type = '')
    {
        $this->where .= ' ' . $type . ' ' . $where;
    }


    public function orderBy($field, $sort)
    {
        $this->order = ' ORDER BY ' . $field . ' ' . $sort;

        return $this;
    }


    public function addOrderBy($field, $sort)
    {
        $this->order .= ' ' . $field . ' ' . $sort;

        return $this;
    }


    public function limit($limit, $offset = '')
    {
        if ($offset != '') {
            $offset .= ', ';
        }
        $this->limit = ' LIMIT ' . $offset . $limit;

        return $this;
    }


    public function getQuery()
    {
        return $this->select . '
        ' . $this->from . '
        ' . $this->join . '
        ' . $this->where . '
        ' . $this->order . '
        ' . $this->limit;
    }
}