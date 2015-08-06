Суть задания
------------

Необходимо обработать файл *searches.csv* и показать результат в формате:

```
Word,Count,Total Broad Searches,Total Exact Searches
киев,30,28374,10040
окна,17,3827,1373
...
```

(числа могут быть другие)
При проверке скрипт будет запускаться из командной строки, поэтому можно не беспокоиться о html-форматировании или headers.

Значения колонок
----------------

* **Word** - слово из текста колонки "keyword" (например - "окна"). Слова нужно брать не целиком, а разбивать. То есть «пластиковые окна киев» - попадает и в «пластиковые», и в «окна» и в «киев».
* **Count** - во скольких строках это слово встречается в исходной колонке "keyword" (например - "100")
* **Total Broad Searches** - сумма значений колонки "Searches" для определённого слова (только для фраз без квадратных скобок)
* **Total Exact Searches** - сумма значений колонки "Searches" для определённого слова (только для фраз с квадратными скобками)


Пример
------

###input
```
окна киев,100
окна харьков,50
[окна киев],10
```

###output
```
Word,Count,Total Broad Searches,Total Exact Searches
окна,3,150,10
киев,2,100,10
харьков,1,50,0
```

Обязательно придерживаться стандартов [PSR-1](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md) и [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)

Использование
---------------
require 'Xparser.php'; 
$file = 'searches.csv';
  
$start = microtime(true);

$text = new Xparser ($file); 
$text->writeResults();//or you can get results by getResults
//for use from comand line write:
//php -r 'include "Xparser.php"; $c = new Xparser("searches.csv"); $c->writeResults();'

echo '<br>'.(microtime(true)-$start).'<hr><br>'; 