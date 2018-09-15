<?php
// Инициализируем первичные настройки: размеры поля,
// начальные и конечные координаты путешественника и его направление.
$settings = [
  'rowsCount' => 10,
  'colsCount' => 10,
  'endPoint' => 'x5_y0',
  'comment' => 'И так, путешествие начинается. Иду прямо.'
];
// Инициализируем координаты путешественника.
$currentPoint = 'x5_y10';
// Инициализируем направление путешественника.
$direction = 'up';

// Определяем координаты стен лабиринта.
$walls = [
  'x1_y1', 'x2_y1', 'x3_y1', 'x4_y1', 'x6_y1', 'x7_y1', 'x8_y1', 'x9_y1', 'x10_y1',
  'x1_y2', 'x2_y2', 'x6_y2', 'x8_y2', 'x9_y2', 'x10_y2',
  'x1_y3', 'x2_y3', 'x4_y3', 'x5_y3', 'x8_y3', 'x10_y3',
  'x1_y4', 'x7_y4', 'x8_y4', 'x10_y4',
  'x1_y5', 'x2_y5', 'x3_y5', 'x4_y5', 'x6_y5', 'x10_y5',
  'x1_y6', 'x3_y6', 'x6_y6', 'x8_y6', 'x9_y6', 'x10_y6',
  'x1_y7', 'x5_y7', 'x6_y7', 'x10_y7',
  'x1_y8', 'x3_y8', 'x4_y8', 'x5_y8', 'x6_y8', 'x8_y8', 'x10_y8',
  'x1_y9', 'x8_y9', 'x10_y9',
  'x1_y10', 'x2_y10', 'x3_y10', 'x4_y10', 'x6_y10', 'x7_y10', 'x8_y10', 'x9_y10', 'x10_y10',
];

/**
 * Функция прорисовывает карту путешественника.
 * @param array $settings - Настройки.
 * @param array $walls - Массив с координатами стен лабиринта.
 * @param string $currentPoint - Текущие коорданаты путешественника.
 * @param string $direction - Текущее направление путешественника.
 */
function render($settings, $walls, &$currentPoint, &$direction) {
  // Используя цикл прорисовываем карту.
  echo "<table class='map'>";
  for ($i = 0; $i < $settings['rowsCount']; $i++) {
    echo "<tr>";
    for ($j = 0; $j < $settings['colsCount']; $j++) {
      // Определяем координаты текущей ячейки в виде строки (x1_y1).
      $currentCell = coordinateInString($j, $i);
      // По умолчанию у ячейки нет класса.
      $class = "";
      // По умолчанию ячейка пустая.
      $fillCell = "";
      // Если координяты ячейки совпадают с коориданатами стены лабиринта, добавляем класс стены.
      // Если координаты ячейки совпадают с координатами путешественника добавляем класс путешественника.
      // В противном случае класс не добавляется.
      if (is_walls($currentCell, $walls)) {
        $class = "class='wall'";
      } elseif (is_traveler($currentCell, $currentPoint)) {
        $fillCell = "<div class='traveler " . $direction . "'></div>";
      }
      echo "<td {$class}>$fillCell</td>";
    }
    echo "</tr>";
  }
  echo "</table>";
  // Поиснительный текст.
  $arrMyCoordinate =  coordinateStringInArr($currentPoint);
  echo "<div class='comment1'>Мои координаты: x: {$arrMyCoordinate['x']}, y: {$arrMyCoordinate['y']}, двигаюсь: {$direction} </div>";
  // Определяем следующие координаты путешественника.
  nextStep($currentPoint, $direction, $walls, $settings);
  // Продолжение пояснительного текста.
  echo "<div class='comment2'>{$settings['comment']}</div>";
  echo "<div class='comment3'>---------------------------------------------------------------------</div>";
}

/**
 * Функция преобразует координаты в строковый вид (x1_y1).
 * @param int $x - Значение координаты x.
 * @param int $y - Значение координаты y.
 * @return string Возвращается строковое преставление координат в виде x1_y1.
 */
function coordinateInString($x, $y) {
  return "x" . (++$x) . "_y" . (++$y);
}

/**
 * Функция преобразует координаты из строки в массив, типа ['x' => 1, 'y' => 1].
 * @param string $currentPoint - Передаваемые координаты в строковом виде.
 * @return array Возвращаются координаты в виде массива.
 */
function coordinateStringInArr($currentPoint) {
  $arr = explode('_', $currentPoint);
  return ['x' => substr($arr[0], 1), 'y' => substr($arr[1], 1)];
}

/**
 * Функция проверяем сопадение координат текущей ячейки с координатами стен лабиринта.
 * @param string $currentCell - Координаты текущей ячейки.
 * @param array $walls - Массив с координатами стен лабиринта.
 * @return bool Если координаты совпадают, то возвращается true, иначе false.
 */
function is_walls($currentCell, $walls) {
  return in_array($currentCell, $walls);
}

