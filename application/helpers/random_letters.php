<?
function random_word($word_len)
{
    $i = 0;
    $word = '';
    $symbols = "QWERTYUOPASDFGHKsdfghkZXCVBNMfpouytrewqaznmxcvb234567890";
    while($i<$word_len) {
        $word .= $symbols[mt_rand(0, strlen($symbols)-1)];
        $i++;
    }
return $word;
}