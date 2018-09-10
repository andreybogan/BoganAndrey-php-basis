<?php
header("Content-type: text/html; charset=utf-8");

// Задание 1.

$a = (int)6.6;
$b = (int)12;
if ($a >= 0 && $b >= 0) {
  echo $a - $b;
} elseif ($a < 0 && $b < 0) {
  echo $a * $b;
} elseif (($a < 0 && $b >= 0) || ($a >= 0 && $b < 0)) {
  echo $a + $b;
}

// Задание 3.

/**
 * Функция выполняет сложениу двух чисел.
 * @param number $par1 - Первое число.
 * @param number $par2 - Второе число.
 * @return number Сумма первого и второго числа.
 */
function addition($par1, $par2) {
  return $par1 + $par2;
}

/**
 * Функция выполняет выичитание из первого числа второго.
 * @param number $par1 - Первое число.
 * @param number $par2 - Второе число.
 * @return number Результат вычитания из первого числа второго.
 */
function subtraction($par1, $par2) {
  return $par1 - $par2;
}

/**
 * Функция выполняет умножение чисел.
 * @param number $par1 - Первое число.
 * @param number $par2 - Второе число.
 * @return number Результат умножения первого числа на второе.
 */
function multiplication($par1, $par2) {
  return $par1 * $par2;
}

/**
 * Функция выполняет деление первого числа на второе.
 * @param number $par1 - Первое число.
 * @param number $par2 - Второе число.
 * @return number|string Результат деления первого числа на второе.
 */
function division($par1, $par2) {
  if ($par2 == 0) {
    return "Деление на ноль невозможно.";
  }
  return $par1 / $par2;
}

// Задание 4.

/**
 * Функция выполняет одну из математических операция (+, -, *, /) над двумя заданными числами.
 * @param number $par1 - Первое число.
 * @param number $par2 - Второе число.
 * @param string $operation - Строка с названием операций: +, -, *, /.
 * @return number|string Результат выполнения операций.
 */
function mathOperation($par1, $par2, $operation) {
  switch ($operation) {
    case "+":
      return addition($par1, $par2);
      break;
    case "-":
      return subtraction($par1, $par2);
      break;
    case "*":
      return multiplication($par1, $par2);
      break;
    case "/":
      return division($par1, $par2);
      break;
    default:
      return "Могут использовать только следующие операции: +, -, *, /.";
  }
}

// Задание 6.

/**
 * Функция возводит заданное числов в степень. Степень может быть только натуральным числом (1, 2, 3 и т.д.).
 * @param int $val - Заданное число.
 * @param int $pow - Степень в которую будем возводить заданное число.
 * @return float|int|string Возвращает результат возведения в степень или возвращает false в случае ошибки.
 */
function power($val, $pow) {
  // Проверяем является степень натуральным числом.
  if ($pow < 1 || !is_int($pow)) {
    return false;
  }
  // Если степень равна 1, то возвращаем заднное число.
  if ($pow == 1) {
    return $val;
  }
  return $val * power($val, $pow - 1);
}

// Задание 7.

/**
 * Функция принимает числительное и массив из слова в трех вариантах склонения,
 * и возвращает слово в нужном склонении для использования с заданным числительным.
 * @param number $num - Числительное для которого будет выбираться слово с нужным склонением.
 * @param array $arrWords - Массив из трех элементов. Слово в трех склонениях для использования с числительными.
 * Напримерм: ['рубль', 'рубля', 'рублей'], ['кошка', 'кошки', 'кошек'] или ['год', 'года', 'лет'].
 * @return string Возвращается искомое слово.
 */
function getDeclination($num, $arrWords) {
  // Получаем последнюю цифру числа.
  $lastNum = $num % 10;
  // Получаем вторую с конца цифру у заданного числа.
  $lastNum2 = floor($num / 10) % 10;

  if ($lastNum != 1 && $lastNum != 2 && $lastNum != 3 && $lastNum != 4) {
    return $arrWords[2];
  } else if ($lastNum == 1) {
    if ($lastNum2 != 1) {
      return $arrWords[0];
    }
    return $arrWords[2];
  } else {
    if ($lastNum2 != 1) {
      return $arrWords[1];
    }
    return $arrWords[2];
  }
}

/**
 * Функция вычисляет текущее время и возвращает его в нужном формате использую функцию getDeclination() для правильного
 * склонения слов: часы и минуты.
 * @return string Возвращает текущее время в формате 22 часа 15 минут.
 */
function currentTime() {
  $hour = date("G");
  $minute = date("i");
  return $hour . " " . getDeclination((int)$hour, ['час', 'часа', 'часов']) . " " . $minute . " " .
    getDeclination((int)$minute, ['минута', 'минуты', 'минут']);
}

echo "<br>";
echo "Текущее время " . currentTime();
echo "<br>";