<?php

/*
 *  TASK
    Write a PHP function to print the next character of a specific character.
    input : 'a'
    Output : 'b'
    input : 'z'
    Output : 'a'
*/

function nextChar($char)
{
    $next = ++$char;
    if (strlen($next) > 1) {
        return $next[0];
    } else {
        return $next;
    }
}

function nextChar1($char)
{
    // with for loop
    $char = strtolower($char);
    $alphaArray = range('a', 'z');
    $arrayLength = count($alphaArray);
    for ($i = 0; $i < $arrayLength; $i++) {
        if ($alphaArray[$i] == $char) {
            if ($i == $arrayLength - 1)
                return $alphaArray[0];
            else
                return $alphaArray[$i + 1];
        }
    }
}

function nextChar2($char)
{
    // with foreach
    $char = strtolower($char);
    $alphaArray = range('a', 'z');
    foreach ($alphaArray as $element) {
        if ($element == $char) {
            $next = ++$element;
            if (strlen($next) > 1) {
                return $next[0];
            } else {
                return $next;
            }
        }
    }
}

// Enter your char here!
echo 'Result of function 1: '.nextChar('z').'<br>';
echo 'Result of function 2: '.nextChar1('z').'<br>';
echo 'Result of function 3: '.nextChar2('z').'<br>';