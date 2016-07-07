### Simple Query Builder

This is a simple OOP Query Builder for PHP and MySQL

Just do something like this
```
$builder = new SimpleQueryBuilder();
$builder->select('firstname')
    ->addSelect('lastname')
    ->from('users')
    ->orderBy('firstname','ASC');
```

Executing the resulting query is not supported yet. To get the query use
```
$builder->getQuery()
```

The code above will create the following sql query
```
SELECT firstname, lastname FROM users ORDER BY firstname ASC
```

Supported:
- select
- from
- where
- inner join
- left join
- limit and offset
- order by

TODO:
- support more mysql stuff
- execute queries and return the results