/**
 * Функция проверяем сопадение координат текущей ячейки с координатами путешественника.
 * @param string $currentCell - Координаты текущей ячейки.
 * @param string $currentPoint - Текущие коорданаты путешественника.
 * @return bool Если координаты совпадают, то возвращается true, иначе false.
 */
function is_traveler($currentCell, $currentPoint) {
  if ($currentCell == $currentPoint) {
    return true;
  }
}

/**
 * Функция определяет следующие координаты и направление путешественника.
 * @param string $currentPoint - Текущие коорданаты путешественника.
 * @param string $direction - Текущее направление путешественника.
 * @param array $walls - Массив с координатами стен лабиринта.
 * @param array $settings - Настройки.
 */
function nextStep(&$currentPoint, &$direction, $walls, &$settings) {
  // Определяем координаты следующей клетки текущего направления.
  $nextCoordinate = nextCoordinateDirection($currentPoint, $direction);
  // Определяем координаты клетки справа от текущей.
  $nextCoordinateRight = nextCoordinateDirection($currentPoint, directionRightHand($direction));
  // Определяем можем ли двигаться вперед, если нет, то переопределить направление в переменной,
  // а если можем то меняем текущие координаты на координаты следующей клетки текущего направления.
  setCoordinatesAndDirection($currentPoint, $direction, $nextCoordinate, $nextCoordinateRight, $walls, $settings);

}

/**
 * Функция переопределяет коорданаты и направления для следующего шага.
 * @param string $currentPoint - Текущие коорданаты путешественника.
 * @param string $direction - Текущее направление путешественника.
 * @param string $nextCoordinate - Координаты следующей клетки текущего направления.
 * @param string $nextCoordinateRight - Координаты клетки справа от текущей.
 * @param array $walls - Массив с координатами стен лабиринта.
 * @param array $settings - Настройки.
 */
function setCoordinatesAndDirection(&$currentPoint, &$direction, $nextCoordinate, $nextCoordinateRight, $walls, &$settings) {
  // Определяем есть ли стена впереди.
  $wallNext = is_walls($nextCoordinate, $walls);
  // Определяем есть ли стена справа.
  $wallNextRight = is_walls($nextCoordinateRight, $walls);
  // Определяем направление движения и координаты.
  if ($wallNext && $wallNextRight) {
    $direction = directionLeftHand($direction);
    $settings['comment'] = 'Передо мной и справа стена, иду влево.';
  } elseif ($wallNext && !$wallNextRight) {
    $direction = directionRightHand($direction);
    $currentPoint = $nextCoordinateRight;
    $settings['comment'] = 'Передо мной стена, справо есть проход. Иду направо.';
  } elseif (!$wallNext && !$wallNextRight) {
    $direction = directionRightHand($direction);
    $currentPoint = $nextCoordinateRight;
    $settings['comment'] = 'Впереди и справа свободно. Иду направо.';
  } else {
    $currentPoint = $nextCoordinate;
    $settings['comment'] = 'Свободно только впереди, туда и иду.';
  }
}

/**
 * Функция определяет координаты следующие клетки текущего направления.
 * @param string $currentPoint - Текущие коорданаты путешественника.
 * @param string $direction - Текущее направление путешественника.
 * @return string Возвращаются координаты в строковом представлении x1_y1.
 */
function nextCoordinateDirection($currentPoint, $direction) {
  // Переводим координаты из строки в массив, типа ['x' => 1, 'y' => 1].
  $arr = coordinateStringInArr($currentPoint);
  switch ($direction) {
    case "up":
      return "x" . $arr['x'] . "_y" . --$arr['y'];
      break;
    case "right":
      return "x" . ++$arr['x'] . "_y" . $arr['y'];
      break;
    case "down":
      return "x" . $arr['x'] . "_y" . ++$arr['y'];
      break;
    default:
      return "x" . --$arr['x'] . "_y" . $arr['y'];
  }
}

/**
 * Функция определяет направление правой руки и возвращает его.
 * @param string $direction - Текущее направление путешественника.
 * @return string Возвращается направление по правой руке.
 */
function directionRightHand($direction) {
  switch ($direction) {
    case "up":
      return "right";
      break;
    case "right":
      return "down";
      break;
    case "down":
      return "left";
      break;
    default:
      return "up";
  }
}

/**
 * Функция определяет направление левой руки и возвращает его.
 * @param string $direction - Текущее направление путешественника.
 * @return string Возвращается направление по левой руке.
 */
function directionLeftHand($direction) {
  switch ($direction) {
    case "up":
      return "left";
      break;
    case "left":
      return "down";
      break;
    case "down":
      return "right";
      break;
    default:
      return "up";
  }
}

// Запускаем карту путешественника в цикле. Цикл работает до тех пор
// пока текущая координата не будет равно координате выхода из лабиринта.
while ($settings['endPoint'] != $currentPoint) {
  render($settings, $walls, $currentPoint, $direction);
}