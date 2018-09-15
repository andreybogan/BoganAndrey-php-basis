<?php
header("Content-type: text/html; charset=utf-8");

// Задание 1.
$i = 0;
while ($i <= 100) {
  if ($i % 3 == 0) {
    echo $i . " ";
  }
  $i++;
}

echo "<br><br>-------------------------------------------------------------<br><br>";

// Задание 2.
$i = 0;
do {
  if ($i == 0) {
    echo $i . " - это ноль.<br>";
  } elseif ($i % 2 == 0) {
    echo $i . " - четное число.<br>";
  } else {
    echo $i . " - нечетное число.<br>";
  }
  $i++;
} while ($i <= 10);

echo "<br><br>-------------------------------------------------------------<br><br>";

// Задание 3.
$arrRegion = [
  "Московская область" => [
    "Москва",
    "Балашиха",
    "Домодедово",
    "Жуковский",
    "Клин",
    "Коломна",
  ],
  "Ленинградская область" => [
    "Санкт-Петербург",
    "Всеволожск",
    "Павловск",
    "Кронштадт",
    "Кингисепп",
    "Шлиссельбург",
  ],
  "Самарская область" => [
    "Самара",
    "Новокуйбышевск",
    "Сызрань",
    "Тольятти",
    "Кинель",
    "Чапаевск",
  ],
];

foreach ($arrRegion as $key => $value) {
  echo $key . "<br>";
  for ($i = 0; $i < count($value); $i++) {
    echo "&nbsp;&nbsp;&nbsp;&nbsp; {$value[$i]} <br>";
  }
}

echo "<br><br>-------------------------------------------------------------<br><br>";

// Задание 4.
/**
 * Функция выполняет транслитерацию строк с кирилицы на латиницу.
 * @param string $st - Исходная строка.
 * @return string Возвращается преобразованная строка.
 */
function transliterate($st) {
  $arrAlphabet = array(
    'а' => 'a', 'б' => 'b', 'в' => 'v',
    'г' => 'g', 'д' => 'd', 'е' => 'e',
    'ё' => 'e', 'ж' => 'zh', 'з' => 'z',
    'и' => 'i', 'й' => 'y', 'к' => 'k',
    'л' => 'l', 'м' => 'm', 'н' => 'n',
    'о' => 'o', 'п' => 'p', 'р' => 'r',
    'с' => 's', 'т' => 't', 'у' => 'u',
    'ф' => 'f', 'х' => 'h', 'ц' => 'c',
    'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',
    'ь' => '', 'ы' => 'y', 'ъ' => '',
    'э' => 'e', 'ю' => 'yu', 'я' => 'ya',

    'А' => 'A', 'Б' => 'B', 'В' => 'V',
    'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
    'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z',
    'И' => 'I', 'Й' => 'Y', 'К' => 'K',
    'Л' => 'L', 'М' => 'M', 'Н' => 'N',
    'О' => 'O', 'П' => 'P', 'Р' => 'R',
    'С' => 'S', 'Т' => 'T', 'У' => 'U',
    'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
    'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch',
    'Ь' => '', 'Ы' => 'Y', 'Ъ' => '',
    'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
  );
  // Инициализируем переменную в которую будем собирать преобразованную строку.
  $newString = null;
  // Разбиваем исходную строку на массив.
  $arrString = preg_split('//u', $st, null, PREG_SPLIT_NO_EMPTY);
  // Обходим массив в цикле и проверяем есть ли совпадения в массиве для замены.
  for ($i = 0; $i < count($arrString); $i++) {
    // Если совпадения есть, то меняем, если нет, то оставляем как есть.
    if (array_key_exists($arrString[$i], $arrAlphabet)) {
      $newString .= $arrAlphabet[$arrString[$i]];
    } else {
      $newString .= $arrString[$i];
    }
  }
  // Возвращаем преобразованную строку.
  return $newString;
}

$st = "Функция выполняет транслитерацию строк с кирилицы на латиницу.";
echo transliterate($st);

echo "<br><br>-------------------------------------------------------------<br><br>";

// Задание 5.
/**
 * Функция заменяет в строке пробелы на подчеркивания.
 * @param string $st - Исхоная строка.
 * @return string Возвращается преобразованная строка.
 */
function replaceSpaceToUnderline($st) {
  return str_replace(" ", "_", $st);
}

$st = "Функция заменяет в строке пробелы на подчеркивания.";
echo replaceSpaceToUnderline($st);

echo "<br><br>-------------------------------------------------------------<br><br>";

// Задание 6. Эмуляция двухуровневой навигации.
$navigation = [
  "О компании" => [
    "Наша миссия",
    "Сотрудники",
    "Партнеры",
  ],
  "Продукция" => [
    "Строительные материалы",
    "Оборудование",
    "Аксессуары",
  ],
  "Услуги" => [
    "Продажа",
    "Доставка",
    "Установка",
  ],
  "Наши координаты" => [],
];

foreach ($navigation as $key => $value) {
  echo "<div style='font-weight: bold;'>" . $key . "</div>";
  echo "<ul>";
  for ($i = 0; $i < count($value); $i++) {
    echo "<li>{$value[$i]} </li>";
  }
  echo "</ul>";
}

echo "<br><br>-------------------------------------------------------------<br><br>";

// Задание 7.
for ($i = 0; $i < 10; print $i . " ", $i++) {
  // здесь пусто
}

echo "<br><br>-------------------------------------------------------------<br><br>";

// Задание 8.
// Массив из регионов и городов береться из задания 3.
foreach ($arrRegion as $key => $value) {
  echo $key . "<br>";
  for ($i = 0; $i < count($value); $i++) {
    if (mb_eregi("^к", $value[$i])) {
      echo "&nbsp;&nbsp;&nbsp;&nbsp; {$value[$i]} <br>";
    }
  }
}

echo "<br><br>-------------------------------------------------------------<br><br>";

// Задание 9.
/**
 * Функция переводит сроку в латиницу и заменяет пробелы подчеркиванием.
 * @param string $value - Заданная строка.
 * @return string Возврщает преобразованную строку.
 */
function LatinAndUnderline($value) {
  // убираем пробелы вначали и в конце строки
  $value = trim($value);
  // выполняем транслитерацию (функция описана ранее)
  $value = transliterate($value);
  // переводим в нижний регистр
  $value = mb_strtolower($value);
  // заменяем пробелы на подчеркивание.
  $value = str_replace(" ", "_", $value);
  return $value;
}

$string = "Функция переводит сроку в латиницу и заменяет пробелы подчеркиванием.";
echo LatinAndUnderline($string);

echo "<br><br>-------------------------------------------------------------<br><br>";

// Задание 9 можно усовершенствовать и написать настоящую функцию которая переводи строку в человекочитаемый url.
/**
 * Функция переводит заданную строку в человекочитаемый url. Если написано неправильно, то приводится в правильный вид.
 * @param string $value - Заданная строка.
 * @return string Возврщает преобразованную строку.
 */
function urlFromString($value) {
  // убираем пробелы вначали и в конце строки
  $value = trim($value);
  // выполняем транслитерацию (функция описана ранее)
  $value = transliterate($value);
  // переводим в нижний регистр
  $value = mb_strtolower($value);
  // удаляем все символы за исключением a-z, 0-9, тире, подчеркиваний и пробелов
  $value = preg_replace('#[^-a-z0-9_ ]#', '', $value);
  // замена пробелов, дефисов и тире на один дефис
  $value = preg_replace('#[-_ ]+#', '-', $value);
  return $value;
}

$string = "Функция переводит заданную строку в человекочитаемый url.";
echo urlFromString($string);