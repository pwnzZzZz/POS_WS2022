<?php

$errors = [];

function calculateBMI($height, $weight)
{
    $bmi = $weight / (($height / 100) * ($height / 100));

    return round($bmi, 1);
}


function validate($date, $name, $height, $weight)
{
    return validateDate($date) & validateName($name) & validateHeight($height) & validateWeight($weight);
}

function validateDate($date)
{
    global $errors;
    try {
        if ($date == "") {
            $errors['date'] = "Datum darf nicht leer sein!";
            return false;
        } else if (new DateTime($date) > new DateTime()) {
            $errors['date'] = "Datum darf nicht in der Zukunft liegen!";
            return false;
        } else {
            return true;
        }
    } catch (Exception $e) {
        $errors['date'] = "Datum ungültig!";
        return false;
    }
}

function validateName($name)
{
    global $errors;

    if ($name == "") {
        $errors['name'] = "Name darf nicht leer sein!";
        return false;
    } else if (strlen($name) > 25) {
        $errors['name'] = "Name darf nicht länger als 25 Zeichen sein!";
        return false;
    } else {
        return true;
    }
}

function validateHeight($height)
{

    global $errors;

    if (is_numeric($height)) {

        if ($height < 1) {
            $errors['height'] = "Größe darf nicht unter 1cm liegen";
            return false;
        } else if ($height > 300) {
            $errors['height'] = "Größe darf nicht über 300cm liegen";
            return false;
        } else {
            return true;
        }
    } else if ($height == "") {
        $errors['height'] = "Größe darf nicht leer sein";
    } else {
        $errors['height'] = "Bitte geben Sie Ihre Größe numerisch ein";
        return false;
    }
}

function validateWeight($weight)
{

    global $errors;

    if (is_numeric($weight)) {
        if ($weight <= 1) {
            $errors['weight'] = "Gewicht darf nicht unter 1kg liegen";
            return false;
        } else if ($weight > 500) {
            $errors['weight'] = "Gewicht darf nicht über 500kg liegen";
            return false;
        } else {
            return true;
        }
    } else if ($weight == "") {
        $errors['weight'] = "Gewicht darf nicht leer sein";
    } else {
        $errors['weight'] = "Bitte geben Sie Ihr Gewicht numerisch ein";
        return false;
    }
}
