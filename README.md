## [Backend] Vehicle fleet parking management [#1](https://github.com/inextensodigital/developers/blob/master/Backend/ddd-and-cqs-level-1.md) et [#2](https://github.com/inextensodigital/developers/blob/master/Backend/ddd-and-cqs-level-2.md)
### Démarrage
Si docker et docker-compose sont installés, le projet démarre grâce à make
```shell
make run
```
### Utilisation
Une fois démarré, les commandes à utiliser sont celles requises pour le test
```shell
./fleet create <userId> # returns fleetId on the standard output
./fleet register-vehicle <fleetId> <vehiclePlateNumber>
./fleet localize-vehicle <fleetId> <vehiclePlateNumber> lat lng [alt]
```
### Revue de code

Les commits sont atomiques et peuvent être lus dans l'ordre de réalisation demandé.
Je n'ai pas eu le temps d'écrire des tests ([PR en cours](https://github.com/nio-dtp/vehicle-fleet/pull/1)): l'idée est d'utiliser les features pour tester les commandes.
J'ai préféré me concentrer sur la prise en compte de la couche métier,
l'implémentation technique et la lisibilité du code.

## [Algo] Fizzbuzz [instructions](https://github.com/inextensodigital/developers/blob/master/Algo/fizzbuzz.md)
### Implémentation 
```php
<?php

declare(strict_types=1);

final class NumberDisplay
{
    public static function toFizzBuzz(int $number): void
    {
        $fizzBuzz = self::getFizzBuzz($number);
        echo($fizzBuzz ?? $number);
    }

    private static function getFizzBuzz(int $number): ?string
    {
        if($number % 15 === 0)  {
            return 'FizzBuzz';
        } elseif ($number % 5 === 0) {
            return 'Buzz';
        } elseif ($number % 3 === 0) {
            return 'Fizz';
        }

        return null;
    }
}

// Pour test
NumberDisplay::toFizzBuzz(975);

```
## [Algo] Custom number type [instructions](https://github.com/inextensodigital/developers/blob/master/Algo/custom-number-type-increment.md)
### Implémentation
```php
<?php

declare(strict_types=1);

final class CustomNumberType
{
    public static function increment(array $numbers): array
    {
        // on inverse le tableau
        $reversed = array_reverse($numbers);
        // on crée un tableau pour stocker le résultat
        $ordered = [];

        // tant qu'il reste des éléments à dépiler
        while (0 < count($reversed)) {
            $number = array_shift($reversed);
            // Si le tableau final est vide on ajoute 1 à la valeur courante
            if (empty($ordered)) {
                $number++;
            }
            // Si la valeur courante est 10, on la change en 0
            // puis on ajoute 1 à la valeur suivante si elle existe
            // ou on ajoute une valeur 1 s'il ne reste plus d'éléments à dépiler
            if (10 === $number) {
                $number = 0;
                $reversed[0] = 0 === count($reversed) ? 1 : $reversed[0] + 1;
            }
            // On ajoute la valeur courante au début du tableau final
            array_unshift($ordered, $number);
        }

        return $ordered;
    }
}

// Pour test
CustomNumberType::increment([9,9,9]);

```
