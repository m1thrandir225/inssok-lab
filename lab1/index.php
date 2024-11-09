<?php

$students = [
  ["name" => "Kiril", "age" => 20, "grades" => array(8, 8, 9)],
  ["name" => "Marko", "age" => 21, "grades" => array(8, 6, 9)],
  ["name" => "Angela", "age" => 21, "grades" => array(7, 7, 9)],
  ["name" => "Petar", "age" => 22, "grades" => array(8, 8, 9)],
  ["name" => "Marija", "age" => 19, "grades" => array(6, 6, 8)]
];

function calculateAverage($grades) {
  $sum = array_sum($grades);

  return round($sum/count($grades), 2);
}

function filterByAge($students, $minAge) {
  $result = [];

  foreach ($students as $student) {
    if ($student['age'] >= $minAge) {
      array_push($result, $student);
    }
  }

  return $result;
}

function capitalizeNames($students) {
  foreach ($students as $student) {
    ucfirst($student['name']);
  }
}

function displayStudents($students) {
  foreach ($students as $student) {
    print("Name: " . $student["name"] . ", Age: " . $student["age"] . ", Average Grade: " . calculateAverage($student["grades"]) . "\n");
  }
}

function sortByName(&$students) {
  foreach($students as $student) {
    lcfirst($student["name"]);
  }

  sort($students);
}


sortByName($students);
capitalizeNames($students);
displayStudents($students)


?>
