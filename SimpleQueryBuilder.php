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


    public function select(string $select, string $alias = null): SimpleQueryBuilder
    {
        $this->select = 'SELECT ' . $select;

        if ($alias !== null) {
            $this->select .= ' as ' . $alias;
        }

        return $this;
    }


    public function addSelect(string $select, string $alias = null): SimpleQueryBuilder
    {
        $this->select .= ', ' . $select;

        if ($alias !== null) {
            $this->select .= ' as ' . $alias;
        }

        return $this;
    }


    public function from(string $from, string $alias = null): SimpleQueryBuilder
    {
        $this->from = ' FROM `' . $from . '` ' . $alias;

        return $this;
    }


    public function innerJoin(string $table, string $cond, string $alias = null): SimpleQueryBuilder
    {
        $this->join('INNER', $table, $cond, $alias);

        return $this;
    }


    public function leftJoin(string $table, string $cond, string $alias = null): SimpleQueryBuilder
    {
        $this->join('LEFT', $table, $cond, $alias);

        return $this;
    }


    public function join(string $type, string $table, string $cond, string $alias): SimpleQueryBuilder
    {
        $this->join .= ' ' . $type . ' JOIN `' . $table . '` ' . $alias . ' ON ' . $cond;

        return $this;
    }


    public function where(string $where): SimpleQueryBuilder
    {
        $this->where = ' WHERE ' . $where;

        return $this;
    }


    public function andWhere(string $where): SimpleQueryBuilder
    {
        $this->addWhere($where, 'AND');

        return $this;
    }


    public function orWhere(string $where): SimpleQueryBuilder
    {
        $this->addWhere($where, 'OR');

        return $this;
    }


    protected function addWhere(string $where, string $type = ''): SimpleQueryBuilder
    {
        $this->where .= ' ' . $type . ' ' . $where;

        return $this;
    }


    public function orderBy(string $field, string $sort): SimpleQueryBuilder
    {
        $this->order = ' ORDER BY ' . $field . ' ' . $sort;

        return $this;
    }


    public function addOrderBy(string $field, string $sort): SimpleQueryBuilder
    {
        $this->order .= ', ' . $field . ' ' . $sort;

        return $this;
    }


    public function limit(string $limit, string $offset = ''): SimpleQueryBuilder
    {
        if ($offset != '') {
            $offset .= ', ';
        }

        $this->limit = ' LIMIT ' . $offset . $limit;

        return $this;
    }


    public function getQuery(): string
    {
        return $this->select . '
        ' . $this->from . '
        ' . $this->join . '
        ' . $this->where . '
        ' . $this->order . '
        ' . $this->limit;
    }
}