<?PHP
$tr_types = [
    'тип не выбран',
    'Промышленность',
    'Логистика',
    'FMCG',
    'Здравоохранение',
    'СМИ',
    'Розничная торговля',
    'Финансы/страхование',
    'IT',
    'Недвижимость',
    'Отели/Рестораны',
    'Консалтинг',
    'Некоммерческий сектор',
    'Энергетика/Сырье',
    'Наука/образование'
];
$tr_Stypes = [
    '',
    [//1
        'подтип не выбран',
        'Химическое производство',
        'Строительные материалы',
        'Тара и упаковка',
        'Металлургия',
        'Целлюлозная промышленность',
        'Оборонная промышленность',
        'Оборудование',
        'Машиностроение',
        'Автомобили'
    ],
    [//2
        'подтип не выбран',
        'Авиаперевозки',
        'Морские перевозки',
        'Авто и жд перевозки',
        'Инфраструктура'
    ],
    [//3
        'подтип не выбран',
        'Одежда и обувь',
        'Бытовые товары',
        'Табачная продукция',
        'Бытовые товары',
        'Алкогольная продукция',
        'Продукты питания'
    ],
    [//4
        'подтип не выбран',
        'Мед оборудование',
        'Фармацевтическая продукции',
        'Медицинские услуги',
        'Торговля лекарствами'
    ],
    [//5
        'подтип не выбран',
        'Реклама',
        'Теле и радиовещание',
        'Телевидение',
        'Издательство'
    ],
    [//6
        'подтип не выбран',
        'Торговля по каталогам',
        'Интернет торговля',
        'Одежда',
        'Компьютеры и комплектующие',
        'Бытовые товары',
        'Автомобили',
        'Продукты питания',
        'Торговый центр',
        'Смешанный ассортимент',
        'Бытовая техника'
    ],
    [//7
        'подтип не выбран',
        'Банк',
        'Финансовые услуги',
        'Страхование',
        'Рынки капитала'
    ],
    [//8
        'подтип не выбран',
        'Интернет',
        'Различные IT услуги',
        'Программное обеспечение',
        'Оборудование для связи',
        'Компьютерная техника',
        'Электронное оборудование',
        'Техника для офиса',
        'Услуги связи'
    ],
    [//9
        'подтип не выбран',
        'Коммунальные услуги',
        'Строительство',
        'Проектная организация',
        'Эксплуатация',
        'Девелопмент'
    ],
    [//10
        'подтип не выбран',
        'Туризм',
        'Досуг и отдых',
        'Общественное питание'
    ],
    [//11
        'подтип не выбран',
        'HR консалтинг',
        'IT консалтинг',
        'Аналитика',
        'Маркетинговый консалтинг',
        'Производственный консалтинг',
        'Управленческий консалтинг',
        'Финансовый консалтинг'
    ],
    [//12
        'подтип не выбран',
        'Госкорпорация',
        'Представительные органы',
        'Исполнительные органы',
        'Правоохранительные органы',
        'Некоммерческие организации'
    ],
    [//13
        'подтип не выбран',
        'Энергетическое оборудование',
        'Добыча энергоносителей',
        'Энергетич. инфраструктура'
    ],
    [//14
        'подтип не выбран',
        'Государственный сектор',
        'Предпринимательский сектор',
        'Сектор высшего образования',
        'Частный сектор'
    ]
];
function transl_com($db, $fieldName, $value)
{
    switch ($db)
    {
        case 'companies':
            switch ($fieldName)
            {
                case 'type':
                    return $tr_types[$value];
                    break;
                case 'subType':
                    $tst = explode (':', $value);
                    $tr_Stypes[$tst[0]][$tst[1]];
            }
            break;
        case 'salary':
            switch ($fieldName)
            {
                case 'goodRFS':
                    switch ($value)
                    {
                        case '1': return 'Специалист'; break;
                        case '2': return 'Менеджер'; break;
                        case '3': return 'Топ-менеджер'; break;
                    }
                    break;
            }
            break;
    }
    return $value;
}