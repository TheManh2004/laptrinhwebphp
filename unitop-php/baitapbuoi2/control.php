<?php

function sumArray($arr) {
    return array_sum($arr);
}

// Hàm tìm giá trị lớn nhất trong mảng
function maxArray($arr) {
    return max($arr);
}

// Hàm tìm giá trị nhỏ nhất trong mảng
function minArray($arr) {
    return min($arr);
}

// Hàm sắp xếp mảng theo thứ tự tăng dần
function sortArrayAscending($arr) {
    sort($arr);
    return $arr;
}

// Hàm sắp xếp mảng theo thứ tự giảm dần
function sortArrayDescending($arr) {
    rsort($arr);
    return $arr;
}
?>
