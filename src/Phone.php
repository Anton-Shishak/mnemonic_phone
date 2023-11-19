<?php
declare(strict_types=1);

namespace Ashishak\MnemonicPhone;

class Phone
{
    CONST Schema = [
        '0' => ['0'],
        '1' => ['1'],
        '2' => ['A', 'B', 'C'],
        '3' => ['D', 'E', 'F'],
        '4' => ['G', 'H', 'I'],
        '5' => ['J', 'K', 'L'],
        '6' => ['M', 'N', 'O'],
        '7' => ['P', 'Q', 'R', 'S'],
        '8' => ['T', 'U', 'V'],
        '9' => ['W', 'X', 'Y', 'Z'],
    ];

    public function ConvertPhone(String $text, Int $lengthPhone = NULL) : String{
        //Проверяем переданную строку на заданный формат
        if (!preg_match("/^\d\-\d{3}\-[A-Z\-]+$/", $text)){
            return 'Ошибка: Указанный номер телефон не соответствует шаблону: 1-800-СALL-ME | 1-800-CALLME';
        } else{
            $text = str_replace('-', '', $text);
        }

        //Обрезаем переданный номер, согласно указанному формату
        if (!empty($lengthPhone))
        {
            if (preg_match("/^([A-Z\d]{".$lengthPhone."})\D*$/", $text, $match)){
                $text = $match[1];
            } else {
                return "Ошибка: длина номера телефона указанная в параметре lengthPhone больше переданного номера";
            }
        }

        //Преобразуем номер телефона
        foreach (self::Schema as $number => $letter){
            $text = str_replace($letter, "$number", $text);
        }

        //формат возвращаемого номера, всегда будет 1-800-352452
        return preg_replace("/^(\d)(\d{3})(\d+)/", "$1-$2-$3", $text);
    }
}