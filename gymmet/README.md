## Gymmet

Du ska gå och träna på lokala gymmet men det värsta som finns är när alla vikter och maskiner är upptagna, så du vill gå när det är som minst folk där. Lyckligtvis har du all data som du behöver eftersom alla medlemmars in- och utloggningstider är fritt tillgängliga i följande format:

```
10:00 - 12:00 Karl Persson
10:30 - 11:30 Per Karlson
11:45 - 12:30 Sven Svensson 
```

Utmaning: skriv ett program som tar emot data i ovanstående format och returnerar ett eller fler tidsspann för när gymmet är som tommast.

---
## Lösningsexempel:
```php
<?php 

require 'vendor/autoload.php';

use Gymmet\Gymmet;
// Gymmet\Reader\ArrayReader can be used instead
use Gymmet\Reader\TxtFormatReader as Reader;
use Gymmet\Collection\WorkoutEventCollection as Collection;

$collection = new Collection();
$reader = new Reader();
$reader->setFile('trainingData.txt');
$gymmet = new Gymmet($reader, $collection, ["opening" => "10:00", "closing" => "14:00"]);

// workout duration (in minutes)
$duration = 40;

// check interval
$interval = 10;

// limit suggestions (default 10)
$limit = 10;

$suggestions = $gymmet->getTimeSuggestions($limit, $duration, $interval, 'ASC');

foreach ($suggestions as $suggestion) {
    printf("Start your workout at <strong>%s</strong> and finish it by <strong>%s</strong> and you'll meet %d other people at most.<br>", $suggestion['start']->format("H:i"), $suggestion['end']->format("H:i"), $suggestion['count']);
}
```
#### trainingData.txt
```
10:00 - 12:00 Karl Persson
10:30 - 11:30 Per Karlson
11:45 - 12:30 Sven Svensson
```

#### Exempel för "Gymmet\Reader\TxtFormatReader"
```php
<?php
//...
use Gymmet\Reader\ArrayReader as Reader;

$reader = new Reader([["10:00", "11:00], ["12:25", "14:20"]]);
```